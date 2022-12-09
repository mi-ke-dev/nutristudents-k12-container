<?php

namespace Bytelaunch\Nutristudents\Http\Controllers;
 
use Inertia\Response;
use Illuminate\Http\Request;
use Laravel\Jetstream\Jetstream;
use Illuminate\Routing\Controller; 
 
use Bytelaunch\Nutristudents\Getters\MenuPlanner\getDateOptionsGetter; 
use Bytelaunch\Nutristudents\Models\MenuCycleDayOption;
use Bytelaunch\Nutristudents\Models\Offering;
use Bytelaunch\Nutristudents\Models\Site; 
use Barryvdh\DomPDF\Facade\Pdf;
use Bytelaunch\Nutristudents\Getters\MenuPlanner\getDateOptionsByOfferingGetter;
use Bytelaunch\Nutristudents\Getters\Sites\GetMealPreprationGetter;
use Bytelaunch\Nutristudents\Getters\Sites\GetMenuCreationGetter;
use Bytelaunch\Nutristudents\Getters\UnitConvert\UnitConversionsGetter;
use Bytelaunch\Nutristudents\Models\Meal;
use Bytelaunch\Nutristudents\Models\MealPreparationGroup;
use Bytelaunch\Nutristudents\Models\MealType;
use Bytelaunch\Nutristudents\Models\MenuCreationGroup;
use Bytelaunch\Nutristudents\Models\MenuCycleDayOptionComponent;
use Bytelaunch\Nutristudents\Models\Recipe;
use Bytelaunch\Nutristudents\Models\UnitOfMeasurement;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;

class GroupMealPrepController extends Controller
{
    
    public function index(Request $request) : Response
    {     
        $user = auth()->user();
        $user_id = $user->id;
        $is_admin = $user->isSuperUser();
        $MenuCreationGroup = (new GetMealPreprationGetter)
        ->forUser(auth()->user()) 
        ->forType('food_preparation')
        ->get();

        $mealTypes = MealType::select('id', 'name');
        if($MenuCreationGroup->count() > 0){
            // dd($MenuCreationGroup->pluck('id')->toArray());
            $mealTypes->with(['meal_preparation_groups' => function($q)use($MenuCreationGroup){
                $q->whereIn('id', $MenuCreationGroup->pluck('id')->toArray());
            }]);
        } else {
            $mealTypes->with(['meal_preparation_groups']);
        }

        $mealTypes =  $mealTypes->get();        
        
        return Jetstream::inertia()->render($request, 'GroupMealPrep/index', [
            'mealTypes'=>$mealTypes
        ]);
    }

    
    public function getRecord(Request $request){
        $date = $request->date;         
        $status = true;
        $message = "data found";
        $dayOptions = null;
        $mpgs = MealPreparationGroup::with(['offerings'])->find($request->meal_preparation_group_id);
        $options = [];            
        $siteIds = [];
        $recipes = [];
        // dd($mpgs->toArray());
        // $foodOrder = [];
        if($mpgs && $mpgs->offerings){
            foreach($mpgs->offerings as $offering){
                // dd($offering->toArray());
                $calender = (new getDateOptionsByOfferingGetter)
                    ->forDate($date)
                    ->forOffering($offering)
                    ->forSite($offering->site)
                    ->get();
                // dd($calender);
                $sites[$offering->site->id] = $offering->site->name;
                $siteIds[$offering->site->id] = null;
                if($calender){
                    if($calender->calendar_days && isset($calender->calendar_days) && $calender->calendar_days[0]->menu_cycle->menuCycleDays && isset($calender->calendar_days[0]->menu_cycle->menuCycleDays[0])) {
                        $ol = $calender->calendar_days[0]->menu_cycle->menuCycleDays[0];
                        foreach($ol->menuCycleDayOptions as $menuCycleDayOption){
                            
                            foreach($menuCycleDayOption->menuCycleDayOptionComponents as $menuCycleDayOptionComponent){

                                if($menuCycleDayOptionComponent->recipe){
                                    // dd($menuCycleDayOptionComponent->id);
                                    if(!isset($recipes[$menuCycleDayOptionComponent->recipe->id])){
                                        $recipes[$menuCycleDayOptionComponent->recipe->id] = 
                                        ['id' => $menuCycleDayOptionComponent->recipe->id, 'name'=> $menuCycleDayOptionComponent->recipe->name, 'sites'=>[]];
                                    } 

                                    if(!isset($recipes[$menuCycleDayOptionComponent->recipe->id]['sites'][$offering->site->id])){
                                        $recipes[$menuCycleDayOptionComponent->recipe->id]['sites'][$offering->site->id] = ['id'=>$offering->site->id, 'name'=>$offering->site->name, 'student_count'=>0, 'prev_count'=>0];
                                    }
                                    $recipes[$menuCycleDayOptionComponent->recipe->id]['sites'][$offering->site->id]['student_count'] += $menuCycleDayOptionComponent->student_count;
                                    // $foodOrder[] = $menuCycleDayOptionComponent->student_count;
                                    // if($menuCycleDayOptionComponent->student_count > 0){
                                    //     dd($menuCycleDayOptionComponent > 0);
                                    // }

                                    if($menuCycleDayOptionComponent->foodOrderStudentCount){
                                        $recipes[$menuCycleDayOptionComponent->recipe->id]['sites'][$offering->site->id]['prev_count'] += $menuCycleDayOptionComponent->foodOrderStudentCount->student_count;
                                    }
                                }
                            }
                        }
                    }  
                    $options[] = $calender->toArray();                      
                } 
            }
        }
        // dd($foodOrder, $options, $recipes);
        if(count($recipes)){
            $newRecipe = [];
            foreach($recipes as $r){
                // dd($r['sites']);
                $n = $r;
                $newRecipe[] = ['id'=> $r['id'], 'r_name'=> $r['name'], 'name'=>$r['name'] , 'r_id'=> $r['id'], 'type'=>'recipe', 'student_count'=> array_sum(array_column($r['sites'], 'student_count')), 'prev_count'=>array_sum(array_column($r['sites'], 'prev_count')), 'override_count'=>array_sum(array_column($r['sites'], 'student_count'))];
                foreach($r['sites'] as $site){
                    $site['r_name'] = $r['name'];
                    $site['r_id'] = $r['id'];
                    $site['type'] = 'site';
                    $site['override_count'] = null;
                    $newRecipe[] = $site;
                }
            }

            // dd($newRecipe, $recipes);
            $dayOptions = $newRecipe;
        } else {
            $status = false;
            $message = "No Record Found";
        }

        return response()->json(['status'=>$status, 'msg'=>$message, 'data'=> $dayOptions, 'type' => $request->type]);
    }
 
    public function getUOMNameByID($uomId = NULL)
    { 
			return $uomname = ($uomId != NULL) ? UnitOfMeasurement::find($uomId)->name : NULL;
    } 

    public function exportPrepReport()
    {
        $preps = request('preps');
        $prepArray = json_decode( json_encode($preps), TRUE);
        $pdf = $this->getPrepPdf($prepArray);
        $n = time().'-'. str_replace("/","-",'Group-Meal-Prep.pdf');
        $fileName =  $n .'.pdf';
        $content = Storage::disk('s3')->put('zip-file/'.$fileName,$pdf->output());
        return Storage::disk('s3')->temporaryUrl(
            "zip-file/$fileName",
            now()->addHour(),
            ['ResponseContentDisposition' => 'attachment']
        );
        // return $pdf->output();
        // return $pdf->download('Group-Meal-Prep.pdf');
    }

    public function getPrepPdf($preps)
    {
        $pdf = PDF::setOptions(['isPhpEnabled' => true, 'isRemoteEnabled' => env('PDF_IS_REMOTE_ENABLED', true)]);
        $pdf = $pdf->loadView('group-meal-prep', ['preps'=> $preps]);
        return $pdf;
    }

    public function exportAll(Request $request)
    {
        $tempFile = time().'-Group-Meal-Prep.zip';
        $zipfile = Storage::disk('tmp')->url($tempFile);
        // dd($zipfile);
        $zip = new \ZipArchive();
        $zip->open($zipfile, \ZipArchive::CREATE);
        $mpgs = MealPreparationGroup::find($request->meal_preparation_group_id);
        $date = request('date');
        if($mpgs && $mpgs->offerings){
            foreach($mpgs->offerings as $offering){
                $calender = (new getDateOptionsGetter)
                    ->forDate($date)
                    ->forOffering($offering)
                    ->forSite($offering->site)
                    ->get();
                $sites[$offering->site->id] = $offering->site->name;
                $siteIds[$offering->site->id] = null;
                if($calender){
                    if($calender->calendar_days && isset($calender->calendar_days) && $calender->calendar_days[0]->menu_cycle->menuCycleDays && isset($calender->calendar_days[0]->menu_cycle->menuCycleDays[0])){
                        foreach($calender->calendar_days[0]->menu_cycle->menuCycleDays as $menuCycleDay){
                            // dd($menuCycleDay);
                            foreach($menuCycleDay->menuCycleDayOptions as $menuCycleDayOption1)
                            {
                                $menuCycleDayOption = $this->convertAssembaly($menuCycleDayOption1, $offering->site->id, $date);
                                $pdf = PDF::setOptions(['isPhpEnabled' => true, 'isRemoteEnabled' => env('PDF_IS_REMOTE_ENABLED', true)]);
                                $pdf = $pdf->loadView('assemblyInstructionsPdf', ['menuCycleDayOption'=> $menuCycleDayOption])->setPaper('a4', 'landscape');
                                $n = time().'-'. str_replace("/","-",$menuCycleDayOption->name);
                                $fileName =  $n .'-'.'options.pdf';
                                $content = Storage::disk('s3')->put('zip-file/'.$fileName,$pdf->output());
                                // dd($fileName);
                                $zip->addFromString($fileName, Storage::disk('s3')->get('zip-file/'.$fileName));

                                foreach($menuCycleDayOption1->menuCycleDayOptionComponents as $menuCycleDayOptionComponent){
                                    $recipe = $menuCycleDayOptionComponent->recipe;
                                    if($recipe && isset($recipe->name)){
                                        if(isset($studentCounts[$menuCycleDayOptionComponent->id]) && $studentCounts[$menuCycleDayOptionComponent->id] > 0){
                                            $studentCount = $studentCounts[$menuCycleDayOptionComponent->id];
                                        } else {
                                            if(isset($recipeCurrentStudentCount[$menuCycleDayOptionComponent->id])){
                                                $studentCount = $recipeCurrentStudentCount[$menuCycleDayOptionComponent->id];
                                            } else {
                                                $studentCount = $menuCycleDayOptionComponent->student_count != null ? $menuCycleDayOptionComponent->student_count : 0;
                                            }
                                            
                                        }                        
                                        $ingre_array = $this->recipeCardIng($recipe);                
                                        $id =  substr($recipe->id, -4);
                                        $pdf = PDF::setOptions(['isPhpEnabled' => true, 'isRemoteEnabled' => env('PDF_IS_REMOTE_ENABLED', true)]);
                                        $pdf = $pdf->loadView('recipe', ['recipe'=> $recipe,'ingre_array'=> $ingre_array,'studentCount'=>$studentCount])  
                                        ;
                                        $n = time().'-'. str_replace("/","-",$recipe->name);
                                        $fileName =  $n .'-'.'.pdf';
                                        $content = Storage::disk('s3')->put('zip-file/'.$fileName,$pdf->output());
                                        $zip->addFromString($fileName, Storage::disk('s3')->get('zip-file/'.$fileName));
                                    }
                                }
                            }
                        }
                        
                    }                        
                } 
            }
        }


        $preps = request('meal_preparation_groups');
        // $prepArray = json_decode($preps, TRUE);
        $prepArray = $preps;
        $pdf = $this->getPrepPdf($prepArray);
        $n = time().'-'. str_replace("/","-",'Group-Meal-Prep');
        $fileName =  $n .'-'.'.pdf';
        $content = Storage::disk('s3')->put('zip-file/'.$fileName,$pdf->output());
        $zip->addFromString($fileName, Storage::disk('s3')->get('zip-file/'.$fileName));
        $zip->close();
        Storage::disk('s3')->put("zip-file/$tempFile", file_get_contents($zipfile));
        return Storage::disk('s3')->temporaryUrl(
            "zip-file/$tempFile",
            now()->addHour(),
            ['ResponseContentDisposition' => 'attachment']
        );
        // return redirect();

    }

    public function convertAssembaly($menuCycleDayOption, $site, $date){
        $mpgs = MealPreparationGroup::find($site);
            $options = $dayOptions = [];
            $sites = [];
            $siteIds = [];
            if($mpgs && $mpgs->offerings){
                foreach($mpgs->offerings as $offering){
                    $calender = (new getDateOptionsGetter)
                        ->forDate($date)
                        ->forOffering($offering)
                        ->forSite($offering->site)
                        ->get();
                    $sites[$offering->site->id] = $offering->site->name;
                    $siteIds[$offering->site->id] = null;
                    if($calender){
                        if($calender->calendar_days && isset($calender->calendar_days) && $calender->calendar_days[0]->menu_cycle->menuCycleDays && isset($calender->calendar_days[0]->menu_cycle->menuCycleDays[0])){
                            $ol = $calender->calendar_days[0]->menu_cycle->menuCycleDays[0];
                            $ol->site_id = $offering->site->id;
                            $ol->site_name = $offering->site->name;
                            $options[] = $ol;
                            // $dayOptions[] = $ol;
                        }                        
                    } 
                }
            }
            if(count($options)){
                $dayOptions = $this->convertGroup($options, $siteIds); 
                foreach($dayOptions as $do){
                    if($do->id == $menuCycleDayOption->id){
                        $menuCycleDayOption = $do;
                    }
                }
            }
            return $menuCycleDayOption;
    }

    public function recipeCardIng($recipe){
        $ingre_array = [
            "usda_componenent_meat"=>	0,
            "usda_componenent_grain"=>0,
            "usda_componenent_fruit"=>0,
            "usda_componenent_milk"=>0,
            "usda_componenent_veg"=>0,
            "usda_componenent_veggrn"=>0,
            "usda_componenent_vegred"=>0,
            "usda_componenent_vegleg"=>0,
            "usda_componenent_vegstar"=>0,
            "usda_componenent_vegothr"=>0,
            "usda_componenent_meat_override"=>0,
            "usda_componenent_grain_override"=>0,
            "usda_componenent_fruit_override"=>0,
            "usda_componenent_milk_override"=>0,
            "usda_componenent_veg_override"=>0,
            "usda_componenent_veggrn_override"=>0,
            "usda_componenent_vegred_override"=>0,
            "usda_componenent_vegleg_override"=>0,
            "usda_componenent_vegstar_override"=>0,
            "usda_componenent_vegothr_override"=>0,
            "cals"=>0,
            "sod"=>0,
            "fat"=>0,
            "prot"=>0,
            "carb"=>0
        ];
        // dd(json_encode($recipe));
        // dd($recipe->toArray());
        foreach($recipe->ingredients_total as $k=>$ingre){
            $ingre_array['usda_componenent_meat'] += isset($ingre->usda_componenent_meat_override)?$ingre->usda_componenent_meat_override:$ingre->usda_componenent_meat;
            $ingre_array['usda_componenent_grain'] += isset($ingre->usda_componenent_grain_override)?$ingre->usda_componenent_grain_override:$ingre->usda_componenent_grain;
            $ingre_array['usda_componenent_fruit'] += isset($ingre->usda_componenent_fruit_override)?$ingre->usda_componenent_fruit_override:$ingre->usda_componenent_fruit;
            $ingre_array['usda_componenent_milk'] += isset($ingre->usda_componenent_milk_override)?$ingre->usda_componenent_milk_override:$ingre->usda_componenent_milk;
            $ingre_array['usda_componenent_veg'] += isset($ingre->usda_componenent_veg_override)?$ingre->usda_componenent_veg_override:$ingre->usda_componenent_veg;
            $ingre_array['usda_componenent_veggrn'] += isset($ingre->usda_componenent_veggrn_override)?$ingre->usda_componenent_veggrn_override:$ingre->usda_componenent_veggrn;
            $ingre_array['usda_componenent_vegred'] += isset($ingre->usda_componenent_vegred_override)?$ingre->usda_componenent_vegred_override:$ingre->usda_componenent_vegred;
            $ingre_array['usda_componenent_vegleg'] += isset($ingre->usda_componenent_vegleg_override)?$ingre->usda_componenent_vegleg_override:$ingre->usda_componenent_vegleg;
            $ingre_array['usda_componenent_vegstar'] += isset($ingre->usda_componenent_vegstar_override)?$ingre->usda_componenent_vegstar_override:$ingre->usda_componenent_vegstar;
            $ingre_array['usda_componenent_vegothr'] += isset($ingre->usda_componenent_vegothr_override)?$ingre->usda_componenent_vegothr_override:$ingre->usda_componenent_vegothr;
            $ingre_array['usda_componenent_meat_override'] += $ingre->usda_componenent_meat_override;
            $ingre_array['usda_componenent_grain_override'] += $ingre->usda_componenent_grain_override;
            $ingre_array['usda_componenent_fruit_override'] += $ingre->usda_componenent_fruit_override;
            $ingre_array['usda_componenent_milk_override'] += $ingre->usda_componenent_milk_override;
            $ingre_array['usda_componenent_veg_override'] += $ingre->usda_componenent_veg_override;
            $ingre_array['usda_componenent_veggrn_override'] += $ingre->usda_componenent_veggrn_override;
            $ingre_array['usda_componenent_vegred_override'] += $ingre->usda_componenent_vegred_override;
            $ingre_array['usda_componenent_vegleg_override'] += $ingre->usda_componenent_vegleg_override;
            $ingre_array['usda_componenent_vegstar_override'] += $ingre->usda_componenent_vegstar_override;
            $ingre_array['usda_componenent_vegothr_override'] += $ingre->usda_componenent_vegothr_override;
            
            $ingredient = array();
            $scale = 1;
            if($recipe->ingredients[$k]->prefer_product){
                $ingredient['recipe_amount'] = $ingre->recipe_amount;
            $ingredient['recipe_amount_uom']  = $this->getUOMNameByID($ingre->recipe_amount_uom_id);

            $ingredient['serving_amount']     = $ingre->serving_amount;
            $ingredient['serving_amount_uom'] = $this->getUOMNameByID($ingre->serving_amount_uom_id);

            // dd($ingre, $ingredient);

            $ingredient['component_mma']   = $ingre->usda_componenent_meat;
            $ingredient['component_wgr']   = $ingre->usda_componenent_grain;
            $ingredient['component_fru']   = $ingre->usda_componenent_fruit;
            $ingredient['component_mlk']   = $ingre->usda_componenent_milk;
            $ingredient['component_veg']   = $ingre->usda_componenent_veg;
            $ingredient['component_dg']    = $ingre->usda_componenent_veggrn;
            $ingredient['component_ro']    = $ingre->usda_componenent_vegred;
            $ingredient['component_leg']   = $ingre->usda_componenent_vegleg;
            $ingredient['component_star']  = $ingre->usda_componenent_vegstar;
            $ingredient['component_other'] = $ingre->usda_componenent_vegothr;

            //setup ingredient components for optional components
            $ingredient['optional_component_mma']   = $ingre->usda_componenent_meat_override;
            $ingredient['optional_component_wgr']   = $ingre->usda_componenent_grain_override;
            $ingredient['optional_component_fru']   = $ingre->usda_componenent_fruit_override;
            $ingredient['optional_component_mlk']   = $ingre->usda_componenent_milk_override;
            $ingredient['optional_component_veg']   = $ingre->usda_componenent_veg_override;
            $ingredient['optional_component_dg']    = $ingre->usda_componenent_veggrn_override;
            $ingredient['optional_component_ro']    = $ingre->usda_componenent_vegred_override;
            $ingredient['optional_component_leg']   = $ingre->usda_componenent_vegleg_override;
            $ingredient['optional_component_star']  = $ingre->usda_componenent_vegstar_override;
            $ingredient['optional_component_other'] = $ingre->usda_componenent_vegothr_override;


            
            $prefer_prod = $recipe->ingredients[$k]->prefer_product;
            $prefer_prod['measurement_serving_weight'] = $prefer_prod->serving_measurement_weight;
            $prefer_prod['measurement_serving_weight_uom'] = $this->getUOMNameByID($prefer_prod->serving_measurement_weight_uom_id);
            $prefer_prod['measurement_serving_volume'] = $prefer_prod->serving_measurement_volume;
            $prefer_prod['measurement_serving_volume_uom'] = $this->getUOMNameByID($prefer_prod->serving_measurement_volume_uom_id);
            $prefer_prod['measurement_serving_unit'] = $prefer_prod->serving_measurement_unit;
            $prefer_prod['measurement_serving_unit_uom'] = $this->getUOMNameByID($prefer_prod->serving_measurement_unit_uom_id);

            $ingredient['preferred_product_information'] = $recipe->ingredients[$k]->prefer_product;

            $scale = (new UnitConversionsGetter)->getNutritionScaleFactor($ingredient);

            }
            

            // dd($scale);

            if($recipe->ingredients[$k]->prefer_product && $recipe->ingredients[$k]->prefer_product->nutrition_facts_calories){
                $ingre_array['cals'] += $recipe->ingredients[$k]->prefer_product->nutrition_facts_calories * $scale;
            }

            if($recipe->ingredients[$k]->prefer_product && $recipe->ingredients[$k]->prefer_product->nutrition_facts_sodium){
                $ingre_array['sod'] += $recipe->ingredients[$k]->prefer_product->nutrition_facts_sodium * $scale;
            }

            if($recipe->ingredients[$k]->prefer_product && $recipe->ingredients[$k]->prefer_product->nutrition_facts_totalfat){
                $ingre_array['fat'] += $recipe->ingredients[$k]->prefer_product->nutrition_facts_totalfat * $scale;
            }

            if($recipe->ingredients[$k]->prefer_product && $recipe->ingredients[$k]->prefer_product->nutrition_facts_protein){
                $ingre_array['prot'] += $recipe->ingredients[$k]->prefer_product->nutrition_facts_protein * $scale;
            }

            if($recipe->ingredients[$k]->prefer_product && $recipe->ingredients[$k]->prefer_product->nutrition_facts_carbs){
                $ingre_array['carb'] += $recipe->ingredients[$k]->prefer_product->nutrition_facts_carbs * $scale;
            }            
        }
        return $ingre_array;
    }

    

    
}
