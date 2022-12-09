<?php

declare(strict_types=1);

namespace Bytelaunch\Nutristudents\Http\Controllers;
 

use Bytelaunch\Nutristudents\Actions\MealPreparationGroups\CreateMealPreparationGroupAction; 
use Bytelaunch\Nutristudents\Actions\MealPreparationGroups\DeleteMealPreparationGroupAction;
use Bytelaunch\Nutristudents\Actions\MealPreparationGroups\UpdateMealPreparationGroupAction;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Laravel\Jetstream\Jetstream;
use Illuminate\Routing\Controller;
use Laravel\Jetstream\RedirectsActions; 
use Bytelaunch\Nutristudents\Models\AgeGradeOffering;
use Bytelaunch\Nutristudents\Models\Days; 
use Bytelaunch\Nutristudents\Models\MealType;
use Bytelaunch\Nutristudents\Models\Offering;
use Bytelaunch\Nutristudents\Models\MealPreparationGroup;


class MealPreparationGroupsController extends Controller
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
        $groups = MealPreparationGroup::with(['age_grade','days','meal_type','guideline'])->orderBy('name', 'asc')->paginate(100);
        $mealTypes = MealType::select('id', 'name')->orderBy('name','asc')->get();
        $ageGradeOfferings = AgeGradeOffering::select('id', 'name')->orderBy('name','asc')->get();
        $days = Days::select('id', 'name')->orderBy('name','asc')->get();

        $search = '';
        $filter = '';
        if ($request->query('search')) {
            $search = $request->query('search');
            $groups = MealPreparationGroup::with(['age_grade','days','meal_type','guideline'])->SearchByAll($search)->orderBy('name', 'asc')->paginate(100);
            $groups->appends(request()->query());
        } 

        return Jetstream::inertia()->render($request,  'MealPreparationGroups/MealPreparationGroups', [
            'groupss'=> $groups,
            'mealTypes' => $mealTypes,
            'ageGradeOfferings' => $ageGradeOfferings,
            'days' => $days,
            'rec_searched' => $search,
            'rec_filter' => $filter,
        ]);
    }


    public function searchFilter(Request $request)
    {
        
        $search_filter = $request->json('type');
        if ($search_filter == 'search') {
            $term = $request->json('term');
            $recipes_search = MealPreparationGroup::with(['age_grade','days','meal_type','guideline'])->SearchByAll($term)->orderBy('name', 'asc')
            ->paginate(100);
        }
        if ($search_filter == 'filter') {
            $meal = $request->json('meal');
            $offrings = $request->json('offrings');
            $day = $request->json('day');

            $recipes_search = MealPreparationGroup::with(['age_grade','days','meal_type','guideline']);
            if($meal && $meal != ''){
                $recipes_search->where('meal_type_id', $meal);
            }
            if($offrings && $offrings != ''){
                $recipes_search->where('age_grade_offering_id', $offrings);
            }
            if($day && $day != ''){
                $recipes_search->where('day_id', $day);
            }             
            
            $recipes_search = $recipes_search->orderBy('name', 'asc')
            ->paginate(100);
 
        }
       
        return response()->json($recipes_search);
    }

    public function create(Request $request): Response
    {

        $mealTypes = MealType::select('id', 'name')->orderBy('name','asc')->get();
        $ageGradeOfferings = AgeGradeOffering::select('id', 'name')->orderBy('name','asc')->get();
        $days = Days::select('id', 'name')->orderBy('name','asc')->get();

        return Jetstream::inertia()->render($request, 'MealPreparationGroups/MealPreparationGroups-add', [
            'mealTypes' => $mealTypes,
            'ageGradeOfferings' => $ageGradeOfferings,
            'days' => $days
        ]);
    }

    public function edit(Request $request, $id): Response
    {        
        $group = MealPreparationGroup::with(['age_grade','days','meal_type','guideline','offerings.site'])->find($id);
        $mealTypes = MealType::select('id', 'name')->orderBy('name','asc')->get();
        $ageGradeOfferings = AgeGradeOffering::select('id', 'name')->orderBy('name','asc')->get();
        $days = Days::select('id', 'name')->orderBy('name','asc')->get();

        $offering_array = $group->offerings->toArray();

        return Jetstream::inertia()->render($request, 'MealPreparationGroups/MealPreparationGroups-edit', [
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
            // 'age_grade_offering_id' => 'required|string',
            // 'day_id' => 'required|string', 
            // 'guideline_id'=>'required|string'
          ],[
            'name.required' => 'This field is required.',                    
            'meal_type_id.required' => 'This field is required.',
            'age_grade_offering_id.required' => 'This field is required.',
            'day_id.required' => 'This field is required.',
            'guideline_id.required' => 'This field is required.'
          ]);

          $menu_creation = MealPreparationGroup::find($id);

          $group = (new UpdateMealPreparationGroupAction)
          ->setMenuCycle($menu_creation)
          ->setName($request->name)
          ->setMealType($request->meal_type_id)
        //   ->setAgeRange($request->age_grade_offering_id)
        //   ->setDays($request->day_id)
        //   ->setGuideline($request->guideline_id)
          ->setOffering($request->siteOfferings) 
          ->update();

          
          return redirect()->route('meal-preparation-groups');
    }

    public function groupDelete(Request $request, MealPreparationGroup $group)
    {
        // dd($group);
       (new DeleteMealPreparationGroupAction())
            ->sourceGroup($group)
            ->deleteGroup();

        return redirect()->back();
    }

    public function searchSiteOffering(Request $request){
        $site_offering = [];
        $form = $request->form;
        if($request->form['meal_type_id'] != '' ){  
            $site_offering = Offering::with(['site'])
            ->whereDoesntHave('mealPreparationGroups')
            ->has('site')
            ->whereHas('guideline', function($q)use($form){
                $q->where('meal_type_id', $form['meal_type_id']);
            })
            // ->where('meal_type_id', $request->form['meal_type_id'])
            ;
            // dd($request->form['siteOfferings']);
            if(isset($request->form['siteOfferings']) && count($request->form['siteOfferings'])> 0 ){
                $soffer = collect($request->form['siteOfferings'])->pluck('id')->toArray();
                // dd($soffer);
                $site_offering->whereNotIn('id', $soffer);
            }  
            
            $site_offering = $site_offering->get();
        }
        return response()->json($site_offering);
    }

     
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string',          
            'meal_type_id' => 'required|string',
            // 'age_grade_offering_id' => 'required|string',
            // 'day_id' => 'required|string', 
            // 'guideline_id'=>'required|string'
          ],[
            'name.required' => 'This field is required.',                    
            'meal_type_id.required' => 'This field is required.',
            'age_grade_offering_id.required' => 'This field is required.',
            'day_id.required' => 'This field is required.',
            'guideline_id.required' => 'This field is required.'
          ]);

          

          $group = (new CreateMealPreparationGroupAction())
          ->setName($request->name)
          ->setMealType($request->meal_type_id)
        //   ->setAgeRange($request->age_grade_offering_id)
        //   ->setDays($request->day_id)
        //   ->setGuideline($request->guideline_id)
          ->setOffering($request->siteOfferings)
          ->create(); 

          return redirect()->route('meal-preparation-groups');
    }
}
