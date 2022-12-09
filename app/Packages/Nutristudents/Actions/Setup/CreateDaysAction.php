<?php


namespace Bytelaunch\Nutristudents\Actions\Setup;

use Bytelaunch\Nutristudents\Models\Days;

class CreateDaysAction
{
    private string $name;

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function setMon($day_mon = false): self
    {
        $this->mon = $day_mon;
        return $this;
    }

    public function setTue($day_tue = false): self
    {
        $this->tue = $day_tue;
        return $this;
    }

    public function setWed($day_wed = false): self
    {
        $this->wed = $day_wed;
        return $this;
    }

    public function setThu($day_thu = false): self
    {
        $this->thu = $day_thu;
        return $this;
    }

    public function setFri($day_fri = false): self
    {
        $this->fri = $day_fri;
        return $this;
    }

    public function setSat($day_sat = false): self
    {
        $this->sat = $day_sat;
        return $this;
    }

    public function setSun($day_sun = false): self
    {
        $this->sun = $day_sun;
        return $this;
    }


    public function create(): Days
    {      
         
        $days = Days::create([
            'name' => $this->name,
            'mon' => $this->mon,
            'tue' => $this->tue,
            'wed' => $this->wed,
            'thu' => $this->thu,
            'fri' => $this->fri,
            'sat' => $this->sat,
            'sun' => $this->sun,
        ]);

        return $days;
    }
}
