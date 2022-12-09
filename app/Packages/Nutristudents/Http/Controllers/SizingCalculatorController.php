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
use Bytelaunch\Nutristudents\Getters\Sites\GetMealPreprationGetter;
use Bytelaunch\Nutristudents\Getters\UnitConvert\UnitConversionsGetter;
use Bytelaunch\Nutristudents\Models\MealPreparationGroup;
use Bytelaunch\Nutristudents\Models\MenuCycleDayOptionComponent;
use Bytelaunch\Nutristudents\Models\Recipe;
use Bytelaunch\Nutristudents\Models\UnitOfMeasurement;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;

class SizingCalculatorController extends Controller
{
    
    public function index(Request $request) : Response
    {    
        $user = auth()->user();
        $user_id = $user->id;
        $is_admin = $user->isSuperUser();
        // $this->getRecordByDate();

        $sites = Site::select('id', 'name')
        ->has('offerings');
        if(!$is_admin ){
            $sites->where(function($q) use($user_id){    
                $q->whereHas('food_preparation', function($q1)use($user_id){
                    $q1->where('user_id', $user_id);
                });
            })            
            ->with(['offerings' => function($q) use($user_id){
                $q->select('offerings.id','offerings.name');
                $q->whereHas('food_preparation', function($q1)use($user_id){
                    $q1->where('user_id', $user_id);
                });
            }]);
        } else {
            $sites          
            ->with(['offerings:id,name']);
        }
        $sites = $sites->orderBy('name','asc')->get();

        // $sites = Site::select('id', 'name')->has('offerings')->with(['offerings:id,name'])->get();
        
        // $mealPreparationGroups = MealPreparationGroup::select('id', 'name')->has('offerings')->get();
        $mealPreparationGroups = (new GetMealPreprationGetter)
        ->forUser(auth()->user()) 
        ->forType('food_preparation')
        ->get();
        
        
        return Jetstream::inertia()->render($request, 'SizingCalculator/index', [
            'sites'=>$sites,
            'mealPreparationGroups' => $mealPreparationGroups
        ]);
    }

    public function convertGroup($options, $sites){
        $optionName = []; 
        $component = [];
        foreach($options as $day){ 
            if($day->menuCycleDayOptions){
                foreach($day->menuCycleDayOptions as $option){
                    if(isset($optionName[$option->name])){
                        foreach($option->menuCycleDayOptionComponents as $menuCycleDayOptionComponents){       
                            $first = Arr::first($optionName[$option->name]->menuCycleDayOptionComponents, function ($value, $key) use($menuCycleDayOptionComponents) {
                                return $value->recipe_id == $menuCycleDayOptionComponents->recipe_id;
                            }); 
                            if($first){                                
                                $first->student_count += $menuCycleDayOptionComponents->student_count;
                                // dd($first->sites, $day->site_id);
                                $s = $first->sites;
                                if($s[$day->site_id]){
                                    $first->sites[$day->site_id] += $menuCycleDayOptionComponents->student_count;
                                } else {
                                    $s[$day->site_id] = $menuCycleDayOptionComponents->student_count;
                                }
                                $first->sites = $s; 
                                


                                 $optionName[$option->name]->menuCycleDayOptionComponents->map(
                                    function($mcdoc) use($first){
                                        if($mcdoc->id == $first->id){
                                            $mcdoc->student_count = $first->student_count;
                                        }
                                        // return $mcdoc;
                                    });                                
                            } else {
                                 
                                    if(!isset($component[$menuCycleDayOptionComponents->id])){
                                        $component[$menuCycleDayOptionComponents->id]=$sites;
                                    }
                                    $component[$menuCycleDayOptionComponents->id][$day->site_id] = $menuCycleDayOptionComponents->student_count;
                                     
                                    $menuCycleDayOptionComponents->sites = $component[$menuCycleDayOptionComponents->id];  

                                $optionName[$option->name]->menuCycleDayOptionComponents->push($menuCycleDayOptionComponents);                                
                            }
                        }
                    } else {
                        foreach($option->menuCycleDayOptionComponents as $menuCycleDayOptionComponents){

                            if(!isset($component[$menuCycleDayOptionComponents->id])){
                                $component[$menuCycleDayOptionComponents->id]=$sites;
                            }
                            $component[$menuCycleDayOptionComponents->id][$day->site_id] = $menuCycleDayOptionComponents->student_count;
                             
                            $menuCycleDayOptionComponents->sites = $component[$menuCycleDayOptionComponents->id];
                            // dd($menuCycleDayOptionComponents->sites);

                        }
                        $optionName[$option->name] = $option;
                    }
                    
                }
            }
        } 
        // dd(array_values($optionName));
        return array_values($optionName);
        // dd( json_decode(json_encode($optionName))); 
    }

    public function setSiteCount($site, $component_id, $count = null){

    }

    public function getRecord(Request $request){
        $date = $request->date;
        $site = Site::find($request->site);
        $offer = Offering::find($request->offer);
        $status = true;
        $message = "data found";
        $dayOptions = [];
        $sites = [];

        if($request->type == 'group'){
            $mpgs = MealPreparationGroup::find($request->site);
            $options = [];
            
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
                // dd($options);
            }
        } else {
            $calender = (new getDateOptionsGetter)
                ->forDate($date)
                ->forOffering($offer)
                ->forSite($site)
                ->get();
                
                if($calender){
                    if($calender->calendar_days && isset($calender->calendar_days) && $calender->calendar_days[0]->menu_cycle->menuCycleDays && isset($calender->calendar_days[0]->menu_cycle->menuCycleDays[0])){
                        $dayOptions[] = $calender->calendar_days[0]->menu_cycle->menuCycleDays[0];
                    } else {
                        $status = false;
                    $message = "No Record Found";
                    }
                    
                } else {
                    $status = false;
                    $message = "No Record Found";
                }
        }       

        return response()->json(['status'=>$status, 'msg'=>$message, 'data'=> $dayOptions, 'type' => $request->type, 'sites'=> $sites]);
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

    public function downloadAssemblyInstructionsForSizingCalculator(MenuCycleDayOption $menuCycleDayOption){
        

        if(request('type') && request('type') == 'group'){
            $site = request()->site;
            $date = request()->date;
            $menuCycleDayOption = $this->convertAssembaly($menuCycleDayOption, $site, $date);            
        }

        $pdf = PDF::setOptions(['isPhpEnabled' => true, 'isRemoteEnabled' => env('PDF_IS_REMOTE_ENABLED', true)]);
        $pdf = $pdf->loadView('assemblyInstructionsPdf', ['menuCycleDayOption'=> $menuCycleDayOption])->setPaper('a4', 'landscape');
        return $pdf->download($menuCycleDayOption->name .'-'.'option.pdf');
    }

    public function downloadRecipeCardForSizingCalculator(MenuCycleDayOptionComponent $menuCycleDayOptionComponent, $headCount = null){

            $recipe = $menuCycleDayOptionComponent->recipe;
            if($recipe && isset($recipe->name)){
                // dd($recipe);
                if($headCount && $headCount > 0){
                    $studentCount = $headCount;
                } else {
                    $studentCount = $menuCycleDayOptionComponent->student_count != null ? $menuCycleDayOptionComponent->student_count : 0;
                }    
                
                $ingre_array = $this->recipeCardIng($recipe);                
                $id =  substr($recipe->id, -4);

                // return view('recipe',  ['recipe'=> $recipe,'ingre_array'=> $ingre_array,'studentCount'=>$studentCount]);

                $pdf = PDF::setOptions(['isPhpEnabled' => true, 'isRemoteEnabled' => env('PDF_IS_REMOTE_ENABLED', true)]);
                $pdf = $pdf->loadView('recipe', ['recipe'=> $recipe,'ingre_array'=> $ingre_array,'studentCount'=>$studentCount])                
                // ->setPaper('a4', 'landscape')
                ;
            }       
        
        return $pdf->download($recipe->name .'.pdf');
    }

    public function downloadRecipeCardForSizingCalculatorFromSearch($id, $headCount = null){
        $recipe = Recipe::find($id);    
        if($recipe && isset($recipe->name)){
            $studentCount = 0;
            if($headCount && $headCount > 0){
                $studentCount = $headCount;
            }  
            
            $ingre_array = $this->recipeCardIng($recipe);                
            $id =  substr($recipe->id, -4);

         
            $pdf = PDF::setOptions(['isPhpEnabled' => true, 'isRemoteEnabled' => env('PDF_IS_REMOTE_ENABLED', true)]);
            // return view('recipe', ['recipe'=> $recipe,'ingre_array'=> $ingre_array,'studentCount'=>$studentCount]);
            $pdf = $pdf->loadView('recipe', ['recipe'=> $recipe,'ingre_array'=> $ingre_array,'studentCount'=>$studentCount])   
            ;
        }
    
        return $pdf->download($recipe->name .'.pdf');
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
    public function getUOMNameByID($uomId = NULL)
    { 
			return $uomname = ($uomId != NULL) ? UnitOfMeasurement::find($uomId)->name : NULL;
    } 

    public function exportAll(Request $request){
        // dd($request->all());
        $tempFile = time().'-Sizing Calculator.zip';
        $zipfile = Storage::disk('tmp')->url($tempFile);
        // dd($zipfile);
        $zip = new \ZipArchive();
        $zip->open($zipfile, \ZipArchive::CREATE);
        // dd($zip);

        if($request->assembly){
            $menuCycleDayOptions = MenuCycleDayOption::whereIn('id', $request->assembly)->get();
            
            foreach($menuCycleDayOptions as $menuCycleDayOption){
                if(request('type') && request('type') == 'group'){
                    $site = request()->site;
                    $date = request()->date;
                    $menuCycleDayOption = $this->convertAssembaly($menuCycleDayOption, $site, $date);      
                }
                $pdf = PDF::setOptions(['isPhpEnabled' => true, 'isRemoteEnabled' => env('PDF_IS_REMOTE_ENABLED', true)]);
                $pdf = $pdf->loadView('assemblyInstructionsPdf', ['menuCycleDayOption'=> $menuCycleDayOption])->setPaper('a4', 'landscape');
                $n = time().'-'. str_replace("/","-",$menuCycleDayOption->name);
				$fileName =  $n .'-'.'options.pdf';
                $content = Storage::disk('s3')->put('zip-file/'.$fileName,$pdf->output());
                // dd($fileName);
                $zip->addFromString($fileName, Storage::disk('s3')->get('zip-file/'.$fileName));
                // dd($zip);
            }
        }
        if($request->recipe){
            $studentCounts = $request->recipeStudentCount;
            $recipeCurrentStudentCount = $request->recipeCurrentStudentCount;
            $menuCycleDayOptionComponents = MenuCycleDayOptionComponent::whereIn('id', $request->recipe)->get();
            foreach($menuCycleDayOptionComponents as $menuCycleDayOptionComponent){
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

        if($request->searchRecipe){
            $studentCounts = $request->recipeStudentCount;
            $menuCycleDayOptionComponents = Recipe::whereIn('id', $request->searchRecipe)->get();
            foreach($menuCycleDayOptionComponents as $recipe){
                // $recipe = $menuCycleDayOptionComponent->recipe;
                // if($recipe && isset($recipe->name)){
                    if(isset($studentCounts[$recipe->id]) && $studentCounts[$recipe->id] > 0){
                        $studentCount = $studentCounts[$recipe->id];
                    } else {
                        $studentCount = 0;
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
                // }
            }            
        }

        $zip->close();
        Storage::disk('s3')->put("zip-file/$tempFile", file_get_contents($zipfile));
        return redirect(Storage::disk('s3')->temporaryUrl(
            "zip-file/$tempFile",
            now()->addHour(),
            ['ResponseContentDisposition' => 'attachment']
        ));
    }
}
