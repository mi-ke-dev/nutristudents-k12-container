<?php

namespace Bytelaunch\Nutristudents\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Laravel\Jetstream\Jetstream;
use Illuminate\Routing\Controller;
use Laravel\Jetstream\RedirectsActions;
use Illuminate\Support\Facades\Validator;

use App\Models\User;
use Bytelaunch\Nutristudents\Models\Guideline;

use Bytelaunch\Nutristudents\Models\MealType;
use Bytelaunch\Nutristudents\Models\AgeGradeOffering;
use Bytelaunch\Nutristudents\Models\Days;

use Bytelaunch\Nutristudents\Actions\Guidelines\CreateGuidelineAction;
use Bytelaunch\Nutristudents\Actions\Guidelines\UpdateGuidelineAction;
use Bytelaunch\Nutristudents\Actions\Guidelines\CopyGuidelineAction;
use Bytelaunch\Nutristudents\Actions\Guidelines\DeleteGuidelineAction;


class GuidelineController extends Controller
{
    public function index(Request $request) : Response
    {
        $guidelines = Guideline::orderBy('name','asc')->get();

        $guidelines->map(function($item, $key) {    
            $item->append('is_tenant_admin');
        $user_name = User::where('id',$item->user_id)->pluck('name');        
        $item->user_name = $user_name[0];
        });

        return Jetstream::inertia()->render($request, 'Guidelines/Guidelines', [
               'all_guidelines' => $guidelines,
        ]);
    }



    public function create(Request $request)
    {
        $mealtype_data = MealType::orderBy('name','asc')->get();
        $agerange_data = AgeGradeOffering::orderBy('name','asc')->get();
        $days_data = Days::orderBy('name','asc')->get();

        return Jetstream::inertia()->render($request, 'Guidelines/Guideline-add', [
              'mealtype_data' => $mealtype_data,
              'agerange_data' => $agerange_data,
              'days_data' => $days_data,
        ]);
    }


    public function store(Request $request)
    {

        $request->validate([
          'name' => 'required|string',
          'meal_type_id' => 'required|string',
          'age_grade_id' => 'required|string',
          'days_id' => 'required|string',  
        ],[
          'name.required' => 'This field is required.',
          'meal_type_id.required' => 'This field is required.',
          'age_grade_id.required' => 'This field is required.',
          'days_id.required' => 'This field is required.',
        ]);   

        $user_info = $request->user();    
        $user_id   = $user_info->id;

        $all_data = $request->all(); 
        $all_data['user_id'] = $user_id;
        //dd($all_data);
        $guideline = (new CreateGuidelineAction)
            ->setData($all_data)
            ->create();           
     
        return redirect()->route('guidelines');

    }


    public function edit(Request $request, Guideline $guideline)
    {
        $guideline_data = Guideline::find($guideline->id);
        $guideline_data->append('is_tenant_admin');

        $mealtype_data = MealType::orderBy('name','asc')->get();
        $agerange_data = AgeGradeOffering::orderBy('name','asc')->get();
        $days_data = Days::orderBy('name','asc')->get();

        return Jetstream::inertia()->render($request, 'Guidelines/Guideline-edit', [
              'guideline' => $guideline_data,
              'mealtype_data' => $mealtype_data,
              'agerange_data' => $agerange_data,
              'days_data' => $days_data,
        ]);
    }


    public function update(Request $request, Guideline $guideline)
    {       
        $request->validate([
          'name' => 'required|string',
          'meal_type_id' => 'required|string',
          'age_grade_id' => 'required|string',
          'days_id' => 'required|string',  
        ],[
          'name.required' => 'This field is required.',
          'meal_type_id.required' => 'This field is required.',
          'age_grade_id.required' => 'This field is required.',
          'days_id.required' => 'This field is required.',
        ]);          

        $all_data = $request->all();
        
        $guideline = (new UpdateGuidelineAction)
            ->setGuideline($guideline)
            ->setData($all_data)
            ->update();          
     
        return redirect()->route('guidelines');
    }


    public function destroy(Guideline $guideline)
    {
        $removeGL = (new DeleteGuidelineAction)
            ->sourceGuideline($guideline)
            ->deleteGuideline();

        return redirect()->route('guidelines');
    }

    public function copy(Request $request, Guideline $guideline)
    {
        $new_guideline = (new CopyGuidelineAction())
                        ->sourceGuideline($guideline)
                        ->copy();

        return redirect()->route('guidelines');
    }


    public function search(Request $request)
    {     
          
        $term        = $request->json('term'); 
        $gl_search = Guideline::whereRaw("LOWER(name) LIKE '%".strtolower($term)."%'")->orderBy('name','asc')->get();   

        $gl_search->map(function($item, $key) {    
            $user_name = User::where('id',$item->user_id)->pluck('name');        
            $item->user_name = $user_name[0];
            $item->append('is_tenant_admin');
        });     
          
        return response()->json($gl_search);
    }
}
