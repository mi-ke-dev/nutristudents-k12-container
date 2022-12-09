<?php

namespace App\Console\Commands\Database;

use App\Models\Tenant;
use App\Models\User;
use Bytelaunch\Nutristudents\Actions\Users\DeleteUserAction;
use Bytelaunch\Nutristudents\Models\Calendar;
use Bytelaunch\Nutristudents\Models\Offering;
use Bytelaunch\Nutristudents\Models\Product;
use Illuminate\Console\Command;

use Illuminate\Support\Facades\DB;

class RemoveCNDatabaseToComponentValue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remove:cn-compnents-value';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change admin mail.';

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
      $tenants = Tenant::get();
      foreach($tenants as $tenant)
      {
        $tenant->run(function($q){
          $pComp = [
            'usda_componenent_serving_meat' => null,
            'usda_componenent_serving_grain' => null,
            'usda_componenent_serving_fruit' => null,
            'usda_componenent_serving_veg' => null,
            'usda_componenent_serving_vegleg' => null,
            'usda_componenent_serving_vegred' => null,
            'usda_componenent_serving_veggrn' => null,
            'usda_componenent_serving_vegstar' => null,
            'usda_componenent_serving_vegothr' => null,
            'usda_componenent_serving_milk' => null,
            'tenant_id' => 'CN25'
          ];
            Product::whereNotNull('cn_code')
            ->update($pComp);
        });
      }

      $this->line('The CN products componenents are null');
    }
}
