<?php


namespace Bytelaunch\Nutristudents\Actions\Calendar;
use Bytelaunch\Nutristudents\Models\Calendar;
use Bytelaunch\Nutristudents\Models\CalendarDay;

class CreateCalendarDaysWithoutMenuAction
{
    private $week_number;
    private Calendar $calendar;
    private $menuCycle_id;

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


    public function setMenCycle($menuCycle_id)
    {
        $this->menu_cycles_id = $menuCycle_id;
        return $this;
    }

    public function create() : CalendarDay
    {

        $calendar_day = CalendarDay::create(['calendar_id'=>$this->calendar->id, 
        'week_number'=>$this->week_number , 'menu_cycles_id'=> $this->menu_cycles_id]);        
        return $calendar_day;

    }


}
