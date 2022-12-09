<?php

namespace Bytelaunch\Nutristudents\Observers;

use Bytelaunch\Nutristudents\Actions\Json\GetMenuCycleJsonNameAction;
use Bytelaunch\Nutristudents\Models\MenuCycleDayOptionComponent;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class MenuCycleDayOptionComponentObserver
{
    /**
     * Handle the MenuCycleDayOptionComponent "created" event.
     *
     * @param  \App\Models\MenuCycleDayOptionComponent  $MenuCycleDayOptionComponent
     * @return void
     */
    public function created(MenuCycleDayOptionComponent $MenuCycleDayOptionComponent)
    {
        //
    }

    /**
     * Handle the MenuCycleDayOptionComponent "updated" event.
     *
     * @param  \App\Models\MenuCycleDayOptionComponent  $MenuCycleDayOptionComponent
     * @return void
     */
    public function updated(MenuCycleDayOptionComponent $MenuCycleDayOptionComponent)
    {
        //
    }

    /**
     * Handle the MenuCycleDayOptionComponent "deleted" event.
     *
     * @param  \App\Models\MenuCycleDayOptionComponent  $MenuCycleDayOptionComponent
     * @return void
     */
    public function deleted(MenuCycleDayOptionComponent $MenuCycleDayOptionComponent)
    {
        if($MenuCycleDayOptionComponent->menuCycleDayOption && $MenuCycleDayOptionComponent->menuCycleDayOption->menuCycleDay){
            try {
                $MenuCycleDayOptionComponent->menuCycleDayOption->menuCycleDay->menu_cycle_id;
                // $filePath = "json/menuCycle/".$MenuCycleDayOptionComponent->menuCycleDayOption->menuCycleDay->menu_cycle_id .'.json';

                $filePath = (new GetMenuCycleJsonNameAction())->get($MenuCycleDayOptionComponent->menuCycleDayOption->menuCycleDay->menuCycle);
                Storage::disk('s3')->delete($filePath);
                Cache::forget($filePath);
            } catch (\Exception $th) {
                // dd($th->getMessage());
            }            
        }        
    }

    /**
     * Handle the MenuCycleDayOptionComponent "restored" event.
     *
     * @param  \App\Models\MenuCycleDayOptionComponent  $MenuCycleDayOptionComponent
     * @return void
     */
    public function restored(MenuCycleDayOptionComponent $MenuCycleDayOptionComponent)
    {
        //
    }

    /**
     * Handle the MenuCycleDayOptionComponent "force deleted" event.
     *
     * @param  \App\Models\MenuCycleDayOptionComponent  $MenuCycleDayOptionComponent
     * @return void
     */
    public function forceDeleted(MenuCycleDayOptionComponent $MenuCycleDayOptionComponent)
    {
        //
    }
}
