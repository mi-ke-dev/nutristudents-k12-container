<?php

declare(strict_types=1);

namespace Bytelaunch\Nutristudents\Http\Controllers;

use App\Models\Tenant;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Laravel\Jetstream\Jetstream;
use Illuminate\Routing\Controller;
use Laravel\Jetstream\RedirectsActions;
use Illuminate\Support\Facades\Validator;
use Bytelaunch\Nutristudents\Models\Ingredient;
use Bytelaunch\Nutristudents\Models\Product;
use Bytelaunch\Nutristudents\Models\Component;
use Bytelaunch\Nutristudents\Models\Category;
use Bytelaunch\Nutristudents\Actions\Ingredients\CreateIngredientAction;
use Bytelaunch\Nutristudents\Actions\Ingredients\UpdateIngredientAction;
use Bytelaunch\Nutristudents\Actions\Ingredients\AttachProductAction;
use Bytelaunch\Nutristudents\Actions\Ingredients\SyncProductAction;
use Bytelaunch\Nutristudents\Actions\Ingredients\DeleteIngredientAction;
use Bytelaunch\Nutristudents\Actions\Ingredients\CopyIngredientAction;



class IngredientController extends Controller
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
        
        $ingredients_val     = Ingredient::orderBy('name','asc')->paginate(100);
        
        if($request->query('search')){
        $search = $request->query('search');
        $ingredients_val = Ingredient::whereRaw("LOWER(name) LIKE '%".strtolower($search)."%'")->orderBy('name','asc')->paginate(100);
        $ingredients_val->appends(request()->query());        
        }else{
          $search = '';
        }

        $ingredients_val->map(function($item, $key) {   
          $item->append('is_tenant_admin');
          $prefer_product = Product::find($item->prefer_product_id);
          if(!empty($prefer_product)){
          $item->prod_name = $prefer_product->name;
          $item->prod_category = Category::where('id',$prefer_product->primary_category_id)->pluck('name')->first();
          $item->prod_sub_category = Category::where('id',$prefer_product->primary_sub_category_id)->pluck('name')->first();
          }else{
          $item->prod_name = '-';
          $item->prod_category = '-';
          $item->prod_sub_category = '-';
          }
        });

        return Jetstream::inertia()->render($request, 'Ingredients/Ingredients', [
               'ingredient_data' => $ingredients_val,
               'ing_searched' => $search,
        ]);
    }

    public function ingredientAddMethod(Request $request) : Response
    {                 
        
        return Jetstream::inertia()->render($request, 'Ingredients/Ingredients-add', [
               
        ]);
    }

    public function ingredientAddSaveMethod(Request $request)
    {

        $request->validate([
          'ing_name' => 'required|string',
        ],[
          'ing_name.required' => 'Ingredient name is required.',
        ]);

        //dd($request->attached_products);

        $ingredient = (new CreateIngredientAction())->setName($request->ing_name);

        $prefer_product = Product::find($request->ing_prefer_product);
        if(!empty($prefer_product)){
          $ingredient->setPreferProduct($request->ing_prefer_product);
        }

        $created = $ingredient->create();

        if(!empty($request->attached_products)){

        foreach($request->attached_products as $product_arr){
        $product = Product::find($product_arr['id']);
        $ingredient = Ingredient::find($created->id);
        $ingredient_prod = (new AttachProductAction())
            ->forIngredient($ingredient)
            ->attachProduct($product)
            ->attach();
        }

        }

        return redirect()->route('ingredients');

    }


    public function ingredientEditMethod(Request $request, Ingredient $ingredient) : Response
    {
           $ingredientbyId = Ingredient::where('id', $ingredient->id)->with([
            'products' => function ($query) {
                // Subquery on `series` table
                return $query
                    // select whatever you'll need
                    ->with('user')
                    ->select('products.*')
                    // order by order number
                    ->orderBy('products.name');
            },
            ])->first();
            $ingredientbyId->append('is_tenant_admin');


            //dd($ingredientbyId->products);

           $ingredient_products = $ingredientbyId->products;
           $ingredient_products->map(function($item, $key) {
            $item->append('tenant_name');
             $item->component_name =  implode(",",$item->components->pluck('name')->toArray());
           });


    $avg_products = array();
    $avg_products[0]['MMA'] = $ingredientbyId->products->pluck('usda_componenent_serving_meat')->avg();
    $avg_products[0]['MMA'] = (float)$avg_products[0]['MMA'];

    $avg_products[0]['WGR'] = $ingredientbyId->products->pluck('usda_componenent_serving_grain')->avg();
    $avg_products[0]['WGR'] = (float)$avg_products[0]['WGR'];

    $avg_products[0]['FRU'] = $ingredientbyId->products->pluck('usda_componenent_serving_fruit')->avg();
    $avg_products[0]['FRU'] = (float)$avg_products[0]['FRU'];

    $avg_products[0]['MLK'] = $ingredientbyId->products->pluck('usda_componenent_serving_milk')->avg();
    $avg_products[0]['MLK'] = (float)$avg_products[0]['MLK'];

    $avg_products[0]['VEG'] = $ingredientbyId->products->pluck('usda_componenent_serving_veg')->avg();
    $avg_products[0]['VEG'] = (float)$avg_products[0]['VEG'];

    $avg_products[0]['DG'] = $ingredientbyId->products->pluck('usda_componenent_serving_veggrn')->avg();
    $avg_products[0]['DG'] = (float)$avg_products[0]['DG'];

    $avg_products[0]['STAR'] = $ingredientbyId->products->pluck('usda_componenent_serving_vegstar')->avg();
    $avg_products[0]['STAR'] = (float)$avg_products[0]['STAR'];

    $avg_products[0]['RO'] = $ingredientbyId->products->pluck('usda_componenent_serving_vegred')->avg();
    $avg_products[0]['RO'] = (float)$avg_products[0]['RO'];

    $avg_products[0]['LEG'] = $ingredientbyId->products->pluck('usda_componenent_serving_vegleg')->avg();
    $avg_products[0]['LEG'] = (float)$avg_products[0]['LEG'];

    $avg_products[0]['OTH'] = $ingredientbyId->products->pluck('usda_componenent_serving_vegothr')->avg();
    $avg_products[0]['OTH'] = (float)$avg_products[0]['OTH'];

    $avg_products[0]['CALS'] = $ingredientbyId->products->pluck('nutrition_facts_calories')->avg();
    $avg_products[0]['CALS'] = (float)$avg_products[0]['CALS'];

    $avg_products[0]['SOD'] = $ingredientbyId->products->pluck('nutrition_facts_sodium')->avg();
    $avg_products[0]['SOD'] = (float)$avg_products[0]['SOD'];

    $avg_products[0]['FAT'] = $ingredientbyId->products->pluck('nutrition_facts_totalfat')->avg();
    $avg_products[0]['FAT'] = (float)$avg_products[0]['FAT'];

    $avg_products[0]['PROT'] = $ingredientbyId->products->pluck('nutrition_facts_protein')->avg();
    $avg_products[0]['PROT'] = (float)$avg_products[0]['PROT'];

    $avg_products[0]['CARB'] = $ingredientbyId->products->pluck('nutrition_facts_carbs')->avg();
    $avg_products[0]['CARB'] = (float)$avg_products[0]['CARB'];

    //dd($ingredient_products);

        return Jetstream::inertia()->render($request, 'Ingredients/Ingredients-edit', [
               'ingredient'   => $ingredientbyId,
               'ing_products' => $ingredient_products,
               'avg_products' => $avg_products,
        ]);
    }

    public function ingredientEditSaveMethod(Request $request, Ingredient $ingredient)
    {
        $request->validate([
          'ing_name' => 'required|string',
        ],[
          'ing_name.required' => 'Ingredient name is required.',
        ]);

        //dd($request->all());

        $ingredient_update = (new UpdateIngredientAction())
                             ->setIngredient($ingredient)
                             ->setName($request->ing_name);

        $prefer_iproduct = Product::find($request->ing_prefer_product);
        if(!empty($prefer_iproduct)){
        $ingredient_update->setPreferProduct($request->ing_prefer_product);
        }

        $updated = $ingredient_update->update();

        if(!empty($request->attached_products)){

        $ingredient_main = Ingredient::find($ingredient->id);

        $ingredient_prod = (new SyncProductAction())
                ->forIngredient($ingredient);

        foreach($request->attached_products as $product_arr){
            $product = Product::find($product_arr['id']);
            $ingredient_prod->attachProduct($product);
        }

        $ingredient_prod->attach();

        }

        return redirect()->route('ingredients');
    }

    public function ingredientCopy(Request $request, Ingredient $ingredient)
    {
    //dd($ingredient);
    $new_ingredient = (new CopyIngredientAction())
                    ->sourceingredient($ingredient)
                    ->copy();

    return redirect()->route('ingredients-edit',['ingredient' => $new_ingredient->id]);
    }

    public function ingredientDelete(Request $request, Ingredient $ingredient)
    {
    //dd($ingredient);
    $delete_ingredient = (new DeleteIngredientAction())
                    ->sourceIngredient($ingredient)
                    ->delete();

    return redirect()->route('ingredients');
    }

    public function ingredientSearchFilter(Request $request)
    {
          $search_filter  = $request->json('type');
          if($search_filter == 'search'){
            $term            = $request->json('term'); 
            $ingredients_search = Ingredient::whereRaw("LOWER(name) LIKE '%".strtolower($term)."%'")->orderBy('name','asc')->paginate(100);
          }    
          if($search_filter == 'filter'){
            $comp_id            = $request->json('term'); 
            $ingredients_search = Ingredient::where('component_id', $comp_id)->orderBy('name','asc')->paginate(100);
          }  

          $ingredients_search->map(function($item, $key) {   
            $item->append('is_tenant_admin');
            $prefer_product = Product::find($item->prefer_product_id);
            if(!empty($prefer_product)){
            $item->prod_name = $prefer_product->name;
            $item->prod_category = Category::where('id',$prefer_product->primary_category_id)->pluck('name')->first();
            $item->prod_sub_category = Category::where('id',$prefer_product->primary_sub_category_id)->pluck('name')->first();
            }else{
            $item->prod_name = '-';
            $item->prod_category = '-';
            $item->prod_sub_category = '-';    
            }
            });
          
          return response()->json($ingredients_search);
    }


    public function ingredientProductSearchModal(Request $request)
    {
          $term    = $request->json('term');
          $exclude = $request->json('ex_ids');
          $is_all = $request->json('is_all');
          // dd($is_all);

          $product_search = Product::with('user')->whereRaw("LOWER(name) LIKE '%".strtolower($term)."%'")
              ->whereNotIn('id', $exclude)
              ->AllProduct($is_all)
              ;

          $product_search = $product_search->orderBy('created_at','desc')->get();
          $product_search->map(function($item, $key) {   
            $item->append('is_tenant_admin');
            $item->append('tenant_name');
            //
          });

          return response()->json($product_search);
    }
}

