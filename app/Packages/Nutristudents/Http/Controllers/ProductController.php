<?php

declare(strict_types=1);

namespace Bytelaunch\Nutristudents\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Laravel\Jetstream\Jetstream;
use Illuminate\Routing\Controller;
use Laravel\Jetstream\RedirectsActions;
use Illuminate\Support\Facades\Validator;
use Bytelaunch\Nutristudents\Models\Product;
use Bytelaunch\Nutristudents\Models\Allergen;
use Bytelaunch\Nutristudents\Models\Component;
use Bytelaunch\Nutristudents\Models\Distributor;
use Bytelaunch\Nutristudents\Models\UnitOfMeasurement;
use Bytelaunch\Nutristudents\Models\Category;
use Bytelaunch\Nutristudents\Actions\Products\CreateProductAction;
use Bytelaunch\Nutristudents\Actions\Products\UpdateProductAction;
use Bytelaunch\Nutristudents\Actions\Products\CopyProductAction;
use Bytelaunch\Nutristudents\Actions\Products\DeleteProductAction;
use Bytelaunch\Nutristudents\Models\MenuCycle;

class ProductController extends Controller
{
    use RedirectsActions;

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Inertia\Response
     */
    public function index(Request $request) : Response
    {
        
        $products_val   = Product::orderBy('name','asc')->paginate(100);

        // dd($products_val[0]->toArray());
        $category_val   = Category::whereNull('parent_id')->orderBy('name','asc')->get();
        
        $menu_user_ids = MenuCycle::distinct()->has('user')->get(['user_id'])->toArray();
        $menu_users = [];
        foreach($menu_user_ids as $menu_user_id){
         if($menu_user_id['user_id'] > 0){
         $menu_users[] = User::where('id',$menu_user_id['user_id'])->orderBy('name','asc')->get(['id','name'])->toArray();
         }
        }
       
         usort($menu_users, function($a, $b)
         {  
            return strcmp($a[0]['name'], $b[0]['name']);
         });
        $tenant_names = [];
        $p = Product::select('tenant_id')->groupBy('tenant_id')->with(['tenant'])->get();
        foreach($p as $ps)
        {
            $tenant_names[] = ['id'=> $ps->tenant_id, 'name' => $ps->tenant_name];
        }


        
        $search = '';
        $filter = '';
        $subfilter = '';
        if($request->query('search')){
        $search = $request->query('search');
        $products_val = Product::whereRaw("LOWER(name) LIKE '%".strtolower($search)."%'")->orderBy('name','asc')->paginate(100);
        $products_val->appends(request()->query());        
        }

        if($request->query('filter')){
        $filter = $request->query('filter');
        $products_val = Product::where('primary_category_id', $filter)->orderBy('name','asc')->paginate(100);
        $products_val->appends(request()->query());        
        }

        if($request->query('subfilter')){
        $subfilter = $request->query('subfilter');
        $products_val = Product::where('primary_sub_category_id', $subfilter)->orderBy('name','asc')->paginate(100);
        $products_val->appends(request()->query());        
        }

        $products_val->map(function($item, $key) {
        $item->append('is_tenant_admin');
        $item->append('tenant_name');
        $item->category_name = Category::where('id',$item->primary_category_id)->pluck('name');
        $item->sub_category_name = Category::where('id',$item->primary_sub_category_id)->pluck('name');
        });
        
        // dd($products_val->toArray());
        // dd($tenant_names);
        return Jetstream::inertia()->render($request, 'Products/Products', [
               'product_data'   => $products_val,
               'categories'     => $category_val,
               'prod_searched'  => $search,
               'prod_filter'    => $filter,
               'prod_subfilter' => $subfilter,
               'menu_users' =>$menu_users,
               'tenant_names' => $tenant_names
        ]);
    }

    public function products_add(Request $request) : Response
    {

        $allergen             = Allergen::get();
        $categories_val       = Category::whereNull('parent_id')->orderBy('name', 'asc')->get();
        $distributors_val     = Distributor::orderBy('name', 'asc')->get();
        $mass_measurements    = UnitOfMeasurement::massMeasurements();
        $unit_measurements    = UnitOfMeasurement::unitMeasurements();
        $volume_measurements  = UnitOfMeasurement::volumeMeasurements();

        $menu_user_ids = MenuCycle::distinct()->has('user')->get(['user_id'])->toArray();
        $menu_users = [];
        foreach($menu_user_ids as $menu_user_id){
         if($menu_user_id['user_id'] > 0){
         $menu_users[] = User::where('id',$menu_user_id['user_id'])->orderBy('name','asc')->get(['id','name'])->toArray();
         }
        }
       
         usort($menu_users, function($a, $b)
         {  
            return strcmp($a[0]['name'], $b[0]['name']);
         });

        return Jetstream::inertia()->render($request, 'Products/Products-add', [
               'allergens' => $allergen,
               'categories' => $categories_val,
               'distributors' => $distributors_val,
               'mass_measurements' => $mass_measurements,
               'unit_measurements' => $unit_measurements,
               'volume_measurements' => $volume_measurements,
               'menu_users' => $menu_users
        ]);
    }

    public function get_prod_subcategories(Request $request)
    {
          if($request->json('category_id') != ""){
          $subcat_val = Category::where('parent_id',$request->json('category_id'))->orderBy('name', 'asc')->get();
          }else{
          $subcat_val = [];
          }
          return response()->json($subcat_val);
    }

    public function products_add_save(Request $request)
    {
        $request->validate([
          'pname' => 'required|string',
          'pmanufacturer' => 'required|string',
          'pmanufacturer_sku' => 'required',
          'primary_cat_val' => 'required',
          'primary_subcat_val' => 'required',
        ],[
          'pname.required' => 'Product name is required.',
          'pmanufacturer.required' => 'Manufacturer name is required.',
          'pmanufacturer_sku.required' => 'Manufacturer SKU is required.',
          'primary_cat_val.required' => 'Primary category is required.',
          'primary_subcat_val.required' => 'Primary subcategory is required.',
        ]);  

        if($request->pyield == null) $request->pyield = 100;
        
        //dd($request->all());
        $product = (new CreateProductAction)
            ->setName(strval($request->pname))
            ->setManufacturer(strval($request->pmanufacturer))
            ->setManufacturerNumber(strval($request->pmanufacturer_sku))
            ->setGTINNumber(strval($request->pgtin))
            ->setYieldPercentage($this->convertIntValue($request->pyield))
            ->setPrimaryCategoryId(strval($request->primary_cat_val))
            ->setPrimarySubCategoryId(strval($request->primary_subcat_val));
        
        // if(!empty($request->user_id)){
        //     $product->setUserId($request->user_id);
        // }

        if(!empty($request->case_weight) && !empty($request->case_mass_uom)){
        $product->setCaseWeight($this->convertFloatValue($request->case_weight), UnitOfMeasurement::find($request->case_mass_uom));
        }

        if(!empty($request->sub_case_weight) && !empty($request->subcase_mass_uom)){
        $product->setSubCaseWeight($this->convertFloatValue($request->sub_case_weight), UnitOfMeasurement::find($request->subcase_mass_uom));
        }

        if(!empty($request->case_volume) && !empty($request->case_vol_uom)){
        $product->setCaseVolume($this->convertFloatValue($request->case_volume), UnitOfMeasurement::find($request->case_vol_uom));
        }

        if(!empty($request->sub_case_volume) && !empty($request->case_vol_sub_uom)){
        $product->setSubCaseVolume($this->convertFloatValue($request->sub_case_volume), UnitOfMeasurement::find($request->case_vol_sub_uom));
        }

        if(!empty($request->mass_measurements) && !empty($request->mass_measurements_uom)){
            $product->setServingMeasurementWeight($this->convertFloatValue($request->mass_measurements), UnitOfMeasurement::find($request->mass_measurements_uom));
        }

        if(!empty($request->volume_measurement) && !empty($request->volume_measurement_uom)){
        $product->setServingMeasurementVolume($this->convertFloatValue($request->volume_measurement), UnitOfMeasurement::find($request->volume_measurement_uom));
        }

        if(!empty($request->unit_measurement) && !empty($request->unit_measurement_uom)){
            $product->setServingMeasurementUnit($this->convertFloatValue($request->unit_measurement), UnitOfMeasurement::find($request->unit_measurement_uom));
        }

        $product->setCaseQuantity($this->convertIntValue($request->case_qty))->setSubCaseQuantity($this->convertIntValue($request->sub_case_qty))->setUsdaComponentMeatServing(($request->usda_componenent_serving_meat))
            ->setUsdaComponentGrainServing($this->convertFloatValue($request->usda_componenent_serving_grain))
            ->setUsdaComponentFruitServing($this->convertFloatValue($request->usda_componenent_serving_fruit))
            ->setUsdaComponentMilkServing($this->convertFloatValue($request->usda_componenent_serving_milk))
            ->setUsdaComponentVegServing($this->convertFloatValue($request->usda_componenent_serving_veg))
            ->setUsdaComponentVegLegServing($this->convertFloatValue($request->usda_componenent_serving_vegleg))
            ->setUsdaComponentVegRedServing($this->convertFloatValue($request->usda_componenent_serving_vegred))
            ->setUsdaComponentVegGrnServing($this->convertFloatValue($request->usda_componenent_serving_veggrn))
            ->setUsdaComponentVegStarServing($this->convertFloatValue($request->usda_componenent_serving_vegstar))
            ->setUsdaComponentVegOthrServing($this->convertFloatValue($request->usda_componenent_serving_vegothr));

        if(!empty($request->nutrition_facts_weight) && !empty($request->nutrition_mass_measurement)){
            $product->setNutritionFactWeight($this->convertFloatValue($request->nutrition_facts_weight), UnitOfMeasurement::find($request->nutrition_mass_measurement));
        }

        if(!empty($request->nutrition_facts_volume) && !empty($request->nutrition_vol_measurement)){
            $product->setNutritionFactVolume($this->convertFloatValue($request->nutrition_facts_volume), UnitOfMeasurement::find($request->nutrition_vol_measurement));
        }

        if(!empty($request->nutrition_facts_unit) && !empty($request->nutrition_unit_measurement)){
            $product->setNutritionFactUnit($this->convertFloatValue($request->nutrition_facts_unit), UnitOfMeasurement::find($request->nutrition_unit_measurement));
        }

        $product->setNutritionFactCalories($this->convertFloatValue($request->nutrition_facts_calories))
            ->setNutritionFactCalFat($this->convertFloatValue($request->nutrition_facts_calfat))
            ->setNutritionFactTotalFat($this->convertFloatValue($request->nutrition_facts_totalfat))
            ->setNutritionFactSatFat($this->convertFloatValue($request->nutrition_facts_satfat))
            ->setNutritionFactTransFat($this->convertFloatValue($request->nutrition_facts_transfat))
            ->setNutritionFactPolySatFat($this->convertFloatValue($request->nutrition_facts_polysatfat))
            ->setNutritionFactMonoSatFat($this->convertFloatValue($request->nutrition_facts_monosatfat))
            ->setNutritionFactCholesterol($this->convertFloatValue($request->nutrition_facts_cholesterol))
            ->setNutritionFactSodium($this->convertFloatValue($request->nutrition_facts_sodium))
            ->setNutritionFactPotassium($this->convertFloatValue($request->nutrition_facts_potassium))
            ->setNutritionFactCarbs($this->convertFloatValue($request->nutrition_facts_carbs))
            ->setNutritionFactFiber($this->convertFloatValue($request->nutrition_facts_fiber))
            ->setNutritionFactSugar($this->convertFloatValue($request->nutrition_facts_sugar))
            ->setNutritionFactProtein($this->convertFloatValue($request->nutrition_facts_protein))
            ->setNutritionFactVitaminA($this->convertFloatValue($request->nutrition_facts_vitamina))
            ->setNutritionFactVitaminB6($this->convertFloatValue($request->nutrition_facts_vitaminb6))
            ->setNutritionFactVitaminB12($this->convertFloatValue($request->nutrition_facts_vitaminb12))
            ->setNutritionFactVitaminC($this->convertFloatValue($request->nutrition_facts_vitaminc))
            ->setNutritionFactVitaminD($this->convertFloatValue($request->nutrition_facts_vitamind))
            ->setNutritionFactVitaminE($this->convertFloatValue($request->nutrition_facts_vitamine))
            ->setNutritionFactCalcium($this->convertFloatValue($request->nutrition_facts_calcium))
            ->setNutritionFactIron($this->convertFloatValue($request->nutrition_facts_iron))
            ->setNutritionFactMagnesium($this->convertFloatValue($request->nutrition_facts_magnesium))
            ->setNutritionFactCoblamin($this->convertFloatValue($request->nutrition_facts_coblamin))
            ->setNutritionFactThiamin($this->convertFloatValue($request->nutrition_facts_thiamin))
            ->setNutritionFactRiboflavin($this->convertFloatValue($request->nutrition_facts_riboflavin))
            ->setNutritionFactNiacin($this->convertFloatValue($request->nutrition_facts_niacin))
            ->setNutritionFactZinc($this->convertFloatValue($request->nutrition_facts_zinc))
            ->setNutritionFactWater($this->convertFloatValue($request->nutrition_facts_water))
            ->setNutritionFactAsh($this->convertFloatValue($request->nutrition_facts_ash));

            // $pcategory_val = Component::find($request->primary_cat_val);
            // $psubcat_val = Component::find($request->primary_subcat_val);
            // if(!empty($pcategory_val)){
            //    $product->attachComponent($pcategory_val, $psubcat_val, true);
            // }

            if(!empty($request->secondary_subcat_ids)){
                foreach($request->secondary_subcat_ids as $secondary_subcat_id){
                  $secondary_subcat = Category::find($secondary_subcat_id);
                  $product->attachSecondSubCategories($secondary_subcat);
                }
            }

            $distributor = Distributor::find($request->distributor_id_val);
            if(!empty($distributor)){
                $product->setDistrubutor($distributor);
            }

            $tagsVals = $request->product_tags_val;
            foreach($tagsVals as $tagsVal){
                $product->attachTag($tagsVal);
            }

            $allergenIDs = $request->product_allergen_ids;
            foreach($allergenIDs as $allergenID){
                $allergenbyID = Allergen::find($allergenID);
                $product->attachAllergen($allergenbyID);
            }

            $product->create();

            return redirect()->route('products');

    }


    public function products_edit(Request $request, Product $product) : Response
    {
           $productbyId = Product::with(['allergens','tags','categories','user'])->find($product->id);
           $productbyId->append('is_tenant_admin');
        //    dd($productbyId->IsTenantAdmin);
           
           $allergen             = Allergen::get();
           $categories_val       = Category::whereNull('parent_id')->orderBy('name', 'asc')->get();
           $subcategories_val    = Category::where('parent_id',$productbyId->primary_category_id)->orderBy('name', 'asc')->get()->toArray();
           $distributors_val     = Distributor::orderBy('name', 'asc')->get();
           $mass_measurements    = UnitOfMeasurement::massMeasurements();
           $unit_measurements    = UnitOfMeasurement::unitMeasurements();
           $volume_measurements  = UnitOfMeasurement::volumeMeasurements();

           $product_tags         = $productbyId->tags->pluck('name')->toArray();
           $product_allergens    = $productbyId->allergens->pluck('id')->toArray();

           $second_categories    = array();
           $second_categories_subcat = array();
           $second_subcategories = array();

           if(!empty($productbyId->categories)){
           foreach($productbyId->categories as $second_subcategory){
             $second_categories[] = Category::where('id',$second_subcategory->parent_id)->value('id');
             $second_categories_subcat[] = Category::where('parent_id',$second_subcategory->parent_id)->get()->toArray();
             $second_subcategories[] = $second_subcategory->id;
           }
           }


            $menu_user_ids = MenuCycle::distinct()->has('user')->get(['user_id'])->toArray();
            $menu_users = [];
            foreach($menu_user_ids as $menu_user_id){
            if($menu_user_id['user_id'] > 0){
            $menu_users[] = User::where('id',$menu_user_id['user_id'])->orderBy('name','asc')->get(['id','name'])->toArray();
            }
            }
        
            usort($menu_users, function($a, $b)
            {  
                return strcmp($a[0]['name'], $b[0]['name']);
            });

        
        return Jetstream::inertia()->render($request, 'Products/Products-edit', [
           'product' => $productbyId,
           'second_categories' => $second_categories,
           'second_subcategories' => $second_subcategories,
           'second_categories_subcat' => $second_categories_subcat,
           'product_tags' => $product_tags,
           'product_allergens' => $product_allergens,
           'allergens' => $allergen,
           'categories' => $categories_val,
           'subcategories' => $subcategories_val,
           'distributors' => $distributors_val,
           'mass_measurements' => $mass_measurements,
           'unit_measurements' => $unit_measurements,
           'volume_measurements' => $volume_measurements,
           'menu_users'=>$menu_users
        ]);
    }

    public function products_edit_save(Request $request, Product $product)
    {
        $validator = $request->validate([
          'pname' => 'required|string',
          'pmanufacturer' => 'required|string',
          'pmanufacturer_sku' => 'required',
          'primary_cat_val' => 'required',
          'primary_subcat_val' => 'required',
        ],[
          'pname.required' => 'Product name is required.',
          'pmanufacturer.required' => 'Manufacturer name is required.',
          'pmanufacturer_sku.required' => 'Manufacturer SKU is required.',
          'primary_cat_val.required' => 'Primary category is required.',
          'primary_subcat_val.required' => 'Primary subcategory is required.',
        ]);

        if($request->pyield == null) $request->pyield = 100;                
        
        $product_update = (new UpdateProductAction) 
            ->setProduct($product)
            ->setName(strval($request->pname))
            ->setManufacturer(strval($request->pmanufacturer))
            ->setManufacturerNumber(strval($request->pmanufacturer_sku))
            ->setGTINNumber(strval($request->pgtin))
            ->setYieldPercentage($this->convertIntValue($request->pyield))
            ->setPrimaryCategoryId(strval($request->primary_cat_val))
            ->setPrimarySubCategoryId(strval($request->primary_subcat_val));

        if(!empty($request->case_weight) && !empty($request->case_mass_uom)){
            $product_update->setCaseWeight($this->convertFloatValue($request->case_weight), UnitOfMeasurement::find($request->case_mass_uom));
        }

        // if(!empty($request->user_id) && !empty($request->user_id)){
        //     $product_update->setUserId($request->user_id);
        // }

        if(!empty($request->sub_case_weight) && !empty($request->subcase_mass_uom)){
            $product_update->setSubCaseWeight($this->convertFloatValue($request->sub_case_weight), UnitOfMeasurement::find($request->subcase_mass_uom));
        }

        if(!empty($request->case_volume) && !empty($request->case_vol_uom)){
            $product_update->setCaseVolume($this->convertFloatValue($request->case_volume), UnitOfMeasurement::find($request->case_vol_uom));
        }

        if(!empty($request->sub_case_volume) && !empty($request->case_vol_sub_uom)){
            $product_update->setSubCaseVolume($this->convertFloatValue($request->sub_case_volume), UnitOfMeasurement::find($request->case_vol_sub_uom));
        }

        if(!empty($request->weight_measurement) && !empty($request->mass_measurements_uom))
        {                
            $uom_val1 = UnitOfMeasurement::find($request->mass_measurements_uom);
            $product_update->setServingMeasurementWeight($this->convertFloatValue($request->weight_measurement), $uom_val1);
        }        

        if(!empty($request->volume_measurement) && !empty($request->volume_measurement_uom))
        {
            $uom_val2 = UnitOfMeasurement::find($request->volume_measurement_uom);            
            $product_update->setServingMeasurementVolume($this->convertFloatValue($request->volume_measurement), $uom_val2);
        }

        if(!empty($request->unit_measurement) && !empty($request->unit_measurement_uom))
        {
            $uom_val3 = UnitOfMeasurement::find($request->unit_measurement_uom);
            $product_update->setServingMeasurementUnit($this->convertFloatValue($request->unit_measurement), $uom_val3);
        }

        $product_update->setCaseQuantity($this->convertIntValue($request->case_qty))->setSubCaseQuantity($this->convertIntValue($request->sub_case_qty))->setUsdaComponentMeatServing($this->convertFloatValue($request->usda_componenent_serving_meat))
            ->setUsdaComponentGrainServing($this->convertFloatValue($request->usda_componenent_serving_grain))
            ->setUsdaComponentFruitServing($this->convertFloatValue($request->usda_componenent_serving_fruit))
            ->setUsdaComponentMilkServing($this->convertFloatValue($request->usda_componenent_serving_milk))
            ->setUsdaComponentVegServing($this->convertFloatValue($request->usda_componenent_serving_veg))
            ->setUsdaComponentVegLegServing($this->convertFloatValue($request->usda_componenent_serving_vegleg))
            ->setUsdaComponentVegRedServing($this->convertFloatValue($request->usda_componenent_serving_vegred))
            ->setUsdaComponentVegGrnServing($this->convertFloatValue($request->usda_componenent_serving_veggrn))
            ->setUsdaComponentVegStarServing($this->convertFloatValue($request->usda_componenent_serving_vegstar))
            ->setUsdaComponentVegOthrServing($this->convertFloatValue($request->usda_componenent_serving_vegothr));

        if(!empty($request->nutrition_facts_weight) && !empty($request->nutrition_mass_measurement))
        {
            $uomn_val1 = UnitOfMeasurement::find($request->nutrition_mass_measurement);
            $product_update->setNutritionFactWeight($this->convertFloatValue($request->nutrition_facts_weight), $uomn_val1);
        }

        if(!empty($request->nutrition_facts_volume) && !empty($request->nutrition_vol_measurement))
        {
            $uomn_val2 = UnitOfMeasurement::find($request->nutrition_vol_measurement);
            $product_update->setNutritionFactVolume($this->convertFloatValue($request->nutrition_facts_volume), $uomn_val2);
        }

        if(!empty($request->nutrition_facts_unit) && !empty($request->nutrition_unit_measurement))
        {
            $uomn_val3 = UnitOfMeasurement::find($request->nutrition_unit_measurement);
            $product_update->setNutritionFactUnit($this->convertFloatValue($request->nutrition_facts_unit), $uomn_val3);
        }

        $product_update->setNutritionFactCalories($this->convertFloatValue($request->nutrition_facts_calories))->setNutritionFactCalFat($this->convertFloatValue($request->nutrition_facts_calfat))
            ->setNutritionFactTotalFat($this->convertFloatValue($request->nutrition_facts_totalfat))
            ->setNutritionFactSatFat($this->convertFloatValue($request->nutrition_facts_satfat))
            ->setNutritionFactTransFat($this->convertFloatValue($request->nutrition_facts_transfat))
            ->setNutritionFactPolySatFat($this->convertFloatValue($request->nutrition_facts_polysatfat))
            ->setNutritionFactMonoSatFat($this->convertFloatValue($request->nutrition_facts_monosatfat))
            ->setNutritionFactCholesterol($this->convertFloatValue($request->nutrition_facts_cholesterol))
            ->setNutritionFactSodium($this->convertFloatValue($request->nutrition_facts_sodium))
            ->setNutritionFactPotassium($this->convertFloatValue($request->nutrition_facts_potassium))
            ->setNutritionFactCarbs($this->convertFloatValue($request->nutrition_facts_carbs))
            ->setNutritionFactFiber($this->convertFloatValue($request->nutrition_facts_fiber))
            ->setNutritionFactSugar($this->convertFloatValue($request->nutrition_facts_sugar))
            ->setNutritionFactProtein($this->convertFloatValue($request->nutrition_facts_protein))
            ->setNutritionFactVitaminA($this->convertFloatValue($request->nutrition_facts_vitamina))
            ->setNutritionFactVitaminB6($this->convertFloatValue($request->nutrition_facts_vitaminb6))
            ->setNutritionFactVitaminB12($this->convertFloatValue($request->nutrition_facts_vitaminb12))
            ->setNutritionFactVitaminC($this->convertFloatValue($request->nutrition_facts_vitaminc))
            ->setNutritionFactVitaminD($this->convertFloatValue($request->nutrition_facts_vitamind))
            ->setNutritionFactVitaminE($this->convertFloatValue($request->nutrition_facts_vitamine))
            ->setNutritionFactCalcium($this->convertFloatValue($request->nutrition_facts_calcium))
            ->setNutritionFactIron($this->convertFloatValue($request->nutrition_facts_iron))
            ->setNutritionFactMagnesium($this->convertFloatValue($request->nutrition_facts_magnesium))
            ->setNutritionFactCoblamin($this->convertFloatValue($request->nutrition_facts_coblamin))
            ->setNutritionFactThiamin($this->convertFloatValue($request->nutrition_facts_thiamin))
            ->setNutritionFactRiboflavin($this->convertFloatValue($request->nutrition_facts_riboflavin))
            ->setNutritionFactNiacin($this->convertFloatValue($request->nutrition_facts_niacin))
            ->setNutritionFactZinc($this->convertFloatValue($request->nutrition_facts_zinc))
            ->setNutritionFactWater($this->convertFloatValue($request->nutrition_facts_water))
            ->setNutritionFactAsh($this->convertFloatValue($request->nutrition_facts_ash));


            // $component_cat = Component::find($request->component_cat_val);
            // $subcomponent_cat = Component::find($request->component_subcat_val);
            // if(!empty($component_cat)){
            // $product_update->attachComponent($component_cat, $subcomponent_cat, true);
            // }


            if(!empty($request->secondary_subcat_ids)){
                foreach($request->secondary_subcat_ids as $secondary_subcat_id){
                  $secondary_subcat = Category::find($secondary_subcat_id);
                  $product_update->attachSecondSubCategories($secondary_subcat);
                }
            }


            $distributor = Distributor::find($request->distributor_id_val);
            if(!empty($distributor)){
            $product_update->setDistrubutor($distributor);
            }

            $tagsVals = $request->product_tags_val;
            foreach($tagsVals as $tagsVal){
                $product_update->attachTag($tagsVal);
            }

            $allergenIDs = $request->product_allergen_ids;
            foreach($allergenIDs as $allergenID){
                $allergenbyID = Allergen::find($allergenID);
                $product_update->attachAllergen($allergenbyID);
            }
        
        //dd($request->all());
        $product_update->update();

        return redirect()->route('products');
    }

    public function product_copy(Request $request, Product $product)
    {
    $new_product = (new CopyProductAction())
                    ->sourceProduct($product)
                    ->copy();

    return redirect()->route('products_edit',['product' => $new_product->id]);
    }

    public function product_delete(Request $request, Product $product)
    {
    $delete_product = (new DeleteProductAction())
                    ->sourceProduct($product)
                    ->deleteProduct();

    return redirect()->route('products');
    }

    public function product_search_filter(Request $request)
    {
        $search_filter  = $request->json('type');

        if($search_filter == 'search'){
            $term            = $request->json('term'); 
            $products_search = Product::SearchByName(strtolower($term))->orderBy('name','asc')->paginate(100);
        }
        if($search_filter == 'filter'){
            $cat_id         = $request->json('term'); 
            $products_search = Product::where('primary_category_id', $cat_id)->orderBy('name','asc')->paginate(100);
        }   
        if($search_filter == 'filter2'){
            $cat_id          = $request->json('term'); 
            $products_search = Product::where('primary_sub_category_id', $cat_id)->orderBy('name','asc')->paginate(100);
        }
        if($search_filter == 'filter3'){
            $cat_id          = $request->json('term');
            if($cat_id == 'USDA'){
                $products_search = Product::where('cn_code', '!=', null)->orderBy('name','asc')->paginate(100);
            }else{
                $products_search = Product::where('tenant_id', $cat_id)->orderBy('name','asc')->paginate(100);
            } 
            
        }     

        $products_search->map(function($item, $key) {
            $item->append('is_tenant_admin');
            $item->append('tenant_name');
        $item->category_name = Category::where('id',$item->primary_category_id)->pluck('name');
        $item->sub_category_name = Category::where('id',$item->primary_sub_category_id)->pluck('name');
        });

        return response()->json($products_search);
    }


    public function convertFloatValue($value = null){
        if(!is_null($value)){
         return floatval($value);
        }else{
         return null;
        }
    }

    public function convertIntValue($value = null){
        if(!is_null($value)){
         return intval($value);
        }else{
         return null;
        }
    }
}
