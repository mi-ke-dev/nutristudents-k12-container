<?php


namespace Bytelaunch\Nutristudents\Actions\Users;

use App\Models\User;
use Bytelaunch\Nutristudents\Models\Guideline;
use Bytelaunch\Nutristudents\Models\Haccp;
use Bytelaunch\Nutristudents\Models\MenuCycle;
use Bytelaunch\Nutristudents\Models\UserPermission;

class DeleteUserAction
{
    private User $user;
    private User $transferUser;

    public function tranferUser($transferUser = null) : self
    {
        $this->transferUser = $transferUser;
        return $this;
    }

    public function sourceUser(User $user) : self
    {
        $this->user = $user;
        return $this;
    }

    public function deleteUser()
    {
        
        if(isset($this->transferUser) && $this->transferUser)
        {
            Guideline::where('user_id', $this->user->id)->update(['user_id'=>$this->transferUser->id ]);
            Haccp::where('user_id', $this->user->id)->update(['user_id'=>$this->transferUser->id ]);
            MenuCycle::where('user_id', $this->user->id)->update(['user_id'=>$this->transferUser->id ]);            
            UserPermission::where('user_id', $this->user->id)->update(['user_id'=>$this->transferUser->id ]);
        } 
        $this->user->delete();
    }

}
