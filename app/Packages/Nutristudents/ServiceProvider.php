<?php

namespace Bytelaunch\Nutristudents;
use Bytelaunch\Nutristudents\Commands\ImportCn24Data;
use Bytelaunch\Nutristudents\Commands\ImportInitData;
use Bytelaunch\Nutristudents\Commands\ImportMarketBasketData;
use Bytelaunch\Nutristudents\Commands\ImportSetupData;
use Bytelaunch\Nutristudents\Getters\Tenants\GetCurrentTenantGetter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Cache\CacheManager;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Exporter;
use Maatwebsite\Excel\Files\Filesystem;
use Maatwebsite\Excel\Files\TemporaryFileFactory;
use Maatwebsite\Excel\Importer;
use Maatwebsite\Excel\Mixins\DownloadCollection;
use Maatwebsite\Excel\Mixins\StoreCollection;
use Maatwebsite\Excel\QueuedWriter;
use Maatwebsite\Excel\Reader;
use Maatwebsite\Excel\Transactions\TransactionHandler;
use Maatwebsite\Excel\Transactions\TransactionManager;
use Maatwebsite\Excel\Writer;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

use Inertia\Inertia;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    //const CONFIG_PATH = __DIR__ . '/../config/nutristudents.php';

    public function boot() : void
    {
        $this->bootPublishes();
        $this->bootRoutes();
        $this->bootMigrations();
        $this->bootCommands();

        Inertia::share('asset_url', function () {
            // dd(global_asset('/'), asset('/'), tenant_asset('/'), config('app.asset_url'));
            // dd(trim(global_asset('') , '/') );
            return trim(global_asset('') , '/');
        });

        Inertia::share('storage_image_url', function () {
            $storage_path = Storage::url('/');
            return substr($storage_path, 0, -1);
        });

        Inertia::share('site_url', function () {
            return $url = URL::to("/");
        });

        Inertia::share('route_info_name', function () {
            return $route = Route::currentRouteName();
        });

        Inertia::share('isUserSuperAdmin', function () {
            if(Auth::user()){
            if(Auth::user()->type == "Super Admin"){
               return true;
            }
            }
            return false;
        });

        Inertia::share('template_permission', function () {
            if(Auth::user()){
               return Auth::user()->template_permissions->pluck('template_type')->toArray();
            }
            return [];
        });
        Inertia::share('is_master_tenant', function () {
            $cTenant = (new GetCurrentTenantGetter())->first();
            if($cTenant)
                return $cTenant->is_primary;
            
            return false;    
        });

    }

    public function register() : void
    {
        // $this->mergeConfigFrom(
        //     self::CONFIG_PATH,
        //     'nutristudents'
        // );

        $this->app->bind('nutristudents', function () {
            return new Nutristudents();
        });

        $this->app->register(\Maatwebsite\Excel\ExcelServiceProvider::class);

    }

    protected function bootPublishes(): self
    {
        // $this->publishes([
        //     __DIR__ . '/../resources/js' => resource_path('js')
        // ], 'nutristudents-views');

        // $this->publishes([
        //     self::CONFIG_PATH => config_path('nutristudents.php'),
        // ], 'config');
//
//        $this->publishes([
//            __DIR__ . '/../database/factories' => database_path('factories'),
//        ], 'nutristudents-seeds');

        // $this->publishes([
        //     __DIR__ . '/../database/migrations' => database_path('migrations'),
        // ], 'nutristudents-migrations');

        // $this->publishes([
        //     __DIR__ . '/../public' => public_path('vendor/nutristudents'),
        // ], 'public');

        return $this;
    }

    protected function bootMigrations(): self
    {
        //$this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        return $this;
    }


    protected function bootRoutes(): self
    {
        Route::group([
            'namespace' => 'Bytelaunch\Nutristudents\Http\Controllers',
        ], function () {
            $this->loadRoutesFrom(__DIR__ . '/../../../routes/nutristudents.php');
        });

        return $this;
    }

    protected function bootCommands(): self
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                ImportInitData::class,
                ImportSetupData::class,
                ImportCn24Data::class,
                ImportMarketBasketData::class,
            ]);
        }
        return $this;
    }



}
