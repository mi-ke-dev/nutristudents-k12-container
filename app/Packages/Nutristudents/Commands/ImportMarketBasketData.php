<?php

namespace Bytelaunch\Nutristudents\Commands;

use Bytelaunch\Nutristudents\Imports\NutristudentsK12Cn24Import;
use Bytelaunch\Nutristudents\Imports\NutristudentsK12InitImport;
use Bytelaunch\Nutristudents\Imports\NutristudentsK12MarketBasketImport;
use Bytelaunch\Nutristudents\Imports\NutristudentsK12SetupImport;
use Bytelaunch\Nutristudents\Models\Allergen;
use Bytelaunch\Nutristudents\Models\Category;
use Bytelaunch\Nutristudents\Models\Component;
use Bytelaunch\Nutristudents\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ImportMarketBasketData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nutri:importMarketBasket {--truncate}';

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
//            Category::truncate();
            echo "truncating...";
            Product::where('cn_code', null)->delete();
            DB::table('ingredient_product')->truncate();
        }

//        Excel::fake();

        $excelPath = __DIR__ . '/../../../../database/xlsx/marketbasket3.2.xlsx';

        Excel::import(new NutristudentsK12MarketBasketImport(), $excelPath);
    }
}
