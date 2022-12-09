<?php

namespace Bytelaunch\Nutristudents\Observers;

use App\Models\User;
use Bytelaunch\Nutristudents\Actions\Json\JsonDeleteMenuCycleUserAction;
use Bytelaunch\Nutristudents\Actions\Json\JsonStoreMenuCycleListAction;
use Illuminate\Support\Facades\Artisan;

class UserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        //
    }

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        if($user->isDirty('name')){
            // dd($user);
            // Artisan::call('reset-json:menu-cycle-json-by-user', ['user_id'=>$user->id]);
            (new JsonDeleteMenuCycleUserAction)->setUser($user)->delete();
        }
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
 
    public function uploadFiles(User $user): bool
    {
        return true;
    }
}
