<?php


namespace Bytelaunch\Nutristudents\Actions\Json;

use App\Models\User;
use Bytelaunch\Nutristudents\Models\MenuCycle;
use Bytelaunch\Nutristudents\Models\Recipe;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class JsonDeleteMenuCycleUserAction
{
    private MenuCycle $menuCycle;
    private User $user;

    //setWeekNumber
    public function setUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function delete()
    {
        // $path = (new GetMenuCycleJsonNameAction())->getUserFolder($this->user);
        $path = (new GetMenuCycleJsonNameAction())->getUserFolder($this->user);
        Storage::disk('s3')->deleteDirectory($path);

        $menuCycles = MenuCycle::select('id', 'user_id', 'name')->where('user_id', $this->user->id)->get();
        
        foreach($menuCycles as $menu_cycle){
            $filePath = (new GetMenuCycleJsonNameAction())->get($menu_cycle);
            Cache::forget($filePath);
        }
    }


    public function store() 
    { 
        
        
    }
}
