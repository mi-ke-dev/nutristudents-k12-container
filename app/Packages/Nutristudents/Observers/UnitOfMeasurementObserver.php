<?php

namespace Bytelaunch\Nutristudents\Observers;

use Bytelaunch\Nutristudents\Models\MenuCycleDayOptionComponent; 
use Bytelaunch\Nutristudents\Models\UnitOfMeasurement;
use Illuminate\Support\Facades\Cache;

class UnitOfMeasurementObserver
{

    public function getCacheId($UnitOfMeasurement){
        return 'UnitOfMeasurementObserver-'.$UnitOfMeasurement->id;
    }

    /**
     * Handle the UnitOfMeasurement "created" event.
     *
     * @param  \App\Models\UnitOfMeasurement  $UnitOfMeasurement
     * @return void
     */
    

    public function created(UnitOfMeasurement $UnitOfMeasurement)
    {
        $cid = $this->getCacheId($UnitOfMeasurement);
        Cache::put($cid, $UnitOfMeasurement);
    }

    /**
     * Handle the UnitOfMeasurement "updated" event.
     *
     * @param  \App\Models\UnitOfMeasurement  $UnitOfMeasurement
     * @return void
     */
    public function updated(UnitOfMeasurement $UnitOfMeasurement)
    {
        $cid = $this->getCacheId($UnitOfMeasurement);
        Cache::put($cid, $UnitOfMeasurement);
    }

    /**
     * Handle the UnitOfMeasurement "deleted" event.
     *
     * @param  \App\Models\UnitOfMeasurement  $UnitOfMeasurement
     * @return void
     */
    public function deleted(UnitOfMeasurement $UnitOfMeasurement)
    {
        $cid = $this->getCacheId($UnitOfMeasurement);
        Cache::forget($cid);
    }

    /**
     * Handle the UnitOfMeasurement "restored" event.
     *
     * @param  \App\Models\UnitOfMeasurement  $UnitOfMeasurement
     * @return void
     */
    public function restored(UnitOfMeasurement $UnitOfMeasurement)
    {
        //
    }

    /**
     * Handle the UnitOfMeasurement "force deleted" event.
     *
     * @param  \App\Models\UnitOfMeasurement  $UnitOfMeasurement
     * @return void
     */
    public function forceDeleted(UnitOfMeasurement $UnitOfMeasurement)
    {
        //
    }
}
