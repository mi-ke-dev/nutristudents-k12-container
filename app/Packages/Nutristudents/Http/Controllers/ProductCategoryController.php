<?php

namespace Bytelaunch\Nutristudents\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Laravel\Jetstream\Jetstream;
use Illuminate\Routing\Controller;
use Laravel\Jetstream\RedirectsActions;
use Illuminate\Support\Facades\Validator;


use Bytelaunch\Nutristudents\Models\Category;
use Bytelaunch\Nutristudents\Actions\ProductCategories\CreateProductCategoryAction;
use Bytelaunch\Nutristudents\Actions\ProductCategories\UpdateProductCategoryAction;
use Bytelaunch\Nutristudents\Actions\ProductCategories\DeleteProductCategoryAction;

class ProductCategoryController extends Controller
{
    public function index(Request $request) : Response
    {
        $productcategories = Category::orderBy('name','asc')->get();

        $productcategories->map(function($item, $key) {   
            $item->append('is_tenant_admin'); 
            $item->main_category = Category::where('id',$item->parent_id)->pluck('name');
        });

        $maincategories = Category::whereNull('parent_id')->orderBy('name','asc')->get();

        return Jetstream::inertia()->render($request, 'Products/Categories/Categories', [
               'all_sub_cats' => $productcategories,
               'main_categories' => $maincategories,
        ]);
    }



    public function create(Request $request)
    {
        $productcategories = Category::whereNull('parent_id')->get();
        return Jetstream::inertia()->render($request, 'Products/Categories/Categories-add', [
                   'main_categories' => $productcategories,
        ]);
    }


    public function store(Request $request)
    {

        $request->validate([
          'sub_category_name' => 'required|string',            
        ],[
          'sub_category_name.required' => 'This field is required.',
        ]);  

        $prod_category = (new CreateProductCategoryAction)
            ->setName($request->sub_category_name);

        if($request->main_category != ""){
            $prod_category->setParent($request->main_category);
        }
        $prod_category->create();            
     
        return redirect()->route('product-categories');

    }


    public function edit(Request $request, Category $category)
    {        
        $cat_data = Category::find($category->id);   
        $cat_data->append('is_tenant_admin');
        $productcategories = Category::whereNull('parent_id')->get();     
        return Jetstream::inertia()->render($request, 'Products/Categories/Categories-edit', [
              'product_subcategory' => $cat_data,
              'main_categories' => $productcategories,
        ]);
    }


    public function update(Request $request, Category $category)
    {       
        $request->validate([
          'sub_category_name' => 'required|string',
        ],[
          'sub_category_name.required' => 'This field is required.',
        ]);  

        $prod_category_update = (new UpdateProductCategoryAction)
            ->setProductCategory($category)
            ->setName($request->sub_category_name)
            ->setParent($request->main_category)
            ->update();         
     
        return redirect()->route('product-categories');
    }


    public function destroy(Category $category)
    {
        $remove_category = (new DeleteProductCategoryAction)
            ->sourceProductCategory($category)
            ->deleteProductCategory();
        return redirect()->route('product-categories');
    }


    public function search(Request $request)
    {     
          
        $term        = $request->json('term'); 
        $type        = $request->json('type'); 
        
        if($type == 'search'){
        $cat_search  = Category::whereRaw("LOWER(name) LIKE '%".strtolower($term)."%'")->orderBy('name','asc')->get();           
        }
        
        if($type == 'filter'){
        $cat_search = Category::where('parent_id', $term)->orderBy('name','asc')->get();
        }  

        $cat_search->map(function($item, $key) {    
            $item->main_category = Category::where('id',$item->parent_id)->pluck('name');
            $item->append('is_tenant_admin');
        });   
          
        return response()->json($cat_search);
    }
}
