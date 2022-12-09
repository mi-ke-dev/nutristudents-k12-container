<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\DB;
use Bytelaunch\Nutristudents\Models\Product;
use Bytelaunch\Nutristudents\Models\Recipe;
use Bytelaunch\Nutristudents\Models\UnitOfMeasurement;

class MigratePieceQtyUOMEach extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'MigrateUOM:pieceqty-each';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'All Piece and Qty Unit of Measurement in the database should be migrated to Each';

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
        $pieceUOMID = UnitOfMeasurement::where('name','Piece')->first()->id;
        $qtyUOMID = UnitOfMeasurement::where('name','Qty')->first()->id;
        $eachUOMID = UnitOfMeasurement::where('name','Each')->first()->id;

        $products = Product::where('serving_measurement_unit_uom_id', $pieceUOMID)
        ->orWhere('nutrition_facts_unit_uom_id', $pieceUOMID)
        ->orWhere('serving_measurement_unit_uom_id', $qtyUOMID)
        ->orWhere('nutrition_facts_unit_uom_id', $qtyUOMID)->get();
        
        $this->line('**************************Products*****************************');
        $products->each(function ($value, $key) use($pieceUOMID, $qtyUOMID, $eachUOMID) {        

        $value->serving_measurement_unit_uom_id = ($value->serving_measurement_unit_uom_id == ($pieceUOMID || $qtyUOMID)) ? $eachUOMID : $value->serving_measurement_unit_uom_id;

        $value->nutrition_facts_unit_uom_id = ($value->nutrition_facts_unit_uom_id == ($pieceUOMID || $qtyUOMID)) ? $eachUOMID : $value->nutrition_facts_unit_uom_id;
         
        if($value->update()){
        $this->comment($key. ' --- Product "'.$value->name.'" Updated' );
        }

        });
        $this->line('***************************************************************');


        $recipes = Recipe::where('serving_size_uom_id', $pieceUOMID)->orWhere('serving_size_uom_id', $qtyUOMID)->get();
        $this->line('**************************Recipes*****************************');
        $recipes->each(function ($value, $key) use($eachUOMID) {
           $value->serving_size_uom_id = $eachUOMID;
        if($value->update()){
        $this->comment($key. ' --- Recipe "'.$value->name.'" Updated' );
        }
        });
        $this->line('**************************************************************');


        $rec_ing_data = DB::table('ingredient_recipe')
        ->where(['recipe_amount_uom_id' => $pieceUOMID])->orWhere('recipe_amount_uom_id', $qtyUOMID)->update(['recipe_amount_uom_id' => $eachUOMID]);

        $rec_ing_data2 = DB::table('ingredient_recipe')        
        ->where(['serving_amount_uom_id' => $pieceUOMID])->orWhere('serving_amount_uom_id', $qtyUOMID)->update(['serving_amount_uom_id' => $eachUOMID]);
        
        //$this->info('Finally All Products with Pound updated to LB successfully');

        //UnitOfMeasurement::where('name','Piece')->delete();
        //UnitOfMeasurement::where('name','Qty')->delete();
    }
}
