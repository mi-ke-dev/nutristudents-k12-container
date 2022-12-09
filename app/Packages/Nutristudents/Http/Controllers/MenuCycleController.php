<?php

declare(strict_types=1);

namespace Bytelaunch\Nutristudents\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Bytelaunch\Nutristudents\Actions\Calendar\AttachCalendarDaysToMenuCycleAction;
use Bytelaunch\Nutristudents\Actions\Calendar\CreateCalendarAction;
use Bytelaunch\Nutristudents\Actions\Calendar\CreateCalendarDaysAction;
use Bytelaunch\Nutristudents\Actions\Calendar\CreateCalendarDaysWithoutMenuAction;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Laravel\Jetstream\Jetstream;
use Illuminate\Routing\Controller;
use Laravel\Jetstream\RedirectsActions;
use Illuminate\Support\Facades\Validator;

use Bytelaunch\Nutristudents\Models\Product;
use Bytelaunch\Nutristudents\Models\Ingredient;
use Bytelaunch\Nutristudents\Models\GradeRange;
use Bytelaunch\Nutristudents\Models\Offering;
use Bytelaunch\Nutristudents\Models\Recipe;
use Bytelaunch\Nutristudents\Models\Site;
use Bytelaunch\Nutristudents\Models\Guideline;
use Illuminate\Support\Facades\DB;

use Bytelaunch\Nutristudents\Models\MealType;
use Bytelaunch\Nutristudents\Models\AgeGradeOffering;
use Bytelaunch\Nutristudents\Models\Days;

use Bytelaunch\Nutristudents\Models\MenuCycle;
use Bytelaunch\Nutristudents\Models\MenuCycleDay;
use Bytelaunch\Nutristudents\Models\MenuCycleDayOption;
use Bytelaunch\Nutristudents\Models\MenuCycleDayOptionComponent;

use Bytelaunch\Nutristudents\Actions\MenuCycleDayOptions\CreateOptionComponentAction;
use Bytelaunch\Nutristudents\Actions\MenuCycleDayOptions\UpdateOptionComponentAction;
use Bytelaunch\Nutristudents\Actions\MenuCycles\CreateMenuCycleForDayAction;
use Bytelaunch\Nutristudents\Actions\MenuCycles\UpdateMenuCycleForDayAction;
use Bytelaunch\Nutristudents\Actions\MenuCycleOptions\CreateOptionAction;
use Bytelaunch\Nutristudents\Actions\MenuCycleOptions\UpdateOptionAction;
use Bytelaunch\Nutristudents\Actions\Recipes\CreateRecipeAction;
use Bytelaunch\Nutristudents\Actions\MenuCycleDayOptions\DeleteMenuCycleDayOptionAction;
use Bytelaunch\Nutristudents\Actions\MenuCycles\ChangeMenuCycleOptionSourceId;
use Bytelaunch\Nutristudents\Actions\MenuCycles\CreateMenuCycleAction;
use Bytelaunch\Nutristudents\Actions\MenuCycles\JsonStoreMenuCycleListAction;
use Bytelaunch\Nutristudents\Actions\MenuCycles\UpdateMenuCycleAction;
use Bytelaunch\Nutristudents\Actions\MenuCycles\SyncGradeRangeAction;
use Bytelaunch\Nutristudents\Enum\CategoryEnum;
use Bytelaunch\Nutristudents\Models\UnitOfMeasurement;
use Illuminate\Support\Facades\Storage;
use Bytelaunch\Nutristudents\Actions\MenuCycles\CopyMenuCycleAction;
use Bytelaunch\Nutristudents\Actions\MenuCycles\CopyMenuCycleCopyAction;
use Bytelaunch\Nutristudents\Actions\MenuCycles\CopyMenuCycleDayAction;
use Bytelaunch\Nutristudents\Getters\Offering\GetOfferingGetter;
use Bytelaunch\Nutristudents\Getters\UnitConvert\UnitConversionsGetter;
use Bytelaunch\Nutristudents\Models\Calendar;
use Bytelaunch\Nutristudents\Models\CalendarDay;
use Bytelaunch\Nutristudents\Models\ExcludeDay;
use Bytelaunch\Nutristudents\Models\MenuCreationGroup;
use Dompdf\Dompdf;
use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Zip;
use File;
use Illuminate\Filesystem\Filesystem;
use ZipStream\ZipStream;

class MenuCycleController extends Controller
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
        $mealtype_data = MealType::orderBy('name','asc')->get();
        $agerange_data = AgeGradeOffering::orderBy('name','asc')->get();
        $days_data = Days::orderBy('name','asc')->get();
        $categories = CategoryEnum::options();  

				$mass_measurements    = UnitOfMeasurement::massMeasurements();
        $unit_measurements    = UnitOfMeasurement::unitMeasurements();
        $volume_measurements  = UnitOfMeasurement::volumeMeasurements(); 
        // dd($days_data->toArray());  
        
        // $grade_ranges_val = GradeRange::orderBy('name','asc')->get();

        // if($request->get('graderange')){
        // $grade_range_name = GradeRange::find($request->get('graderange'));
        // $meal_types = Offering::whereRaw("LOWER(name) LIKE '%".strtolower($grade_range_name->name)."%'")->orderBy('name','asc')->get('name'); 
        // $meal_types->map(function($item, $key){
        //     $start = strpos($item->name, "(")+1;
        //     $end = strpos($item->name, ")");
        //     $length = $end - $start;
        //     $item->name = substr($item->name, $start, $length);
        // });        
        // }else{
        //  $meal_types='';
        // }
		
				$offering_id = ($request->has('offering_id')) ? $request->input('offering_id') : '';
        $selected_mealtype = $request->get('mealtype');
        $selected_agerange = $request->get('agerange');
        $selected_days = $request->get('days');
        $month = $request->get('month');
        $year = $request->get('year');
        $weekNumber = $request->get('weekNumber');
        $site = $request->get('site');
				$type = $request->get('type');
        $guide_line_id = $request->get('guide_line_id');
				$weekDate = $request->get('weekDate');

				$name = "Menu Cycle";
				$is_template = 1;
				$is_fav_show = 1;
				if($weekDate){
					$name = "Week of ".$weekDate;
					$is_template = 0;
					$is_fav_show = 0;
				}


        return Jetstream::inertia()->render($request, 'MenuCycle/MenuCycle', [  
           // 'meal_types_data' => $meal_types,         
           // 'grade_ranges' => $grade_ranges_val,
           'selected_mealtype' => $selected_mealtype,
           'selected_agerange' => $selected_agerange,
           'selected_days' => $selected_days,
           'mealtype_data' => $mealtype_data,
           'agerange_data' => $agerange_data,
           'days_data' => $days_data,
           'categories' => $categories,
           'month' => $month,
           'year' => $year,
           'weekNumber' => $weekNumber,
           'site' => $site,
           'guide_line_id' => $guide_line_id,
					'menuName' => $name,
					'mass_measurements' => $mass_measurements,
					'unit_measurements' => $unit_measurements,
					'volume_measurements' => $volume_measurements,
					'is_template' => $is_template,
					'is_fav_show' => $is_fav_show,
					'type'=>$type,
					'offering_id'=> $offering_id
        ]);


    }


    public function store(Request $request)
    {
        
        $request->validate([
          'mc_name' => 'required',          
          'meal_type_id' => 'required|string',
          'age_grade_id' => 'required|string',
          'days_id' => 'required|string', 
          'guideline_id'=>'required|string',
        //   'week_number'=>'required'
        ],[
          'mc_name.required' => 'This field is required.',                    
          'meal_type_id.required' => 'This field is required.',
          'age_grade_id.required' => 'This field is required.',
          'days_id.required' => 'This field is required.',
          'guideline_id.required' => 'This field is required.',
          'week_number.required' => 'This field is required.'
        ]);


        

        $current_user = $request->user();
        $current_user_id = $current_user->id;
		$name = $request->mc_name;
		$week_number = 0;
		if($request->week_number)
		{
			$week_number = $request->week_number;
		}

        $menu_cycle = (new CreateMenuCycleAction())
            ->setName($name)
            ->setMealType($request->meal_type_id)
            ->setAgeRange($request->age_grade_id)
            ->setDays($request->days_id)
            ->setUserId(intval($current_user_id))
            ->setGuideline($request->guideline_id)
            ->setWeekNumber($week_number)
            ->setIsTemplate($request->is_template)
            ->create();        

        // ********** monday condition ***************
        
        if(!empty($request->mc_options_mon)){
        $monday_data_save = $this->updateMenuCycleDayOptionsMethod($request->mc_options_mon, $menu_cycle, 'MON');            
        }

        // ********** tuesday condition ***************
            
        if(!empty($request->mc_options_tue)){
        $tuesday_data_save = $this->updateMenuCycleDayOptionsMethod($request->mc_options_tue, $menu_cycle, 'TUE');
        }

        // ********** wednesday condition ***************
            
        if(!empty($request->mc_options_wed)){
        $wednesday_data_save = $this->updateMenuCycleDayOptionsMethod($request->mc_options_wed, $menu_cycle, 'WED');
        }

        // ********** thursday condition ***************
            
        if(!empty($request->mc_options_thu)){
        $thursday_data_save = $this->updateMenuCycleDayOptionsMethod($request->mc_options_thu, $menu_cycle, 'THU');
        }

        // ********** friday condition ***************
            
        if(!empty($request->mc_options_fri)){
        $friday_data_save = $this->updateMenuCycleDayOptionsMethod($request->mc_options_fri, $menu_cycle, 'FRI');
        }        

        // ********** saturday condition ***************
            
        if(!empty($request->mc_options_sat)){
        $saturday_data_save = $this->updateMenuCycleDayOptionsMethod($request->mc_options_sat, $menu_cycle, 'SAT');
        }

        // ********** sunday condition ***************
            
        if(!empty($request->mc_options_sun)){
        $sunday_data_save = $this->updateMenuCycleDayOptionsMethod($request->mc_options_sun, $menu_cycle, 'SUN');
        }

        (new JsonStoreMenuCycleListAction())->setMenuCycle($menu_cycle)->store();
        if($request->month && $request->year && $request->mealtype && $request->agerange && $request->days ){
            $MealType = MealType::find($request->mealtype);
            $AgeGradeOffering = AgeGradeOffering::find($request->agerange);
            $Days = Days::find($request->days);
            $monthYear = date('Y-m-d', strtotime($request->year .'-'.$request->month.'-'.'01'));
            $site = Site::find($request->site);
						$type = $request->type;


						if($type == 'group'){
							$site = null;
							$offerid = null;
							$groupid = $request->site;
						}else{
								$site = $request->site;
								$groupid = null;
								$offerid = $request->offering_id;
						}

						$calender = ( new CreateCalendarAction())
								->setDays($Days)
								->setMealType($MealType)
								->setAgeGradeOffering($AgeGradeOffering)
								->setMonthYear($monthYear)
								->setSiteId($site)
								->setGuideLineId($request->guideline_id)
								->setSiteType($type)
								->setGroupId($groupid)
								->setOfferingId($offerid)
								->create();

						if($request->is_template){
							$menu_cycle = MenuCycle::find($menu_cycle->id);
							$cal_days = (new CreateCalendarDaysAction)
							->forCalendar($calender)
							->setWeekNumber( (int) $request->weekNumber) 
							->setMenCycle($menu_cycle)
							->create();
						} else {
							$cal_days = (new AttachCalendarDaysToMenuCycleAction())
							->forCalendar($calender)
							->setWeekNumber( (int) $request->weekNumber) 
							->setMenCycle($menu_cycle)
							->attach();
						}

						if($type == 'group'){
								$group = MenuCreationGroup::with(['offerings.site'])->find($calender->group_id);
								$offering_array = $group->offerings->toArray();
								
								foreach($offering_array as $offer){
										$calender = ( new CreateCalendarAction())
										->setDays($Days)
                    ->setMealType($MealType)
                    ->setAgeGradeOffering($AgeGradeOffering)
                    ->setMonthYear($monthYear)
                    ->setSiteId($offer['site_id'])
                    ->setGuideLineId($request->guideline_id)
                    ->setSiteType('site')
                    ->setGroupId($groupid)
                    ->setOfferingId($offer['id'])
                    ->create();

										if($request->is_template){
											$menu_cycle = MenuCycle::find($menu_cycle->id);
											(new CreateCalendarDaysAction)
											->forCalendar($calender)
											->setWeekNumber( (int) $request->weekNumber) 
											->setMenCycle($cal_days->menu_cycle)
											->create();
										} else {
											(new AttachCalendarDaysToMenuCycleAction())
											->forCalendar($calender)
											->setWeekNumber( (int) $request->weekNumber) 
											->setMenCycle($cal_days->menu_cycle)
											->attach();
										}
								}
						}

			
					// if($request->is_template){
					// 	$menu_cycle = MenuCycle::find($menu_cycle->id);
					// 	(new CreateCalendarDaysAction)
					// 	->forCalendar($calender)
					// 	->setWeekNumber( (int) $request->weekNumber) 
					// 	->setMenCycle($menu_cycle)
					// 	->create();
					// } else {
					// 	(new AttachCalendarDaysToMenuCycleAction())
					// 	->forCalendar($calender)
					// 	->setWeekNumber( (int) $request->weekNumber) 
					// 	->setMenCycle($menu_cycle)
					// 	->attach();
					// }
				 
                return redirect()->route('calendars',['meal_type' => $request->mealtype, 'age_grade_offering' => $request->agerange, 'day' => $request->days, 'month'=> $request->month, 'year'=> $request->year,'site'=> $request->site,'guide_line_id' => $request->guideline_id,'type'=>$request->type,'offering_id'=>$request->offering_id]);
        }

        

        return redirect()->route('week-cycles',['mealtype' => $request->meal_type_id, 'agerange' => $request->age_grade_id, 'days' => $request->days_id, 'menuUser' => $menu_cycle->user_id]);
    }


    public function edit(Request $request, MenuCycle $menucycle) : Response
    {   
        
        $mealtype_data = MealType::orderBy('name','asc')->get();
        $agerange_data = AgeGradeOffering::orderBy('name','asc')->get();
        $days_data = Days::orderBy('name','asc')->get(); 
        $categories = CategoryEnum::options(); 

		$mass_measurements    = UnitOfMeasurement::massMeasurements();
        $unit_measurements    = UnitOfMeasurement::unitMeasurements();
        $volume_measurements  = UnitOfMeasurement::volumeMeasurements(); 

        $site = ($request->has('site')) ? $request->input('site') : '';
        $guide_line_id = ($request->has('guide_line_id')) ? $request->input('guide_line_id') : '';
		$offering_id = ($request->has('offering_id')) ? $request->input('offering_id') : '';
				$is_fav_show = 1;
				if($site && $site !='' ){
					$is_fav_show = 0;
				}

        $menu_cycle = MenuCycle::with(['menuCycleDays'])->find($menucycle->id);
		$menu_cycle->append('is_tenant_admin');
		// dd($menu_cycle->toArray());        
            $menu_cycle_all_days = array('','','','','','','');
        
            $menu_cycle_mon_options = $menu_cycle_tue_options = $menu_cycle_wed_options = $menu_cycle_thu_options = $menu_cycle_fri_options = $menu_cycle_sat_options = $menu_cycle_sun_options = array();
            
            foreach($menu_cycle->menuCycleDays as $menuCycleDay){
            
                 if($menuCycleDay['day_of_week'] == 'MON'){
                    $menu_cycle_all_days[0] = $menuCycleDay;
                    $menu_cycle_mon_options = MenuCycleDayOption::with(['menuCycleDayOptionComponents'])->where('menu_cycle_day_id',$menuCycleDay['id'])->orderBy('sort_order')->get();

                    $menu_cycle_mon_options->map(function($item, $key) {
                        $recipes = [];
                        foreach($item->menuCycleDayOptionComponents as $OptionComponent){                            
                           $recipes_ar = Recipe::find($OptionComponent->recipe_id)->append('allergens_name')->toArray();
						   //dd($recipes_ar);
                           $recipes_ar['option_component_id'] = $OptionComponent->id;
                           $recipes_ar['meat_total'] = $this->getRecipeProductMeatTotal($recipes_ar['id']);
                           $recipes_ar['grain_total'] = $this->getRecipeProductGrainTotal($recipes_ar['id']);
                           $recipes_ar['prefer_products'] = $this->getRecipePreferProduct2($recipes_ar['id']);
                           $recipes_ar['instructions'] = $OptionComponent->cooking_instructions;
                           $recipes_ar['dont_count'] = json_decode($OptionComponent->exclude_from);
                           $recipes_ar['smartsnack'] = $OptionComponent->smart_snack;
													 $recipes_ar['is_exclude_export'] = $OptionComponent->is_exclude_export;
                           $recipes_ar['is_override'] = $OptionComponent->is_override;

						   $recipes_ar['is_exclude_from_printable_calendar'] = $OptionComponent->is_exclude_from_printable_calendar;

                           $recipes_ar['total_val_override'] = $OptionComponent->total_val_override;
                           $recipes[] = $recipes_ar;
                        }                                                                        
                        $item->recipes = $recipes;
                        $item->photo = $item->photo_store_path;
                        $item->sort = $item->sort_order;
                    });  
                    // dd($menu_cycle_mon_options);                  
                 }

                 if($menuCycleDay['day_of_week'] == 'TUE'){
                    $menu_cycle_all_days[1] = $menuCycleDay;
                    $menu_cycle_tue_options = MenuCycleDayOption::with(['menuCycleDayOptionComponents'])->where('menu_cycle_day_id',$menuCycleDay['id'])->orderBy('sort_order')->get();

                    $menu_cycle_tue_options->map(function($item, $key) {
                        $recipes = array();
                        foreach($item->menuCycleDayOptionComponents as $OptionComponent){
                           $recipes_ar = Recipe::find($OptionComponent->recipe_id)->append('allergens_name')->toArray();
                           $recipes_ar['option_component_id'] = $OptionComponent->id;
                           $recipes_ar['meat_total'] = $this->getRecipeProductMeatTotal($recipes_ar['id']);
                           $recipes_ar['grain_total'] = $this->getRecipeProductGrainTotal($recipes_ar['id']);
                           $recipes_ar['prefer_products'] = $this->getRecipePreferProduct2($recipes_ar['id']);
                           $recipes_ar['instructions'] = $OptionComponent->cooking_instructions;
                           $recipes_ar['dont_count'] = json_decode($OptionComponent->exclude_from);
                           $recipes_ar['smartsnack'] = $OptionComponent->smart_snack;
                           $recipes_ar['is_override'] = $OptionComponent->is_override;
							
						   $recipes_ar['is_exclude_export'] =  $OptionComponent->is_exclude_export ;

						   $recipes_ar['is_exclude_from_printable_calendar'] =  $OptionComponent->is_exclude_from_printable_calendar ;

                           $recipes_ar['total_val_override'] = $OptionComponent->total_val_override;
                           $recipes[] = $recipes_ar;
                        }
                        $item->recipes = $recipes;
                        $item->photo = $item->photo_store_path;
                        $item->sort = $item->sort_order;
                    });
                 }

                 if($menuCycleDay['day_of_week'] == 'WED'){
                    $menu_cycle_all_days[2] = $menuCycleDay;
                    $menu_cycle_wed_options = MenuCycleDayOption::with(['menuCycleDayOptionComponents'])->where('menu_cycle_day_id',$menuCycleDay['id'])->orderBy('sort_order')->get();

                    $menu_cycle_wed_options->map(function($item, $key) {
                        $recipes = array();
                        foreach($item->menuCycleDayOptionComponents as $OptionComponent){
                           $recipes_ar = Recipe::find($OptionComponent->recipe_id)->append('allergens_name')->toArray();
                           
                           $recipes_ar['option_component_id'] = $OptionComponent->id;
                           $recipes_ar['meat_total'] = $this->getRecipeProductMeatTotal($recipes_ar['id']);
                           $recipes_ar['grain_total'] = $this->getRecipeProductGrainTotal($recipes_ar['id']);
                           $recipes_ar['prefer_products'] = $this->getRecipePreferProduct2($recipes_ar['id']);
                           $recipes_ar['instructions'] = $OptionComponent->cooking_instructions;
                           $recipes_ar['dont_count'] = json_decode($OptionComponent->exclude_from);
                           $recipes_ar['smartsnack'] = $OptionComponent->smart_snack;
                           $recipes_ar['is_override'] = $OptionComponent->is_override;							
						   $recipes_ar['is_exclude_export'] = $OptionComponent->is_exclude_export;
						   $recipes_ar['is_exclude_from_printable_calendar'] =  $OptionComponent->is_exclude_from_printable_calendar ;
                           $recipes_ar['total_val_override'] = $OptionComponent->total_val_override;
                           $recipes[] = $recipes_ar;
                        }
                        $item->recipes = $recipes;
                        $item->photo = $item->photo_store_path;
                        $item->sort = $item->sort_order;
                    });
                 }

                 if($menuCycleDay['day_of_week'] == 'THU'){
                    $menu_cycle_all_days[3] = $menuCycleDay;
                    $menu_cycle_thu_options = MenuCycleDayOption::with(['menuCycleDayOptionComponents'])->where('menu_cycle_day_id',$menuCycleDay['id'])->orderBy('sort_order')->get();

                    $menu_cycle_thu_options->map(function($item, $key) {
                        $recipes = array();
                        foreach($item->menuCycleDayOptionComponents as $OptionComponent){
                           $recipes_ar = Recipe::find($OptionComponent->recipe_id)->append('allergens_name')->toArray();
                           $recipes_ar['option_component_id'] = $OptionComponent->id;
                           $recipes_ar['meat_total'] = $this->getRecipeProductMeatTotal($recipes_ar['id']);
                           $recipes_ar['grain_total'] = $this->getRecipeProductGrainTotal($recipes_ar['id']);
                           $recipes_ar['prefer_products'] = $this->getRecipePreferProduct2($recipes_ar['id']);
                           $recipes_ar['instructions'] = $OptionComponent->cooking_instructions;
                           $recipes_ar['dont_count'] = json_decode($OptionComponent->exclude_from);
                           $recipes_ar['smartsnack'] = $OptionComponent->smart_snack;
                           $recipes_ar['is_override'] = $OptionComponent->is_override;
						
						   $recipes_ar['is_exclude_export'] = $OptionComponent->is_exclude_export;

						   $recipes_ar['is_exclude_from_printable_calendar'] =  $OptionComponent->is_exclude_from_printable_calendar ;

                           $recipes_ar['total_val_override'] = $OptionComponent->total_val_override;
                           $recipes[] = $recipes_ar;
                        }
                        $item->recipes = $recipes;
                        $item->photo = $item->photo_store_path;
                        $item->sort = $item->sort_order;
                    });
                 }

                 if($menuCycleDay['day_of_week'] == 'FRI'){
                    $menu_cycle_all_days[4] = $menuCycleDay;
                    $menu_cycle_fri_options = MenuCycleDayOption::with(['menuCycleDayOptionComponents'])->where('menu_cycle_day_id',$menuCycleDay['id'])->orderBy('sort_order')->get();

                    $menu_cycle_fri_options->map(function($item, $key) {
                        $recipes = array();
                        foreach($item->menuCycleDayOptionComponents as $OptionComponent){
                           $recipes_ar = Recipe::find($OptionComponent->recipe_id)->append('allergens_name')->toArray();
                           $recipes_ar['option_component_id'] = $OptionComponent->id;
                           $recipes_ar['meat_total'] = $this->getRecipeProductMeatTotal($recipes_ar['id']);
                           $recipes_ar['grain_total'] = $this->getRecipeProductGrainTotal($recipes_ar['id']);
                           $recipes_ar['prefer_products'] = $this->getRecipePreferProduct2($recipes_ar['id']);
                           $recipes_ar['instructions'] = $OptionComponent->cooking_instructions;
                           $recipes_ar['dont_count'] = json_decode($OptionComponent->exclude_from);
                           $recipes_ar['smartsnack'] = $OptionComponent->smart_snack;
                           $recipes_ar['is_override'] = $OptionComponent->is_override;
							
						   $recipes_ar['is_exclude_export'] = $OptionComponent->is_exclude_export;

						   $recipes_ar['is_exclude_from_printable_calendar'] =  $OptionComponent->is_exclude_from_printable_calendar ;

                           $recipes_ar['total_val_override'] = $OptionComponent->total_val_override;
                           $recipes[] = $recipes_ar;
                        }                        
                        $item->recipes = $recipes;
                        $item->photo = $item->photo_store_path;
                        $item->sort = $item->sort_order;
                    });
                 }

                 if($menuCycleDay['day_of_week'] == 'SAT'){
                    $menu_cycle_all_days[5] = $menuCycleDay;
                    $menu_cycle_sat_options = MenuCycleDayOption::with(['menuCycleDayOptionComponents'])->where('menu_cycle_day_id',$menuCycleDay['id'])->orderBy('sort_order')->get();

                    $menu_cycle_sat_options->map(function($item, $key) {
                        $recipes = array();
                        foreach($item->menuCycleDayOptionComponents as $OptionComponent){
                           $recipes_ar = Recipe::find($OptionComponent->recipe_id)->append('allergens_name')->toArray();
                           $recipes_ar['option_component_id'] = $OptionComponent->id;
                           $recipes_ar['meat_total'] = $this->getRecipeProductMeatTotal($recipes_ar['id']);
                           $recipes_ar['grain_total'] = $this->getRecipeProductGrainTotal($recipes_ar['id']);
                           $recipes_ar['prefer_products'] = $this->getRecipePreferProduct2($recipes_ar['id']);
                           $recipes_ar['instructions'] = $OptionComponent->cooking_instructions;
                           $recipes_ar['dont_count'] = json_decode($OptionComponent->exclude_from);
                           $recipes_ar['smartsnack'] = $OptionComponent->smart_snack;
                           $recipes_ar['is_override'] = $OptionComponent->is_override;
													 
						   $recipes_ar['is_exclude_export'] = $OptionComponent->is_exclude_export;
						   $recipes_ar['is_exclude_from_printable_calendar'] =  $OptionComponent->is_exclude_from_printable_calendar ;

                           $recipes_ar['total_val_override'] = $OptionComponent->total_val_override;
                           $recipes[] = $recipes_ar;
                        }
                        $item->recipes = $recipes;
                        $item->photo = $item->photo_store_path;
                        $item->sort = $item->sort_order;
                    });
                 }

                 if($menuCycleDay['day_of_week'] == 'SUN'){
                    $menu_cycle_all_days[6] = $menuCycleDay;
                    $menu_cycle_sun_options = MenuCycleDayOption::with(['menuCycleDayOptionComponents'])->where('menu_cycle_day_id',$menuCycleDay['id'])->orderBy('sort_order')->get();

                    $menu_cycle_sun_options->map(function($item, $key) {
                        $recipes = array();
                        foreach($item->menuCycleDayOptionComponents as $OptionComponent){
                           $recipes_ar = Recipe::find($OptionComponent->recipe_id)->append('allergens_name')->toArray();
                           $recipes_ar['option_component_id'] = $OptionComponent->id;
                           $recipes_ar['meat_total'] = $this->getRecipeProductMeatTotal($recipes_ar['id']);
                           $recipes_ar['grain_total'] = $this->getRecipeProductGrainTotal($recipes_ar['id']);
                           $recipes_ar['prefer_products'] = $this->getRecipePreferProduct2($recipes_ar['id']);
                           $recipes_ar['instructions'] = $OptionComponent->cooking_instructions;
                           $recipes_ar['dont_count'] = json_decode($OptionComponent->exclude_from);
                           $recipes_ar['smartsnack'] = $OptionComponent->smart_snack;
                           $recipes_ar['is_override'] = $OptionComponent->is_override;
													 
						   $recipes_ar['is_exclude_export'] = $OptionComponent->is_exclude_export;
						   $recipes_ar['is_exclude_from_printable_calendar'] =  $OptionComponent->is_exclude_from_printable_calendar ;

                           $recipes_ar['total_val_override'] = $OptionComponent->total_val_override;
                           $recipes[] = $recipes_ar;
                        }                        
                        $item->recipes = $recipes;
                        $item->photo = $item->photo_store_path;
                        $item->sort = $item->sort_order;
                    });
                 }    

            }

            //dd($menu_cycle_tue_options);

            //setup other days and components...
            $menu_cycle->menuCycleDays = $menu_cycle_all_days; 

            $guideline_data = Guideline::where("meal_type_id", $menu_cycle->meal_type_id)->where("age_grade_id", $menu_cycle->age_grade_id)->where("days_id", $menu_cycle->days_id)->orderBy('name','asc')->get(['id','name'])->toArray();
        
            $selected_mealtype = $request->get('mealtype');
            $selected_agerange = $request->get('agerange');
            $selected_days = $request->get('days');
            $month = $request->get('month');
            $year = $request->get('year');
            $week_date = $request->get('weekDate');
			$is_update = ($request->has('is_update')) ? $request->input('is_update') : 0;
			$type = ($request->has('type')) ? $request->input('type') : '';
			// dd($menu_cycle->toArray());
			$week_number = ($request->has('weekNumber')) ? $request->input('weekNumber') : $menu_cycle->week_number;
						
			// dd($menu_cycle->toArray());   
        return Jetstream::inertia()->render($request, 'MenuCycle/MenuCycle-edit', [
            'month' => $month,
            'year' => $year,
            'selected_mealtype' => $selected_mealtype,
            'selected_agerange' => $selected_agerange,
            'selected_days' => $selected_days,

           'menucycle' => $menu_cycle,
           'guidelines_val' => $guideline_data,
           'monday_data' => $menu_cycle_mon_options,
           'tuesday_data' => $menu_cycle_tue_options,
           'wednesday_data' => $menu_cycle_wed_options,
           'thursday_data' => $menu_cycle_thu_options,
           'friday_data' => $menu_cycle_fri_options,
           'saturday_data' => $menu_cycle_sat_options,
           'sunday_data' => $menu_cycle_sun_options,
           'mealtype_data' => $mealtype_data,
           'agerange_data' => $agerange_data,
           'days_data' => $days_data,
           'categories' => $categories,
           'site' => $site,
           'guide_line_id' => $guide_line_id,
		   'offering_id' => $offering_id,
           'week_date'=> $week_date,
			'is_update'=> $is_update,
			'is_fav_show' => $is_fav_show,
			'mass_measurements' => $mass_measurements,
			'unit_measurements' => $unit_measurements,
			'volume_measurements' => $volume_measurements,

			'menuUserWeek'=> isset($request->menuUser)?$request->menuUser:'',
			'mealtypeWeek'=> isset($request->mealtype)?$request->mealtype:'',
			'agerangeWeek'=> isset($request->agerange)?$request->agerange:'',
			'daysWeek'=> isset($request->days)?$request->days:'',
			'type'=> $type,
			'week_number'=> $week_number
        ]);
    }

		public function getMenuCycleForGroup($request_array){
			$calendars = Calendar::with('calendar_days')->where('group_id', $request_array['site'])->get();
			foreach($calendars as $cal){
				foreach($cal->calendar_days as $day_data){		
					if((int) $request_array['week_number'] == $day_data->week_number){
						$menucycle = MenuCycle::with(['menuCycleDays'])->find($day_data->menu_cycles_id);     		
						$menu_cycle = (new UpdateMenuCycleAction)
							->setMenuCycle($menucycle)
							->setName($request_array['mc_name'])
							->setMealType($request_array['meal_type_id'])
							->setAgeRange($request_array['age_grade_id'])
							->setDays($request_array['days_id'])
							->setGuideline($request_array['guideline_id'])
							->setWeekNumber((int) $request_array['week_number'])
							->setSourceId(null)
							->update();
					}
				}
			}
		}

		public function updateOptionDayData(Request $request, MenuCycle $menu_cycle){
			(new ChangeMenuCycleOptionSourceId)
			->forMenCycle($menu_cycle)
			->setSourceId()
			->change();
			$menu_cycle->refresh();	
			
			if(!empty($request->mc_options_mon)){
				$monday_data_save = $this->updateMenuCycleDayOptionsMethod($request->mc_options_mon, $menu_cycle, 'MON');            
			}

			// ********** tuesday condition ***************
			
			if(!empty($request->mc_options_tue)){
				//dd($request->mc_options_tue);
				$tuesday_data_save = $this->updateMenuCycleDayOptionsMethod($request->mc_options_tue, $menu_cycle, 'TUE');
			
			}
			// dd($request->mc_options_tue, $request->all());

			// ********** wednesday condition ***************
					
			if(!empty($request->mc_options_wed)){
				$wednesday_data_save = $this->updateMenuCycleDayOptionsMethod($request->mc_options_wed, $menu_cycle, 'WED');
			}

			// ********** thursday condition ***************
					
			if(!empty($request->mc_options_thu)){
				$thursday_data_save = $this->updateMenuCycleDayOptionsMethod($request->get('mc_options_thu'), $menu_cycle, 'THU');
			}
			// dd($request->mc_options_thu);
			// dd($request->mc_options_thu, $request->all());

			// ********** friday condition ***************
					
			if(!empty($request->mc_options_fri)){
				$friday_data_save = $this->updateMenuCycleDayOptionsMethod($request->mc_options_fri, $menu_cycle, 'FRI');
			}        

			// ********** saturday condition ***************
				
			if(!empty($request->mc_options_sat)){
			
				$saturday_data_save = $this->updateMenuCycleDayOptionsMethod($request->mc_options_sat, $menu_cycle, 'SAT');
				//dd($saturday_data_save);
			}

			// ********** sunday condition ***************
				
			if(!empty($request->mc_options_sun)){
				$sunday_data_save = $this->updateMenuCycleDayOptionsMethod($request->mc_options_sun, $menu_cycle, 'SUN');
			}
		}


    public function update(Request $request, MenuCycle $menucycle)
    {
		
			$r = request()->all();
			$request->validate([
				'mc_name' => 'required|string',          
				'meal_type_id' => 'required|string',
				'age_grade_id' => 'required|string',
				'days_id' => 'required|string', 
				'guideline_id'=>'required|string'   ,
				// 'week_number'=>'required'   
			], [
				'mc_name.required' => 'This field is required.',                    
				'meal_type_id.required' => 'This field is required.',
				'age_grade_id.required' => 'This field is required.',
				'days_id.required' => 'This field is required.',
				'guideline_id.required' => 'This field is required.',
				'week_number.required' => 'This field is required.'
			]);

			

			$week_number = 0;
			if($request->week_number)
			{
				$week_number = $request->week_number;
			}
			
			try {

				if($request->type == 'group'){
					$updateMenuCycle = $this->getMenuCycleForGroup($r);
					$calendars = Calendar::with('calendar_days')->where('group_id', $request->site)->get();
					foreach($calendars as $calendar){
						foreach($calendar->calendar_days as $cal_day){
							if($cal_day->week_number == (int) $request->week_number){
								$menu_cycle = MenuCycle::with(['menuCycleDays'])->where('id',$cal_day->menu_cycles_id)->first();
								$this->updateOptionDayData($request,$menu_cycle);
							}
						}
					}
				
				}else{
					$menu_cycle = (new UpdateMenuCycleAction)
					->setMenuCycle($menucycle)
					->setName($request->mc_name)
					->setMealType($request->meal_type_id)
					->setAgeRange($request->age_grade_id)
					->setDays($request->days_id)
					->setGuideline($request->guideline_id)
					->setWeekNumber((int) $week_number)
					->setSourceId(null)
					->update();

					//dd($request->all());

					$this->updateOptionDayData($request,$menu_cycle);
				}
			
				if($request->mc_name_new){
					$name = $request->mc_name_new;
					$template = 1;
					$newMenuCycle = (new CopyMenuCycleAction())
					->forMenCycle($menucycle)
					->setName($name)
					->setTemplate($template)
					->copy();

					$update_menu_cycle = (new UpdateMenuCycleAction)
					->setMenuCycle($newMenuCycle)
					->setSourceId(null)
					->update();
				
					if((int) $request->is_update == 1){
						$menu_cycle = (new UpdateMenuCycleAction)
						->setMenuCycle($menucycle)
						->setSourceId($newMenuCycle->id)
						->update();
					}
				}

				(new JsonStoreMenuCycleListAction())->setMenuCycle($menu_cycle)->store();
				
			} catch (\Exception $th) {
				 dd($request->all(), $th->getMessage());
					//throw $th;
			}

			

			if((int) $request->is_update == 1){
				return redirect()->route('calendars',['meal_type' => $request->mealtype, 'age_grade_offering' => $request->agerange, 'day' => $request->days, 'month'=> $request->month, 'year'=> $request->year,'site'=>$request->site,'guide_line_id'=>$request->guideline_id,'type'=>$request->type]);
			}

			if($request->month && $request->year && $request->mealtype && $request->agerange && $request->days ){
					return redirect()->route('calendars',['meal_type' => $request->mealtype, 'age_grade_offering' => $request->agerange, 'day' => $request->days, 'month'=> $request->month, 'year'=> $request->year,'site'=>$request->site,'guide_line_id'=>$request->guide_line_id,'type'=>$request->type]);
			}
			if($request->menuUserWeek != null || $request->mealtypeWeek != null || $request->agerangeWeek != null || $request->daysWeek != null){
				return redirect()->route('week-cycles',['mealtype' => $request->mealtypeWeek, 'agerange' => $request->agerangeWeek, 'days' => $request->daysWeek, 'menuUser' => $request->menuUserWeek]);
			}

			return redirect()->route('week-cycles',['mealtype' => $request->meal_type_id, 'agerange' => $request->age_grade_id, 'days' => $request->days_id,'site'=>$request->site,'guide_line_id'=>$request->guide_line_id,'type'=>$request->type, 'menuUser' => $menu_cycle->user_id]);
    }       


    public function menucycleRecipeSearchModal(Request $request)
    {
			$term   = $request->json('term');
			$cat    = $request->json('recipeCat');

			$recipe_search = Recipe::with(['ingredients'])
			->SearchByAll($term)
			;
			if($cat && $cat != ''){
				$recipe_search->where('category',$cat);
			}
			
			$recipe_search = $recipe_search->orderBy('name','asc')->get()->append('allergens_name');   
				
			return response()->json($recipe_search);
    }


    public function getRecipeTotal(Request $request, $recipe_id)
		{
			$recipe = Recipe::find($recipe_id);
			// dd($recipe);
			// $returnArray= [
			//     'MMA' =>null,
			//     'WGR' =>null,
			//     'FRU' =>null,
			//     'MLK' =>null,
			//     'VEG' =>null,
			//     'DG' =>null,
			//     'RO' =>null,
			//     'LEG' =>null,
			//     'STAR' =>null,
			//     'OTH' =>null,
			//     'CALS' =>null,
			//     'SOD' =>null,
			//     'FAT' =>null,
			//     'PROT' =>null,
			//     'CARB' =>null
			// ];
			$returnArray = [];

			if($recipe->ingredients_total){
					foreach($recipe->ingredients_total as $it){
							if($it->ingredient && $it->ingredient->prefer_product){
									$returnArray[] = $this->getRecipePreferProduct($it->ingredient->prefer_product, $it);
							}   
							// $returnArray['MMA'] = $this->getTrueValue($returnArray['MMA'], 
							// $it->usda_componenent_meat, $it->usda_componenent_meat_override);
							// $returnArray['WGR'] = $this->getTrueValue($returnArray['WGR'], $it->usda_componenent_grain, $it->usda_componenent_grain_override);
							
							// $returnArray['FRU'] = $this->getTrueValue($returnArray['FRU'], $it->usda_componenent_fruit, $it->usda_componenent_fruit_override);
							
							// $returnArray['MLK'] = $this->getTrueValue($returnArray['MLK'], $it->usda_componenent_milk, $it->usda_componenent_milk_override);
							
							// $returnArray['VEG'] = $this->getTrueValue($returnArray['VEG'], $it->usda_componenent_veg, $it->usda_componenent_veg_override);
							
							// $returnArray['DG'] = $this->getTrueValue($returnArray['DG'], $it->usda_componenent_veggrn, $it->usda_componenent_veggrn_override);
							
							// $returnArray['RO'] = $this->getTrueValue($returnArray['RO'], $it->usda_componenent_vegred, $it->usda_componenent_vegred_override);
							
							// $returnArray['LEG'] = $this->getTrueValue($returnArray['LEG'], $it->usda_componenent_vegleg, $it->usda_componenent_vegleg_override);
							
							// $returnArray['STAR'] = $this->getTrueValue($returnArray['STAR'], $it->usda_componenent_vegstar, $it->usda_componenent_vegstar_override);
							
							// $returnArray['OTH'] = $this->getTrueValue($returnArray['OTH'], $it->usda_componenent_vegothr, $it->usda_componenent_vegothr_override);


					}   
			}

			// if($recipe->ingredients )
			// {
					
			//     foreach($recipe->ingredients as $ing){
							
			//         if($ing->prefer_product){
			//             $returnArray['CALS'] = $this->getTrueValue($returnArray['CALS'], $ing->prefer_product->nutrition_facts_calories, $ing->prefer_product->nutrition_facts_calories);
							
			//             $returnArray['SOD'] = $this->getTrueValue($returnArray['SOD'], $ing->prefer_product->nutrition_facts_sodium, $ing->prefer_product->nutrition_facts_sodium);
									
			//             $returnArray['FAT'] = $this->getTrueValue($returnArray['FAT'], $ing->prefer_product->nutrition_facts_totalfat, $ing->prefer_product->nutrition_facts_totalfat);
									
			//             $returnArray['PROT'] = $this->getTrueValue($returnArray['PROT'], $ing->prefer_product->nutrition_facts_protein, $ing->prefer_product->nutrition_facts_protein);
									
			//             $returnArray['CARB'] = $this->getTrueValue($returnArray['CARB'], $ing->prefer_product->nutrition_facts_carbs, $ing->prefer_product->nutrition_facts_carbs);
			//         }
			//     }

			//     // dd($returnArray, $recipe->ingredients->toArray());
			// }
			// dd($returnArray);
			return response()->json($returnArray);
    }

    public function getTrueValue($currentValue = null, $actuleValue = null, $overRide = null){
			if(!is_null($overRide)){
					if(!is_null($currentValue)){
							return $currentValue + $overRide;
					} 
					return $overRide;
			} elseif(!is_null($actuleValue)){
					if(!is_null($currentValue)){
							return $currentValue + $actuleValue;
					} 
					return $actuleValue;
			}
			return $currentValue;
        
    }

    public function getRecipePreferProduct($prefer_product, $rec_ing_data)
		{
      
			$prefer_product->serving_amount = $rec_ing_data->serving_amount;
			$prefer_product->serving_amount_uom = $this->getUOMNameByID($rec_ing_data->serving_amount_uom_id);     

			$prefer_product->serving_measurement_weight_uom_name = $this->getUOMNameByID($prefer_product->serving_measurement_weight_uom_id);
			$prefer_product->serving_measurement_volume_uom_name = $this->getUOMNameByID($prefer_product->serving_measurement_volume_uom_id);   
			
			$prefer_product->usda_componenent_serving_meat = ( !is_null($rec_ing_data->usda_componenent_meat_override) && $rec_ing_data->usda_componenent_meat_override >= 0) ? $rec_ing_data->usda_componenent_meat_override : $rec_ing_data->usda_componenent_meat;

			$prefer_product->usda_componenent_serving_grain = (!is_null($rec_ing_data->usda_componenent_grain_override) && $rec_ing_data->usda_componenent_grain_override >= 0) ? $rec_ing_data->usda_componenent_grain_override : $rec_ing_data->usda_componenent_grain;

			$prefer_product->usda_componenent_serving_fruit = (!is_null($rec_ing_data->usda_componenent_fruit_override) && $rec_ing_data->usda_componenent_fruit_override >= 0) ? $rec_ing_data->usda_componenent_fruit_override : $rec_ing_data->usda_componenent_fruit;

			$prefer_product->usda_componenent_serving_milk = (!is_null($rec_ing_data->usda_componenent_milk_override) && $rec_ing_data->usda_componenent_milk_override >= 0) ? $rec_ing_data->usda_componenent_milk_override : $rec_ing_data->usda_componenent_milk;

			$prefer_product->usda_componenent_serving_veg = (!is_null($rec_ing_data->usda_componenent_veg_override) && $rec_ing_data->usda_componenent_veg_override >= 0) ? $rec_ing_data->usda_componenent_veg_override : $rec_ing_data->usda_componenent_veg;

			$prefer_product->usda_componenent_serving_veggrn = (!is_null($rec_ing_data->usda_componenent_veggrn_override) && $rec_ing_data->usda_componenent_veggrn_override >= 0) ? $rec_ing_data->usda_componenent_veggrn_override : $rec_ing_data->usda_componenent_veggrn;

			$prefer_product->usda_componenent_serving_vegred = (!is_null($rec_ing_data->usda_componenent_vegred_override) && $rec_ing_data->usda_componenent_vegred_override >= 0) ? $rec_ing_data->usda_componenent_vegred_override : $rec_ing_data->usda_componenent_vegred;

			$prefer_product->usda_componenent_serving_vegleg = (!is_null($rec_ing_data->usda_componenent_vegleg_override) && $rec_ing_data->usda_componenent_vegleg_override >= 0) ? $rec_ing_data->usda_componenent_vegleg_override : $rec_ing_data->usda_componenent_vegleg;

			$prefer_product->usda_componenent_serving_vegstar = (!is_null($rec_ing_data->usda_componenent_vegstar_override) && $rec_ing_data->usda_componenent_vegstar_override >= 0) ? $rec_ing_data->usda_componenent_vegstar_override : $rec_ing_data->usda_componenent_vegstar;

			$prefer_product->usda_componenent_serving_vegothr = (!is_null($rec_ing_data->usda_componenent_vegothr_override) && $rec_ing_data->usda_componenent_vegothr_override >= 0) ? $rec_ing_data->usda_componenent_vegothr_override : $rec_ing_data->usda_componenent_vegothr;
			
			return $prefer_product->toArray();
    }


    public function getRecipeIngredientPreferProduct(Request $request)
    {             
			$IngredientData  = Ingredient::find($request->json('ingredient_id'));
			$prefer_product  = Product::find($IngredientData->prefer_product_id);

			$rec_ing_data = DB::table('ingredient_recipe')->where([['ingredient_id','=', $request->json('ingredient_id')],['recipe_id','=', $request->json('recipe_id')]])->first();
			
			if(!empty($rec_ing_data) && $prefer_product){

			$prefer_product->serving_amount = $rec_ing_data->serving_amount;
			$prefer_product->serving_amount_uom = $this->getUOMNameByID($rec_ing_data->serving_amount_uom_id);     

			$prefer_product->serving_measurement_weight_uom_name = $this->getUOMNameByID($prefer_product->serving_measurement_weight_uom_id);
			$prefer_product->serving_measurement_volume_uom_name = $this->getUOMNameByID($prefer_product->serving_measurement_volume_uom_id);   
			
			$prefer_product->usda_componenent_serving_meat = ($rec_ing_data->usda_componenent_meat_override > 0) ? $rec_ing_data->usda_componenent_meat_override : $rec_ing_data->usda_componenent_meat;

			$prefer_product->usda_componenent_serving_grain = ($rec_ing_data->usda_componenent_grain_override > 0) ? $rec_ing_data->usda_componenent_grain_override : $rec_ing_data->usda_componenent_grain;

			$prefer_product->usda_componenent_serving_fruit = ($rec_ing_data->usda_componenent_fruit_override > 0) ? $rec_ing_data->usda_componenent_fruit_override : $rec_ing_data->usda_componenent_fruit;

			$prefer_product->usda_componenent_serving_milk = ($rec_ing_data->usda_componenent_milk_override > 0) ? $rec_ing_data->usda_componenent_milk_override : $rec_ing_data->usda_componenent_milk;

			$prefer_product->usda_componenent_serving_veg = ($rec_ing_data->usda_componenent_veg_override > 0) ? $rec_ing_data->usda_componenent_veg_override : $rec_ing_data->usda_componenent_veg;

			$prefer_product->usda_componenent_serving_veggrn = ($rec_ing_data->usda_componenent_veggrn_override > 0) ? $rec_ing_data->usda_componenent_veggrn_override : $rec_ing_data->usda_componenent_veggrn;

			$prefer_product->usda_componenent_serving_vegred = ($rec_ing_data->usda_componenent_vegred_override > 0) ? $rec_ing_data->usda_componenent_vegred_override : $rec_ing_data->usda_componenent_vegred;

			$prefer_product->usda_componenent_serving_vegleg = ($rec_ing_data->usda_componenent_vegleg_override > 0) ? $rec_ing_data->usda_componenent_vegleg_override : $rec_ing_data->usda_componenent_vegleg;

			$prefer_product->usda_componenent_serving_vegstar = ($rec_ing_data->usda_componenent_vegstar_override > 0) ? $rec_ing_data->usda_componenent_vegstar_override : $rec_ing_data->usda_componenent_vegstar;

			$prefer_product->usda_componenent_serving_vegothr = ($rec_ing_data->usda_componenent_vegothr_override > 0) ? $rec_ing_data->usda_componenent_vegothr_override : $rec_ing_data->usda_componenent_vegothr;
			}

			return response()->json($prefer_product);
    }

    public function getRecipePreferProduct2($recipe_id)
    {             
			$prefer_products = array();

			$ing_ids = DB::table('ingredient_recipe')->where('recipe_id','=', $recipe_id)->get();

			foreach($ing_ids as $ing_id){
			$IngredientData  = Ingredient::find($ing_id->ingredient_id);
			if(!empty($IngredientData)){ 
			$prefer_product  = Product::find($IngredientData->prefer_product_id);
			if($prefer_product){

					$prefer_product->serving_amount = $ing_id->serving_amount;
					$prefer_product->serving_amount_uom = $this->getUOMNameByID($ing_id->serving_amount_uom_id);

					$prefer_product->serving_measurement_weight_uom_name = $this->getUOMNameByID($prefer_product->serving_measurement_weight_uom_id);
					$prefer_product->serving_measurement_volume_uom_name = $this->getUOMNameByID($prefer_product->serving_measurement_volume_uom_id);

					$prefer_product->usda_componenent_serving_meat = (!is_null($ing_id->usda_componenent_meat_override) && $ing_id->usda_componenent_meat_override >= 0) ? $ing_id->usda_componenent_meat_override : $ing_id->usda_componenent_meat;

					$prefer_product->usda_componenent_serving_grain = (!is_null($ing_id->usda_componenent_grain_override) && $ing_id->usda_componenent_grain_override >= 0) ? $ing_id->usda_componenent_grain_override : $ing_id->usda_componenent_grain;

					$prefer_product->usda_componenent_serving_fruit = (!is_null($ing_id->usda_componenent_fruit_override) && $ing_id->usda_componenent_fruit_override >= 0) ? $ing_id->usda_componenent_fruit_override : $ing_id->usda_componenent_fruit;

					$prefer_product->usda_componenent_serving_milk = (!is_null($ing_id->usda_componenent_milk_override) && $ing_id->usda_componenent_milk_override >= 0) ? $ing_id->usda_componenent_milk_override : $ing_id->usda_componenent_milk;

					$prefer_product->usda_componenent_serving_veg = (!is_null($ing_id->usda_componenent_veg_override) && $ing_id->usda_componenent_veg_override >= 0) ? $ing_id->usda_componenent_veg_override : $ing_id->usda_componenent_veg;

					$prefer_product->usda_componenent_serving_veggrn = (!is_null($ing_id->usda_componenent_veggrn_override) && $ing_id->usda_componenent_veggrn_override >= 0) ? $ing_id->usda_componenent_veggrn_override : $ing_id->usda_componenent_veggrn;

					$prefer_product->usda_componenent_serving_vegred = (!is_null($ing_id->usda_componenent_vegred_override) && $ing_id->usda_componenent_vegred_override >= 0) ? $ing_id->usda_componenent_vegred_override : $ing_id->usda_componenent_vegred;

					$prefer_product->usda_componenent_serving_vegleg = (!is_null($ing_id->usda_componenent_vegleg_override) && $ing_id->usda_componenent_vegleg_override >= 0) ? $ing_id->usda_componenent_vegleg_override : $ing_id->usda_componenent_vegleg;

					$prefer_product->usda_componenent_serving_vegstar = (!is_null($ing_id->usda_componenent_vegstar_override) && $ing_id->usda_componenent_vegstar_override >= 0) ? $ing_id->usda_componenent_vegstar_override : $ing_id->usda_componenent_vegstar;

					$prefer_product->usda_componenent_serving_vegothr = (!is_null($ing_id->usda_componenent_vegothr_override) && $ing_id->usda_componenent_vegothr_override >= 0) ? $ing_id->usda_componenent_vegothr_override : $ing_id->usda_componenent_vegothr;   
					
					$prefer_products[] = $prefer_product;  
			}   
			}
			}

			return $prefer_products;
    }

    public function getRecipeProductMeatTotal($recipe_id)
    {             
			$meat_total = 0;

			$ing_ids = DB::table('ingredient_recipe')->where('recipe_id','=', $recipe_id)->get();

			foreach($ing_ids as $ing_id){
			
							
			if($ing_id->usda_componenent_meat_override > 0 || $ing_id->usda_componenent_meat > 0){
					$meat_total += ($ing_id->usda_componenent_meat_override > 0) ? $ing_id->usda_componenent_meat_override : $ing_id->usda_componenent_meat;
			}else{
					$IngredientData  = Ingredient::find($ing_id->ingredient_id);
					if(!empty($IngredientData)){        
					$prefer_product  = Product::find($IngredientData->prefer_product_id);
							if($prefer_product){
									$meat_total = $meat_total + $prefer_product->usda_componenent_serving_meat;
							}            
					}else{
					$meat_total =  $meat_total;   
					}            
					
			}     
			}

			return $meat_total;
    }

    public function getRecipeProductGrainTotal($recipe_id)
    {             
			$grain_total = 0;

			$ing_ids = DB::table('ingredient_recipe')->where('recipe_id','=', $recipe_id)->get();

			foreach($ing_ids as $ing_id){
			
							
			if($ing_id->usda_componenent_grain_override > 0 || $ing_id->usda_componenent_grain > 0){
					$grain_total += ($ing_id->usda_componenent_grain_override > 0) ? $ing_id->usda_componenent_grain_override : $ing_id->usda_componenent_grain;
			}else{
					$IngredientData  = Ingredient::find($ing_id->ingredient_id);
					if(!empty($IngredientData)){        
					$prefer_product  = Product::find($IngredientData->prefer_product_id);
					if($prefer_product){
							$grain_total = $grain_total + $prefer_product->usda_componenent_serving_grain;
					}
					
					}else{
					$grain_total =  $grain_total;   
					}            
					
			}     
			}

			return $grain_total;
    }

    public function menuCycleGetMealTypes(Request $request){
			$grade_range   = $request->json('grade_range');
			$grade_range_name = GradeRange::find($grade_range);
			$meal_types = Offering::select('name')->whereRaw("LOWER(name) LIKE '%".strtolower($grade_range_name->name)."%'")->distinct()->get(); 
			$meal_types->map(function($item, $key){
					$start = strpos($item->name, "(")+1;
					$end = strpos($item->name, ")");
					$length = $end - $start;
					$item->name = substr($item->name, $start, $length);
			});          
			return response()->json($meal_types);
    }

    public function menuCycleGetOfferingSites(Request $request){
			$meal_type  = $request->json('meal');
			$grade_range  = $request->json('grade_range');
			$grade_range_name = GradeRange::find($grade_range);
			if($meal_type && $grade_range_name){
				$meal_types = Offering::whereRaw("LOWER(name) LIKE '%".strtolower($grade_range_name->name)."%'")->distinct()->get(); 

			$meal_types->map(function($item, $key) use($meal_type){
					
					if(strpos($item->name, $meal_type) !== false){            
							$item->offering_preview_id = $item->id;                           
					}
			});

			$offering_preview_ids = $meal_types->pluck('offering_preview_id')->toArray();
			$offering_sites = [];
			foreach($offering_preview_ids as $offering_preview_id){
					if($offering_preview_id != ''){
					$offering_site = DB::table('offering_site')->where('offering_id', $offering_preview_id)->get();             
					$offering_sites = Site::find($offering_site[0]->site_id);
					$offering_val = Offering::find($offering_preview_id);
					$offering_sites->guideline_id = $offering_val->guideline_id;                  
					}
			}          
			}
			return response()->json($offering_sites);
    }

    public function getOffrings(Request $request){
			// $offrings = Offering::where('site_id',$request->site_id)->get();
			if(request()->has('user_id')){
				$user = User::find($request->user_id);
			} else {
				$user = auth()->user();
			}
			$is_headcount = false;
			if(request()->has('is_headcount')){
				$is_headcount = $request->is_headcount;
			} 

			$site = Site::find($request->site_id);

			$offrings = (new GetOfferingGetter)->forUser($user)->forSite($site)
				->forType($request->type)
				->setHeadCount($is_headcount)
				->get();
			
			return response()->json($offrings);
    }

		public function getOffringsForGroup(Request $request){
			$group = MenuCreationGroup::with('offerings')->where('id',$request->group_id)->get()->first();
			return response()->json($group);
    }

    public function getGuideline(Request $request){
			$offrings = Offering::find($request->id);
			$guideline = Guideline::find($offrings->guideline_id);
			return response()->json($guideline);
    }

		public function getGuidelineForGroup(Request $request){
			$group = MenuCreationGroup::find($request->id);
			$guideline = Guideline::find($group->guideline_id);
			return response()->json($guideline);
    }

    public function getLimitsByGuideline(Request $request){
			$guidelineID = $request->json('guideline');
			$guideline_data = Guideline::find($guidelineID);
			return response()->json($guideline_data);
    }


    public function updateMenuCycleDayOptionsMethod($option_data, $menu_cycle, $day){
        
			$count = 0;
			
		
			$menuCycleDayObj = MenuCycleDay::where('menu_cycle_id',$menu_cycle->id)->where('day_of_week',$day)->first(); 
			//dd($menuCycleDayObj);
			if(!empty($menuCycleDayObj)){       
			$menu_cycle_day = (new UpdateMenuCycleForDayAction)
					->setMenuCycleDay($menuCycleDayObj)
					->setDayOfWeek($day)
					->update();  
			}else{
			$menu_cycle_day = (new CreateMenuCycleForDayAction)
					->forMenuCycle($menu_cycle)
					->setDayOfWeek($day)
					->create();
			}
			
			// dd($option_data);
			foreach($option_data as $mcOption){ 
					// dd($mcOption);

				if(!empty($mcOption['photo'])){                       
						if(is_array($mcOption['photo'])){    
								$img_upload_url = Storage::copy(
										$mcOption['photo']['key'],
										str_replace('tmp/', 'images/options/', $mcOption['photo']['key'])
								);      
								$img_upload_url = str_replace('tmp/', 'images/options/', $mcOption['photo']['key']);
								// dd($img_upload_url);      
								// $img_upload_url = $mcOption['photo']->store('images/options');
						}else{
								$img_upload_url = $mcOption['photo'];                
						}  
						// dd($img_upload_url);      
				} else {
					$img_upload_url = "";  
				}

				$sort = isset($mcOption['sort'])?$mcOption['sort']:$mcOption['sort_order'];
				$sort = $mcOption['sort'];
				//isset($mcOption['sort'])?$mcOption['sort']:$mcOption['sort_order'];
				$isFavorite = (isset($mcOption['is_favorite']) && $mcOption['is_favorite'])?$mcOption['is_favorite']:false;

				$a_la_carte = (isset($mcOption['a_la_carte']) && $mcOption['a_la_carte'])?$mcOption['a_la_carte']:false;


			
			
				$excludeFrom = isset($mcOption['is_exclude_from_export'])?$mcOption['is_exclude_from_export']: false;

				$assemblyServingFreeText = isset($mcOption['assembly_serving_free_text'])?$mcOption['assembly_serving_free_text']:'';
				$assemblyServing = isset($mcOption['assembly_serving'])?$mcOption['assembly_serving']:0;
				$assemblyUnit = isset($mcOption['assembly_serving_unit'])?$mcOption['assembly_serving_unit']:null;
				$instraction = isset($mcOption['assembly_instructions'])?$mcOption['assembly_instructions']:'';
				
				if(isset($mcOption['menu_cycle_day_id']) && isset($mcOption['id'])){
			
					$menuCycleDayOptionObj = MenuCycleDayOption::find($mcOption['id']);        
					$name = isset($mcOption['name'])?$mcOption['name']:'';
					$menu_cycle_option = (new UpdateOptionAction)
							->forMenuCycleDayOption($menuCycleDayOptionObj)
							->updateImage($img_upload_url)
							->updateSortOrder(intval($sort))
							->updateName($name)
							->setIsExclude($excludeFrom)
							->setAssembly($assemblyServingFreeText, $assemblyServing, $assemblyUnit, $instraction)
							->updateisFavorite($isFavorite)
							->updateALaCarte($a_la_carte)
							->update();
			}else{        
				$name = isset($mcOption['name'])?$mcOption['name']:'';
				

				$menu_cycle_option = (new CreateOptionAction)
						->forMenuCycleDay($menu_cycle_day)
						->setImage($img_upload_url)
						->setName($name)
						->setIsExclude($excludeFrom)
						->setAssembly($assemblyServingFreeText, $assemblyServing, $assemblyUnit, $instraction)
						->setIsFavorite($isFavorite)
						->setALaCarte($a_la_carte)
						->setSortOrder(intval($sort))
						->create();        
			
			}

			
			//setup or update recipe in optioncomponets

			 
			
			$recipe_count = 0;
			 
			foreach($mcOption['recipes'] as $mcOptionRecipe){
			$recipe = Recipe::find($mcOptionRecipe['id']);
			$exclude_from = [];
			$instruction_update = '';
			$smartsnack = false;
		
			if(!empty($mcOptionRecipe['instructions'])){
					$instruction_update = $mcOptionRecipe['instructions'];
			}
			if(!empty($mcOptionRecipe['dont_count'])){
					$exclude_from = $mcOptionRecipe['dont_count'];
			}
			if(!empty($mcOptionRecipe['smartsnack'])){            
					if(is_array($mcOptionRecipe['smartsnack'])){
					if($mcOptionRecipe['smartsnack'][0] == 'Yes'){$smartsnack = true;}
					}
					else{
					if($mcOptionRecipe['smartsnack'] == 'true'){$smartsnack = true;}
					if($mcOptionRecipe['smartsnack'] == '1'){$smartsnack = true;}
					}
			}
			
			$is_over_ride = isset($mcOptionRecipe['is_override'])?$mcOptionRecipe['is_override']:false;
			$isExported = isset($mcOptionRecipe['is_exclude_export'])?$mcOptionRecipe['is_exclude_export']:false;
			

			$is_exclude_from_printable_calendar = isset($mcOptionRecipe['is_exclude_from_printable_calendar'])?$mcOptionRecipe['is_exclude_from_printable_calendar']:false;


			if(!empty($mcOption['menu_cycle_day_option_components'])){

					$check_recipe = 0;
					foreach($mcOption['menu_cycle_day_option_components'] as $mcOptionComponent){
							if($mcOptionComponent['recipe_id'] == $mcOptionRecipe['id']){
								
							$menuCycleDayOptionComObj = MenuCycleDayOptionComponent::find($mcOptionComponent['id']); 
							if($menuCycleDayOptionComObj){
									$menu_cycle_component = (new UpdateOptionComponentAction)
									->forMenuCycleDayOptionComponent($menuCycleDayOptionComObj)
									->updateRecipe($recipe, $exclude_from, $instruction_update, $smartsnack)
									->updateOverRide($is_over_ride, $mcOptionRecipe['total_val_override'])
									->updateSortOrder($recipe_count)
									->setIsExclude($isExported)
									->setIsExcludeFromPrintableCalendar($is_exclude_from_printable_calendar)
									->update();
									$check_recipe = 1;
							}              
							
							}
					}  
				
					if($check_recipe == 0 || !isset($mcOptionRecipe['option_component_id'])){        
					$menu_cycle_component = (new CreateOptionComponentAction)
							->forMenuCycleDayOption($menu_cycle_option)
							->attachRecipe($recipe, $exclude_from, $instruction_update, $smartsnack, $is_over_ride, $mcOptionRecipe['total_val_override'])
							->setSortOrder($recipe_count)
							->setIsExclude($isExported)
							->setIsExcludeFromPrintableCalendar($is_exclude_from_printable_calendar)
							->create();      
					}

			}else{
			
			$menu_cycle_component = (new CreateOptionComponentAction)
					->forMenuCycleDayOption($menu_cycle_option)
					->attachRecipe($recipe, $exclude_from, $instruction_update, $smartsnack,$is_over_ride, $mcOptionRecipe['total_val_override'])
					->setSortOrder($recipe_count)
					->setIsExclude($isExported)
					->setIsExcludeFromPrintableCalendar($is_exclude_from_printable_calendar)
					->create();

			}
			// echo json_encode($menu_cycle_component);
			// echo "<br><br><br><br>";
			$recipe_count++;
			}


			$count++;
			}

    }


    public function option_delete(Request $request, MenuCycleDayOption $menucycledayoption){     
			if($request->type == 'group'){
				$last_option_check_all = MenuCycleDayOption::where('menu_cycle_day_id',$menucycledayoption->menu_cycle_day_id)->get();			
				$last_option_check = MenuCycleDayOption::where('group_source_id',$menucycledayoption->id)->orWhere('id',$menucycledayoption->id)->get();
				foreach($last_option_check as $options){
					$new_option_check = MenuCycleDayOption::where('id',$options->id)->get();
					if(count($last_option_check_all) == 1){
						$deletelastRow = MenuCycleDay::where('id', $menucycledayoption->menu_cycle_day_id)->delete();
					}					
					$delete_option = (new DeleteMenuCycleDayOptionAction())
					->sourceMenuCycleOption($new_option_check[0])
					->delete();		
				}	  
			}else{
				$last_option_check = MenuCycleDayOption::where('menu_cycle_day_id',$menucycledayoption->menu_cycle_day_id)->get();
				if(count($last_option_check) == 1){
					$deletelastRow = MenuCycleDay::where('id', $menucycledayoption->menu_cycle_day_id)->delete();
				}        
				$delete_option = (new DeleteMenuCycleDayOptionAction())
										->sourceMenuCycleOption($menucycledayoption)
										->delete();

			}
			
			return redirect()->back();
    }   


    public function getUOMNameByID($uomId = NULL)
    { 
			return $uomname = ($uomId != NULL) ? UnitOfMeasurement::find($uomId)->name : NULL;
    } 

    public function deleteMenuCycleDayOptionComponents(MenuCycleDayOptionComponent $MenuCycleDayOptionComponent  ){
			$MenuCycleDayOptionComponent->delete();
			return redirect()->back();
    }

    public function delete(Request $request){
			// dd($request->all());
			if($request->type == 'group'){
				$calendars = Calendar::with('calendar_days')->where('group_id', $request->site)->get();
				foreach($calendars as $calendar){
					foreach($calendar->calendar_days as $cal_day){
						if($cal_day->week_number == (int) $request->weekNumber){
							$menu_cycle = MenuCycle::with(['menuCycleDays'])->where('id',$cal_day->menu_cycles_id)->first();
							foreach($menu_cycle->menuCycleDays as $menuCycleDay){
								$menuCycleDayOptions = $menuCycleDay->menuCycleDayOptions()->with('menuCycleDayOptionComponents');
								foreach($menuCycleDayOptions as $component){
									$component->menuCycleDayOptionComponents()->delete();
									$menuCycleDayOptions->delete();
								}
								
								$menuCycleDay->delete();
							}
							$menu_cycle->delete();
							$cal_day->delete();
						}
					}
				}
				
			}else{
				$MenuCycle = MenuCycle::find($request->id);
				$cal_day = CalendarDay::where('menu_cycles_id',$request->id)->first();
				if($cal_day){
					CalendarDay::where('calendar_id', $cal_day->calendar_id)
					->where('calendar_id', $cal_day->calendar_id)
					->where('week_number', $request->weekNumber)
					->delete();
				}

				 CalendarDay::where('menu_cycles_id',$request->id)->delete();
				// if($cal_days){
				// 	$cal_days = CalendarDay::where('menu_cycles_id',$request->id)->get();
				// 	foreach($cal_days as $day){
				// 		$days = CalendarDay::find($day->id)->delete();
				// 	}
				// }
				$MenuCycle->delete();
			}
		
			return redirect()->route('calendars',['meal_type' => $request->mealtype, 'age_grade_offering' => $request->agerange, 'day' => $request->days, 'month'=> $request->month, 'year'=> $request->year,'site'=>$request->site,'guide_line_id'=>$request->guide_line_id,'type'=>$request->type,'week_number'=>$request->weekNumber]);
    }

		public function deleteDay(Request $request){
			if($request->form['type'] == 'group'){
				if($request->week_number == 0){
					$week = 'MON';
				}
				if($request->week_number == 1){
					$week = 'TUE';
				}
				if($request->week_number == 2){
					$week = 'WED';
				}
				if($request->week_number == 3){
					$week = 'THU';
				}
				if($request->week_number == 4){
					$week = 'FRI';
				}
				if($request->week_number == 5){
					$week = 'SAT';
				}
				if($request->week_number == 6){
					$week = 'SUN';
				}
				$calendars = Calendar::with('calendar_days')->where('group_id', $request->form['group_id'])->get();
				foreach($calendars as $calendar){
					foreach($calendar->calendar_days as $cal_day){
						if($cal_day->week_number == (int) $request->week){
							$menu_cycle = MenuCycle::with(['menuCycleDays'])->where('id',$cal_day->menu_cycles_id)->first();
							foreach($menu_cycle->menuCycleDays as $menuCycleDay){ 
								if($menuCycleDay->day_of_week == $week){
									$menuCycleDayOptions = $menuCycleDay->menuCycleDayOptions()->with('menuCycleDayOptionComponents');
									$menuCycleDayOptions->delete();
									$menuCycleDay->delete();
								}
							}
						}

					}
				}
				return true;
			}else{
				if($request->id){
					$menuCycleDay = MenuCycleDay::find($request->id);
					$menuCycleDayOptions = $menuCycleDay->menuCycleDayOptions()->with('menuCycleDayOptionComponents');
					$menuCycleDayOptions->delete();
					$menuCycleDay->delete();
					return true;
				}
			}	
		}

		public function copyDayForGroup(Request $request){
			$request->week_number = (int) $request->week_number;
			$week = '';
			$menuCycleDay = MenuCycleDay::find($request->id);
			$form = $request->get('form');
			if($request->week_number == 0){
				$week = 'MON';
			}
			if($request->week_number == 1){
				$week = 'TUE';
			}
			if($request->week_number == 2){
				$week = 'WED';
			}
			if($request->week_number == 3){
				$week = 'THU';
			}
			if($request->week_number == 4){
				$week = 'FRI';
			}
			if($request->week_number == 5){
				$week = 'SAT';
			}
			if($request->week_number == 6){
				$week = 'SUN';
			}
			if($form['type'] == 'group'){
				 $calendar_records = Calendar::with('calendar_days')->where('group_id',$form['group_id'])->get();
        if($calendar_records){
					foreach($calendar_records as $calendar){
						
						foreach($calendar->calendar_days as $cal_day){ 
							if($cal_day->week_number == (int) $request->week){ dd('asdf');
								$menu_cycle = MenuCycle::with(['menuCycleDays'])->where('id',$cal_day->menu_cycles_id)->first();
								if($menu_cycle && count($menu_cycle->menuCycleDays) > 0){
									foreach($menu_cycle->menuCycleDays as $menuCycleDay){  	
										if($menuCycleDay->day_of_week == $week){ 
											$prevMenuCycleDayOptions = $menuCycleDay->menuCycleDayOptions()->with('menuCycleDayOptionComponents');
											$prevMenuCycleDayOptions->delete();
											$menuCycleDay->delete();
										}else{ 
											$newMenuCycleDay = (new CopyMenuCycleDayAction())
											->forMenCycleDay($menuCycleDay)
											->setDayOfWeek($week)
											->setMenuCycleId($menu_cycle->id)
											->copy();

										}
									}
								}
							}
						}
					}
        }

			}
		}



		public function copyDay(Request $request){
			//dd($request->all());
			$request->week_number = (int) $request->week_number;
			
			if($request){
				$week = '';
				$menuCycleDay = MenuCycleDay::find($request->id);
				if($request->week_number == 0){
					$week = 'MON';
				}
				if($request->week_number == 1){
					$week = 'TUE';
				}
				if($request->week_number == 2){
					$week = 'WED';
				}
				if($request->week_number == 3){
					$week = 'THU';
				}
				if($request->week_number == 4){
					$week = 'FRI';
				}
				if($request->week_number == 5){
					$week = 'SAT';
				}
				if($request->week_number == 6){
					$week = 'SUN';
				}

				if($request->menu_cycle && $request->menu_cycle['id'] != ''){ 
					$form = $request->get('form');
					if($form['type'] == 'group'){ 
						$this->copyDayForGroup($request);
					}else{
						$menu_cycle_id = null;
						if($request->menu_cycle['id'] == $menuCycleDay->menu_cycle_id){
						
							$prevMenuCycleDay = MenuCycleDay::where([
								['menu_cycle_id',$menuCycleDay->menu_cycle_id],
								['day_of_week',$week]
							])->get()->first();
							if($prevMenuCycleDay){
								$prevMenuCycleDayOptions = $prevMenuCycleDay->menuCycleDayOptions()->with('menuCycleDayOptionComponents');
								$prevMenuCycleDayOptions->delete();
								$prevMenuCycleDay->delete();
							}
							$menu_cycle_id = $menuCycleDay->menu_cycle_id;
						}else{
							$menu_cycle_id = $request->menu_cycle['id'];
						}	
								
						$newMenuCycleDay = (new CopyMenuCycleDayAction())
							->forMenCycleDay($menuCycleDay)
							->setDayOfWeek($week)
							->setMenuCycleId($menu_cycle_id)
							->copy();
						$menuCycle = MenuCycle::find($newMenuCycleDay->menu_cycle_id);
						if($menuCycle){
							return true;
						}
					}
					
				}else{	
					$form = $request->get('form');
					if($form){
						$menuCycle = MenuCycle::find($menuCycleDay->menu_cycle_id);
						$MealType = MealType::find($form['meal_type']);
						$AgeGradeOffering = AgeGradeOffering::find($form['age_grade_offering']);
						$Days = Days::find($form['day']);
						$monthYear = date('Y-m-d', strtotime($form['year'] .'-'.$form['month'].'-'.'01'));
						$site = Site::find($form['site']);
						if($form['type'] == 'group'){
							$site = null;
							$offerid = null;
							$groupid = $form['site'];
						 
						}else{
							$site = $form['site'];
							$groupid = null;
							$offerid = $form['offering_id'];
						}

						if($form['type'] == 'group'){
						
							$calendars = Calendar::where('group_id',$form['group_id'])->get();
							foreach($calendars as $cal){
								$newMenuCycle = (new CopyMenuCycleCopyAction())
									->forMenCycle($menuCycle)
									->setName($menuCycle->name)
									->setTemplate(0)
									->setWeek($request->week)
									->copy();
									
								$cal_days = (new CreateCalendarDaysWithoutMenuAction())
										->forCalendar($cal)
										->setWeekNumber($request->week) 
										->setMenCycle($newMenuCycle->id)
										->create();

								$menuCycleDay = MenuCycleDay::find($request->id);

								$newMenuCycleDay = (new CopyMenuCycleDayAction())
										->forMenCycleDay($menuCycleDay)
										->setDayOfWeek($week)
										->setMenuCycleId($newMenuCycle->id)
										->copy();

							}
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

					

							$newMenuCycle = (new CopyMenuCycleCopyAction())
									->forMenCycle($menuCycle)
									->setName($menuCycle->name)
									->setTemplate(0)
									->setWeek($request->week)
									->copy();
									
							$cal_days = (new CreateCalendarDaysWithoutMenuAction())
									->forCalendar($calender)
									->setWeekNumber($request->week) 
									->setMenCycle($newMenuCycle->id)
									->create();

							$newMenuCycleDay = (new CopyMenuCycleDayAction())
									->forMenCycleDay($menuCycleDay)
									->setDayOfWeek($week)
									->setMenuCycleId($newMenuCycle->id)
									->copy();

						}
						return true;
					}	
				}
			}
		}

		public function excludedDate(Request $request){
			if($request && $request->site_id != ''){
				$excludedDays  = ExcludeDay::where('site_id', $request->site_id)
											->where('offering_id', $request->offering_id) 
											->orderBy('date','asc')
											->get()
											->pluck('date')
											->toArray();
				if($excludedDays){
					return $excludedDays;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}

		function array_sum_values(array $input, $key) {
			$sum = 0;
			array_walk($input, function($item, $index, $params) {
						if (!empty($item[$params[1]]))
							 $params[0] += $item[$params[1]];
				 }, array(&$sum, $key)
			);
			return $sum;
	 	}

		  

		 public function downloadRecipeCard(Request $request, $id){
			//  dd(decToFraction(400068.34));
			ini_set('max_execution_time', '300');
			if($id){
				// $path = public_path('pdf/');
				$path = 's3://nutristudents/public/pdf';
				$filepath =  Storage::url('public/pdf/');
				// dd($filepath);
				$menuCycleDay = MenuCycleDay::with(
					[
					'menuCycleDayOptions.menuCycleDayOptionComponents.recipe.ingredients.prefer_product',
					'menuCycleDayOptions.menuCycleDayOptionComponents.recipe.ingredients_total',
					'menuCycleDayOptions.menuCycleDayOptionComponents.recipe.ingredients_total.unitOfMesurment',
					'menuCycleDayOptions.menuCycleDayOptionComponents.recipe.unitOfMesurment',
					'menuCycleDayOptions.menuCycleDayOptionComponents.recipe.ingredients_total.recipeUnitOfMesurment',
					])->find($id);

				if($menuCycleDay && $menuCycleDay->menuCycleDayOptions){
					
					// dd($path . '/' . 'Recipe'.'.zip');
					// $zip = Zip::create($path . '/' . 'Recipe'.'.zip');
					$tempFile = time().'-recipe-cards.zip';
					$zipfile = Storage::disk('tmp')->url($tempFile);
					$zip = new \ZipArchive();
					$zip->open($zipfile, \ZipArchive::CREATE);
					$zip = $this->assemblyData($menuCycleDay, $zip);
					
					foreach($menuCycleDay->menuCycleDayOptions as $key=>$options){
						if($options->menuCycleDayOptionComponents){
							
							foreach($options->menuCycleDayOptionComponents as $i=>$component){
								if($component->is_exclude_export != true){

									$recipe = $component->recipe;
									if($recipe && isset($recipe->name)){
										// dd($recipe);
										$studentCount = $component->student_count != null ? $component->student_count : 0;
										$ingre_array = [
											"usda_componenent_meat"=>	0,
											"usda_componenent_grain"=>0,
											"usda_componenent_fruit"=>0,
											"usda_componenent_milk"=>0,
											"usda_componenent_veg"=>0,
											"usda_componenent_veggrn"=>0,
											"usda_componenent_vegred"=>0,
											"usda_componenent_vegleg"=>0,
											"usda_componenent_vegstar"=>0,
											"usda_componenent_vegothr"=>0,
											"usda_componenent_meat_override"=>0,
											"usda_componenent_grain_override"=>0,
											"usda_componenent_fruit_override"=>0,
											"usda_componenent_milk_override"=>0,
											"usda_componenent_veg_override"=>0,
											"usda_componenent_veggrn_override"=>0,
											"usda_componenent_vegred_override"=>0,
											"usda_componenent_vegleg_override"=>0,
											"usda_componenent_vegstar_override"=>0,
											"usda_componenent_vegothr_override"=>0,
											"cals"=>0,
											"sod"=>0,
											"fat"=>0,
											"prot"=>0,
											"carb"=>0
										];
										// dd(json_encode($recipe));
										// dd($recipe->toArray());
										foreach($recipe->ingredients_total as $k=>$ingre){
											$ingre_array['usda_componenent_meat'] += isset($ingre->usda_componenent_meat_override)?$ingre->usda_componenent_meat_override:$ingre->usda_componenent_meat;
											$ingre_array['usda_componenent_grain'] += isset($ingre->usda_componenent_grain_override)?$ingre->usda_componenent_grain_override:$ingre->usda_componenent_grain;
											$ingre_array['usda_componenent_fruit'] += isset($ingre->usda_componenent_fruit_override)?$ingre->usda_componenent_fruit_override:$ingre->usda_componenent_fruit;
											$ingre_array['usda_componenent_milk'] += isset($ingre->usda_componenent_milk_override)?$ingre->usda_componenent_milk_override:$ingre->usda_componenent_milk;
											$ingre_array['usda_componenent_veg'] += isset($ingre->usda_componenent_veg_override)?$ingre->usda_componenent_veg_override:$ingre->usda_componenent_veg;
											$ingre_array['usda_componenent_veggrn'] += isset($ingre->usda_componenent_veggrn_override)?$ingre->usda_componenent_veggrn_override:$ingre->usda_componenent_veggrn;
											$ingre_array['usda_componenent_vegred'] += isset($ingre->usda_componenent_vegred_override)?$ingre->usda_componenent_vegred_override:$ingre->usda_componenent_vegred;
											$ingre_array['usda_componenent_vegleg'] += isset($ingre->usda_componenent_vegleg_override)?$ingre->usda_componenent_vegleg_override:$ingre->usda_componenent_vegleg;
											$ingre_array['usda_componenent_vegstar'] += isset($ingre->usda_componenent_vegstar_override)?$ingre->usda_componenent_vegstar_override:$ingre->usda_componenent_vegstar;
											$ingre_array['usda_componenent_vegothr'] += isset($ingre->usda_componenent_vegothr_override)?$ingre->usda_componenent_vegothr_override:$ingre->usda_componenent_vegothr;
											$ingre_array['usda_componenent_meat_override'] += $ingre->usda_componenent_meat_override;
											$ingre_array['usda_componenent_grain_override'] += $ingre->usda_componenent_grain_override;
											$ingre_array['usda_componenent_fruit_override'] += $ingre->usda_componenent_fruit_override;
											$ingre_array['usda_componenent_milk_override'] += $ingre->usda_componenent_milk_override;
											$ingre_array['usda_componenent_veg_override'] += $ingre->usda_componenent_veg_override;
											$ingre_array['usda_componenent_veggrn_override'] += $ingre->usda_componenent_veggrn_override;
											$ingre_array['usda_componenent_vegred_override'] += $ingre->usda_componenent_vegred_override;
											$ingre_array['usda_componenent_vegleg_override'] += $ingre->usda_componenent_vegleg_override;
											$ingre_array['usda_componenent_vegstar_override'] += $ingre->usda_componenent_vegstar_override;
											$ingre_array['usda_componenent_vegothr_override'] += $ingre->usda_componenent_vegothr_override;
											
											$ingredient = array();
											$scale = 1;
											if($recipe->ingredients[$k]->prefer_product){
												$ingredient['recipe_amount'] = $ingre->recipe_amount;
											$ingredient['recipe_amount_uom']  = $this->getUOMNameByID($ingre->recipe_amount_uom_id);

											$ingredient['serving_amount']     = $ingre->serving_amount;
											$ingredient['serving_amount_uom'] = $this->getUOMNameByID($ingre->serving_amount_uom_id);

											// dd($ingre, $ingredient);

											$ingredient['component_mma']   = $ingre->usda_componenent_meat;
											$ingredient['component_wgr']   = $ingre->usda_componenent_grain;
											$ingredient['component_fru']   = $ingre->usda_componenent_fruit;
											$ingredient['component_mlk']   = $ingre->usda_componenent_milk;
											$ingredient['component_veg']   = $ingre->usda_componenent_veg;
											$ingredient['component_dg']    = $ingre->usda_componenent_veggrn;
											$ingredient['component_ro']    = $ingre->usda_componenent_vegred;
											$ingredient['component_leg']   = $ingre->usda_componenent_vegleg;
											$ingredient['component_star']  = $ingre->usda_componenent_vegstar;
											$ingredient['component_other'] = $ingre->usda_componenent_vegothr;

											//setup ingredient components for optional components
											$ingredient['optional_component_mma']   = $ingre->usda_componenent_meat_override;
											$ingredient['optional_component_wgr']   = $ingre->usda_componenent_grain_override;
											$ingredient['optional_component_fru']   = $ingre->usda_componenent_fruit_override;
											$ingredient['optional_component_mlk']   = $ingre->usda_componenent_milk_override;
											$ingredient['optional_component_veg']   = $ingre->usda_componenent_veg_override;
											$ingredient['optional_component_dg']    = $ingre->usda_componenent_veggrn_override;
											$ingredient['optional_component_ro']    = $ingre->usda_componenent_vegred_override;
											$ingredient['optional_component_leg']   = $ingre->usda_componenent_vegleg_override;
											$ingredient['optional_component_star']  = $ingre->usda_componenent_vegstar_override;
											$ingredient['optional_component_other'] = $ingre->usda_componenent_vegothr_override;


											
											$prefer_prod = $recipe->ingredients[$k]->prefer_product;
											$prefer_prod['measurement_serving_weight'] = $prefer_prod->serving_measurement_weight;
											$prefer_prod['measurement_serving_weight_uom'] = $this->getUOMNameByID($prefer_prod->serving_measurement_weight_uom_id);
											$prefer_prod['measurement_serving_volume'] = $prefer_prod->serving_measurement_volume;
											$prefer_prod['measurement_serving_volume_uom'] = $this->getUOMNameByID($prefer_prod->serving_measurement_volume_uom_id);
											$prefer_prod['measurement_serving_unit'] = $prefer_prod->serving_measurement_unit;
											$prefer_prod['measurement_serving_unit_uom'] = $this->getUOMNameByID($prefer_prod->serving_measurement_unit_uom_id);

											$ingredient['preferred_product_information'] = $recipe->ingredients[$k]->prefer_product;

											$scale = (new UnitConversionsGetter)->getNutritionScaleFactor($ingredient);

											}
											

											// dd($scale);

											if($recipe->ingredients[$k]->prefer_product && $recipe->ingredients[$k]->prefer_product->nutrition_facts_calories){
												$ingre_array['cals'] += $recipe->ingredients[$k]->prefer_product->nutrition_facts_calories * $scale;
											}

											if($recipe->ingredients[$k]->prefer_product && $recipe->ingredients[$k]->prefer_product->nutrition_facts_sodium){
												$ingre_array['sod'] += $recipe->ingredients[$k]->prefer_product->nutrition_facts_sodium * $scale;
											}
		
											if($recipe->ingredients[$k]->prefer_product && $recipe->ingredients[$k]->prefer_product->nutrition_facts_totalfat){
												$ingre_array['fat'] += $recipe->ingredients[$k]->prefer_product->nutrition_facts_totalfat * $scale;
											}
		
											if($recipe->ingredients[$k]->prefer_product && $recipe->ingredients[$k]->prefer_product->nutrition_facts_protein){
												$ingre_array['prot'] += $recipe->ingredients[$k]->prefer_product->nutrition_facts_protein * $scale;
											}
		
											if($recipe->ingredients[$k]->prefer_product && $recipe->ingredients[$k]->prefer_product->nutrition_facts_carbs){
												$ingre_array['carb'] += $recipe->ingredients[$k]->prefer_product->nutrition_facts_carbs * $scale;
											}
											
										}
										
										$index = $key + 1;
										$id =  substr($recipe->id, -4);
										// return view('recipe',  ['recipe'=> $recipe,'ingre_array'=> $ingre_array,'studentCount'=>$studentCount]);

										$pdf = PDF::setOptions(['isPhpEnabled' => true, 'isRemoteEnabled' => env('PDF_IS_REMOTE_ENABLED', true)]);
										$pdf = $pdf->loadView('recipe', ['recipe'=> $recipe,'ingre_array'=> $ingre_array,'studentCount'=>$studentCount])
										
										// ->setPaper('a4', 'landscape')
										;
										// return $pdf->download(time ().$request->curent_date.'-'.'rrr.pdf');
										// Str::slug('dsfdsf-sdf');
										$n = time().'-'. str_replace("/","-",$recipe->name);
										$fileName =  $n .'-'.$index.'-'.'recipe-card.pdf';

										$content = Storage::disk('s3')->put('public/pdf/'.$fileName,$pdf->output());

										// $file_content = Storage::disk('s3')->url('public/pdf/'.$fileName);

										// dd($file_content);
										$zip->addFromString($fileName, Storage::disk('s3')->get('public/pdf/'.$fileName));
									}
								}
							}

						}

					}
					$zip->close();
					Storage::disk('s3')->put("zip-file/$tempFile", file_get_contents($zipfile));
					return redirect(Storage::disk('s3')->temporaryUrl(
						"zip-file/$tempFile",
						now()->addHour(),
						['ResponseContentDisposition' => 'attachment']
					));

					// return response()->download(public_path('pdf/'. 'Recipe'.'.zip'));
				}else{
					return redirect()->route('calendars',['meal_type' => $request->searchForm['meal_type'], 'age_grade_offering' => $request->searchForm['age_grade_offering'], 'day' =>$request->searchForm['day'], 'month'=> $request->searchForm['month'], 'year'=> $request->searchForm['year'],'site'=>$request->searchForm['site'],'guide_line_id'=>$request->searchForm['guide_line_id']]);
				}
			}else{
				return redirect()->route('calendars',['meal_type' => $request->searchForm['meal_type'], 'age_grade_offering' => $request->searchForm['age_grade_offering'], 'day' =>$request->searchForm['day'], 'month'=> $request->searchForm['month'], 'year'=> $request->searchForm['year'],'site'=>$request->searchForm['site'],'guide_line_id'=>$request->searchForm['guide_line_id']]);
			}
		}

	 

		public function downloadFpr(Request $request, $id){
			$site_id = $request->site_id;
			$site = null;
			$SaladBar = false;
			if($site_id && $site_id != ''){
				$site = Site::find($site_id);

			}
			// dd($site, $site_id);
			$siteName = ($site)?$site->name: '';// $request->site_name;
			if($id){
				$menuCycleDay = MenuCycleDay::with(
					[
					'menuCycleDayOptions.menuCycleDayOptionComponents.recipe.ingredients.prefer_product',
					'menuCycleDayOptions.menuCycleDayOptionComponents.recipe.ingredients_total',
					'menuCycleDayOptions.menuCycleDayOptionComponents.recipe.ingredients_total.unitOfMesurment',
					'menuCycleDayOptions.menuCycleDayOptionComponents.recipe.unitOfMesurment'
					])->find($id);

				if($menuCycleDay != '' && $menuCycleDay->menuCycleDayOptions && count($menuCycleDay->menuCycleDayOptions) > 0){

					$firstOption = $menuCycleDay->menuCycleDayOptions[0];
					//dd($firstOption);
					if($firstOption != '' ){
						$ingre_array = [
							"usda_componenent_meat"=>	0,
							"usda_componenent_grain"=>0,
							"usda_componenent_fruit"=>0,
							"usda_componenent_milk"=>0,
							"usda_componenent_veg"=>0,
							"usda_componenent_veggrn"=>0,
							"usda_componenent_vegred"=>0,
							"usda_componenent_vegleg"=>0,
							"usda_componenent_vegstar"=>0,
							"usda_componenent_vegothr"=>0,
							"usda_componenent_meat_override"=>0,
							"usda_componenent_grain_override"=>0,
							"usda_componenent_fruit_override"=>0,
							"usda_componenent_milk_override"=>0,
							"usda_componenent_veg_override"=>0,
							"usda_componenent_veggrn_override"=>0,
							"usda_componenent_vegred_override"=>0,
							"usda_componenent_vegleg_override"=>0,
							"usda_componenent_vegstar_override"=>0,
							"usda_componenent_vegothr_override"=>0,
							"cals"=>0,
							"sod"=>0,
							"fat"=>0,
							"prot"=>0,
							"carb"=>0
						];
						$headCount = [];
						// $menuCycleDay->menuCycleDayOptions->map(function ($a){
						// 	return $a->sort('menuCycleDayOptionComponents.recipe.category_sort');
						// });
						// $a = $menuCycleDay->menuCycleDayOptions->sortBy('menuCycleDayOptionComponents.recipe.category_sort');
						// // dd($a->toArray());
						// $menuCycleDay->menuCycleDayOptions = $menuCycleDay->menuCycleDayOptions->sortBy('menuCycleDayOptionComponents.recipe.category_sort');

						foreach($menuCycleDay->menuCycleDayOptions as $key=>$options){
							$headCount[$options->id] =0;

							if(!$options->a_la_carte){
								foreach($options->menuCycleDayOptionComponents as $i=>$component){
									if($headCount[$options->id] < $component->student_count){
										$headCount[$options->id] = $component->student_count;
									}
									$recipe = $component->recipe;
									 
									if($recipe->category == 'Salad Bar'){
										$SaladBar = true;
									}
									foreach($recipe->ingredients_total as $k=>$ingre){
										$ingre_array['usda_componenent_meat'] += isset($ingre->usda_componenent_meat_override)?$ingre->usda_componenent_meat_override:$ingre->usda_componenent_meat;
										$ingre_array['usda_componenent_grain'] += isset($ingre->usda_componenent_grain_override)?$ingre->usda_componenent_grain_override:$ingre->usda_componenent_grain;
										$ingre_array['usda_componenent_fruit'] += isset($ingre->usda_componenent_fruit_override)?$ingre->usda_componenent_fruit_override:$ingre->usda_componenent_fruit;
										$ingre_array['usda_componenent_milk'] += isset($ingre->usda_componenent_milk_override)?$ingre->usda_componenent_milk_override:$ingre->usda_componenent_milk;
										$ingre_array['usda_componenent_veg'] += isset($ingre->usda_componenent_veg_override)?$ingre->usda_componenent_veg_override:$ingre->usda_componenent_veg;
										$ingre_array['usda_componenent_veggrn'] += isset($ingre->usda_componenent_veggrn_override)?$ingre->usda_componenent_veggrn_override:$ingre->usda_componenent_veggrn;
										$ingre_array['usda_componenent_vegred'] += isset($ingre->usda_componenent_vegred_override)?$ingre->usda_componenent_vegred_override:$ingre->usda_componenent_vegred;
										$ingre_array['usda_componenent_vegleg'] += isset($ingre->usda_componenent_vegleg_override)?$ingre->usda_componenent_vegleg_override:$ingre->usda_componenent_vegleg;
										$ingre_array['usda_componenent_vegstar'] += isset($ingre->usda_componenent_vegstar_override)?$ingre->usda_componenent_vegstar_override:$ingre->usda_componenent_vegstar;
										$ingre_array['usda_componenent_vegothr'] += isset($ingre->usda_componenent_vegothr_override)?$ingre->usda_componenent_vegothr_override:$ingre->usda_componenent_vegothr;
										$ingre_array['usda_componenent_meat_override'] += $ingre->usda_componenent_meat_override;
										$ingre_array['usda_componenent_grain_override'] += $ingre->usda_componenent_grain_override;
										$ingre_array['usda_componenent_fruit_override'] += $ingre->usda_componenent_fruit_override;
										$ingre_array['usda_componenent_milk_override'] += $ingre->usda_componenent_milk_override;
										$ingre_array['usda_componenent_veg_override'] += $ingre->usda_componenent_veg_override;
										$ingre_array['usda_componenent_veggrn_override'] += $ingre->usda_componenent_veggrn_override;
										$ingre_array['usda_componenent_vegred_override'] += $ingre->usda_componenent_vegred_override;
										$ingre_array['usda_componenent_vegleg_override'] += $ingre->usda_componenent_vegleg_override;
										$ingre_array['usda_componenent_vegstar_override'] += $ingre->usda_componenent_vegstar_override;
										$ingre_array['usda_componenent_vegothr_override'] += $ingre->usda_componenent_vegothr_override;
										
										if($recipe->ingredients[$k]->prefer_product && $recipe->ingredients[$k]->prefer_product->nutrition_facts_calories){
											$ingre_array['cals'] += $recipe->ingredients[$k]->prefer_product->nutrition_facts_calories;
										}

										if($recipe->ingredients[$k]->prefer_product && $recipe->ingredients[$k]->prefer_product->nutrition_facts_sodium){
											$ingre_array['sod'] += $recipe->ingredients[$k]->prefer_product->nutrition_facts_sodium;
										}

										if($recipe->ingredients[$k]->prefer_product && $recipe->ingredients[$k]->prefer_product->nutrition_facts_totalfat){
											$ingre_array['fat'] += $recipe->ingredients[$k]->prefer_product->nutrition_facts_totalfat;
										}

										if($recipe->ingredients[$k]->prefer_product && $recipe->ingredients[$k]->prefer_product->nutrition_facts_protein){
											$ingre_array['prot'] += $recipe->ingredients[$k]->prefer_product->nutrition_facts_protein;
										}

										if($recipe->ingredients[$k]->prefer_product && $recipe->ingredients[$k]->prefer_product->nutrition_facts_carbs){
											$ingre_array['carb'] += $recipe->ingredients[$k]->prefer_product->nutrition_facts_carbs;
										}
										
									}
								}
							}
						}

						$showHeadCount = 0;

						if(count($headCount) > 0){
							$showHeadCount = array_sum( array_values($headCount));
						}

						$dp = new Dompdf();
						$newFont = $dp->getFontMetrics()->getFont("helvetica", "bold");
						
						$pdf = PDF::setOptions(['isPhpEnabled' => true, 'isRemoteEnabled' => env('PDF_IS_REMOTE_ENABLED', true)]);
						// dd($newFont);
						$pdf = $pdf->loadView('fpr',['firstOption'=>$firstOption,'menuCycleDay'=>$menuCycleDay,'ingre_array'=> $ingre_array, 'curent_date'=> $request->curent_date, 'siteName'=> $siteName, 'pdf' => $pdf, 'showHeadCount'=> $showHeadCount])->setPaper('a4', 'landscape');

						// $pdf->page
						if($request->is_html){
							return view('fpr', ['firstOption'=>$firstOption,'menuCycleDay'=>$menuCycleDay,'ingre_array'=> $ingre_array, 'curent_date'=> $request->curent_date, 'siteName'=> $siteName, 'pdf' => $pdf, 'showHeadCount'=> $showHeadCount]);
						}


						// return view('salad-bar',[ 'curent_date'=> $request->curent_date, 'siteName'=> $siteName, 'pdf' => $pdf, 'showHeadCount'=> $showHeadCount]);
						// dd(env('PDF_IS_REMOTE_ENABLED', true));

						if($SaladBar){
							
							$tempFile = time().'-FPR.zip';
							$zipfile = Storage::disk('tmp')->url($tempFile);
							$zip = new \ZipArchive();
							$zip->open($zipfile, \ZipArchive::CREATE);
							// $zip = $this->assemblyData($menuCycleDay, $zip);

							$n = time();
							$fileName =  $n .'-'.'FPR.pdf';
							Storage::disk('s3')->put('public/pdf/'.$fileName,$pdf->output());
							$zip->addFromString($fileName, Storage::disk('s3')->get('public/pdf/'.$fileName));

							$pdf1 =   PDF::setOptions(['isPhpEnabled' => true, 'isRemoteEnabled' => env('PDF_IS_REMOTE_ENABLED', true)]);
							$pdf1 = $pdf1->loadView('salad-bar',[ 'curent_date'=> $request->curent_date, 'siteName'=> $siteName, 'pdf' => $pdf1, 'showHeadCount'=> $showHeadCount])->setPaper('a4', 'landscape');

							$n = time();
							$fileName =  $n .'-'.'salad-bar.pdf';

							$content = Storage::disk('s3')->put('public/pdf/'.$fileName,$pdf1->output());
							$zip->addFromString($fileName, Storage::disk('s3')->get('public/pdf/'.$fileName));

							$zip->close();

							Storage::disk('s3')->put("zip-file/$tempFile", file_get_contents($zipfile));
							return redirect(Storage::disk('s3')->temporaryUrl(
								"zip-file/$tempFile",
								now()->addHour(),
								['ResponseContentDisposition' => 'attachment']
							));

						} else {
							return $pdf->download(time ().$request->curent_date.'-'.'FPR.pdf');
						} 
					}
				}
			}
		}
     
		public function downloadAssemblyInstructions(Request $request, MenuCycleDay $menuCycleDay){
			
			$path = 's3://nutristudents/zip-file/';
			$filepath =  Storage::url('zip-file/');
			$menuCycleDayOptions = $menuCycleDay->menuCycleDayOptions->where('assembly_instructions', '!=', '')
			;
			if(count($menuCycleDayOptions) > 0){
				$tempFile = time().'-AssemblyInstructions.zip';
				$zipfile = Storage::disk('tmp')->url($tempFile);
				$zip = new \ZipArchive();
				$zip->open($zipfile, \ZipArchive::CREATE);
				$zip = $this->assemblyData($menuCycleDay, $zip);

				$zip->close();
					Storage::disk('s3')->put("zip-file/$tempFile", file_get_contents($zipfile));
					return redirect(Storage::disk('s3')->temporaryUrl(
						"zip-file/$tempFile",
						now()->addHour(),
						['ResponseContentDisposition' => 'attachment']
					));
			} else {
				return redirect()->back();
			}
		}

		public function assemblyData(MenuCycleDay $menuCycleDay, $zip ){
			// dd($menuCycleDay->menuCycleDayOptions->toArray());
			$menuCycleDayOptions = $menuCycleDay->menuCycleDayOptions->where('assembly_instructions', '!=','');
			if(count($menuCycleDayOptions) > 0){
				foreach($menuCycleDayOptions as $menuCycleDayOption){	
									
					$pdf = PDF::setOptions(['isPhpEnabled' => true, 'isRemoteEnabled' => env('PDF_IS_REMOTE_ENABLED', true)]);
					$pdf = $pdf->loadView('assemblyInstructionsPdf', ['menuCycleDayOption'=> $menuCycleDayOption])->setPaper('a4', 'landscape');
					$n = time().'-'. str_replace("/","-",$menuCycleDayOption->name);
					$fileName =  $n .'-'.'options.pdf';
					$content = Storage::disk('s3')->put('zip-file/'.$fileName,$pdf->output());
					$zip->addFromString($fileName, Storage::disk('s3')->get('zip-file/'.$fileName));
				}
			}
			return $zip;
		}
}
