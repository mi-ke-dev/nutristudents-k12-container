<?php


namespace Bytelaunch\Nutristudents\Actions\WeekCycles;


use Bytelaunch\Nutristudents\Exceptions\CouldNotImportToCalendar;
use Bytelaunch\Nutristudents\Models\Calendar;
use Bytelaunch\Nutristudents\Models\WeekCycle;
use Carbon\Carbon;

class ImportWeekCycleAction
{
    private Calendar $calendar;
    private WeekCycle $weekCycle;
    private Carbon $onMondayDate;

    public function forCalendar(Calendar $calendar): self
    {
        $this->calendar = $calendar;
        return $this;
    }

    public function useWeekCycle(WeekCycle $weekCycle): self
    {
        $this->weekCycle = $weekCycle;
        return $this;
    }

    public function startingOnMondayDate(string $onMondayDate): self
    {
        $date = Carbon::parse($onMondayDate);

        if ($date->dayName != 'Monday') {
            throw CouldNotImportToCalendar::startDayIsNotAMonday();
        }

        $this->onMondayDate = $date;
        return $this;
    }

    public function import(): Calendar
    {


        ray($this->weekCycle->toArray());

        return $object;
    }

}
