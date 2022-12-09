<?php

namespace Bytelaunch\Nutristudents\Http\Controllers;

use Bytelaunch\Nutristudents\Models\MealPreparationGroup;
use Bytelaunch\Nutristudents\Models\MenuCreationGroup;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Laravel\Jetstream\Jetstream;
use Illuminate\Routing\Controller;
use Laravel\Jetstream\RedirectsActions;
use Illuminate\Support\Facades\Validator;

use Bytelaunch\Nutristudents\Models\Offering;

class GlobleController extends Controller
{
    public function SearchOffering(Request $request) 
    {   
        $Offerings = Offering::whereHas('site');
        if($request->get('ex_ids')){
            $Offerings->whereNotIn('id', $request->get('ex_ids'));
        }
        if($request->get('term')){
            $Offerings->where(function($q) use($request){
                $q->where('name', 'ilike', "%". $request->get('term') . "%");
                $q->orWhereRelation('site', 'name', 'ilike', "%". $request->get('term') . "%");
            });
        }
        // dd($Offerings->toSql());
        $Offerings = $Offerings->with(['site:id,name'])->orderBy('name', 'asc')->get();
        
        return response()->json($Offerings);
    }

    public function SearchGroups(Request $request) 
    {   
        // dd($request->searchType);
        if($request->searchType == 'food_preparation'){
            $Offerings =  MealPreparationGroup::select('id', 'name');
        } else {
            $Offerings = MenuCreationGroup::select('id', 'name');
        }
        
        if($request->get('ex_ids')){
            $Offerings->whereNotIn('id', $request->get('ex_ids'));
        }
        if($request->get('term')){
            $Offerings->where(function($q) use($request){
                $q->where('name', 'ilike', "%". $request->get('term') . "%");
            });
        }
        $Offerings = $Offerings->orderBy('name', 'asc')->get();
        
        return response()->json($Offerings);
    }
    
}
