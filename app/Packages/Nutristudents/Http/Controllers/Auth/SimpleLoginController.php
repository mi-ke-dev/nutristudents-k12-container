<?php

declare(strict_types=1);

namespace Bytelaunch\Nutristudents\Http\Controllers\Auth;

use App\Models\Tenant;
use App\Models\User;
use Bytelaunch\Nutristudents\Actions\Tenants\UpdateCurrentTenantsDataAction;
use Bytelaunch\Nutristudents\Getters\Tenants\GetCurrentTenantGetter;
use Illuminate\Routing\Controller;
use Laravel\Jetstream\Jetstream;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SimpleLoginController extends Controller
{
    public function loginForm(Request $request)
    {
        
        return Jetstream::inertia()->render($request, 'Auth/LoginSimple', [ ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user = User::where('email', $request->email)->first();
        if(!$user){
            $this->checkDefaultTenant($request->email);
            $user = User::where('email', $request->email)->first();
        }
        
        if($user && Hash::check($request->password, $user->password)){
            $remeber = ($user->password)?true:false;
            Auth::login($user, $remeber);
            (new UpdateCurrentTenantsDataAction)->add();
            return redirect()->route('calendars');
        } else {
            // dd('Not match');
            return redirect()->back()->withErrors('These credentials do not match our records.');
        }
    }

    public function checkDefaultTenant($email){
        $tenant =  Tenant::where('is_primary', true)->first();
        $user = null;
        $tenant->run(function () use($email, &$user) {
            $user = DB::table('users')->where('email', $email)->first();
        });
        // dd($user);
        $data = [];
        if($user){
            $schema = (new GetCurrentTenantGetter())->first()->tenancy_db_name;
            $table = 'users';
            DB::select("SELECT setval('{$schema}.{$table}_id_seq', max(id)) FROM {$schema}.{$table};");
            $data = (array) $user;
            unset($data['id']);
            DB::table('users')->upsert(
                [$data]
            , ['email']);

            
            // dd($data);
        }
    }


}
