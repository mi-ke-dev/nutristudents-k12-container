<?php

//namespace App\Http\Controllers;
namespace Bytelaunch\Nutristudents\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Jetstream\Jetstream;
use Illuminate\Routing\Controller;
use Laravel\Jetstream\RedirectsActions;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use Bytelaunch\Nutristudents\Actions\Users\CreateUserAction;
use Bytelaunch\Nutristudents\Actions\Users\UpdateUserAction;
use Bytelaunch\Nutristudents\Actions\Users\DeleteUserAction;

use Bytelaunch\Nutristudents\Models\Site;
use Bytelaunch\Nutristudents\Models\Group;

use Mail;
use App\Models\User;
use Bytelaunch\Nutristudents\Getters\Permission\PermissionTemplate;
use Bytelaunch\Nutristudents\Models\MealPreparationGroup;
use Bytelaunch\Nutristudents\Models\MenuCreationGroup;
use Bytelaunch\Nutristudents\Models\Offering;
use Bytelaunch\Nutristudents\Models\UserPermission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;


class UserController extends Controller
{
    public function index(Request $request) : Response
    {
        $users = User::orderBy('name','asc')->get();

        $type = Auth::user()->type;
        //dd($type);

        return Jetstream::inertia()->render($request, 'Users/Users', [
               'all_users' => $users,
        ]);
    }



    public function create(Request $request)
    {
      $permission_template = PermissionTemplate::options();
        return Jetstream::inertia()->render($request, 'Users/User-add', [
          'permission_template' => $permission_template
        ]);
    }


    public function store(Request $request)
    {

        $request->validate([
          'user_name' => 'required|string',
          'user_type' => 'required', 
          'user_email' => 'required|email|unique:users,email',
          'user_email_confirmation' => 'required|same:user_email',    
        ],[
          'user_name.required' => 'This field is required.',
          'user_type.required' => 'This field is required.',
          'user_email.required' => 'This field is required.',
          'user_email.email' => 'Please enter an email address.',
          'user_email.unique' => 'Email is already exist.',
        ]);  
        
    $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890!$%^&!$%^&');
    $password = substr($random, 0, 10);
    //$password = '12345678';
    $hash_password = Hash::make($password);       

    $user_create = (new CreateUserAction())
            ->setName($request->user_name)
            ->setType($request->user_type)
            ->setEmail($request->user_email)            
            ->setPassword($hash_password);

    // if(!empty($request->attached_sites)){
    //     foreach($request->attached_sites as $user_site){
    //        $site = Site::find($user_site['id']);
    //        $permissions = [
    //                         'can_view'     => $user_site['site_permission_view'],
    //                         'can_admin' => $user_site['site_permission_admin'],
    //                         'can_menu_edit' => $user_site['site_permission_menu'],
    //                         'can_order_edit' => $user_site['site_permission_order'],
    //                         'can_add_student_counts' => $user_site['site_permission_student'],
    //                       ];
    //        $user_create->addSiteToUser($site, $permissions);
    //     }
    // }


    // if(!empty($request->attached_groups)){
    //     foreach($request->attached_groups as $user_group){
    //        $group = Group::find($user_group['id']);
    //        $permissions = [
    //                         'can_view'  => $user_group['group_permission_view'],
    //                         'can_admin' => $user_group['group_permission_admin'],
    //                       ];
    //        $user_create->addGroupToUser($group, $permissions);
    //     }
    // }
                
    $user_create->create();        
    if($user_create){
    $login_url = URL::to("/login");
    $mailer = Mail::send('mails/mailSendPasswordAfterUserCreate', ['user' => $request->user_name, 'email' => $request->user_email, 'password' => $password, 'login_url' => $login_url], function ($m) use ($request) {
        $m->to($request->user_email, $request->user_name)->subject('An account has been created for you on Nutristudents');
    });
    }
     
    return redirect()->route('users');

    }


    public function edit(Request $request, User $user)
    {
        $user_data = User::with(['sites','groups'])->find($user->id); 
        $user_sites_data = $user_data->sites;       
        $user_groups_data = $user_data->groups;
        $permission_template = PermissionTemplate::options();

        $menu_planings = [];
        $menu_planings_group = [];
        $headcounts = [];
        $food_preparation = [];
        $food_preparation_group = [];

        $uPermission = UserPermission::where('user_id', $user->id)->get();
        $templates = $uPermission->where('type', 'templates')->pluck('is_access', 'template_type')->toArray();
        // dd($templates,  $permission_template);
        foreach($permission_template as $k => $pt){
          if(!isset($templates[$k])){
            $templates[$k] = false;
          }
        }

        $umenu_planings = $uPermission->where('type', 'menu_planings')->whereNotNull('offering_id');
        if($umenu_planings){
          $menu_planings = Offering::with(['site'])->whereIn('id', $umenu_planings->pluck('offering_id')->toArray())->get();
        }    

        $umenu_planings_group = $uPermission->where('type', 'menu_planings')->whereNotNull('group_id');
        if($umenu_planings_group){
          $menu_planings_group = MenuCreationGroup::whereIn('id', $umenu_planings_group->pluck('group_id')->toArray())->get();
        }
        // dd($menu_planings_group);

        $uheadcounts = $uPermission->where('type', 'headcounts');
        if($uheadcounts){
          $headcounts = Offering::with(['site'])->whereIn('id', $uheadcounts->pluck('offering_id')->toArray())->get();
        }

        $ufood_preparation = $uPermission->where('type', 'food_preparation')->whereNotNull('offering_id');
        if($ufood_preparation){
          $food_preparation = Offering::with(['site'])->whereIn('id', $ufood_preparation->pluck('offering_id')->toArray())->get();
        }

        $ufood_preparation_group = $uPermission->where('type', 'food_preparation')->whereNotNull('group_id');
        if($ufood_preparation_group){
          $food_preparation_group = MealPreparationGroup::whereIn('id', $ufood_preparation_group->pluck('group_id')->toArray())->get();
        }

        return Jetstream::inertia()->render($request, 'Users/User-edit', [
              'user' => $user_data,
              'user_sites_data' => $user_sites_data,
              'user_groups_data' => $user_groups_data,
              'permission_templates' => $permission_template,
              'templates' => $templates,
              'menu_planings' => $menu_planings,
              'headcounts' => $headcounts,
              'food_preparation' => $food_preparation,
              'menu_planings_group' => $menu_planings_group,
              'food_preparation_group' => $food_preparation_group
        ]);
    }


    public function update(Request $request, User $user)
    {       
        $request->validate([
          'user_name' => 'required|string',
          'user_type' => 'required',   
        ],[
          'user_name.required' => 'This field is required.',
          'user_type.required' => 'This field is required.',
        ]);   

        $user_update = (new UpdateUserAction())
            ->setUser($user)
            ->setName($request->user_name)
            ->setType($request->user_type)
            ->setTemplates($request->templates)
            ->setMenuPlaning($request->menu_planings)
            ->setHeadcounts($request->headcounts)
            ->setFoodPreparation($request->food_preparation)
            ->setFoodPreparationGroup($request->food_preparation_group)
            ->setFMenuPlanningGroup($request->menu_planings_group)
            ;

        
                    
        $user_update->update();
             
        return redirect()->route('users');
    }


    public function destroy(User $user)
    {
      // dd(request()->all());
      $other_user = null;
      if(request()->other_user_id && request()->other_user_id != ''){
        $other_user = User::find(request()->other_user_id);
      }

        $removeUser = (new DeleteUserAction())
            ->sourceUser($user)
            ->tranferUser($other_user)
            ->deleteUser();
        return redirect()->route('users');
    }


    public function search(Request $request)
    {     
          
          $term        = $request->json('term'); 
          $user_search = User::whereRaw("LOWER(name) LIKE '%".strtolower($term)."%'")->orderBy('name','asc')->get();        
          
          return response()->json($user_search);
    }


    public function getCurrentUserInfo(Request $request)
    {               
          //$user_id = $request->json('user_id'); 
          $user_info = $request->user();    
          $user_name = $user_info->name;   
          
          return response()->json($user_info);
    }


    public function userSiteSearchModal(Request $request)
    {
          $term    = $request->json('term');
          $exclude = $request->json('ex_ids');

          $site_search = Site::whereRaw("LOWER(name) LIKE '%".strtolower($term)."%'")->whereNotIn('id', $exclude)->orderBy('name','asc')->get();   
          
          return response()->json($site_search);
    }

    public function userGroupSearchModal(Request $request)
    {
          $term    = $request->json('term');
          $exclude = $request->json('ex_ids');

          $group_search = Group::whereRaw("LOWER(name) LIKE '%".strtolower($term)."%'")->whereNotIn('id', $exclude)->orderBy('name','asc')->get();   
          
          return response()->json($group_search);
    }
}
