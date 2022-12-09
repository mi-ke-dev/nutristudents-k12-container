<?php

namespace Bytelaunch\Nutristudents\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Laravel\Jetstream\Jetstream;
use Illuminate\Routing\Controller;
use Laravel\Jetstream\RedirectsActions;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use Bytelaunch\Nutristudents\Models\Site;
use Bytelaunch\Nutristudents\Models\Group;
use Bytelaunch\Nutristudents\Actions\Groups\CreateGroupAction;
use Bytelaunch\Nutristudents\Actions\Groups\UpdateGroupAction;
use Bytelaunch\Nutristudents\Actions\Groups\DeleteGroupAction;
use Bytelaunch\Nutristudents\Actions\Groups\AttachSiteAction;
use Bytelaunch\Nutristudents\Actions\Groups\AttachUserAction;

class GroupController extends Controller
{
    public function index(Request $request) : Response
    {
        $groups = Group::orderBy('name','asc')->get()->toArray();        
        return Jetstream::inertia()->render($request, 'Groups/Groups', [
               'all_groups' => $groups,
        ]);
    }



    public function create(Request $request)
    {
        return Jetstream::inertia()->render($request, 'Groups/Group-add', [

        ]);
    }


    public function store(Request $request)
    {

        $request->validate([
          'group_name' => 'required|string',  
          'group_type' => 'required',
        ],[
          'group_name.required' => 'This field is required.',
          'group_type.required' => 'This field is required.',
        ]);  
        
        $group_create = (new CreateGroupAction)
            ->setName($request->group_name)
            ->setGroupType($request->group_type);     
        
        $group_added = $group_create->create();  

        if(!empty($request->attached_sites)){                   
           $group = (new AttachSiteAction)
            ->setSite($request->attached_sites)
            ->forGroup($group_added)
            ->attach();        
        }      

        if(!empty($request->attached_users)){   
        $users       = array();
        $permissions = array();
        foreach($request->attached_users as $group_user){
           $users[] = $group_user['id'];
           $permissions[] = [
                            'can_view'  => $group_user['user_permission_view'],
                            'can_admin' => $group_user['user_permission_admin'],
                          ];            
        }

           $group = (new AttachUserAction)
            ->setUser($users, $permissions)
            ->forGroup($group_added)
            ->attach();        
        }

        return redirect()->route('groups');

    }


    public function edit(Request $request, Group $group)
    {
        $group_data = Group::with(['sites','users'])->find($group->id);
        $group_sites_data = $group_data->sites;       
        $group_users_data = $group_data->users;   

        $group_users_arr = DB::table('group_user')->where('group_id', $group->id)->get();

        $group_users_data->map(function($item, $key) use ($group_users_arr) {  
        foreach($group_users_arr as $group_user_arr){
          if($group_user_arr->user_id == $item->id){            
            $item->user_permission_view    =  $group_user_arr->can_view;
            $item->user_permission_admin   =  $group_user_arr->can_admin;
          }
        }
        });

        return Jetstream::inertia()->render($request, 'Groups/Group-edit', [
              'group' => $group_data,              
              'group_sites_data' => $group_sites_data,
              'group_users_data' => $group_users_data,
        ]);
    }


    public function update(Request $request, Group $group)
    {       
        $request->validate([
          'group_name' => 'required|string',  
          'group_type' => 'required',
        ],[
          'group_name.required' => 'This field is required.',
          'group_type.required' => 'This field is required.',
        ]); 

        //dd($request->all());          
        
        $group_update = (new UpdateGroupAction)
            ->setGroup($group)
            ->setName($request->group_name)
            ->setGroupType($request->group_type)
            ->update();

                           
        $group_sites = (new AttachSiteAction)
            ->setSite($request->attached_sites)
            ->forGroup($group)
            ->attach();                 

           
        $users       = array();
        $permissions = array();
        if(!empty($request->attached_users)){
        foreach($request->attached_users as $group_user){
           $users[] = $group_user['id'];
           $permissions[] = [
                            'can_view'  => $group_user['user_permission_view'],
                            'can_admin' => $group_user['user_permission_admin'],
                          ];            
        }
        }

        $group_users = (new AttachUserAction)
            ->setUser($users, $permissions)
            ->forGroup($group)
            ->attach();                        
             
        return redirect()->route('groups');
    }


    public function destroy(Group $group)
    {
        $removeGroup = (new DeleteGroupAction)
            ->sourceGroup($group)
            ->deleteGroup();
        return redirect()->route('groups');
    }


    public function search(Request $request)
    {     
          
          $term        = $request->json('term'); 
          $group_search = Group::whereRaw("LOWER(name) LIKE '%".strtolower($term)."%'")->orderBy('name','asc')->get();        
          
          return response()->json($group_search);
    }


    public function groupSiteSearchModal(Request $request)
    {
          $term    = $request->json('term');
          $exclude = $request->json('ex_ids');

          $site_search = Site::whereRaw("LOWER(name) LIKE '%".strtolower($term)."%'")->whereNotIn('id', $exclude)->orderBy('name','asc')->get();   
          
          return response()->json($site_search);
    }

    public function groupUserSearchModal(Request $request)
    {
          $term    = $request->json('term');
          $exclude = $request->json('ex_ids');

          $user_search = User::whereRaw("LOWER(name) LIKE '%".strtolower($term)."%'")->whereNotIn('id', $exclude)->whereNotIn('type', ['Super Admin'])->orderBy('name','asc')->get();   
          
          return response()->json($user_search);
    }
}
