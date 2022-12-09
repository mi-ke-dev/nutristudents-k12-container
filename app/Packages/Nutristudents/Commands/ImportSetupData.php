<?php

namespace Bytelaunch\Nutristudents\Commands;

use Bytelaunch\Nutristudents\Imports\NutristudentsK12SetupImport;
use Bytelaunch\Nutristudents\Models\Allergen;
use Bytelaunch\Nutristudents\Models\Component;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class ImportSetupData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nutri:importSetupData {--truncate}';

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
        if ($this->option('truncate')) {
            ray('trunc');
        }

//        Excel::fake();

        $excelPath = __DIR__ . '/../../../../database/xlsx/nutristudents.xlsx';
//        ray($excelPath);
        Excel::import(new NutristudentsK12SetupImport(), $excelPath);
    }
}
