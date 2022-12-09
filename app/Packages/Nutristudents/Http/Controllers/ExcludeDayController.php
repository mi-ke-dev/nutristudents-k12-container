<?php

namespace Bytelaunch\Nutristudents\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Laravel\Jetstream\Jetstream;
use Illuminate\Routing\Controller;
use Laravel\Jetstream\RedirectsActions;
use Illuminate\Support\Facades\Validator;

use Bytelaunch\Nutristudents\Models\HelpState;
use Bytelaunch\Nutristudents\Actions\HelpStates\CreateHelpStateAction;
use Bytelaunch\Nutristudents\Actions\HelpStates\UpdateHelpStateAction;
use Bytelaunch\Nutristudents\Actions\HelpStates\DeleteHelpStateAction;
use Bytelaunch\Nutristudents\Models\ExcludeDay;
use Bytelaunch\Nutristudents\Models\Site;
use Illuminate\Support\Facades\Route;


class ExcludeDayController extends Controller
{

    public function index(Request $request) : Response
    {
        $sites = Site::orderBy('name')->pluck('name', 'id');
        $site = ($request->site)?$request->site:'';
        $month = ($request->has('month')) ? $request->input('month') : date('m');
        $year = ($request->has('year')) ? $request->input('year') : date('Y');
        $firstday = "{$year}-{$month}-01";
        $year_list = range(2017, date('Y', strtotime('+10 years')));
        $excludeDays = [];
        if($site != ''){
            $excludeDays  = ExcludeDay::with('offering')->whereMonth('date', $month)
                            ->whereYear('date', $year)
                            ->where('site_id', $site)
                            ->orderBy('date','asc')->get();
        }
            

        return Jetstream::inertia()->render($request, 'ExcludeDay/ExcludeDay', [
               'excludeDays' => $excludeDays,
               'sites' => $sites,
               'site' => $site,
               'get_month' => $month,
               'get_year' => $year,
               'next_month' => date('m',strtotime($firstday.' +1 month')),
               'next_year' =>  date('Y',strtotime($firstday.' +1 year')),
               'pre_month' =>  date('m',strtotime($firstday.' -1 month')),
               'pre_year' =>   date('Y',strtotime($firstday.' -1 year')),
               'year_lists' => $year_list
        ]);
    }

    public function noMealDay(Request $request){
        if($request->day && $request->day !=''){
          $excludeDay =   ExcludeDay::firstOrCreate(['site_id'=> $request->site, 'date'=> $request->day,
        'offering_id'=> $request->offering_id]);
         return response()->json($excludeDay);
        }       
    }

    //addMealDay
    public function addMealDay(Request $request){
        if($request->day && $request->day !=''){
          $excludeDay =   ExcludeDay::where('site_id',$request->site ) 
          ->where('offering_id', $request->offering_id)
          ->where('date', $request->day)
          ->delete();
          
        //   firstOrCreate(['site_id'=> $request->site, 'date'=> $request->day,
        // 'guide_line_id'=> $request->guide_line_id]);
         return response()->json($excludeDay);
        }       
    }


    public function create(Request $request)
    {
       
        $sites = Site::orderBy('name')->pluck('name', 'id');
        $site = $request->site;
        $offering_id = isset($request->offering_id)?$request->offering_id:'';
        $is_menu_planner = isset($request->is_menu_planner)?$request->is_menu_planner:0;
        return Jetstream::inertia()->render($request, 'ExcludeDay/ExcludeDay-add', [
            'sites' => $sites,
            'site' => $site,
            'offering_id'=>$offering_id,
            'is_menu_planner'=>$is_menu_planner
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
          'site_id' => 'required|string',
          'offering_id' => 'required|string',
        //   'date.0' => 'required|date',
        ]);

        foreach(request('date') as $date){
            if($date && $date !=''){
                ExcludeDay::firstOrCreate(['site_id'=> $request->site_id, 'date'=> $date,
            'offering_id'=> $request->offering_id]);
            }
        }
        
        // $reute 
        if($request->is_menu_planner == 1){
            return redirect()->route('calendars', ['site'=> $request->site_id,'offering_id'=>$request->offering_id]);
        }else{
            return redirect()->route('special-days', ['site'=> $request->site_id,'offering_id'=>$request->offering_id]);
        }

    }

    public function destroy(ExcludeDay $ExcludeDay)
    {
        // $remove_helpstate = (new DeleteHelpStateAction())
        //     ->sourceHelpState($helpstate)
        //     ->deleteHelpState();
            // HelpState
        $site_id = $ExcludeDay->site_id;
        $month = date('m', strtotime($ExcludeDay->date)) ;
        // dd($month, $ExcludeDay->date);
        $year = date('Y', strtotime($ExcludeDay->date));
        $ExcludeDay->delete();
        return redirect()->route('special-days', ['site'=>$site_id, 'month'=> $month, 'year'=>$year]);
    }



    
}
