<?php

namespace App\Jobs;

use Illuminate\Bus\Batchable;
use App\Models\Tenant;
use Bytelaunch\Nutristudents\Models\Ingredient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Illuminate\Support\Facades\DB;

class SetTenantData implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var TenantWithDatabase */
    protected $masterTenant;
    protected $tenancy_db_name;

    public function __construct($masterTenant, $tenancy_db_name)    {
        $this->masterTenant = $masterTenant;
        $this->tenancy_db_name = $tenancy_db_name;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {  
        $tables = ['menu_cycles', 
            'recipes','products', 'ingredients',              
            'guidelines', 'categories', 'distributors', 'haccps', 
            'menu_cycle_days', 'menu_cycle_day_options', 'menu_cycle_day_option_components'
        ];
        foreach($tables as $table){
            try {
                try { 
                    if($table == 'ingredients')
                    {
                        $sub_tenant = Tenant::whereJsonContains('data->tenancy_db_name', $this->tenancy_db_name)
                        ->where('is_primary', false)
                        ->where('is_master_release', false)
                        ->first(); 

                        if($sub_tenant)
                        {                            
                            $masterTenant = $this->masterTenant;
                            $tenancy_db_name = $this->tenancy_db_name;
                            $sub_tenant->run(function () use($table, $masterTenant, $tenancy_db_name) {

                                $mt = Tenant::where('is_primary', true)->first();
                                $ingredient_array = Ingredient::select('id', 'prefer_product_id')
                                ->where('tenant_id', $mt->id)
                                ->pluck('prefer_product_id', 'id')
                                ->toArray();

                                DB::select(self::getQuery($table, $masterTenant, $tenancy_db_name));

                                $ingredients = Ingredient::where('tenant_id', $mt->id)->get();
                                foreach($ingredients as $ingredient)
                                {
                                    if(isset($ingredient_array[$ingredient->id]) && $ingredient_array[$ingredient->id] != $ingredient->prefer_product_id)
                                    {
                                        $ingredient->prefer_product_id = $ingredient_array[$ingredient->id];
                                        $ingredient->save(); 
                                    }
                                }

                            });
                        } else {
                            DB::select(self::getQuery($table, $this->masterTenant, $this->tenancy_db_name));
                        }
                         
                        

                    } else {
                        DB::select(self::getQuery($table, $this->masterTenant, $this->tenancy_db_name));
                    }
                    
                    
                } catch (\Exception $th) {
                    echo $th->getMessage();
                }
            } catch (\Exception $th) {
                echo "Error ". $th->getMessage();
            }
        }


        $this->setPivotTables();

        
    }

    public function setPivotTables()
    {
        $mTenant = Tenant::whereJsonContains('data->tenancy_db_name', $this->masterTenant)
        ->first();

        $sTenant = Tenant::whereJsonContains('data->tenancy_db_name', $this->tenancy_db_name)
        ->first();
        if($mTenant && $sTenant)
        {
            try {
                $ingredient_recipes = [];
                $ingredient_products = [];
                $mTenant->run(function () use(&$ingredient_products, &$ingredient_recipes)  {
                    
                    $ingredient_products = DB::table('ingredient_product')->get(); 
                    $ingredient_recipes = DB::table('ingredient_recipe')->get();    

                });  
                
                $sTenant->run(function () use($ingredient_products, $ingredient_recipes) {
                    foreach($ingredient_products as $ingredient_product)
                    {
                        // set ingredient_product
                        DB::table('ingredient_product')->updateOrInsert(
                            ['ingredient_id' => $ingredient_product->ingredient_id, 'product_id' => $ingredient_product->product_id],
                            ['ingredient_id' => $ingredient_product->ingredient_id, 'product_id' => $ingredient_product->product_id]
                        ); 
                    }

                    foreach($ingredient_recipes as $ingredient_recipe)
                    {
                        // set ingredient_product
                        DB::table('ingredient_recipe')->updateOrInsert(
                            ['ingredient_id' => $ingredient_recipe->ingredient_id, 'recipe_id' => $ingredient_recipe->recipe_id],
                            ['ingredient_id' => $ingredient_recipe->ingredient_id, 'recipe_id' => $ingredient_recipe->recipe_id,
                            'recipe_amount' => $ingredient_recipe->recipe_amount,
                            'recipe_amount_uom_id' => $ingredient_recipe->recipe_amount_uom_id,
                            'usda_componenent_meat' => $ingredient_recipe->usda_componenent_meat,
                            'usda_componenent_grain' => $ingredient_recipe->usda_componenent_grain,
                            'usda_componenent_fruit' => $ingredient_recipe->usda_componenent_fruit,
                            'usda_componenent_milk' => $ingredient_recipe->usda_componenent_milk,
                            'usda_componenent_veg' => $ingredient_recipe->usda_componenent_veg,
                            'serving_amount' => $ingredient_recipe->serving_amount,
                            'serving_amount_uom_id' => $ingredient_recipe->serving_amount_uom_id,
                            'usda_componenent_veggrn' => $ingredient_recipe->usda_componenent_veggrn,
                            'usda_componenent_vegred' => $ingredient_recipe->usda_componenent_vegred,
                            'usda_componenent_vegleg' => $ingredient_recipe->usda_componenent_vegleg,
                            'usda_componenent_vegstar' => $ingredient_recipe->usda_componenent_vegstar,
                            'usda_componenent_vegothr' => $ingredient_recipe->usda_componenent_vegothr,
                            'usda_componenent_meat_override' => $ingredient_recipe->usda_componenent_meat_override,
                            'usda_componenent_grain_override' => $ingredient_recipe->usda_componenent_grain_override,
                            'usda_componenent_fruit_override' => $ingredient_recipe->usda_componenent_fruit_override,
                            'usda_componenent_milk_override' => $ingredient_recipe->usda_componenent_milk_override,
                            'usda_componenent_veg_override' => $ingredient_recipe->usda_componenent_veg_override,
                            'usda_componenent_veggrn_override' => $ingredient_recipe->usda_componenent_veggrn_override,
                            'usda_componenent_vegred_override' => $ingredient_recipe->usda_componenent_vegred_override,
                            'usda_componenent_vegleg_override' => $ingredient_recipe->usda_componenent_vegleg_override,
                            'usda_componenent_vegstar_override' => $ingredient_recipe->usda_componenent_vegstar_override,
                            'usda_componenent_vegothr_override' => $ingredient_recipe->usda_componenent_vegothr_override
                            ]
                        ); 
                    }
                                       
                });              
                
            } catch (\Exception $th) {
                //throw $th;
                echo "Error Pivot". $th->getMessage();
            }
        }
    }

    public static function  getQuery($tableName, $masterTenant, $subTenant)
    {
        $tenantId = $subTenant;
        return "
            WITH data(id) AS (                   -- Only 1st column gets explicit name
               (SELECT * FROM \"{$masterTenant}\".\"$tableName\")
               )
            , ups AS (
               INSERT INTO \"$tenantId\".\"$tableName\" AS t
               TABLE  data                       -- short for: SELECT * FROM data
               ON     CONFLICT (id) DO UPDATE
               SET    id = t.id
               WHERE  false                      -- never executed, but locks the row!
               RETURNING t.id
               )
            , del AS (
               DELETE FROM \"$tenantId\".\"$tableName\" AS t
               USING  data     d
               LEFT   JOIN ups u USING (id)
               WHERE  u.id IS NULL               -- not inserted!
               AND    t.id = d.id
               -- AND    t <> d                  -- avoid empty updates - only for full rows
               RETURNING t.id
               )
            , ins AS (
               INSERT INTO \"$tenantId\".\"$tableName\" AS t
               SELECT *
               FROM   data
               JOIN   del USING (id)             -- conflict impossible!
               RETURNING id
               )
            SELECT ARRAY(TABLE ups) AS inserted  -- with UPSERT
                 , ARRAY(TABLE ins) AS updated;  -- with DELETE & INSERT
        ";

    }
}
