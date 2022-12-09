<?php

namespace App\Console\Commands;

use Bytelaunch\Nutristudents\Actions\MenuCycles\JsonStoreMenuCycleListAction;
use Bytelaunch\Nutristudents\Models\MenuCycle;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class RefreshMenuCycle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'menuCycle:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        

        try {
            $filePath = "json/menuCycle/";
            Storage::disk('s3')->deleteDirectory($filePath);
            $this->line($filePath.' flush');
        } catch (\Exception $th) {
            $this->line($th->getMessage());
        }

        try {
            $menuCycles = MenuCycle::get();
            foreach($menuCycles as $menuCycle){
                $filePath = "json/menuCycle/".$menuCycle->id .'.json';
                Cache::forget($filePath);
            }
            $this->line('cache flush');
        } catch (\Exception $th) {
            $this->line($th->getMessage());
        }
    }
}
