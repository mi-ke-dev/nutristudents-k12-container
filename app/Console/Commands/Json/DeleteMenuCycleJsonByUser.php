<?php

namespace App\Console\Commands\Json;

use App\Models\User;
use Bytelaunch\Nutristudents\Actions\Json\JsonDeleteMenuCycleUserAction;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DeleteMenuCycleJsonByUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset-json:menu-cycle-json-by-user {user_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command hydrates a tenant database';

    protected $user_id;
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
        $this->user_id =   $this->argument('user_id');
        $user = User::find($this->user_id);
        ( new JsonDeleteMenuCycleUserAction)->setUser($user)->delete();
        // $table = $this->option('table');

        // $defalutScema = config('database.connections.pg_tenant.schema' );
        // // dd($defalutScema, $this->sourceTenant);

        // config(['database.connections.pg_tenant.schema' => $this->sourceTenant]);
        
        // $db = config('database.connections.pg_tenant.database');
        // DB::purge('pg_tenant');    
        // DB::reconnect('pg_tenant');

        // try {
        //     $results = DB::connection('pg_tenant')->select("SELECT  * FROM {$schema}.{$table};");
        //     $this->info(count($results));
        //     if(count($results) > 0){
        //       $r =   DB::connection('pg_tenant')->select("SELECT setval('{$schema}.{$table}_id_seq', max(id)) FROM {$schema}.{$table};");
        //       $this->line(json_encode($r));
        //       $this->line('Done');
        //     } else {
        //         $this->line('not record found');
        //     }
        // } catch (\Throwable $th) {
        //     $this->error('Error'. $th->getMessage());
        // }

        // config(['database.connections.pg_tenant.schema' => $defalutScema]);
        // DB::purge('pg_tenant');    
        // DB::reconnect('pg_tenant');
        // $this->line("COMPLETE");
        // return 0;
    }
}
