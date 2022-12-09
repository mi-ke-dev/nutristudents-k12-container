<?php


namespace Bytelaunch\Nutristudents\Actions\Calendar;

use Bytelaunch\Nutristudents\Models\AgeGradeOffering;
use Bytelaunch\Nutristudents\Models\Calendar;
use Bytelaunch\Nutristudents\Models\Days;
use Bytelaunch\Nutristudents\Models\Grade;
use Bytelaunch\Nutristudents\Models\GradeRange;
use Bytelaunch\Nutristudents\Models\Meal;
use Bytelaunch\Nutristudents\Models\MealType;
use Bytelaunch\Nutristudents\Models\MenuCycle;
use Bytelaunch\Nutristudents\Models\Site;

class CreateCalendarAction
{
    private MealType $mealType;
    private AgeGradeOffering $AgeGradeOffering;
    private $monthYear;
    private MenuCycle $menuCycle;
    private $week_number;
    private Days $Days;
    private $site;
    private $guide_line_id;
    private $offering;
    private $group;

    public function setDays(Days $Days): self
    {
        $this->Days = $Days;
        return $this;
    }

    public function setMealType(MealType $mealType): self
    {
        $this->mealType = $mealType;
        return $this;
    }

    public function setSiteId($site)
    {
        $this->site = $site;
        return $this;
    }

    public function setSiteType($type)
    {
        $this->site_type = $type;
        return $this;
    }

    public function setGuideLineId($guide_line_id)
    {
        $this->guide_line_id = $guide_line_id;
        return $this;
    }

    public function setOfferingId($offering)
    {
        $this->offering_id = $offering;
        return $this;
    }

    public function setGroupId($group)
    {
        $this->group_id = $group;
        return $this;
    }


    public function setAgeGradeOffering(AgeGradeOffering $AgeGradeOffering): self
    {
        $this->AgeGradeOffering = $AgeGradeOffering;
        return $this;
    }

    public function setMonthYear($monthYear): self
    {
        $this->monthYear = $monthYear;
        return $this;
    }

    public function setWeekNumber(int $week_number)
    {
        $this->week_number = $week_number;
        return $this;
    }

    

    public function create(): Calendar
    {
        // $calendar_records = Calendar::with('calendar_days')->where('group_id',$this->group_id)->where('site_type','group')->get();
        // if($calendar_records){
        //    foreach($calendar_records as $calendars){
        //     $this->removeBeforNewImport($calendars);
        //    }
        // }
        $calendar = Calendar::firstOrCreate([
            'month_year' =>  $this->monthYear,
            'age_grade_offering_id' => $this->AgeGradeOffering->id,
            'meal_type_id' => $this->mealType->id,
            'day_id' => $this->Days->id,
            'site_id' => $this->site,
            'guide_line_id' => $this->guide_line_id,
            'site_type'=> $this->site_type,
            'group_id'=> $this->group_id,
            'offering_id'=> $this->offering_id
        ]);


        return $calendar;
    }

    
    public function removeBeforNewImport($calendars){
        foreach($calendars->calendar_days as $cal_day){
            if($cal_day->week_number == (int) $this->week_number){
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
    
}
