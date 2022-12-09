<?php

namespace App\Console\Commands\Issues;

use App\Models\Tenant;
use App\Models\User;
use Bytelaunch\Nutristudents\Actions\MenuCycles\DeleteMenuCycleAction;
use Bytelaunch\Nutristudents\Actions\Users\DeleteUserAction;
use Bytelaunch\Nutristudents\Models\Calendar;
use Bytelaunch\Nutristudents\Models\Guideline;
use Bytelaunch\Nutristudents\Models\Haccp;
use Bytelaunch\Nutristudents\Models\MenuCycle;
use Bytelaunch\Nutristudents\Models\Offering;
use Illuminate\Console\Command;

use Illuminate\Support\Facades\DB;

class Issue315 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'issue:315';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change admin mail.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
      $tenants = Tenant::get();
      foreach($tenants as $tenant)
      {
        $tenant->run(function($q){
            $user = User::where('email', 'james@nutristudentsk-12.com')->first();
            if($user){
                $user->name = "NutriStudents K-12";
                $user->email = 'nutrist-admin@yopmail.com';
                $user->password = bcrypt(12345678);
                $user->type = "Super Admin";
                $user->save();
                
            } else {
              $user = User::firstOrNew(['email'=> 'nutrist-admin@yopmail.com']);
              $user->name = "NutriStudents K-12";
              $user->password = bcrypt(12345678);
              $user->type = "Super Admin";
              $user->save();
            }

            $users = User::whereIn('email', ['admin@yopmail.com', 'joseph999morris@gmail.com'])->withTrashed()->get();
            foreach($users as $dUser)
            {
              $mcs = MenuCycle::where('user_id', $dUser->id)->get();
              foreach($mcs as $mc)
              {
                (new DeleteMenuCycleAction)->sourceMenuCycle($mc)->deleteForce();
              }

              Guideline::where('user_id', $dUser->id)->delete();
              Haccp::where('user_id', $dUser->id)->delete();
              $removeUser = (new DeleteUserAction())
              ->sourceUser($dUser)
              ->tranferUser($user)
              ->deleteUser();
              $dUser->forceDelete();
            }

            


        });
      }
      $this->line('Done');
    }
}
