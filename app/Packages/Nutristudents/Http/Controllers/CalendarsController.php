<?php

declare(strict_types=1);

namespace Bytelaunch\Nutristudents\Http\Controllers;

use App\Models\User;
use Bytelaunch\Nutristudents\Actions\Calendar\CreateCalendarAction;
use Bytelaunch\Nutristudents\Actions\Calendar\CreateCalendarDaysAction;
use Bytelaunch\Nutristudents\Actions\MenuCycles\CopyMenuCycleAction;
use Bytelaunch\Nutristudents\Getters\MenuCycle\MenuCycleCalendarGetter;
use Bytelaunch\Nutristudents\Getters\Sites\GetMenuCreationGetter;
use Bytelaunch\Nutristudents\Getters\Sites\GetSitesGetter;
use Bytelaunch\Nutristudents\Models\AgeGradeOffering;
use Bytelaunch\Nutristudents\Models\Calendar;
use Bytelaunch\Nutristudents\Models\Days;
use Bytelaunch\Nutristudents\Models\ExcludeDay;
use Bytelaunch\Nutristudents\Models\FoodOrderStudentCount;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Laravel\Jetstream\Jetstream;
use Illuminate\Routing\Controller;
use Laravel\Jetstream\RedirectsActions;
use Illuminate\Support\Facades\Validator;

use Bytelaunch\Nutristudents\Models\Site;
use Bytelaunch\Nutristudents\Models\GradeRange;
use Bytelaunch\Nutristudents\Models\Guideline;
use Bytelaunch\Nutristudents\Models\Meal;
use Bytelaunch\Nutristudents\Models\MealType;
use Bytelaunch\Nutristudents\Models\MenuCreationGroup;
use Bytelaunch\Nutristudents\Models\MenuCycle;
use Bytelaunch\Nutristudents\Models\MenuCycleDayOption;
use Bytelaunch\Nutristudents\Models\MenuCycleDayOptionComponent;
use Bytelaunch\Nutristudents\Models\Recipe;
use Bytelaunch\Nutristudents\Models\WeekCycle;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class CalendarsController extends Controller
{
    use RedirectsActions;

    
    public function index(Request $request)
    {
        // Artisan ::call('autoincrement:set-increment' , ['source-tenant'=> 'tenancy_test', '--table' => 'users']);

        $users = User::select('id', 'name')->get();
        $month = ($request->has('month')) ? $request->input('month') : date('m');
        $year = ($request->has('year')) ? $request->input('year') : date('Y');
        $meal_type = ($request->has('meal_type')) ? $request->input('meal_type') : '';
        $age_grade_offering = ($request->has('age_grade_offering')) ? $request->input('age_grade_offering') : '';
        $day = ($request->has('day')) ? $request->input('day') : '';
        $site = ($request->has('site')) ? $request->input('site') : '';
        $guide_line_id = ($request->has('guide_line_id')) ? $request->input('guide_line_id') : '';
        $type = ($request->has('type')) ? $request->input('type') : '';
        $offering_id = ($request->has('offering_id')) ? $request->input('offering_id') : '';
        $group_id = ($request->has('group_id')) ? $request->input('group_id') : '';
        
        
        $firstday = "{$year}-{$month}-01";
        $is_print = isset($request->is_print) ? $request->is_print : 0;
        
        // if($is_print == 1){
        //     $calender_days = $this->getCalendarMonthDaysForReport($month, $year); 
        // }else{
        //     $calender_days = $this->getCalendarMonthDays($month, $year); 
        // }

        $calender_days = $this->getCalendarMonthDays($month, $year); 
       

         
        $grade_ranges = AgeGradeOffering::orderBy('name','asc')->get();
        // GradeRange::has('menu_cycles')->orderBy('name','asc')->get();
        $mealTypeImport = MealType::orderBy('name','asc')->get();
        $daysImport = Days::has('menu_cycles')->orderBy('name','asc')->get();
        $new_array = [];
        $sites = (new GetSitesGetter)
                    ->forUser(auth()->user()) 
                    ->forType('menu_planings,headcounts')
                    ->get(); 
                    //Site::orderBy('name','asc')->get(); 
        $menu_group_creation = (new GetMenuCreationGetter)
        ->forUser(auth()->user()) 
        ->forType('menu_planings')
        ->get();
        // MenuCreationGroup::orderBy('name','asc')->get();
        
        foreach($sites as $value){
            $new_array[] = array('type'=> 'site', 'name'=> $value->name, 'id'=> $value->id);
        }

        foreach($menu_group_creation as $val){
            $new_array[] = array('type'=> 'group', 'name'=> $val->name, 'id'=> $val->id);
        }

        // dd($menu_group_creation->toArray(), $new_array);
        

        if($is_print == 1){

            $guideline = Guideline::find($guide_line_id);
            $site_name = Site::find($site);
            $age_group = AgeGradeOffering::find($guideline->age_grade_id);
            $day_data = Days::find($guideline->days_id);
            $type = request('type');
            // dd($type);
            $calendar_data = $this->loadMenuPlannerData($guideline->meal_type_id, $guideline->age_grade_id, $guideline->days_id, $month, $year, $site,$guide_line_id, $type);
            return view('calendar-print', [
                'meal_type' => $meal_type,
                'age_grade_offering' => $age_grade_offering,
                'day' => $day,
                'get_month' => $month,
                'get_year' => $year,
                'next_month' => date('m',strtotime($firstday.' +1 month')),
                'next_year' =>  date('Y',strtotime($firstday.' +1 year')),
                'pre_month' =>  date('m',strtotime($firstday.' -1 month')),
                'pre_year' =>   date('Y',strtotime($firstday.' -1 year')),
                'calender_days' => $calender_days,
                'grade_ranges' => $grade_ranges,
                'mealTypeImport' => $mealTypeImport,
                'daysImport' => $daysImport,
                'sites' => $sites,
                'site'=> $site,
                'guide_line_id' => $guide_line_id,
                'calendar_data' => $calendar_data,
                'day_data' => $day_data,
                'age_group' => $age_group,
                'site_name' => $site_name
            ]);
        }else{
            return Jetstream::inertia()->render($request, 'Calendar/Calendar', [
                'meal_type' => $meal_type,
                'age_grade_offering' => $age_grade_offering,
                'day' => $day,
                'get_month' => $month,
                'get_year' => $year,
                'next_month' => date('m',strtotime($firstday.' +1 month')),
                'next_year' =>  date('Y',strtotime($firstday.' +1 year')),
                'pre_month' =>  date('m',strtotime($firstday.' -1 month')),
                'pre_year' =>   date('Y',strtotime($firstday.' -1 year')),
                'calender_days' => $calender_days,
                'grade_ranges' => $grade_ranges,
                'mealTypeImport' => $mealTypeImport,
                'daysImport' => $daysImport,
                'sites' => $new_array,
                'site'=> $site,
                'guide_line_id' => $guide_line_id,
                'type'=> $type,
                'offering_id'=>$offering_id,
                'group_id'=>$group_id,
                'users' => $users
         ]);

        }

        
    }

    public function loadMenuPlannerData($mealType, $ageGradeOffering, $day, $month, $year, $site,$guide_line_id, $type){
        $monthYear = date('Y-m-d', strtotime($year .'-'.$month.'-'.'01'));     
        $calendar_weeks = [];
        $calendar = Calendar::where('age_grade_offering_id', $ageGradeOffering);
        if($type == 'group'){
            $calendar = $calendar->where('meal_type_id', $mealType) 
             ->where('site_type', 'group')
            ->where('group_id', $site)
        ->first();
        } else {
            $calendar = $calendar->where('meal_type_id', $mealType) 
            ->where('day_id', $day) 
            ->where('month_year', $monthYear)
            ->where('site_id', $site)
            ->where('guide_line_id', $guide_line_id)  
        ->first();
        }
        
        //dd($calendar);
        if($calendar && $calendar->calendar_days){
            //dd($calendar->calendar_days);
            foreach($calendar->calendar_days as $cal_days){
                if($cal_days->menu_cycle){
                    $cal_days->menu_cycle = (new MenuCycleCalendarGetter)->forMenuCycle($cal_days->menu_cycle)->get();
                    $calendar_weeks[] = $cal_days;
                }  
            }
        }
        
        return $calendar_weeks;
    }


    public function loadMenuPlanner( MealType $mealType, AgeGradeOffering $ageGradeOffering, Days $day, $month, $year,$site,$guide_line_id, $type, $offering_id=null){
        $monthYear = date('Y-m-d', strtotime($year .'-'.$month.'-'.'01'));
        $calendar_weeks = [];
        if($type == 'group'){
            $calendar_records = Calendar::where('age_grade_offering_id', $ageGradeOffering->id)
            ->where('meal_type_id', $mealType->id) 
            ->where('day_id', $day->id) 
            ->where('guide_line_id', $guide_line_id)
            ->where('group_id', $site)
            ->where('month_year', $monthYear)
            
            ->where('site_type', 'group')    
            ->get();
        }else{           
            $calendar_records = Calendar::where('age_grade_offering_id', $ageGradeOffering->id)
            ->where('meal_type_id', $mealType->id) 
            ->where('day_id', $day->id) 
            ->where('site_id', $site)
            ->where('guide_line_id', $guide_line_id)  
            ->where('offering_id',$offering_id)
            ->where('month_year', $monthYear)            
            ->where('site_type','site')
            ->get();

        }

        if($calendar_records){
            foreach($calendar_records as $calendar){
                foreach($calendar->calendar_days as $cal_days){
                    if($cal_days->menu_cycle){
                        $cal_days->menu_cycle = (new MenuCycleCalendarGetter)->forMenuCycle($cal_days->menu_cycle)->get();
                        $calendar_weeks[] = $cal_days;
                    }  
                }
            }            
        } 

        if(count($calendar_weeks) > 0){
            $json = md5(json_encode($calendar_weeks));
            $filePath = 'dummy/'. date('Y-m-d').'/'.$json.'json';
            if(!Storage::disk('s3')->exists($filePath)){
                Storage::disk('s3')->put($filePath, json_encode($calendar_weeks));                
            }
            $json_url =  Storage::disk('s3')->temporaryUrl($filePath, now()->addDay());         
            return $json_url;
        } 
        return response()->json('');
        
        // return response()->json($calendar_weeks);
    }

    public function loadMenuPlannerByWeek( MealType $mealType, AgeGradeOffering $ageGradeOffering, Days $day, $month, $year,$site,$guide_line_id, $type, $offering_id=null, $weekNumber=null){
        $monthYear = date('Y-m-d', strtotime($year .'-'.$month.'-'.'01'));
        $calendar_weeks = null;
        if($type == 'group'){
            $calendar_records = Calendar::where('month_year', $monthYear)
            ->where('age_grade_offering_id', $ageGradeOffering->id)
            ->where('meal_type_id', $mealType->id) 
            ->where('day_id', $day->id) 
            ->where('guide_line_id', $guide_line_id)
            ->where('group_id', $site)                        
            ->where('site_type', 'group')    
            ->whereRelation('calendar_days', 'week_number', '=', $weekNumber)
            ->get();
        }else{           
            $calendar_records = Calendar::where('month_year', $monthYear)
            ->where('age_grade_offering_id', $ageGradeOffering->id)
            ->where('meal_type_id', $mealType->id) 
            ->where('day_id', $day->id) 
            ->where('site_id', $site)
            ->where('guide_line_id', $guide_line_id)  
            ->where('offering_id',$offering_id)                        
            ->where('site_type','site')
            ->whereRelation('calendar_days', 'week_number', '=', $weekNumber)
            ->get();

        }

        if($calendar_records){
            foreach($calendar_records as $calendar){
                $cDays = $calendar->calendar_days->where('week_number', $weekNumber);
                foreach($cDays as $cal_days){
                    if($cal_days->menu_cycle){
                        
                        $cal_days->menu_cycle = (new MenuCycleCalendarGetter)->forMenuCycle($cal_days->menu_cycle)->get();
                        $calendar_weeks = $cal_days;
                    }  
                }
            }            
        } 

        // if(count($calendar_weeks) > 0){
        //     $json = md5(json_encode($calendar_weeks));
        //     $filePath = 'dummy/'. date('Y-m-d').'/'.$json.'json';
        //     if(!Storage::disk('s3')->exists($filePath)){
        //         Storage::disk('s3')->put($filePath, json_encode($calendar_weeks));                
        //     }
        //     $json_url =  Storage::disk('s3')->temporaryUrl($filePath, now()->addDay());         
        //     return $json_url;
        // } 
        // return response()->json('');
        return $calendar_weeks;
        
        // return response()->json($calendar_weeks);
    }

    public function loadExcludeDates($site,$guide_line_id){
        $excludeDays = [];
        if($site != '' && $guide_line_id != ''){
            $excludeDays  = ExcludeDay::where('site_id', $site)
            ->where('offering_id', $guide_line_id) 
            // where([['site_id', ],['offering_id', $guide_line_id]])
            ->orderBy('date','asc')->get()->toArray();
        }
        
        return response()->json($excludeDays);
    }

    public function loadMenuSearch( MealType $mealType, AgeGradeOffering $ageGradeOffering, Days $day, $month, $year, Site $site, $search){
        $monthYear = date('Y-m-d', strtotime($year .'-'.$month.'-'.'01'));
       // dd($site);
        $calendar_weeks = [];

    

        $calendar = Calendar::where('age_grade_offering_id', $ageGradeOffering->id)
            ->where('meal_type_id', $mealType->id) 
            ->where('day_id', $day->id) 
            ->where('month_year', $monthYear)
            ->where('site_id', $site->id)  
        ->first();
        // dd($calendar);
        if($calendar){
            foreach($calendar->calendar_days as $cal_days){
                $cal_days->menu_cycle = (new MenuCycleCalendarGetter)->forMenuCycle($cal_days->menu_cycle)->get();
                $calendar_weeks[] = $cal_days;
            }
        }
        return response()->json($calendar_weeks);
    }


    public function getMenuCycleDetail(Request $request, MenuCycle $menuCycle )
    {          
        if($request->is_create){
            $form = $request->get('form');
            $MealType = MealType::find($form['meal_type']);
            $AgeGradeOffering = AgeGradeOffering::find($form['age_grade_offering']);
            $Days = Days::find($form['day']);
            $monthYear = date('Y-m-d', strtotime($form['year'] .'-'.$form['month'].'-'.'01'));
            $site = $form['site'];

            if($form['type'] == 'group'){
                $site = null;
                $offerid = null;
                $groupid = $form['site'];
               
            }else{
                $site = $form['site'];
                $groupid = null;
                $offerid = $form['offering_id'];
                
            }

            $calender = Calendar::where('age_grade_offering_id', $form['age_grade_offering'])
                ->where('meal_type_id', $form['meal_type']) 
                ->where('day_id', $form['day']) 
                ->where('month_year', $monthYear)
                ->where('site_id', $form['site']) 
                ->where('offering_id',$form['offering_id'])
                ->first();

            if($calender){
                $calender = $calender;
            }else{
                $calender = ( new CreateCalendarAction())
                ->setDays($Days)
                ->setMealType($MealType)
                ->setAgeGradeOffering($AgeGradeOffering)
                ->setMonthYear($monthYear)
                ->setSiteId($site)
                ->setGuideLineId($form['guide_line_id'])
                ->setSiteType($form['type'])
                ->setGroupId($groupid)
                ->setOfferingId($offerid)
                ->setWeekNumber($request->week_number) 
                ->create();
            }

            
            
            $cal_days = (new CreateCalendarDaysAction())
                ->forCalendar($calender)
                ->setWeekNumber($request->week_number) 
                ->setMenCycle($menuCycle)
                ->create();


            if($form['type'] == 'group'){
                $group = MenuCreationGroup::with(['offerings.site'])->find($calender->group_id);
                $offering_array = $group->offerings->toArray();
                
                foreach($offering_array as $offer){

                    $calender = Calendar::where('age_grade_offering_id', $AgeGradeOffering->id)
                    ->where('meal_type_id', $MealType->id) 
                    ->where('day_id', $Days->id) 
                    ->where('month_year', $monthYear)
                    ->where('group_id', $groupid)
                    ->where('offering_id',$offer['id'])
                    ->first();
                    if($calender){
                        $calender = $calender;
                    }else{
                        $calender = ( new CreateCalendarAction())
                        ->setDays($Days)
                        ->setMealType($MealType)
                        ->setAgeGradeOffering($AgeGradeOffering)
                        ->setMonthYear($monthYear)
                        ->setSiteId($offer['site_id'])
                        ->setGuideLineId($form['guide_line_id'])
                        ->setSiteType('site')
                        ->setGroupId($groupid)
                        ->setOfferingId($offer['id'])
                        ->create();

                    }

                    

                    $new_cal_days = (new CreateCalendarDaysAction())
                    ->forCalendar($calender)
                    ->setWeekNumber($request->week_number) 
                    ->setMenCycle($cal_days->menu_cycle)
                    ->create();
                }
            }
            $menuCycleData = (new MenuCycleCalendarGetter)->forMenuCycle($cal_days->menu_cycle)->get();
        } else {
            $menuCycleData = (new MenuCycleCalendarGetter)->forMenuCycle($menuCycle)->get();
        }
        return response()->json($menuCycleData);
    }


    public function add_count(Request $request) : Response
    {
        
        return Jetstream::inertia()->render($request, 'Calendar/StudentCounts', []);
    }


    public function getCalendarMonthDays($month = '', $year = ''){

        $firstday    = $this->firstlastdayMonth('first', $month, $year);
        $lastday     = $this->firstlastdayMonth('last', $month, $year);
        $total_weeks = $this->getTotalWeeks($firstday, $lastday);
        $month = (empty($month)) ? date('m') : $month;
        $year  = (empty($year)) ? date('Y') : $year;
        // dd($firstday, $lastday, $total_weeks, date('Y-m-d',strtotime($firstday)));
        $calendar_days = array();
        // dd($firstday);
        // $day = date('w', strtotime($firstday));
        // $week_start = date('m-d-Y', strtotime('-'.$day.' days'));
        // dd($day , $week_start);

        for($week = 0; $week < $total_weeks; $week++){

            $firstweekday = ($week == 0) ? strtotime($firstday) : strtotime("+7 day", $firstweekday);
            
            
            $wday = date('w', $firstweekday);  
            // dd($wday); 
            $weeks = array('days'=> [], 'menuCycle'=> '');
            // dd( date('Y-m-d', $firstweekday), $wday, $weeks);
            
            for($day = 0; $day < 7; $day++){
            
                // dd(date('D', $firstweekday), $wday , $day+1);
              
            //   $get_date  = date('d-m-Y', $firstweekday - ($wday - ($day+1))*86400);
            if(date('D', $firstweekday) == 'Sun'){
                $get_date  = date('d-m-Y', $firstweekday - ($wday - ($day-6))*86400);
            } else {
                $get_date  = date('d-m-Y', $firstweekday - ($wday - ($day+1))*86400);
            }
              

            //   dd($get_date, $day, $wday);
              $date_month = date("m", strtotime($get_date));
              $date_day = date("D", strtotime($get_date));   
              
              $weeks['days'][$day]['date'] = date($this->getDateFormat(), strtotime($get_date));              
              $weeks['days'][$day]['type'] = ($date_month != $month) ? 'next' : '';
              $weeks['days'][$day]['day'] =  strtoupper($date_day);
              $weeks['days'][$day]['is_past'] = date('Y-m-d', strtotime($get_date)) > date('Y-m-d');
            }
            $calendar_days['weeks'][$week] = $weeks;   
            // dd($calendar_days);
        }     
        return $calendar_days;
    }

    public function getCalendarMonthDaysForReport($month = '', $year = ''){

        $firstday    = $this->firstlastdayMonth('first', $month, $year);
        $lastday     = $this->firstlastdayMonth('last', $month, $year);
        $total_weeks = $this->getTotalWeeks($firstday, $lastday);
        $month = (empty($month)) ? date('m') : $month;
        $year  = (empty($year)) ? date('Y') : $year;
        $calendar_days = array();
        for($week = 0; $week < $total_weeks; $week++){

            $firstweekday = ($week == 0) ? strtotime($firstday) : strtotime("+7 day", $firstweekday);
            $wday = date('w', $firstweekday);   
            $weeks = array('days'=> [], 'menuCycle'=> '');
            
            for($day = 1; $day < 8; $day++){
              
              $get_date  = date('d-m-Y', $firstweekday - ($wday - ($day-1))*86400);
              $date_month = date("m", strtotime($get_date));
              $date_day = date("D", strtotime($get_date));   
              
              $weeks['days'][$day]['date'] = date($this->getDateFormat(), strtotime($get_date));              
              $weeks['days'][$day]['type'] = ($date_month != $month) ? 'next' : '';
              $weeks['days'][$day]['day'] =  strtoupper($date_day);
            }
            $calendar_days['weeks'][$week] = $weeks;   
        }     
        return $calendar_days;
    }


    public function firstlastdayMonth($output = '', $month = '', $year = '') {
       
       if (empty($month)) {
          $month = date('m');
       }
       if (empty($year)) {
          $year = date('Y');
       }

       $firstday = strtotime("{$year}-{$month}-01");
       $lastday  = strtotime('-1 second', strtotime('+1 month', $firstday));

       if($output == 'first'){
        return date('d-m-Y', $firstday);
       }

       else if($output == 'last'){
        return date('d-m-Y', $lastday);
       }

       else{
        return date('d-m-Y', $lastday);
       }
       
    }


    public function getDateFormat() {
        return 'm-d-Y';
    }




    public function getTotalWeeks($first, $last)
    {                     
         // Start week
         $start_week = date('W', strtotime($first));
         // End week
         $end_week = date('W', strtotime($last));

         if ($end_week < $start_week) { // Month wraps
           return ((52 + $end_week) - $start_week) + 1;
         }

         return ($end_week - $start_week) + 1;
    }    

    public function saveStudentCount(Request $request )
    {        
        if($request->fav){
            foreach($request->fav as $ocomp => $val){
                $op =Recipe::find($ocomp);
                if($op){
                    $op->is_favorite = $val;
                    $op->save();
                }
            }
        }
        if($request->studentCount){
            foreach($request->studentCount as $ocomp => $val){
                $op =MenuCycleDayOptionComponent::find($ocomp);

                if($op){
                    if($op->source_id && $val['student_count'] > 0){
                        $foodOrderStudentCount = FoodOrderStudentCount::updateOrCreate(
                            [
                                'site_id'=> $val['site_id'], 
                                'meal_type_id'=> $val['meal_type_id'],
                                'age_range_id'=> $val['age_range_id'],
                                'recipe_id'=> $val['recipe_id'],
                                'option_id'=> $op->source_id
                            ],
                            ['student_count'=> $val['student_count']]
                        );
                    }
                    

                    $op->student_count = $val['student_count'];
                    if(isset($val['is_favorite'])){
                        $op->is_favorite = $val['is_favorite'];
                    }
                    
                    $op->save();
                    // if(isset($val['student_count'])){
                        
                    // }
                }
            }
        }
        return response()->json(true);
    }

}
