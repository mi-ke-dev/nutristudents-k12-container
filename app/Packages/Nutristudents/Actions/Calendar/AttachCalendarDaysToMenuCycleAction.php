<?php


namespace Bytelaunch\Nutristudents\Actions\Calendar;

use Bytelaunch\Nutristudents\Actions\MenuCycles\CopyMenuCycleAction;
use Bytelaunch\Nutristudents\Models\Calendar;
use Bytelaunch\Nutristudents\Models\CalendarDay;
use Bytelaunch\Nutristudents\Models\MenuCycle;

class AttachCalendarDaysToMenuCycleAction
{
    private $week_number;
    private Calendar $calendar;
    private MenuCycle $menuCycle;

    public function forCalendar(Calendar $calendar) : self
    {
        $this->calendar = $calendar;
        return $this;
    }

    public function setWeekNumber(int $week_number) : self
    {
        $this->week_number = $week_number;
        return $this;
    }

    public function setMenCycle(MenuCycle $menuCycle) : self
    {
        $this->menuCycle = $menuCycle;
        return $this;
    }

    public function attach() : CalendarDay
    {
        $calendar_day = CalendarDay::create(['calendar_id'=>$this->calendar->id, 
        'week_number'=>$this->week_number , 'menu_cycles_id'=> $this->menuCycle->id]);        
        return $calendar_day;

    }


}
