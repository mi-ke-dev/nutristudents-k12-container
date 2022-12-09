<?php

namespace Bytelaunch\Nutristudents\Http\Controllers;
 
use Inertia\Response;
use Illuminate\Http\Request;
use Laravel\Jetstream\Jetstream;
use Illuminate\Routing\Controller; 
 
use Bytelaunch\Nutristudents\Getters\MenuPlanner\getDateOptionsGetter; 
use Bytelaunch\Nutristudents\Models\MenuCycleDayOption;
use Bytelaunch\Nutristudents\Models\Offering;
use Bytelaunch\Nutristudents\Models\Site; 
use Barryvdh\DomPDF\Facade\Pdf;
use Bytelaunch\Nutristudents\Getters\Sites\GetMealPreprationGetter;
use Bytelaunch\Nutristudents\Getters\Sites\GetMenuCreationGetter;
use Bytelaunch\Nutristudents\Getters\UnitConvert\UnitConversionsGetter;
use Bytelaunch\Nutristudents\Models\MealPreparationGroup;
use Bytelaunch\Nutristudents\Models\MenuCreationGroup;
use Bytelaunch\Nutristudents\Models\MenuCycleDayOptionComponent;
use Bytelaunch\Nutristudents\Models\Recipe;
use Bytelaunch\Nutristudents\Models\UnitOfMeasurement;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;

class FoodProductionReportController extends Controller
{
    
    public function index(Request $request) : Response
    {     
        $user = auth()->user();
        $user_id = $user->id;
        $is_admin = $user->isSuperUser();
        // dd($is_admin);
        $sites = Site::select('id', 'name')
        ->has('offerings');
        if(!$is_admin ){
            $sites->where(function($q) use($user_id){    
                $q->whereHas('food_preparation', function($q1)use($user_id){
                    $q1->where('user_id', $user_id);
                });
            })            
            ->with(['offerings' => function($q) use($user_id){
                $q->select('offerings.id','offerings.name');
                $q->whereHas('food_preparation', function($q1)use($user_id){
                    $q1->where('user_id', $user_id);
                });
            }]);
        } else {
            $sites          
            ->with(['offerings:id,name']);
        }
        $sites = $sites->orderBy('name','asc')->get();
        
        $MenuCreationGroup = (new GetMealPreprationGetter)
        ->forUser(auth()->user()) 
        ->forType('food_preparation')
        ->get();
        
        
        return Jetstream::inertia()->render($request, 'FoodProductionReport/index', [
            'sites'=>$sites,
            'MenuCreationGroup' => $MenuCreationGroup
        ]);
    }

    
    public function getRecord(Request $request){
        $date = $request->date;
        $site = Site::find($request->site);
        $offer = Offering::find($request->offer);
        $status = true;
        $message = "data found";
        $dayOptions = null;

        if($request->type == 'group'){
            $mpgs = MealPreparationGroup::find($request->site);
            $options = [];
            // dd($mpgs->toArray());
            
            $siteIds = [];
            if($mpgs && $mpgs->offerings){
                foreach($mpgs->offerings as $offering){
                    $calender = (new getDateOptionsGetter)
                        ->forDate($date)
                        ->forOffering($offering)
                        ->forSite($offering->site)
                        ->get();
                    $sites[$offering->site->id] = $offering->site->name;
                    $siteIds[$offering->site->id] = null;
                    if($calender){
                        if($calender->calendar_days && isset($calender->calendar_days) && $calender->calendar_days[0]->menu_cycle->menuCycleDays && isset($calender->calendar_days[0]->menu_cycle->menuCycleDays[0])){
                            // $ol = $calender->calendar_days[0]->menu_cycle->menuCycleDays[0];
                            $ol = $offering;
                            $ol->day_id = $calender->calendar_days[0]->menu_cycle->menuCycleDays[0]->id;
                            $ol->site_id = $offering->site->id;
                            $ol->site_name = $offering->site->name;
                            $options[] = $ol->toArray();
                        }                        
                    } 
                }
            }
            if(count($options)){
                $dayOptions = $options;
                // $this->convertGroup($options, $siteIds);
                // dd($options);
            } else {
                $status = false;
                $message = "No Record Found";
            }
            // dd($dayOptions);
        } else {
            $calender = (new getDateOptionsGetter)
                ->forDate($date)
                ->forOffering($offer)
                ->forSite($site)
                ->get();                
                if($calender){
                    if($calender->calendar_days && isset($calender->calendar_days) && $calender->calendar_days[0]->menu_cycle->menuCycleDays && isset($calender->calendar_days[0]->menu_cycle->menuCycleDays[0])){
                        $dayOptions = $calender->calendar_days[0]->menu_cycle->menuCycleDays[0]->id;
                    } else {
                        $status = false;
                    $message = "No Record Found";
                    }
                    
                } else {
                    $status = false;
                    $message = "No Record Found";
                }
        }       

        return response()->json(['status'=>$status, 'msg'=>$message, 'data'=> $dayOptions, 'type' => $request->type]);
    }
 
    public function getUOMNameByID($uomId = NULL)
    { 
			return $uomname = ($uomId != NULL) ? UnitOfMeasurement::find($uomId)->name : NULL;
    } 

    
}
