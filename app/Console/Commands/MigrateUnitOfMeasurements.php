<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\DB;
use Bytelaunch\Nutristudents\Models\Product;
use Bytelaunch\Nutristudents\Models\Recipe;
use Bytelaunch\Nutristudents\Models\UnitOfMeasurement;

class MigrateUnitOfMeasurements extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'MigrateUOM:pound-lb';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'All Pounds weight Unit of Measurement in the database will be migrated to LBS';

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
        $poundUOMID = UnitOfMeasurement::where('name','Pound')->first()->id;
        $lbUOMID = UnitOfMeasurement::where('name','LB')->first()->id;

        $products = Product::where('case_weight_uom_id', $poundUOMID)
        ->orWhere('sub_case_weight_uom_id', $poundUOMID)
        ->orWhere('serving_measurement_weight_uom_id', $poundUOMID)
        ->orWhere('nutrition_facts_weight_uom_id', $poundUOMID)->get();
        
        $this->line('**************************Products*****************************');
        $products->each(function ($value, $key) use($poundUOMID, $lbUOMID) {        

        $value->case_weight_uom_id = ($value->case_weight_uom_id == $poundUOMID) ? $lbUOMID : $value->case_weight_uom_id;

        $value->sub_case_weight_uom_id = ($value->sub_case_weight_uom_id == $poundUOMID) ? $lbUOMID : $value->sub_case_weight_uom_id;

        $value->serving_measurement_weight_uom_id = ($value->serving_measurement_weight_uom_id == $poundUOMID) ? $lbUOMID : $value->serving_measurement_weight_uom_id;

        $value->nutrition_facts_weight_uom_id = ($value->nutrition_facts_weight_uom_id == $poundUOMID) ? $lbUOMID : $value->nutrition_facts_weight_uom_id;
         
        if($value->update()){
        $this->comment($key. ' --- Product "'.$value->name.'" Updated' );
        }

        });
        $this->line('***************************************************************');


        $recipes = Recipe::where('serving_size_uom_id', $poundUOMID)->get();
        $this->line('**************************Recipes*****************************');
        $recipes->each(function ($value, $key) use($poundUOMID, $lbUOMID) {
           $value->serving_size_uom_id = ($value->serving_size_uom_id == $poundUOMID) ? $lbUOMID : $value->serving_size_uom_id;
        if($value->update()){
        $this->comment($key. ' --- Recipe "'.$value->name.'" Updated' );
        }
        });
        $this->line('**************************************************************');


        $rec_ing_data = DB::table('ingredient_recipe')
        ->where(['recipe_amount_uom_id' => $poundUOMID])
        ->update(['recipe_amount_uom_id' => $lbUOMID]);

        $rec_ing_data2 = DB::table('ingredient_recipe')
        ->where(['serving_amount_uom_id' => $poundUOMID])
        ->update(['serving_amount_uom_id' => $lbUOMID]);
        
        //$this->info('Finally All Products with Pound updated to LB successfully');

        //UnitOfMeasurement::where('name','Pound')->delete();
    }
}
