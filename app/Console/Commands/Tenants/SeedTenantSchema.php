<?php

namespace App\Console\Commands\Tenants;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SeedTenantSchema extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schema:seed {source-tenant=default}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command hydrates a tenant database';

    protected $sourceTenant;
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
        $this->sourceTenant = $this->argument('source-tenant');


        $query = "
SELECT t1.tablename as tablename
FROM pg_catalog.pg_tables t1
WHERE
t1.schemaname LIKE '{$this->sourceTenant}'
";
        $results = DB::select($query);

//        echo $query;

        $excludeTables = [
            'calendar_days',
            'calendars',
            'password_resets',
            'meal_preparation_group_offerings',
            'meal_preparation_groups',
            'menu_creation_group_offerings',
            'menu_creation_groups',
            'taggables',
            'tags',
            'personal_access_tokens'
        ];

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
            "users",
        ];

        foreach ($results as $result) {

            $this->info($result->tablename);

            if (in_array($result->tablename, $excludeTables)) {
//                echo "skipping..."; continue;
                continue;
            }


            $statement = DB::select($this->getQuery($result->tablename));


            if (isset($statement['inserted'])) {
//                $this->line('Inserted: ' . count(explode(',', $statement['inserted'])));
//                $this->line('Updated: ' . count(explode(',', $statement['updated'])));
            } else {
//                print_r($statement);
            }
            // php artisan  a --table=users
            if (in_array($result->tablename, $idAutoIncrements)) {
                $defalutScema = config('database.connections.pg_tenant.schema' );
                // dd($defalutScema, $this->sourceTenant);
                Artisan::call('autoincrement:set-increment' , ['source-tenant'=> $this->sourceTenant, '--table' => $result->tablename]);
            }
        }

//        User::where('password', '!=', '')->update([
//            'password' => Hash::make('password')
//        ]);

        return 0;
    }

    private function getQuery($tableName)
    {
        $tenantId = tenant('id');
        return "
            WITH data(id) AS (                   -- Only 1st column gets explicit name
               (SELECT * FROM \"{$this->sourceTenant}\".$tableName)
               )
            , ups AS (
               INSERT INTO $tenantId.$tableName AS t
               TABLE  data                       -- short for: SELECT * FROM data
               ON     CONFLICT (id) DO UPDATE
               SET    id = t.id
               WHERE  false                      -- never executed, but locks the row!
               RETURNING t.id
               )
            , del AS (
               DELETE FROM $tenantId.$tableName AS t
               USING  data     d
               LEFT   JOIN ups u USING (id)
               WHERE  u.id IS NULL               -- not inserted!
               AND    t.id = d.id
               -- AND    t <> d                  -- avoid empty updates - only for full rows
               RETURNING t.id
               )
            , ins AS (
               INSERT INTO $tenantId.$tableName AS t
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
