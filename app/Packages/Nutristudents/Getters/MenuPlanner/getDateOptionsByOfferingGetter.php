<?php


namespace Bytelaunch\Nutristudents\Getters\MenuPlanner;

use Bytelaunch\Nutristudents\Models\Calendar;
use Bytelaunch\Nutristudents\Models\MealPreparationGroup;
use Bytelaunch\Nutristudents\Models\Offering;
use Bytelaunch\Nutristudents\Models\Site;

class getDateOptionsByOfferingGetter
{
    protected $date;
    protected Site $site;
    protected Offering $offering;
    protected MealPreparationGroup $group;

    public function forDate($date): self
    {
        $this->date = $date;
        return $this;
    }

    public function forGroup(MealPreparationGroup $group): self
    {
        $this->group = $group;
        return $this;
    }

    public function forSite(Site $site): self
    {
        $this->site = $site;
        return $this;
    }

    public function forOffering(Offering $offering): self
    {
        $this->offering = $offering;
        return $this;
    }

    public function get()
    {
        $dateTimestemp = strtotime($this->date);
        $weekOfMonth = weekOfMonth($dateTimestemp) - 1;
        $month_year = date('Y-m-01', $dateTimestemp);
        $day_name = strtoupper(date('D', $dateTimestemp));

        // dd($weekOfMonth);
        
        $calender = Calendar::where('month_year', $month_year)
        ->where('site_id', $this->site->id)
        ->where('offering_id', $this->offering->id)
        ->whereRelation('calendar_days', 'week_number', $weekOfMonth)
        ->whereRelation('calendar_days.menu_cycle.menuCycleDays', 'day_of_week', $day_name)
        ->with(['calendar_days'=>function($q) use($weekOfMonth, $day_name){
            $q->where('week_number', $weekOfMonth);
            $q->with(['menu_cycle.menuCycleDays' => function($q1) use($day_name){
                $q1->where('day_of_week', $day_name);
                $q1->with(['menuCycleDayOptions.menuCycleDayOptionComponents.recipe']);
            } ]);
        }])
        ->first();
        return $calender;        
    }

    public function getGroup()
    {
        $dateTimestemp = strtotime($this->date);
        $weekOfMonth = weekOfMonth($dateTimestemp) - 1;
        $month_year = date('Y-m-01', $dateTimestemp);
        $day_name = strtoupper(date('D', $dateTimestemp));
        
        $calender = Calendar::where('month_year', $month_year)
        // ->where('group_id', $this->group->id)
        ->where('site_type', 'group')
        ->whereRelation('calendar_days', 'week_number', $weekOfMonth)
        ->whereRelation('calendar_days.menu_cycle.menuCycleDays', 'day_of_week', $day_name)
        ->with(['calendar_days'=>function($q) use($weekOfMonth, $day_name){
            $q->where('week_number', $weekOfMonth);
            $q->with(['menu_cycle.menuCycleDays' => function($q1) use($day_name){
                $q1->where('day_of_week', $day_name);
                $q1->with(['menuCycleDayOptions.menuCycleDayOptionComponents.recipe']);
            } ]);
        }])
        ->get();
        // dd($calender->toArray());
        return $calender;        
    }

    public function getMenuCreationGroup($mcg)
    {
        // dd($mcg->id);
        $dateTimestemp = strtotime($this->date);
        $weekOfMonth = weekOfMonth($dateTimestemp) - 1;
        $month_year = date('Y-m-01', $dateTimestemp);
        $day_name = strtoupper(date('D', $dateTimestemp));
        // dd($day_name);
        
        $calender = Calendar::where('month_year', $month_year)
        ->where('group_id', $mcg->id)
        ->where('site_type', 'group')
        ->whereRelation('calendar_days', 'week_number', $weekOfMonth)
        ->whereRelation('calendar_days.menu_cycle.menuCycleDays', 'day_of_week', $day_name)
        ->with(['calendar_days'=>function($q) use($weekOfMonth, $day_name){
            $q->where('week_number', $weekOfMonth);
            $q->with(['menu_cycle.menuCycleDays' => function($q1) use($day_name){
                $q1->where('day_of_week', $day_name);
                $q1->with(['menuCycleDayOptions.menuCycleDayOptionComponents.recipe']);
            } ]);
        }])
        ->first();
        return $calender;        
    }
}