<?php

declare(strict_types=1);

namespace Bytelaunch\Nutristudents\Http\Controllers;

use App\Packages\Nutristudents\Mutators\ComponentServing;
use Bytelaunch\Nutristudents\Actions\MenuCreationGroups\CreateMenuCreationGroupAction;
use Bytelaunch\Nutristudents\Actions\MenuCreationGroups\CreateMenuCreationGroupOfferingAction;
use Bytelaunch\Nutristudents\Actions\MenuCreationGroups\DeleteMenuCreationAction;
use Bytelaunch\Nutristudents\Actions\MenuCreationGroups\UpdateMenuCreationAction;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Laravel\Jetstream\Jetstream;
use Illuminate\Routing\Controller;
use Laravel\Jetstream\RedirectsActions;
use Illuminate\Support\Facades\Validator;
use Bytelaunch\Nutristudents\Models\Recipe;
use Illuminate\Support\Facades\DB;
use Bytelaunch\Nutristudents\Actions\Recipes\CreateRecipeAction;
use Bytelaunch\Nutristudents\Models\Ingredient;
use Bytelaunch\Nutristudents\Models\Product;
use Bytelaunch\Nutristudents\Models\UnitOfMeasurement;
use Bytelaunch\Nutristudents\Actions\Recipes\UpdateRecipeAction;
use Bytelaunch\Nutristudents\Actions\Recipes\CopyRecipeAction;
use Bytelaunch\Nutristudents\Actions\Recipes\DeleteRecipeAction;
use Bytelaunch\Nutristudents\Enum\CategoryEnum;
use Bytelaunch\Nutristudents\Models\AgeGradeOffering;
use Bytelaunch\Nutristudents\Models\Days;
use Bytelaunch\Nutristudents\Models\Haccp;
use Bytelaunch\Nutristudents\Models\MealType;
use Bytelaunch\Nutristudents\Models\MenuCreationGroup;
use Bytelaunch\Nutristudents\Models\MenuCreationGroupOffering;
use Bytelaunch\Nutristudents\Models\Offering;
use Bytelaunch\Nutristudents\Models\OfferingSite;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class MenuCreationGroupsController extends Controller
{
    use RedirectsActions;

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Inertia\Response
     */
    

    public function index(Request $request): Response
    {
        $groups = MenuCreationGroup::with(['age_grade','days','meal_type','guideline'])->orderBy('name', 'asc')->paginate(100);
        $mealTypes = MealType::select('id', 'name')->orderBy('name','asc')->get();
        $ageGradeOfferings = AgeGradeOffering::select('id', 'name')->orderBy('name','asc')->get();
        $days = Days::select('id', 'name')->orderBy('name','asc')->get();

        $search = '';
        $filter = '';
        if ($request->query('search')) {
            $search = $request->query('search');
            $groups = MenuCreationGroup::with(['age_grade','days','meal_type','guideline'])->SearchByAll($search)->orderBy('name', 'asc')->paginate(100);
            $groups->appends(request()->query());
        }

        $search_meal_type = '';

        return Jetstream::inertia()->render($request,  'MenuCreationGroups/MenuCreationGroups', [
            'groupss'=> $groups,
            'mealTypes' => $mealTypes,
            'ageGradeOfferings' => $ageGradeOfferings,
            'days' => $days,
            'rec_searched' => $search,
            'rec_filter' => $filter,
            'search_meal_type'=> ''
        ]);
    }


    public function searchFilter(Request $request)
    {
        
        $search_filter = $request->json('type');
        if ($search_filter == 'search') {
            $term = $request->json('term');
            $recipes_search = MenuCreationGroup::with(['age_grade','days','meal_type','guideline'])->SearchByAll($term)->orderBy('name', 'asc')->paginate(100);
        }
        if ($search_filter == 'filter') {
            $meal = $request->json('meal');
            $offrings = $request->json('offrings');
            $day = $request->json('day');

            $recipes_search = MenuCreationGroup::with(['age_grade','days','meal_type','guideline'])
            ->where('meal_type_id', $meal)
            ->orWhere('age_grade_offering_id', $offrings)
            ->orWhere('day_id', $day)
            ->orderBy('name', 'asc')
            ->paginate(100);

            // $recipes_search = MenuCreationGroup::where([
            //     ['meal_type_id', $meal],
            //     ['age_grade_offering_id', $offrings],
            //     ['day_id', $day]
            // ])->orderBy('name', 'asc')->paginate(100);
        }
       
        return response()->json($recipes_search);
    }

    public function create(Request $request): Response
    {

        $mealTypes = MealType::select('id', 'name')->orderBy('name','asc')->get();
        //$ageGradeOfferings = AgeGradeOffering::select('id', 'name')->where('type', 'Age')->orderBy('name','asc')->get();
        $ageGradeOfferings = AgeGradeOffering::orderBy('name','asc')->get();
        $days = Days::select('id', 'name')->orderBy('name','asc')->get();

        return Jetstream::inertia()->render($request, 'MenuCreationGroups/MenuCreationGroups-add', [
            'mealTypes' => $mealTypes,
            'ageGradeOfferings' => $ageGradeOfferings,
            'days' => $days
        ]);
    }

    public function edit(Request $request, $id): Response
    {
        
        $group = MenuCreationGroup::with(['age_grade','days','meal_type','guideline','offerings.site'])->find($id);
        $mealTypes = MealType::select('id', 'name')->orderBy('name','asc')->get();
        $ageGradeOfferings = AgeGradeOffering::orderBy('name','asc')->get();
        $days = Days::select('id', 'name')->orderBy('name','asc')->get();

        $offering_array = $group->offerings->toArray();

        return Jetstream::inertia()->render($request, 'MenuCreationGroups/MenuCreationGroups-edit', [
            'mealTypes' => $mealTypes,
            'ageGradeOfferings' => $ageGradeOfferings,
            'days' => $days,
            'group'=> $group,
            'offering_array'=> $offering_array
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',          
            'meal_type_id' => 'required|string',
            'age_grade_offering_id' => 'required|string',
            'day_id' => 'required|string', 
            'guideline_id'=>'required|string'
          ],[
            'name.required' => 'This field is required.',                    
            'meal_type_id.required' => 'This field is required.',
            'age_grade_offering_id.required' => 'This field is required.',
            'day_id.required' => 'This field is required.',
            'guideline_id.required' => 'This field is required.'
          ]);

          $menu_creation = MenuCreationGroup::find($id);

          $group = (new UpdateMenuCreationAction)
          ->setMenuCycle($menu_creation)
          ->setName($request->name)
          ->setMealType($request->meal_type_id)
          ->setAgeRange($request->age_grade_offering_id)
          ->setDays($request->day_id)
          ->setGuideline($request->guideline_id)
          ->setOffering($request->siteOfferings) 
          ->update();

          
          return redirect()->route('menu-creation-groups');
    }

    public function groupDelete(Request $request, MenuCreationGroup $group)
    {
        $removeRecipe = (new DeleteMenuCreationAction())
            ->sourceGroup($group)
            ->deleteGroup();

        return redirect()->route('menu-creation-groups');
    }

    public function siteOfferingSearch(Request $request){
        $site_offering = [];
        $exclude_offering = [];
        if($request->form['guideline_id'] != '' ){  
            $site_offering = Offering::with(['site'])->where('guideline_id', $request->form['guideline_id'])->get();
        }
        foreach($site_offering as $key=>$offering){
            $data = $this->verifyOfferingInGroup($key,$offering);
            if($data){
                $exclude_offering[] = $site_offering[$data]->id;
            }
        }
        $site_offerings = Offering::with(['site'])->where('guideline_id', $request->form['guideline_id'])->whereNotIn('id',$exclude_offering)->get();
      
        return response()->json($site_offerings);
    }

    public function verifyOfferingInGroup($index,$offering){
        $offering = MenuCreationGroupOffering::where('offering_id',$offering->id)->get()->first();
        if($offering){
            return $index;
        }
    }

    public function addMenuCreationSiteOffering(Request $request){
        $group = (new CreateMenuCreationGroupOfferingAction())
        ->setGroupId($request->group_id)
        ->setOfferingId($request->offering_id)
        ->create();
        return response()->json($group);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string',          
            'meal_type_id' => 'required|string',
            'age_grade_offering_id' => 'required|string',
            'day_id' => 'required|string', 
            'guideline_id'=>'required|string'
          ],[
            'name.required' => 'This field is required.',                    
            'meal_type_id.required' => 'This field is required.',
            'age_grade_offering_id.required' => 'This field is required.',
            'day_id.required' => 'This field is required.',
            'guideline_id.required' => 'This field is required.'
          ]);

          

          $group = (new CreateMenuCreationGroupAction())
          ->setName($request->name)
          ->setMealType($request->meal_type_id)
          ->setAgeRange($request->age_grade_offering_id)
          ->setDays($request->day_id)
          ->setGuideline($request->guideline_id)
          ->setOffering($request->siteOfferings)
          ->create(); 

          return redirect()->route('menu-creation-groups');
    }

    public function recipeAddSaveMethod(Request $request)
    {
        $request->validate([
            'recipe_name' => 'required|string',
            'recipe_category' => 'required',
            'recipe_portion' => 'required|not_in:0',
            // 'recipe_image' => 'nullable|sometimes|mimes:jpg,png,jpeg|max:4096',
            'recipe_instructions' => 'required',
        ], [
            'recipe_name.required' => 'Recipe name is required.',
            'recipe_category.required' => 'Recipe Category is required.',
            'recipe_portion.required' => 'Recipe portion is required.',
            'recipe_instructions.required' => 'Recipe instructions is required.',
        ]);

        //dd($request->all());

        $recipe = (new CreateRecipeAction())
            ->setName($request->recipe_name)
            ->setCategory($request->recipe_category)
            ->setRecipePortion(intval($request->recipe_portion))            
            ->setServingSize(floatval($request->recipe_serving))
            ->setServingSizeUom($request->recipe_serving_unit)
            ->setCookingInstructions($request->recipe_instructions)
            ->setIsFavorite($request->is_favorite)
            ->setHaccpId($request->recipe_haccp_id);

        if (!empty($request->attached_ingredients)) {
            foreach ($request->attached_ingredients as $ingredient_arr) {
                $ingredient = Ingredient::find($ingredient_arr['id']);
                $component_data = [
                    'recipe_amount' => $ingredient_arr['recipe_amount'],
                    'recipe_amount_uom_id' => $this->getUOMIDByName($ingredient_arr['recipe_amount_uom']),
                    'serving_amount' => $ingredient_arr['serving_amount'],
                    'serving_amount_uom_id' => $this->getUOMIDByName($ingredient_arr['serving_amount_uom']),
                    'usda_componenent_meat' => ComponentServing::value($ingredient_arr['component_mma']),
                    'usda_componenent_grain' => ComponentServing::value($ingredient_arr['component_wgr']),
                    'usda_componenent_fruit' => ComponentServing::value($ingredient_arr['component_fru']),
                    'usda_componenent_milk' => ComponentServing::value($ingredient_arr['component_mlk']),
                    'usda_componenent_veg' => ComponentServing::value($ingredient_arr['component_veg']),
                    'usda_componenent_veggrn' => ComponentServing::value($ingredient_arr['component_dg']),
                    'usda_componenent_vegred' => ComponentServing::value($ingredient_arr['component_ro']),
                    'usda_componenent_vegleg' => ComponentServing::value($ingredient_arr['component_leg']),
                    'usda_componenent_vegstar' => ComponentServing::value($ingredient_arr['component_star']),
                    'usda_componenent_vegothr' => ComponentServing::value($ingredient_arr['component_other']),

                    'usda_componenent_meat_override' => ComponentServing::value($ingredient_arr['optional_component_mma']),
                    'usda_componenent_grain_override' => ComponentServing::value($ingredient_arr['optional_component_wgr']),
                    'usda_componenent_fruit_override' => ComponentServing::value($ingredient_arr['optional_component_fru']),
                    'usda_componenent_milk_override' => ComponentServing::value($ingredient_arr['optional_component_mlk']),
                    'usda_componenent_veg_override' => ComponentServing::value($ingredient_arr['optional_component_veg']),
                    'usda_componenent_veggrn_override' => ComponentServing::value($ingredient_arr['optional_component_dg']),
                    'usda_componenent_vegred_override' => ComponentServing::value($ingredient_arr['optional_component_ro']),
                    'usda_componenent_vegleg_override' => ComponentServing::value($ingredient_arr['optional_component_leg']),
                    'usda_componenent_vegstar_override' => ComponentServing::value($ingredient_arr['optional_component_star']),
                    'usda_componenent_vegothr_override' => ComponentServing::value($ingredient_arr['optional_component_other']),
                ];

                $recipe->addIngredient($ingredient, $component_data);
            }
        }

        $recipe = $recipe->create();

        if (!empty($request->recipe_image)) {

            $img_upload_url = Storage::copy(
                $request->recipe_image['key'],
                str_replace('tmp/', 'images/recipes/', $request->recipe_image['key'])
            );      
            $img_upload_url = str_replace('tmp/', 'images/recipes/', $request->recipe_image['key']);
            // $img_upload_url = $request->recipe_image->store('images/recipes');
            $recipe->photo_store_path = $img_upload_url;
            $recipe->save();
        }

        return redirect()->route('recipes');
    }


    public function recipeEditMethod(Request $request, Recipe $recipe): Response
    {
        $recipe_data = Recipe::with(['ingredients'])->find($recipe->id);
        
        $mass_measurements    = UnitOfMeasurement::massMeasurements();
        $unit_measurements    = UnitOfMeasurement::unitMeasurements();
        $volume_measurements  = UnitOfMeasurement::volumeMeasurements();
        $categories = CategoryEnum::options();   

        $recipe_ingredients = $recipe_data->ingredients;

        $rec_ing_data = DB::table('ingredient_recipe')->where('recipe_id', $recipe->id)->get();

        $haccp_type_vals = Haccp::orderBy('name', 'asc')->get('type')->unique('type');
        $selected_haccp_type = Haccp::where('id', $recipe_data->haccp_id)->pluck('type');

        $selected_haccp_names = "";
        if ($selected_haccp_type->count()) {
            $selected_haccp_names = Haccp::where('type', $selected_haccp_type[0])->orderBy('name', 'asc')->get(['id', 'name']);
        }


        if (!empty($recipe_ingredients)) {

        //ray('$recipe_ingredients', $recipe_ingredients->toArray());
        
        $ingredient_data = array();
        $prefer_products = array();        
        foreach($recipe_ingredients as $item){
            
            $prefer_prod = array();
            $ingredient = array();

            $prefer_prod_array = Product::find($item->prefer_product_id);

            if($prefer_prod_array){

            $prefer_prod['measurement_serving_weight'] = $prefer_prod_array->serving_measurement_weight;
            $prefer_prod['measurement_serving_weight_uom'] = $this->getUOMNameByID($prefer_prod_array->serving_measurement_weight_uom_id);
            $prefer_prod['measurement_serving_volume'] = $prefer_prod_array->serving_measurement_volume;
            $prefer_prod['measurement_serving_volume_uom'] = $this->getUOMNameByID($prefer_prod_array->serving_measurement_volume_uom_id);
            $prefer_prod['measurement_serving_unit'] = $prefer_prod_array->serving_measurement_unit;
            $prefer_prod['measurement_serving_unit_uom'] = $this->getUOMNameByID($prefer_prod_array->serving_measurement_unit_uom_id);


            //reset prefer product components from ingredient values if available!
            $prefer_prod['component_mma'] = $prefer_prod_array->usda_componenent_serving_meat;
            $prefer_prod['component_wgr'] = $prefer_prod_array->usda_componenent_serving_grain;
            $prefer_prod['component_fru'] = $prefer_prod_array->usda_componenent_serving_fruit;
            $prefer_prod['component_mlk'] = $prefer_prod_array->usda_componenent_serving_milk;
            $prefer_prod['component_veg'] = $prefer_prod_array->usda_componenent_serving_veg;
            $prefer_prod['component_dg'] = $prefer_prod_array->usda_componenent_serving_veggrn;
            $prefer_prod['component_ro'] = $prefer_prod_array->usda_componenent_serving_vegred;
            $prefer_prod['component_leg'] = $prefer_prod_array->usda_componenent_serving_vegleg;
            $prefer_prod['component_star'] = $prefer_prod_array->usda_componenent_serving_vegstar;
            $prefer_prod['component_other'] = $prefer_prod_array->usda_componenent_serving_vegothr;


            // $prefer_prod['nutrition_facts_weight'] = $prefer_prod_array->nutrition_facts_weight;
            // $prefer_prod['nutrition_facts_weight_uom'] = $this->getUOMNameByID($prefer_prod_array->nutrition_facts_weight_uom_id);
            // $prefer_prod['nutrition_facts_volume'] = $prefer_prod_array->nutrition_facts_volume;
            // $prefer_prod['nutrition_facts_volume_uom'] = $this->getUOMNameByID($prefer_prod_array->nutrition_facts_volume_uom_id);
            // $prefer_prod['nutrition_facts_unit'] = $prefer_prod_array->nutrition_facts_unit;
            // $prefer_prod['nutrition_facts_unit_uom'] = $this->getUOMNameByID($prefer_prod_array->nutrition_facts_unit_uom_id);


            $ingredient['component_nut_calories'] = $prefer_prod_array->nutrition_facts_calories;
            $ingredient['component_nut_sodium'] = $prefer_prod_array->nutrition_facts_sodium;
            $ingredient['component_nut_totalfat'] = $prefer_prod_array->nutrition_facts_totalfat;
            $ingredient['component_nut_protein'] = $prefer_prod_array->nutrition_facts_protein;
            $ingredient['component_nut_carbs'] = $prefer_prod_array->nutrition_facts_carbs; 
                        
            }
            //managing ingredient data

            $ingredient['id'] = $item->id;
            $ingredient['name'] = $item->name;


            foreach ($rec_ing_data as $rec_ing) {
                if ($rec_ing->ingredient_id == $item->id) {
                    
                    $ingredient['recipe_ingredient_edit'] = $rec_ing->ingredient_id;

                    $ingredient['recipe_amount'] = $rec_ing->recipe_amount;
                    $ingredient['recipe_amount_uom']  = $this->getUOMNameByID($rec_ing->recipe_amount_uom_id);

                    $ingredient['serving_amount']     = $rec_ing->serving_amount;
                    $ingredient['serving_amount_uom'] = $this->getUOMNameByID($rec_ing->serving_amount_uom_id);

                    $ingredient['component_mma']   = $rec_ing->usda_componenent_meat;
                    $ingredient['component_wgr']   = $rec_ing->usda_componenent_grain;
                    $ingredient['component_fru']   = $rec_ing->usda_componenent_fruit;
                    $ingredient['component_mlk']   = $rec_ing->usda_componenent_milk;
                    $ingredient['component_veg']   = $rec_ing->usda_componenent_veg;
                    $ingredient['component_dg']    = $rec_ing->usda_componenent_veggrn;
                    $ingredient['component_ro']    = $rec_ing->usda_componenent_vegred;
                    $ingredient['component_leg']   = $rec_ing->usda_componenent_vegleg;
                    $ingredient['component_star']  = $rec_ing->usda_componenent_vegstar;
                    $ingredient['component_other'] = $rec_ing->usda_componenent_vegothr;

                    //setup ingredient components for optional components
                    $ingredient['optional_component_mma']   = $rec_ing->usda_componenent_meat_override;
                    $ingredient['optional_component_wgr']   = $rec_ing->usda_componenent_grain_override;
                    $ingredient['optional_component_fru']   = $rec_ing->usda_componenent_fruit_override;
                    $ingredient['optional_component_mlk']   = $rec_ing->usda_componenent_milk_override;
                    $ingredient['optional_component_veg']   = $rec_ing->usda_componenent_veg_override;
                    $ingredient['optional_component_dg']    = $rec_ing->usda_componenent_veggrn_override;
                    $ingredient['optional_component_ro']    = $rec_ing->usda_componenent_vegred_override;
                    $ingredient['optional_component_leg']   = $rec_ing->usda_componenent_vegleg_override;
                    $ingredient['optional_component_star']  = $rec_ing->usda_componenent_vegstar_override;
                    $ingredient['optional_component_other'] = $rec_ing->usda_componenent_vegothr_override;


                    $ingredient['preferred_product_information'] = $prefer_prod;
                }
            }     

           $ingredient_data[] = $ingredient;  
           $prefer_products[] = $prefer_prod;
        }

    }        

        //ray($recipe_ingredients->toArray());
        return Jetstream::inertia()->render($request, 'Recipes/Recipes-edit', [
            'recipe' => $recipe_data,
            'recipe_ingredients' => $ingredient_data,
            'prefer_products' => $prefer_products,            
            'haccp_types' => $haccp_type_vals,
            'selected_haccp_type' => $selected_haccp_type,
            'selected_haccp_names' => $selected_haccp_names,
            'mass_measurements' => $mass_measurements,
            'unit_measurements' => $unit_measurements,
            'volume_measurements' => $volume_measurements,
            'categories' => $categories
        ]);
    }

    public function recipeEditSaveMethod(Request $request, Recipe $recipe)
    {
        $request->validate([
            'recipe_name' => 'required|string',
            'recipe_category' => 'required',
            'recipe_portion' => 'required|not_in:0',
            // 'recipe_image' => 'nullable|sometimes|mimes:jpg,png,jpeg|max:4096',
            'recipe_instructions' => 'required',
        ], [
            'recipe_name.required' => 'Recipe name is required.',
            'recipe_category.required' => 'Recipe Category is required.',
            'recipe_portion.required' => 'Recipe portion is required.',
            'recipe_instructions.required' => 'Recipe instructions is required.',
        ]);  

        //dd($request->attached_ingredients);      

        $recipe_update = (new UpdateRecipeAction())
            ->setRecipe($recipe)
            ->setName($request->recipe_name)
            ->setCategory($request->recipe_category)
            ->setRecipePortion(intval($request->recipe_portion))            
            ->setServingSize(floatval($request->recipe_serving))
            ->setServingSizeUom($request->recipe_serving_unit)
            ->setCookingInstructions($request->recipe_instructions)
            ->setIsFavorite($request->is_favorite)
            ->setHaccpId($request->recipe_haccp_id);


        if (!empty($request->attached_ingredients)) {
            foreach ($request->attached_ingredients as $ingredient_arr) {

                $ingredient = Ingredient::find($ingredient_arr['id']);
                //ray($ingredient_arr);
                $component_data = [
                    'recipe_amount' => $ingredient_arr['recipe_amount'],
                    'recipe_amount_uom_id' => $this->getUOMIDByName($ingredient_arr['recipe_amount_uom']),
                    'serving_amount' => $ingredient_arr['serving_amount'],
                    'serving_amount_uom_id' => $this->getUOMIDByName($ingredient_arr['serving_amount_uom']),
                    'usda_componenent_meat' => ComponentServing::value($ingredient_arr['component_mma']),
                    'usda_componenent_grain' => ComponentServing::value($ingredient_arr['component_wgr']),
                    'usda_componenent_fruit' => ComponentServing::value($ingredient_arr['component_fru']),
                    'usda_componenent_milk' => ComponentServing::value($ingredient_arr['component_mlk']),
                    'usda_componenent_veg' => ComponentServing::value($ingredient_arr['component_veg']),
                    'usda_componenent_veggrn' => ComponentServing::value($ingredient_arr['component_dg']),
                    'usda_componenent_vegred' => ComponentServing::value($ingredient_arr['component_ro']),
                    'usda_componenent_vegleg' => ComponentServing::value($ingredient_arr['component_leg']),
                    'usda_componenent_vegstar' => ComponentServing::value($ingredient_arr['component_star']),
                    'usda_componenent_vegothr' => ComponentServing::value($ingredient_arr['component_other']),

                    'usda_componenent_meat_override' => ComponentServing::value($ingredient_arr['optional_component_mma']),
                    'usda_componenent_grain_override' => ComponentServing::value($ingredient_arr['optional_component_wgr']),
                    'usda_componenent_fruit_override' => ComponentServing::value($ingredient_arr['optional_component_fru']),
                    'usda_componenent_milk_override' => ComponentServing::value($ingredient_arr['optional_component_mlk']),
                    'usda_componenent_veg_override' => ComponentServing::value($ingredient_arr['optional_component_veg']),
                    'usda_componenent_veggrn_override' => ComponentServing::value($ingredient_arr['optional_component_dg']),
                    'usda_componenent_vegred_override' => ComponentServing::value($ingredient_arr['optional_component_ro']),
                    'usda_componenent_vegleg_override' => ComponentServing::value($ingredient_arr['optional_component_leg']),
                    'usda_componenent_vegstar_override' => ComponentServing::value($ingredient_arr['optional_component_star']),
                    'usda_componenent_vegothr_override' => ComponentServing::value($ingredient_arr['optional_component_other']),
                ];

                //dd($component_data);

                $recipe_update->addIngredient($ingredient, $component_data);
            }
        }


        $recipe_updated = $recipe_update->update();

        if (!empty($request->recipe_image)) {
            //$recipeImageName = time().'.'.$request->recipe_image->getClientOriginalExtension();
            //$request->recipe_image->move(public_path('images\recipes'), $recipeImageName);
            $img_upload_url = Storage::copy(
                $request->recipe_image['key'],
                str_replace('tmp/', 'images/recipes/', $request->recipe_image['key'])
            );      
            $img_upload_url = str_replace('tmp/', 'images/recipes/', $request->recipe_image['key']);
            // dd($img_upload_url);
            // $img_upload_url = $request->recipe_image->store('images/recipes');
        } else {
            $img_upload_url = '';
        }

        if ($request->recipe_edit_image == $recipe->photo_store_path && $recipe->photo_store_path != '') {
            $img_upload_url = $recipe->photo_store_path;
            // dd($img_upload_url);
        }

        $recipe_updated->photo_store_path = $img_upload_url;
        $recipe_updated->save();


        return redirect()->route('recipes');
    }


    public function recipeCopy(Request $request, Recipe $recipe)
    {
        $newRecipe = (new CopyRecipeAction())
            ->sourceRecipe($recipe)
            ->copy();
        
        return redirect()->route('recipes-edit', ['recipe' => $newRecipe->id]);
    }

    public function recipeDelete(Request $request, Recipe $recipe)
    {
        $removeRecipe = (new DeleteRecipeAction())
            ->sourceRecipe($recipe)
            ->deleteRecipe();

        return redirect()->route('recipes');
    }

    public function recipeSearchFilter(Request $request)
    {
        $search_filter = $request->json('type');
        if ($search_filter == 'search') {
            $term = $request->json('term');
            // dd(Recipe::SearchByAll($term)->toSql());
            $recipes_search = Recipe::SearchByAll($term)->orderBy('name', 'asc')->paginate(100);
        }
        if ($search_filter == 'filter') {
            $category = $request->json('term');
            $recipes_search = Recipe::where('category', $category)->orderBy('name', 'asc')->paginate(100);
        }

        return response()->json($recipes_search);
    }


    public function recipeIngredientSearchModal(Request $request)
    {
        $term = $request->json('term');
        $exclude = $request->json('ex_ids');

        $singular = Str::singular(strtolower($term));
        $plural = Str::plural(strtolower($term));


        $ingredient_search = Ingredient::SearchByName($term)
        // ->where(function($q) use($term, $singular, $plural){

        //     $q->whereRaw("LOWER(name) LIKE '%" . strtolower($term) . "%'")
        //     ->orWhereRaw("LOWER(name) LIKE '%" . strtolower($singular) . "%'")
        //     ->orWhereRaw("LOWER(name) LIKE '%" . strtolower($plural) . "%'");
        // })
        
        ->whereNotIn('id', $exclude)->orderBy('name', 'asc')->get();

        return response()->json($ingredient_search);
    }


    public function get_ingredient_prefer_product(Request $request)
    {
        $preferProductId = Ingredient::find($request->json('ingredient_id'));
        $prefer_product = Product::where('id', $preferProductId->prefer_product_id)->get();
        
        $prefer_product->map(function ($item, $key){

        $item->serving_measurement_weight_uom_name = ($item->serving_measurement_weight_uom_id != NULL) ? UnitOfMeasurement::find($item->serving_measurement_weight_uom_id)->name : NULL;

        $item->serving_measurement_volume_uom_name = ($item->serving_measurement_volume_uom_id != NULL) ? UnitOfMeasurement::find($item->serving_measurement_volume_uom_id)->name : NULL;

        $item->serving_measurement_unit_uom_name = ($item->serving_measurement_unit_uom_id != NULL) ? UnitOfMeasurement::find($item->serving_measurement_unit_uom_id)->name : NULL;



        $item->nutrition_facts_weight_uom_name = ($item->nutrition_facts_weight_uom_id != NULL) ? UnitOfMeasurement::find($item->nutrition_facts_weight_uom_id)->name : NULL;

        $item->nutrition_facts_volume_uom_name = ($item->nutrition_facts_volume_uom_id != NULL) ? UnitOfMeasurement::find($item->nutrition_facts_volume_uom_id)->name : NULL;

        $item->nutrition_facts_unit_uom_name = ($item->nutrition_facts_unit_uom_id != NULL) ? UnitOfMeasurement::find($item->nutrition_facts_unit_uom_id)->name : NULL;
        
        });

        return response()->json($prefer_product);
    }


    public function getHaccpNamesAjax(Request $request)
    {
        $haccp_names = Haccp::where('type', $request->json('type'))->orderBy('name', 'asc')->get(['id', 'name']);
        return response()->json($haccp_names);
    }

    public function getHaccpDescriptionAjax(Request $request)
    {
        $haccp_data = Haccp::select(['type', 'rule'])->where('id', $request->json('haccp'))->first()->toArray();
        $haccp_fulldata = '<br>--' . strtoupper($haccp_data['type']) . '--<br>' . $haccp_data['rule'];
        return response()->json($haccp_fulldata);
    }

    public function getUOMNameByID($uomId = NULL)
    { 
        return $uomname = ($uomId != NULL) ? UnitOfMeasurement::find($uomId)->name : NULL;
    }

    public function getUOMIDByName($uomName = NULL)
    { 
        $UomId = UnitOfMeasurement::where('name', $uomName)->first('id');        
        return $uomidd = ($uomName != NULL) ? $UomId->id : NULL;
    }


    public function getSelectedUOMTypeVals(Request $request)
    {
        $current = $request->json('current');
        $selected = $request->json('selected');

        $base_unit_vol = $request->json('base_unit_vol');
        $base_unit_weight = $request->json('base_unit_weight');

        $current_uom = UnitOfMeasurement::find($current);
        $selected_uom = UnitOfMeasurement::find($selected);
        
        $type_vals = array();
        $type_vals['current'] = $current_uom;
        $type_vals['selected'] = $selected_uom;

        $base_unit_vol_val = UnitOfMeasurement::find($base_unit_vol);
        $base_unit_weight_val = UnitOfMeasurement::find($base_unit_weight);
        
        if(!empty($base_unit_vol_val)){
            $type_vals['base_unit_vol'] = $base_unit_vol_val->name;
        }else{
            $type_vals['base_unit_vol'] = '';
        }

        if(!empty($base_unit_weight_val)){
            $type_vals['base_unit_weight'] = $base_unit_weight_val->name;
        }else{
            $type_vals['base_unit_vol'] = '';
        }                
        
        return response()->json($type_vals);
    }

    public function getFavorite(Request $request){
        $recipe = Recipe::find($request->recipe_id);    
        if($recipe){
            $recipe->is_favorite = $request->is_fav;
            $recipe->save();
        }
        return $recipe;
    }
}
