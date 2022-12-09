<?php


namespace Bytelaunch\Nutristudents\Actions\Setup;

use Bytelaunch\Nutristudents\Models\Days;

class UpdateDaysAction
{
    private Days $days;

    public function setDay(Days $days): self
    {
        $this->day = $days;
        return $this;
    }

    public function updateName(string $name): self
    {
        $this->day->name = $name;
        return $this;
    }

    public function setMon($day_mon = false): self
    {
        $this->day->mon = $day_mon;
        return $this;
    }

    public function setTue($day_tue = false): self
    {
        $this->day->tue = $day_tue;
        return $this;
    }

    public function setWed($day_wed = false): self
    {
        $this->day->wed = $day_wed;
        return $this;
    }

    public function setThu($day_thu = false): self
    {
        $this->day->thu = $day_thu;
        return $this;
    }

    public function setFri($day_fri = false): self
    {
        $this->day->fri = $day_fri;
        return $this;
    }

    public function setSat($day_sat = false): self
    {
        $this->day->sat = $day_sat;
        return $this;
    }

    public function setSun($day_sun = false): self
    {
        $this->day->sun = $day_sun;
        return $this;
    }


    public function update(): Days
    {               
        $this->day->save();
        return $this->day;
    }
}
