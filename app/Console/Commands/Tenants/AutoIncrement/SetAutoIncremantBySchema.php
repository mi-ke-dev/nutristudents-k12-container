<?php

namespace App\Console\Commands\Tenants\AutoIncrement;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SetAutoIncremantBySchema extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schema:set-increment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command hydrates a tenant database';

    protected $sourceTenant;
    protected $table;
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
        // $this->sourceTenant = $this->argument('source-tenant');
        // $this->table = $this->option('table');

        // $this->line('sourceTenant = '. $this->sourceTenant);
        // $this->line('table = '. $this->table);

        // $this->line("SELECT setval('{$this->sourceTenant}.{$this->table}_id_seq', max(id)) FROM {$this->sourceTenant}.{$this->table};");

        // SELECT setval('users_id_seq', max(id)) FROM users;
        // $query = "
        // SELECT t1.tablename as tablename
        // FROM pg_catalog.pg_tables t1
        // WHERE
        // t1.schemaname LIKE '{$this->sourceTenant}'
        //     ";
            // $results = DB::select($query);
            $idAutoIncrements = [
                "allergen_product",
                "categories_product",
                "component_product",
                "grade_grade_range",
                "grade_menu_cycle",
                "group_site",
                "group_user",
                "ingredient_product",
                "ingredient_recipe",
                "meals",
                "migrations",
                "offering_site",
                "personal_access_tokens",
                "site_user",
                "user_permissions",
                "users"
            ];
            // $this->line( $results);
            $tenents = Tenant::get();
            foreach($tenents as $tenent){
                // $this->line( $tenent);
                foreach($idAutoIncrements as $tbl){
                    // $this->line( $tbl);
                    $this->setIncrementId($tenent->id, $tbl);
                    // Artisan::call('autoincrement:set-increment' , ['source-tenant'=> $tenent->id, '--table' => $tbl]);
                }
            }
            // foreach ($results as $result) {
            //     $this->info(' info ', $result->tablename);
            //     if (in_array($result->tablename, $idAutoIncrements)) {
                    
            //         $this->line($this->sourceTenant, $result->tablename);
            //         Artisan ::call('autoincrement:set-increment' , ['source-tenant'=> $this->sourceTenant, '--table' => $result->tablename]);
            //     }                
            // }

            $this->line("COMPLETE");
        return 0;
    }

    public function setIncrementId($schema, $table){
        config(['database.connections.pg_tenant.schema' => $schema]);
        $db = config('database.connections.pg_tenant.database');
        DB::purge('pg_tenant');    
        DB::reconnect('pg_tenant');
            $this->line("SELECT  max(id) FROM {$table};");
            try {
                $results = DB::connection('pg_tenant')->select("SELECT  * FROM {$schema}.{$table};");
            $this->info(count($results));
                if(count($results) > 0){
                  $r =   DB::connection('pg_tenant')->select("SELECT setval('{$schema}.{$table}_id_seq', max(id)) FROM {$schema}.{$table};");
                  $this->line(json_encode($r));
                  $this->line('in');
                }
            } catch (\Throwable $th) {
                $this->error('Error'. $th->getMessage());
            }
        $this->line('setIncrementId complete');
    }
}
