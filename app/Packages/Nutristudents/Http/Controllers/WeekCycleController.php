<?php

declare(strict_types=1);

namespace Bytelaunch\Nutristudents\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Laravel\Jetstream\Jetstream;
use Illuminate\Routing\Controller;
use Laravel\Jetstream\RedirectsActions;
use Illuminate\Support\Facades\Validator;

use Bytelaunch\Nutristudents\Models\MealType;
use Bytelaunch\Nutristudents\Models\AgeGradeOffering;
use Bytelaunch\Nutristudents\Models\Days;

use Bytelaunch\Nutristudents\Models\GradeRange;
use Bytelaunch\Nutristudents\Models\Offering;
use Bytelaunch\Nutristudents\Models\MenuCycle;
use Bytelaunch\Nutristudents\Models\MenuCycleDay;
use Bytelaunch\Nutristudents\Models\MenuCycleDayOption;
use Bytelaunch\Nutristudents\Models\MenuCycleDayOptionComponent;
use Bytelaunch\Nutristudents\Actions\MenuCycles\DeleteMenuCycleAction;
use Bytelaunch\Nutristudents\Actions\MenuCycles\DuplicateMenuCycleAction;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

use App\Models\User;
use Bytelaunch\Nutristudents\Actions\Json\GetMenuCycleJsonNameAction;
use Bytelaunch\Nutristudents\Actions\MenuCycles\JsonStoreMenuCycleListAction;
use Bytelaunch\Nutristudents\Models\Recipe;

class WeekCycleController extends Controller
{
    use RedirectsActions;

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Inertia\Response
     */
    public function index(Request $request) : Response
    {
      
    $mealtype_data = MealType::whereHas('menu_cycles')->orderBy('name','asc')->get();
    $agerange_data = AgeGradeOffering::whereHas('menu_cycles')->orderBy('name','asc')->get();
    $days_data = Days::whereHas('menu_cycles')->orderBy('name','asc')->get();

    $selected_mealtype = $request->get('mealtype');
    $selected_agerange = $request->get('agerange');
    $selected_days = $request->get('days');
    $selected_user = $request->get('user_id');

    $menu_cycles = MenuCycle::with(['menuCycleDays.menuCycleDayOptions'])->orderBy('name','asc')->take(10)->get();

        foreach($menu_cycles as $menu_cycle){

            $menu_cycle_all_days = array('','','','','','','');

            foreach($menu_cycle->menuCycleDays as $menuCycleDay){

                 if($menuCycleDay['day_of_week'] == 'MON'){
                    $menu_cycle_all_days[0] = $menuCycleDay;
                 }

                 if($menuCycleDay['day_of_week'] == 'TUE'){
                    $menu_cycle_all_days[1] = $menuCycleDay;
                 }

                 if($menuCycleDay['day_of_week'] == 'WED'){
                    $menu_cycle_all_days[2] = $menuCycleDay;
                 }

                 if($menuCycleDay['day_of_week'] == 'THU'){
                    $menu_cycle_all_days[3] = $menuCycleDay;
                 }

                 if($menuCycleDay['day_of_week'] == 'FRI'){
                    $menu_cycle_all_days[4] = $menuCycleDay;
                 }

                 if($menuCycleDay['day_of_week'] == 'SAT'){
                    $menu_cycle_all_days[5] = $menuCycleDay;
                 }

                 if($menuCycleDay['day_of_week'] == 'SUN'){
                    $menu_cycle_all_days[6] = $menuCycleDay;
                 }

            }

            //setup other days and components...
            $menu_cycle->menuCycleDays = $menu_cycle_all_days;
        }
        //dd($menu_cycles);

        $menu_user_ids = MenuCycle::distinct()->has('user')->get(['user_id'])->toArray();
        $menu_users = [];
        foreach($menu_user_ids as $menu_user_id){
         if($menu_user_id['user_id'] > 0){
         $menu_users[] = User::where('id',$menu_user_id['user_id'])->orderBy('name','asc')->get(['id','name'])->toArray();
         }
        }
       
         usort($menu_users, function($a, $b)
         {  
            return strcmp($a[0]['name'], $b[0]['name']);
         });
         
        return Jetstream::inertia()->render($request, 'WeekCycles/WeekCycles', [
            'menu_cycles_data' => '',
            // 'meal_types_data' => $meal_types,
            // 'grade_ranges' => $grade_ranges_val,
            'menu_users' => $menu_users,
            'selected_mealtype' => $selected_mealtype,
            'selected_agerange' => $selected_agerange,
            'selected_days' => $selected_days,
            'mealtype_data' => $mealtype_data,
            'agerange_data' => $agerange_data,
            'days_data' => $days_data,
            'menuUserWeek'=> isset($request->menuUser)?$request->menuUser:'',
            'mealtypeWeek'=> isset($request->mealtype)?$request->mealtype:'',
            'agerangeWeek'=> isset($request->agerange)?$request->agerange:'',
            'daysWeek'=> isset($request->days)?$request->days:''
        ]);
    }

    function cmp($a, $b) {
      return strcmp($a->name, $b->name);
  }
  

    public function menu_detail(Request $request) : Response
    {
       return Jetstream::inertia()->render($request, 'WeekCycles/WeekCycleDayHover', []);
    }

    public function getWeekCycleList(Request $request)
    {
       $meal_type  = $request->json('meal');
       $age_range  = $request->json('age_range');
       $days  = $request->json('days');
       $user  = $request->json('user');

      //  dd($request->all(), $meal_type, $age_range, $days);

       $menucycles_search = MenuCycle::select('id', 'name', 'user_id');
       if($user && $user != ''){
         $menucycles_search->whereHas('user', function($q) use($user){
            $q->where('id', $user);
         } );
       } else {
         $menucycles_search->has('user');
       }

       if($meal_type && $meal_type != ''){
         $menucycles_search->where('meal_type_id', $meal_type);
       }

       if($age_range && $age_range != ''){
         $menucycles_search->where('age_grade_id', $age_range);
       }

       if($days && $days != ''){
         $menucycles_search->where('days_id', $days);
       }

       $menucycles_search->with(['user:id,name']);

       $menucycles_search = $menucycles_search->IsTemplate()->orderBy('week_number','asc')->get();
       $menucycles_search->append(['option_name', 'is_tenant_admin']);
      return response()->json($menucycles_search);
        
    }


    public function onWeekCycleListFilter(Request $request)
    {
       $meal_type  = $request->json('meal');
       $age_range  = $request->json('age_range');
       $days  = $request->json('days');
       $user_id  = $request->json('user_id');

       $menucycles_search = MenuCycle::with(['menuCycleDays.menuCycleDayOptions'])
       ->IsTemplate()
       ->has('user')
       ;

       if($meal_type && $meal_type != ''){
         $menucycles_search->where('meal_type_id', $meal_type);
       }

       if($age_range && $age_range != ''){
         $menucycles_search->where('age_grade_id', $age_range);
       }

       if($days && $days != ''){
         $menucycles_search->where('days_id', $days);
       }

       if($user_id && $user_id != ''){
         //  dd($user_id);
         $menucycles_search->where('user_id', $user_id);
       }

       $menucycles_search_data = $menucycles_search
       ->orderBy('week_number','asc')
       ->orderBy('name','asc')       
       ->paginate(10);
      //  dd( $user_id, $menucycles_search_data->toArray());
       $jsonArray = [];
       foreach($menucycles_search_data as $mc){
         $filePath = (new GetMenuCycleJsonNameAction())->get($mc);
         // "json/menuCycle/".$mc->id .'.json';
         $cJson = Cache::get($filePath);
         // $cJson = null;
         if($cJson){
            $jsonArray[] = json_decode($cJson);
         } elseif(Storage::disk('s3')->exists($filePath)){
            $jsonArray[] = $m = json_decode(Storage::disk('s3')->get($filePath));
            Cache::put($filePath, json_encode($m), now()->addDay(1));
         } else {
            $jsonArray[] = (new JsonStoreMenuCycleListAction())->setMenuCycle($mc)->store();
         }
       }
      
        if($menucycles_search_data->count()> 0){
         $m = $menucycles_search_data->toArray();
         $m['data'] = $jsonArray;
         $json = md5(json_encode($m));
         $filePath = 'dummy/'. date('Y-m-d').'/'.$json.'json';
         if(!Storage::disk('s3')->exists($filePath)){
          Storage::disk('s3')->put($filePath, json_encode($m));
         }
 
         $json_url =  Storage::disk('s3')->temporaryUrl($filePath, now()->addDay());         
            return $json_url;
        } else {
            return response()->json('');
        }
    }




public function onWeekCycleUserListFilter(Request $request){

       $user_id = $request->json('user_id');
       $menucycles_search = [];

        if($user_id){

            $menucycles_search = MenuCycle::has('user')->where('user_id', $user_id)->with(['menuCycleDays.menuCycleDayOptions'])->orderBy('week_number','asc')->get();

            $jsonArray = [];
            foreach($menucycles_search as $mc){
               // $filePath = "json/menuCycle/".$mc->id .'.json';
               $filePath = (new GetMenuCycleJsonNameAction())->get($mc);
               $cJson = Cache::get($filePath);
               if($cJson){
                  $jsonArray[] = json_decode($cJson);
               } elseif(Storage::disk('s3')->exists($filePath)){
                  $jsonArray[] = json_decode(Storage::disk('s3')->get($filePath));
               } else {
                  $jsonArray[] = (new JsonStoreMenuCycleListAction())->setMenuCycle($mc)->store();
               }
            }
        }

        if($menucycles_search->count()> 0){
         $json = md5(json_encode($jsonArray));
         $filePath = 'dummy/'.date('Y-m-d').'/'.$json.'json';
         if(!Storage::disk('s3')->exists($filePath)){
          Storage::disk('s3')->put($filePath, json_encode($jsonArray));
         } 
         $json_url =  Storage::disk('s3')->temporaryUrl($filePath, now()->addDay());         
            return $json_url;
        } else {
            return response()->json($menucycles_search);
        }

        return response()->json($menucycles_search);
    }


    public function delete(Request $request, MenuCycle $menucycle)
    {
       $delete_option = (new DeleteMenuCycleAction())
                    ->sourceMenuCycle($menucycle)
                    ->deleteMC();

        return redirect()->back();
    }


    public function duplicate(Request $request, MenuCycle $menucycle)
    {
       $duplicate = (new DuplicateMenuCycleAction())
                    ->sourceMenuCycle($menucycle)
                    ->duplicate();

       return redirect()->back();
    }
}
