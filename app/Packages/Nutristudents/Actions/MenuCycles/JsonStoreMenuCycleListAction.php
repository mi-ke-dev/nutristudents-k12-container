<?php


namespace Bytelaunch\Nutristudents\Actions\MenuCycles;

use App\Models\User;
use Bytelaunch\Nutristudents\Actions\Json\GetMenuCycleJsonNameAction;
use Bytelaunch\Nutristudents\Models\MenuCycle;
use Bytelaunch\Nutristudents\Models\Recipe;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class JsonStoreMenuCycleListAction
{
    private MenuCycle $menuCycle;

    //setWeekNumber
    public function setMenuCycle(MenuCycle $menuCycle): self
    {
        $this->menuCycle = $menuCycle;
        return $this;
    }



    public function store(): MenuCycle
    {
        $menu_cycle_all_days = array('', '', '', '', '', '', '');
        $menu_cycle = $this->menuCycle;
        // $menu_cycle->is_tenant_admin;
        $menu_cycle->append('is_tenant_admin');
        $menu_cycle->user_name = User::where('id',$menu_cycle->user_id)->pluck('name')->first();
        foreach ($menu_cycle->menuCycleDays as $menuCycleDay) {
            $menu_cycle_mon_options = $menuCycleDay->menuCycleDayOptions;
            $menu_cycle_mon_options->map(function ($item, $key) {
                // unset($item->menuCycleDayOptionComponents);
                $recipes = [];
                foreach ($item->menuCycleDayOptionComponents as $OptionComponent) {
                    $r = Recipe::select('id', 'name', 'category', 'portion_uom_id')->find($OptionComponent->recipe_id);
                    if ($r) {
                        $recipes_ar = $r->toArray();
                        $recipes[] = $recipes_ar;
                    }
                }
                $item->recipes = $recipes;
            });
            // unset($menuCycleDay->menuCycleDayOptions);
            // dd($menuCycleDay->toArray());
            $m = $menuCycleDay->toArray();

            if ($menuCycleDay['day_of_week'] == 'MON') {
                $menu_cycle_all_days[0] = $m;
            }

            if ($menuCycleDay['day_of_week'] == 'TUE') {
                $menu_cycle_all_days[1] = $m;
            }

            if ($menuCycleDay['day_of_week'] == 'WED') {
                $menu_cycle_all_days[2] = $m;
            }

            if ($menuCycleDay['day_of_week'] == 'THU') {
                $menu_cycle_all_days[3] = $m;
            }

            if ($menuCycleDay['day_of_week'] == 'FRI') {
                $menu_cycle_all_days[4] = $m;
            }

            if ($menuCycleDay['day_of_week'] == 'SAT') {
                $menu_cycle_all_days[5] = $m;
            }

            if ($menuCycleDay['day_of_week'] == 'SUN') {
                $menu_cycle_all_days[6] = $m;                
            }
            // dd($menu_cycle_all_days);
        }
        unset($menu_cycle->menuCycleDays);
        $menu_cycle->menu_cycle_days = $menu_cycle_all_days;

        // dd($menu_cycle->toArray());
        
        // $filePath = "json/menuCycle/".$menu_cycle->id .'.json';
        $filePath = (new GetMenuCycleJsonNameAction)->get($menu_cycle);
       Storage::disk('s3')->put($filePath, json_encode($menu_cycle));
       Cache::put($filePath, json_encode($menu_cycle), now()->addDay(1));
        return $menu_cycle;
    }
}
