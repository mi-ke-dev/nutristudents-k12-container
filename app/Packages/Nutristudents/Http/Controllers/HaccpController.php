<?php

namespace Bytelaunch\Nutristudents\Http\Controllers;

use App\Models\Tenant;
use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Laravel\Jetstream\Jetstream;
use Illuminate\Routing\Controller;
use Laravel\Jetstream\RedirectsActions;
use Illuminate\Support\Facades\Validator;
use Bytelaunch\Nutristudents\Models\Haccp;
use Bytelaunch\Nutristudents\Actions\Haccps\CreateHaccpAction;
use Bytelaunch\Nutristudents\Actions\Haccps\UpdateHaccpAction;
use Bytelaunch\Nutristudents\Actions\Haccps\CopyHaccpAction; 
use Bytelaunch\Nutristudents\Actions\Haccps\DeleteHaccpAction;
use Bytelaunch\Nutristudents\Getters\Tenants\GetCurrentTenantGetter;

class HaccpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) : Response
    {
        // $tenants = Tenant::get();
        // // dd($tenants->toArray());
        // foreach($tenants as $tenant){
        //     $tenant->run(function () {
        //         User::create([                   
        // 'name' => '1 tenants',
        // 'type' => 'User',
        // 'email' => 'a@tenant.com',
        // 'password' => '123456',
        //         ]);
        //     });
        // }
        $haccps = Haccp::orderBy('name','asc')->get(); 
        $haccps->map(function($item, $key) {
            $item->append('is_tenant_admin');
        });

        return Jetstream::inertia()->render($request, 'Haccps/Haccps', [
               'haccp_data' => $haccps,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return Jetstream::inertia()->render($request, 'Haccps/Haccps-add', [

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //dd($request->all());
        $request->validate([
          'haccp_name' => 'required|string',
          'haccp_type' => 'required',     
        ],[
          'haccp_name.required' => 'Haccp name is required.',
          'haccp_type.required' => 'Haccp Type is required.',
        ]);
        
        $haccp = (new CreateHaccpAction())
            ->setName($request->haccp_name)
            ->setType($request->haccp_type)
            ->setRule($request->haccp_rule)            
            ->setUserId(intval(1))
            ->create();
        
        return redirect()->route('haccp-snippets');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Haccp  $haccp
     * @return \Illuminate\Http\Response
     */
    public function show(Haccp $haccp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Haccp  $haccp
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Haccp $haccp)
    {
        $haccp_data = Haccp::find($haccp->id);
        $haccp_data->append('is_tenant_admin');

        return Jetstream::inertia()->render($request, 'Haccps/Haccps-edit', [
                'haccp' => $haccp_data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Haccp  $haccp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Haccp $haccp)
    {
        $request->validate([
          'haccp_name' => 'required|string',
          'haccp_type' => 'required',     
        ],[
          'haccp_name.required' => 'Haccp name is required.',
          'haccp_type.required' => 'Haccp Type is required.',
        ]);


        $haccp = (new UpdateHaccpAction())
            ->setHaccp($haccp)
            ->setName($request->haccp_name)
            ->setType($request->haccp_type)
            ->setRule($request->haccp_rule)            
            ->setUserId(intval(1))
            ->update();
        
        return redirect()->route('haccp-snippets');
    }

    /**
     * Copy the specified resource from storage.
     *
     * @param  \App\Models\Haccp  $haccp
     * @return \Illuminate\Http\Response
     */
    public function copy(Haccp $haccp)
    {
        $newHaccp = (new CopyHaccpAction())
            ->sourceHaccp($haccp)
            ->copy();
    
        return redirect()->route('haccp-snippets');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Haccp  $haccp
     * @return \Illuminate\Http\Response
     */
    public function destroy(Haccp $haccp)
    {
        $removeHaccp = (new DeleteHaccpAction())
            ->sourceHaccp($haccp)
            ->deleteHaccp();
        return redirect()->route('haccp-snippets');
    }
    
    
    /**
     * Search the specified resource from storage.
     *
     * @param  \App\Models\Haccp  $haccp
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {     
          $search_filter  = $request->json('type');
          if($search_filter == 'search'){
            $term            = $request->json('term'); 
            $haccp_search = Haccp::whereRaw("LOWER(name) LIKE '%".strtolower($term)."%'")->orderBy('name','asc')->get();
          }
          if($search_filter == 'filter'){
            $type        = $request->json('term'); 
            $haccp_search  = Haccp::where('type',$type)->orderBy('name','asc')->get();
          }       
          
          return response()->json($haccp_search);
    }
}
