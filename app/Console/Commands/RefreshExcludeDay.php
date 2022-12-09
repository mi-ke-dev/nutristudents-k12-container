<?php

namespace App\Console\Commands;

use Bytelaunch\Nutristudents\Models\ExcludeDay;
use Bytelaunch\Nutristudents\Models\Offering;
use Illuminate\Console\Command; 

class RefreshExcludeDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ExcludeDay:refresh';

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
        $exds = ExcludeDay::whereNull('offering_id')->whereNotNull('guide_line_id')->get();
        foreach($exds as $exd){
            $o = Offering::where('guideline_id', $exd->guide_line_id)
            ->where('site_id', $exd->site_id)
            ->first();
            if($o){
                $exd->offering_id = $o->id;
                $exd->save();
            }
        }
    }
}
