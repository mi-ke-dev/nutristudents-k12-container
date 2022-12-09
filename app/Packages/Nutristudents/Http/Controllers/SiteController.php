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

use Bytelaunch\Nutristudents\Models\Site;
use Bytelaunch\Nutristudents\Models\Group;
use Bytelaunch\Nutristudents\Models\Guideline;
use Bytelaunch\Nutristudents\Models\Offering;
use App\Models\User;

use Bytelaunch\Nutristudents\Models\MealType;
use Bytelaunch\Nutristudents\Models\AgeGradeOffering;
use Bytelaunch\Nutristudents\Models\Days;

use Bytelaunch\Nutristudents\Actions\Sites\CreateSiteAction;
use Bytelaunch\Nutristudents\Actions\Sites\UpdateSiteAction;
use Bytelaunch\Nutristudents\Actions\Sites\DeleteSiteAction;
use Bytelaunch\Nutristudents\Actions\Sites\AttachUserAction;
use Bytelaunch\Nutristudents\Actions\Sites\AttachOfferingAction;

use Bytelaunch\Nutristudents\Actions\Offerings\CreateOfferingAction;
use Bytelaunch\Nutristudents\Actions\Offerings\UpdateOfferingAction;
use Bytelaunch\Nutristudents\Actions\Offerings\DeleteOfferingAction;

class SiteController extends Controller
{
    public function index(Request $request) : Response
    {
        $sites = Site::orderBy('name','asc')->with(['users'])->get()->toArray();         
        // dd($sites);
        return Jetstream::inertia()->render($request, 'Sites/Sites', [
               'all_sites' => $sites,
        ]);
    }



    public function create(Request $request)
    {
        $mealtype_data = MealType::orderBy('name','asc')->get();
        $agerange_data = AgeGradeOffering::orderBy('name','asc')->get();
        $days_data = Days::orderBy('name','asc')->get();

        $offering_guidelines = Guideline::orderBy('name','asc')->get();        
        $offering_sites = Site::orderBy('name','asc')->get();

        $offering_menuadmins_user = User::orderBy('name','asc')->get();
        $offering_menuadmins_group = Group::where('group_type','Menu')->orderBy('name','asc')->get();                
        $offering_orderadmins_group = Group::where('group_type','Order')->orderBy('name','asc')->get();

        return Jetstream::inertia()->render($request, 'Sites/Site-add', [
               //'offering_guidelines' => $offering_guidelines,
               'offering_menuadmins_user' => $offering_menuadmins_user,
               'offering_menuadmins_group' => $offering_menuadmins_group,
               'offering_orderadmins_user' => $offering_menuadmins_user,
               'offering_orderadmins_group' => $offering_orderadmins_group,
               'offering_sites' => $offering_sites,
               'mealtype_data' => $mealtype_data,
               'agerange_data' => $agerange_data,
               'days_data' => $days_data,
        ]);
    }


    public function store(Request $request)
    {

        $request->validate([
          'site_name' => 'required|string',  
        ],[
          'site_name.required' => 'This field is required.',
        ]);  
        
        $site_create = (new CreateSiteAction)
            ->setName($request->site_name);
        
        $site_added = $site_create->create();   


        if(!empty($request->attached_users)){   
        $users       = array();
        $permissions = array();
        foreach($request->attached_users as $site_user){
           $users[] = $site_user['id'];
           $permissions[] = [
                            'can_view'  => $site_user['user_permission_view'],
                            'can_admin' => $site_user['user_permission_admin'],
                          ];            
        }

           $site = (new AttachUserAction)
            ->setUser($users, $permissions)
            ->forSite($site_added)
            ->attach();        
        }    


        //add offering process 
        if(!empty($request->attached_offerings)){
          $offerings = array();
          foreach($request->attached_offerings as $site_offering){ 

          $guideline = Guideline::find($site_offering['guidelineId']);
          // $prep_site = Site::find($site_offering['prepId']);
          // $cook_site = Site::find($site_offering['cookId']);

          // if($site_offering['menuType'] == 'user'){
          // $menu_admin = User::find($site_offering['menuId']);
          // }
          // if($site_offering['menuType'] == 'group'){
          // $menu_admin = Group::find($site_offering['menuId']);
          // }

          // if($site_offering['orderType'] == 'user'){
          // $order_admin = User::find($site_offering['orderId']);
          // }
          // if($site_offering['orderType'] == 'group'){
          // $order_admin = Group::find($site_offering['orderId']);
          // }

            $offering = (new CreateOfferingAction)
            ->setName($site_offering['name'])
            ->forSite($site_added)
            ->forGuideline($guideline)            
            // ->forPrepSite($prep_site)
            // ->forCookSite($cook_site)
            // ->forMenuAdmin($menu_admin)
            // ->forOrderAdmin($order_admin)
            ->create(); 

            $offerings[] = $offering->id;
          }

        //attach site offerings into site offering table
        $group = (new AttachOfferingAction)
            ->setOffering($offerings)
            ->forSite($site_added)
            ->attach();        
        
        }    
     
        return redirect()->route('sites');

    }


    public function edit(Request $request, Site $site)
    {
        $mealtype_data = MealType::orderBy('name','asc')->get();
        $agerange_data = AgeGradeOffering::orderBy('name','asc')->get();
        $days_data = Days::orderBy('name','asc')->get();        

        $site_data = Site::with(['users','offerings'])->find($site->id);   
        $site_users_data = $site_data->users;
        $site_offerings_data = $site_data->offerings; 

        // $offering_menuadmins_user = User::orderBy('name','asc')->get();
        // $offering_menuadmins_group = Group::where('group_type','Menu')->orderBy('name','asc')->get();                
        // $offering_orderadmins_group = Group::where('group_type','Order')->orderBy('name','asc')->get();  

        $site_users_arr = DB::table('site_user')->where('site_id', $site->id)->get();

        // $site_users_data->map(function($item, $key) use ($site_users_arr) {  
        // foreach($site_users_arr as $site_user_arr){
        //   if($site_user_arr->user_id == $item->id){            
        //     $item->user_permission_view    =  $site_user_arr->can_view;
        //     $item->user_permission_admin   =  $site_user_arr->can_admin;
        //   }
        // }
        // });
                
        $site_offerings = array();
        foreach($site_offerings_data as $item){ 
          
          $guideline = Guideline::find($item->guideline_id);
          // $prep_site = Site::find($item->prep_site_id);
          // $cook_site = Site::find($item->cook_site_id);

          // if($item->menu_adminable_type == "App\Models\User"){
          //   $menu_adminable_type = "user";
          //   $menu_admin = User::find($item->menu_adminable_id);
          // }

          // if($item->menu_adminable_type == "Bytelaunch\Nutristudents\Models\Group"){
          //   $menu_adminable_type = "group";
          //   $menu_admin = Group::find($item->menu_adminable_id);
          // }

          // if($item->order_adminable_type == "App\Models\User"){
          //   $order_adminable_type = "user";
          //   $order_admin = User::find($item->order_adminable_id);
          // }

          // if($item->order_adminable_type == "Bytelaunch\Nutristudents\Models\Group"){
          //   $order_adminable_type = "group";
          //   $order_admin = Group::find($item->order_adminable_id);
          // }
                    
           
          $site_offerings[] = array(
                'id' => $item->id,
                'name' => $item->name,
                'guidelineId' => $item->guideline_id,
                'guidelineText' => ($guideline)?$guideline->name : '',
                // 'menuType' => $menu_adminable_type,
                // 'menuId' => $item->menu_adminable_id,
                // 'menuText' => $menu_admin->name,
                // 'orderType' => $order_adminable_type,
                // 'orderId' => $item->order_adminable_id,
                // 'orderText' => $order_admin->name,
                // 'prepId' => $item->prep_site_id,
                // 'prepText' => $prep_site->name,
                // 'cookId' => $item->cook_site_id,
                // 'cookText' => $cook_site->name,   
                'meal_type_id' => ($guideline)?$guideline->meal_type_id : '',
                'age_grade_id' => ($guideline)?$guideline->age_grade_id : '',
                'days_id' => ($guideline)?$guideline->days_id : ''
          );
          

        }        

        //$offering_guidelines = Guideline::orderBy('name','asc')->get();
        $offering_sites = Site::orderBy('name','asc')->get();
        
        return Jetstream::inertia()->render($request, 'Sites/Site-edit', [
              'site' => $site_data,
              'site_users_data' => $site_users_data,
              'site_offerings_data' => $site_offerings,                            
              //  'offering_menuadmins_user' => $offering_menuadmins_user,
              //  'offering_menuadmins_group' => $offering_menuadmins_group,
              //  'offering_orderadmins_user' => $offering_menuadmins_user,
              //  'offering_orderadmins_group' => $offering_orderadmins_group,
              'offering_sites' => $offering_sites,

              'mealtype_data' => $mealtype_data,
              'agerange_data' => $agerange_data,
              'days_data' => $days_data,
        ]);
    }


    public function update(Request $request, Site $site)
    {       
        $request->validate([
          'site_name' => 'required|string',
        ],[
          'site_name.required' => 'This field is required.',
        ]);                       
        
        $site_update = (new UpdateSiteAction)
            ->setSite($site)
            ->setName($request->site_name)
            ->update();

        $users       = array();
        $permissions = array();
        // if(!empty($request->attached_users)){
        // foreach($request->attached_users as $site_user){
        //    $users[] = $site_user['id'];
        //    $permissions[] = [
        //                     'can_view'  => $site_user['user_permission_view'],
        //                     'can_admin' => $site_user['user_permission_admin'],
        //                     ];            
        // }
        // }

        $site_users = (new AttachUserAction)
        ->setUser($users, $permissions)
        ->forSite($site)
        ->attach();

        
        //add offering process 
        if(!empty($request->attached_offerings)){
            
          $offerings = array();
          foreach($request->attached_offerings as $site_offering){ 

          $guideline = Guideline::find($site_offering['guidelineId']);
          // $prep_site = Site::find($site_offering['prepId']);
          // $cook_site = Site::find($site_offering['cookId']);
          
          // if($site_offering['menuType'] == 'user'){
          // $site_offering_menuType = "App\Models\User";
          // $menu_admin = User::find($site_offering['menuId']);
          // }
          // if($site_offering['menuType'] == 'group'){
          // $site_offering_menuType = "Bytelaunch\Nutristudents\Models\Group";
          // $menu_admin = Group::find($site_offering['menuId']);
          // }

          // if($site_offering['orderType'] == 'user'){
          // $site_offering_orderType = "App\Models\User";
          // $order_admin = User::find($site_offering['orderId']);
          // }
          // if($site_offering['orderType'] == 'group'){
          // $site_offering_orderType = "Bytelaunch\Nutristudents\Models\Group";
          // $order_admin = Group::find($site_offering['orderId']);
          // }

          $offering_obj = Offering::find($site_offering['id']);
          
          if($site_offering['id']){
            $offering = (new UpdateOfferingAction)
            ->setOffering($offering_obj)
            ->setName($site_offering['name'])
            ->forSite($site->id)
            ->forGuideline($site_offering['guidelineId'])            
            // ->forPrepSite($site_offering['prepId'])
            // ->forCookSite($site_offering['cookId'])
            // ->forMenuAdmin($site_offering['menuId'], $site_offering_menuType)
            // ->forOrderAdmin($site_offering['orderId'], $site_offering_orderType)
            ->update();
          }else{            
            $offering = (new CreateOfferingAction)
            ->setName($site_offering['name'])
            ->forSite($site)
            ->forGuideline($guideline)            
            // ->forPrepSite($prep_site)
            // ->forCookSite($cook_site)
            // ->forMenuAdmin($menu_admin)
            // ->forOrderAdmin($order_admin)
            ->create(); 
          }

            $offerings[] = $offering->id;
          }

        //attach site offerings into site offering table
        $group = (new AttachOfferingAction)
            ->setOffering($offerings)
            ->forSite($site)
            ->attach();                
        } 
        
        //delete entries of offering from offering table
        if(!empty($request->delete_offerings)){
            foreach($request->delete_offerings as $delete_offer){                
                $deleted_offer = Offering::find($delete_offer);
                $removeOffer = $this->destroy_offering($deleted_offer);
            }
        }

        return redirect()->route('sites');
    }


    public function destroy(Site $site)
    {
        $removeSite = (new DeleteSiteAction)
            ->sourceSite($site)
            ->deleteSite();
        return redirect()->route('sites');
    }


    public function destroy_offering(Offering $offering)
    {
        $removeSite = (new DeleteOfferingAction)
            ->sourceOffering($offering)
            ->deleteOffering();     
        return $removeSite;   
    }


    public function search(Request $request)
    {     
          
          $term        = $request->json('term'); 
          $site_search = Site::whereRaw("LOWER(name) LIKE '%".strtolower($term)."%'")->orderBy('name','asc')->get();        
          
          return response()->json($site_search);
    }


    public function siteOfferingGetGuidelines(Request $request)
    {
        $meal_type   = $request->json('meal_type'); 
        $age_range   = $request->json('age_range'); 
        $days        = $request->json('days'); 

        $guidelines = Guideline::where("meal_type_id", $meal_type)->where("age_grade_id", $age_range)->where("days_id", $days)->orderBy('name','asc')->get()->toArray();             
          
        return response()->json($guidelines);
    }
}
