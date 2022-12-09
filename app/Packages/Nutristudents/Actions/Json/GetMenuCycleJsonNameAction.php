<?php


namespace Bytelaunch\Nutristudents\Actions\Json;

use App\Models\User;
use Bytelaunch\Nutristudents\Models\MenuCycle;
use Bytelaunch\Nutristudents\Models\Recipe;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class GetMenuCycleJsonNameAction
{
    public function get($menu_cycle)
    {        
        return "json/menuCycle/".request()->getHost(). "/".$menu_cycle->user_id. '/'.$menu_cycle->id .'.json';
    }

    public function getUserFolder($user)
    {
        return "json/menuCycle/".request()->getHost(). "/".$user->id;
    }
}
