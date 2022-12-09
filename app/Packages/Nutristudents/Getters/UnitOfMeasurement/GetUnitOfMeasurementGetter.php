<?php
namespace Bytelaunch\Nutristudents\Getters\UnitOfMeasurement;

use Bytelaunch\Nutristudents\Models\UnitOfMeasurement;
use Illuminate\Support\Facades\Cache;


class GetUnitOfMeasurementGetter
{
    private $unitId;
    public function setUnitId($unitId = null){
        $this->unitId = $unitId;
        return $this;
    }

    public function getCacheId($UnitOfMeasurement){
        return 'UnitOfMeasurementObserver-'.$UnitOfMeasurement;
    }

    public function get()
    {
        if($this->unitId){
            $cid = $this->getCacheId($this->unitId);
            if (Cache::has($cid)) {
                return Cache::get($cid);
            }
            $umo = UnitOfMeasurement::find($this->unitId);
            if($umo){
                Cache::put($cid, $umo);
                return $umo;
            }
        }
        return null;
    }

    public function getName()
    {
        $umo = $this->get();
        if($umo){
            return $umo->name;
        }
        return null;
    }

}

?>