<?php

namespace Bytelaunch\Nutristudents\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Laravel\Jetstream\Jetstream;
use Illuminate\Routing\Controller;
use Laravel\Jetstream\RedirectsActions;
use Illuminate\Support\Facades\Validator;

use Bytelaunch\Nutristudents\Models\MealType;
use Bytelaunch\Nutristudents\Models\AgeGradeOffering;
use Bytelaunch\Nutristudents\Models\Days;

use Bytelaunch\Nutristudents\Actions\Setup\CreateMealTypeAction;
use Bytelaunch\Nutristudents\Actions\Setup\UpdateMealTypeAction;
use Bytelaunch\Nutristudents\Actions\Setup\DeleteMealTypeAction;

use Bytelaunch\Nutristudents\Actions\Setup\CreateAgeGradeOfferingAction;
use Bytelaunch\Nutristudents\Actions\Setup\UpdateAgeGradeOfferingAction;
use Bytelaunch\Nutristudents\Actions\Setup\DeleteAgeGradeOfferingAction;

use Bytelaunch\Nutristudents\Actions\Setup\CreateDaysAction;
use Bytelaunch\Nutristudents\Actions\Setup\UpdateDaysAction;
use Bytelaunch\Nutristudents\Actions\Setup\DeleteDaysAction;

class SetupController extends Controller
{
    public function index(Request $request) : Response
    {   
        $mealtypes = MealType::orderBy('name','asc')->get();
        $agegrades = AgeGradeOffering::orderBy('name','asc')->get();
        $days = Days::orderBy('name','asc')->get();
        //dd($mealtypes);
        return Jetstream::inertia()->render($request, 'Setup/Setup', [
               'mealtypes' => $mealtypes,
               'agegrades' => $agegrades,
               'days' => $days,
        ]);
    }

    public function add_mealtype(Request $request)
    {        
        $request->validate([
            'mealtype_name' => 'required|string',
        ], [
            'mealtype_name.required' => 'This field is required.',
        ]);

        $mealtype = (new CreateMealTypeAction())
            ->setName($request->mealtype_name)
            ->create();

        return redirect()->route('setup');
    }

    public function edit_mealtype(Request $request)
    {   
        $mealtype_data = MealType::where('id', $request->json('id'))->get()->toArray();
        return response()->json($mealtype_data);
    }

    public function update_mealtype(Request $request, MealType $mealtype)
    {   
        $request->validate([
            'mealtype_name' => 'required|string',
        ], [
            'mealtype_name.required' => 'This field is required.',
        ]);
        
        $mealtype_update = (new UpdateMealTypeAction())
            ->setMealType($mealtype)
            ->updateName($request->mealtype_name)
            ->update();

        return redirect()->route('setup');
    }

    public function destroy_mealtype(MealType $mealtype)
    {
        $removeMeal = (new DeleteMealTypeAction())
            ->sourceMealType($mealtype)
            ->deleteMealType();

        return redirect()->route('setup');
    }




    public function add_agegrade_offering(Request $request)
    {
        
        $request->validate([
            'agegrade_name' => 'required|string',
            'agegrade_type' => 'required|string',
            'grade_starting' => 'required_if:agegrade_type,==,Grade',
            'grade_ending' => 'required_if:agegrade_type,==,Grade',
            'age_starting' => 'nullable|integer|min:1|max:99',
            'age_ending' => 'nullable|integer|min:2|max:100',
        ], [
            'agegrade_name.required' => 'This field is required.',
            'agegrade_type.required' => 'This field is required.',
            'grade_starting.required_if' => 'This field is required.',
            'grade_ending.required_if' => 'This field is required.',
        ]);

        if($request->agegrade_type == "Grade"){
            $starting = $request->grade_starting;
            $ending = $request->grade_ending;
        }

        if($request->agegrade_type == "Age"){

            $starting = ($request->age_starting >= 1 && $request->age_starting < 100) ? $request->age_starting : 'No Minimum';
            $ending = ($request->age_ending > 1 && $request->age_ending <= 100) ? $request->age_ending : 'No Maximum';
        }

        $agegrade = (new CreateAgeGradeOfferingAction())
            ->setName($request->agegrade_name)
            ->setType($request->agegrade_type)
            ->setStarting($starting)
            ->setEnding($ending)
            ->create();

        return redirect()->route('setup');
    }       

    public function edit_agegrade_offering(Request $request)
    {        
        $agegrade_data = AgeGradeOffering::where('id', $request->json('id'))->get()->toArray();
        return response()->json($agegrade_data);
    }

    public function update_agegrade_offering(Request $request, AgeGradeOffering $agegradeoffering)
    {   
        $request->validate([
            'agegrade_name' => 'required|string',
            'agegrade_type' => 'required|string',
            'grade_starting' => 'required_if:agegrade_type,==,Grade',
            'grade_ending' => 'required_if:agegrade_type,==,Grade',
            'age_starting' => 'nullable|integer|min:1|max:99',
            'age_ending' => 'nullable|integer|min:2|max:100',
        ], [
            'agegrade_name.required' => 'This field is required.',
            'agegrade_type.required' => 'This field is required.',
            'grade_starting.required_if' => 'This field is required.',
            'grade_ending.required_if' => 'This field is required.',
        ]);

        if($request->agegrade_type == "Grade"){
            $starting = $request->grade_starting;
            $ending = $request->grade_ending;
        }

        if($request->agegrade_type == "Age"){

            $starting = ($request->age_starting >= 1 && $request->age_starting < 100) ? $request->age_starting : 'No Minimum';
            $ending = ($request->age_ending > 1 && $request->age_ending <= 100) ? $request->age_ending : 'No Maximum';
        }
        
        $agegrade_update = (new UpdateAgeGradeOfferingAction())
            ->setAgeGrade($agegradeoffering)
            ->updateName($request->agegrade_name)
            ->updateType($request->agegrade_type)
            ->updateStarting($starting)
            ->updateEnding($ending)
            ->update();
        
        return redirect()->route('setup');
    }

    public function destroy_agegrade_offering(AgeGradeOffering $agegradeoffering)
    {                
        $removeAgeGrade = (new DeleteAgeGradeOfferingAction())
            ->sourceAgeGradeOffering($agegradeoffering)
            ->deleteAgeGradeOffering();
        return redirect()->route('setup');
    }




    public function add_days(Request $request)
    {        
        $request->validate([
            'days_name' => 'required|string',
        ], [
            'days_name.required' => 'This field is required.',
        ]);


        $days = (new CreateDaysAction())
            ->setName($request->days_name)
            ->setMon($request->day_mon)
            ->setTue($request->day_tue)
            ->setWed($request->day_wed)
            ->setThu($request->day_thu)
            ->setFri($request->day_fri)
            ->setSat($request->day_sat)
            ->setSun($request->day_sun)
            ->create();

        return redirect()->route('setup');
    }      

    public function edit_days(Request $request)
    {
        $day_data = Days::where('id', $request->json('id'))->get()->toArray();
        return response()->json($day_data);
    }

    public function update_days(Request $request, Days $days)
    {     
        $request->validate([
            'days_name' => 'required|string',
        ], [
            'days_name.required' => 'This field is required.',
        ]);


        $days_update = (new UpdateDaysAction())
            ->setDay($days)
            ->updateName($request->days_name)
            ->setMon($request->day_mon)
            ->setTue($request->day_tue)
            ->setWed($request->day_wed)
            ->setThu($request->day_thu)
            ->setFri($request->day_fri)
            ->setSat($request->day_sat)
            ->setSun($request->day_sun)
            ->update();

        return redirect()->route('setup');
    }

    public function destroy_days(Days $days)
    {
        $removeDay = (new DeleteDaysAction())
            ->sourceDays($days)
            ->deleteDays();
        return redirect()->route('setup');
    }
    
}
