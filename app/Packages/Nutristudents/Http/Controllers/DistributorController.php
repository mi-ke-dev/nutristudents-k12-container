<?php

namespace Bytelaunch\Nutristudents\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Laravel\Jetstream\Jetstream;
use Illuminate\Routing\Controller;
use Laravel\Jetstream\RedirectsActions;
use Illuminate\Support\Facades\Validator;


use Bytelaunch\Nutristudents\Models\Distributor;
use Bytelaunch\Nutristudents\Actions\ProductDistributors\CreateProductDistributorAction;
use Bytelaunch\Nutristudents\Actions\ProductDistributors\UpdateProductDistributorAction;
use Bytelaunch\Nutristudents\Actions\ProductDistributors\DeleteProductDistributorAction;

class DistributorController extends Controller
{
    public function index(Request $request) : Response
    {
        $distributors = Distributor::orderBy('name','asc')->get();    
        $distributors->map(function($item, $key) {
            $item->append('is_tenant_admin');
        });    

        return Jetstream::inertia()->render($request, 'Products/Distributors/Distributors', [
               'all_distributors' => $distributors,
        ]);
    }



    public function create(Request $request)
    {        
        return Jetstream::inertia()->render($request, 'Products/Distributors/Distributor-add', []);
    }


    public function store(Request $request)
    {

        $request->validate([
          'distributor_name' => 'required|string',  
        ],[
          'distributor_name.required' => 'This field is required.',
        ]);  

        $add_distributor = (new CreateProductDistributorAction)
            ->setName($request->distributor_name)
            ->create();            
     
        return redirect()->route('product-distributors');

    }


    public function edit(Request $request, Distributor $distributor)
    {        
        $distributor = Distributor::find($distributor->id);   
        $distributor->append('is_tenant_admin');
        return Jetstream::inertia()->render($request, 'Products/Distributors/Distributor-edit', [
              'distributor' => $distributor,
        ]);
    }


    public function update(Request $request, Distributor $distributor)
    {       
        $request->validate([
          'distributor_name' => 'required|string',  
        ],[
          'distributor_name.required' => 'This field is required.',
        ]);  

        $distributor_update = (new UpdateProductDistributorAction)
            ->setDistributor($distributor)
            ->setName($request->distributor_name)
            ->update();            
     
        return redirect()->route('product-distributors');
    }


    public function destroy(Distributor $distributor)
    {
        $remove_distributor = (new DeleteProductDistributorAction)
            ->sourceDistributor($distributor)
            ->deleteDistributor();

        return redirect()->route('product-distributors');
    }


    public function search(Request $request)
    {     
          
        $term                = $request->json('term'); 
        $distributor_search  = Distributor::whereRaw("LOWER(name) LIKE '%".strtolower($term)."%'")->orderBy('name','asc')->get();       
          
        return response()->json($distributor_search);
    }
}
