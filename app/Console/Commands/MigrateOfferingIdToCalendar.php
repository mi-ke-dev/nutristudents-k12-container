<?php

namespace App\Console\Commands;

use Bytelaunch\Nutristudents\Models\Calendar;
use Bytelaunch\Nutristudents\Models\Offering;
use Illuminate\Console\Command;

use Illuminate\Support\Facades\DB;

class MigrateOfferingIdToCalendar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Calendar:offering_id';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'All offering id update in calendar';

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
      $calendar_records = Calendar::get();
      foreach($calendar_records as $calendar){
        $site_id = $calendar->site_id;
        $guide_line_id = $calendar->guide_line_id;
        $offering = Offering::where('site_id', $site_id)->where('guideline_id',$guide_line_id)->get()->first();
        if($offering){
          $calendar->offering_id = $offering->id;
          $calendar->save();
        }
      }
    }
}
