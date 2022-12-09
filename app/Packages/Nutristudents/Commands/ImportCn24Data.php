<?php

namespace Bytelaunch\Nutristudents\Commands;

use Bytelaunch\Nutristudents\Imports\NutristudentsK12Cn24Import;
use Bytelaunch\Nutristudents\Imports\NutristudentsK12InitImport;
use Bytelaunch\Nutristudents\Imports\NutristudentsK12SetupImport;
use Bytelaunch\Nutristudents\Models\Allergen;
use Bytelaunch\Nutristudents\Models\Category;
use Bytelaunch\Nutristudents\Models\Component;
use Bytelaunch\Nutristudents\Models\Product;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class ImportCn24Data extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nutri:importCn24Data {--truncate}';

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
            Category::truncate();
            Product::truncate();
        }


        $excelPath = __DIR__ . '/../../../../database/xlsx/cn24.xlsx';

        Excel::import(new NutristudentsK12Cn24Import(), $excelPath);
    }
}
