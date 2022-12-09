<?php

namespace Bytelaunch\Nutristudents\Imports\NutristudentsK12Data;

use Bytelaunch\Nutristudents\Actions\MenuCycleDayOptions\CreateOptionComponentAction;
use Bytelaunch\Nutristudents\Actions\MenuCycleOptions\CreateOptionAction;
use Bytelaunch\Nutristudents\Actions\MenuCycles\CreateMenuCycleAction;
use Bytelaunch\Nutristudents\Actions\MenuCycles\CreateMenuCycleForDayAction;
use Bytelaunch\Nutristudents\Models\Component;
use Bytelaunch\Nutristudents\Models\GradeRange;
use Bytelaunch\Nutristudents\Models\MenuCycle;
use Bytelaunch\Nutristudents\Models\MenuCycleDay;
use Bytelaunch\Nutristudents\Models\MenuCycleDayOption;
use Bytelaunch\Nutristudents\Models\Recipe;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMappedCells;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Row;

class WeekCyclesImport implements ToModel, WithMappedCells
{

    private $endRowOffSet = 60; //60

    public function mapping(): array
    {

        $map = [];
        $endRowOffSet = $this->endRowOffSet;


        $startRowSet1 = 4; // 3
        $startRowSet2 = 78; // 78
        $startRowSet3 = 152; // 152
        $startRowSet4 = 226; // 226


        // 4 day
        $map[] = $this->createMap('3 to 5', 'Planned Vegetables', 2 + 40 * 0, 40, $startRowSet1, $startRowSet1 + $endRowOffSet);
        $map[] = $this->createMap('6 to 8', 'Planned Vegetables', 2 + 40 * 0, 40, $startRowSet2, $startRowSet2 + $endRowOffSet);
        $map[] = $this->createMap('K to 8', 'Planned Vegetables', 2 + 40 * 0, 40, $startRowSet3, $startRowSet3 + $endRowOffSet);
        $map[] = $this->createMap('9 to 12', 'Planned Vegetables', 2 + 40 * 0, 40, $startRowSet4, $startRowSet4 + $endRowOffSet);

        // 5 day
        $startRowSet1 = 4; // 4
        $startRowSet2 = 77; // 77
        $startRowSet3 = 151; // 151
        $startRowSet4 = 225; // 225

        $map[] = $this->createMap('3 to 5', 'Planned Vegetables', 3 + 40 * 1, 40, $startRowSet1, $startRowSet1 + $endRowOffSet);
        $map[] = $this->createMap('6 to 8', 'Planned Vegetables', 3 + 40 * 1, 40, $startRowSet2, $startRowSet2 + $endRowOffSet);
        $map[] = $this->createMap('K to 8', 'Planned Vegetables', 3 + 40 * 1, 40, $startRowSet3, $startRowSet3 + $endRowOffSet);
        $map[] = $this->createMap('9 to 12', 'Planned Vegetables', 3 + 40 * 1, 40, $startRowSet4, $startRowSet4 + $endRowOffSet);

        // 7 day
        $startRowSet1 = 4; // 3
        $startRowSet2 = 78; // 78
        $startRowSet3 = 152; // 152
        $startRowSet4 = 226; // 226

        $map[] = $this->createMap('3 to 5', 'Planned Vegetables', 4 + 40 * 2, 40, $startRowSet1, $startRowSet1 + $endRowOffSet);
        $map[] = $this->createMap('6 to 8', 'Planned Vegetables', 4 + 40 * 2, 40, $startRowSet2, $startRowSet2 + $endRowOffSet);
        $map[] = $this->createMap('K to 8', 'Planned Vegetables', 4 + 40 * 2, 40, $startRowSet3, $startRowSet3 + $endRowOffSet);
        $map[] = $this->createMap('9 to 12', 'Planned Vegetables', 4 + 40 * 2, 40, $startRowSet4, $startRowSet4 + $endRowOffSet);


        // VEG BAR
        // 4 Day

        $map[] = $this->createMap('3 to 5', 'Veggie Bar', 6 + 40 * 3, 40, $startRowSet1, $startRowSet1 + $endRowOffSet);
        $map[] = $this->createMap('6 to 8', 'Veggie Bar', 6 + 40 * 3, 40, $startRowSet2, $startRowSet2 + $endRowOffSet);
        $map[] = $this->createMap('K to 8', 'Veggie Bar', 6 + 40 * 3, 40, $startRowSet3, $startRowSet3 + $endRowOffSet);
        $map[] = $this->createMap('9 to 12', 'Veggie Bar', 6 + 40 * 3, 40, $startRowSet4, $startRowSet4 + $endRowOffSet);

        $map[] = $this->createMap('3 to 5', 'Veggie Bar', 7 + 40 * 4, 40, $startRowSet1, $startRowSet1 + $endRowOffSet);
        $map[] = $this->createMap('6 to 8', 'Veggie Bar', 7 + 40 * 4, 40, $startRowSet2, $startRowSet2 + $endRowOffSet);
        $map[] = $this->createMap('K to 8', 'Veggie Bar', 7 + 40 * 4, 40, $startRowSet3, $startRowSet3 + $endRowOffSet);
        $map[] = $this->createMap('9 to 12', 'Veggie Bar', 7 + 40 * 4, 40, $startRowSet4, $startRowSet4 + $endRowOffSet);

        $map[] = $this->createMap('3 to 5', 'Veggie Bar', 8 + 40 * 5, 40, $startRowSet1, $startRowSet1 + $endRowOffSet);
        $map[] = $this->createMap('6 to 8', 'Veggie Bar', 8 + 40 * 5, 40, $startRowSet2, $startRowSet2 + $endRowOffSet);
        $map[] = $this->createMap('K to 8', 'Veggie Bar', 8 + 40 * 5, 40, $startRowSet3, $startRowSet3 + $endRowOffSet);
        $map[] = $this->createMap('9 to 12', 'Veggie Bar', 8 + 40 * 5, 40, $startRowSet4, $startRowSet4 + $endRowOffSet);

        $map = array_merge(...array_values($map));

        return $map;

    }


    public function model(array $row)
    {

        MenuCycle::truncate();
        MenuCycleDay::truncate();
        MenuCycleDayOption::truncate();
        Component::truncate();

        foreach (['Planned Vegetables', 'Veggie Bar'] as $planType) {
            foreach (['3 to 5', '6 to 8', 'K to 8', '9 to 12'] as $gradeRangeStr) {
                for ($weekNum = 1; $weekNum <= 40; $weekNum++) {

                    // find the grade range
                    $gradeRange = GradeRange::where('name', $gradeRangeStr)->firstOrFail();

                    // create the week cycle for the grade
                    $menuCycle = (new CreateMenuCycleAction())
                        ->setName("$planType - $gradeRangeStr - $weekNum")
                        ->setGradeRange($gradeRange)
                        ->create();

                    $recipes = [];
                    $recipeCounter = 0;

                    for ($recipeNum = 1; $recipeNum <= $this->endRowOffSet; $recipeNum++) {

                        $key = "{gradeRange: '$gradeRangeStr', planType: '$planType', weekCycle: '$weekNum', recipe: '$recipeNum'}";
                        $nsRecipe = $row[$key];

                        echo $key . ":" . $nsRecipe . "\n";

                        if ($nsRecipe == "") {
                            echo "❗ Uh oh. Blank Recipe \n";
                            $recipeCounter++;
                            continue;
                        }


                        $daysOfWeek = [
                            'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT', 'SUN'
                        ];

//                        $recipes['batch' . $recipeCounter][] = $nsRecipe;
                        $recipes[$daysOfWeek[$recipeCounter]][] = Recipe::where('ns_recipe', $nsRecipe)->firstOrFail();;
                    }


                    foreach ($recipes as $day => $recipeBatch) {

                        $day = (new CreateMenuCycleForDayAction)
                            ->forMenuCycle($menuCycle)
                            ->setDayOfWeek($day)
                            ->create();

                        $option = (new CreateOptionAction)
                            ->forMenuCycleDay($day)
                            ->setImage('/some/image/path.png') // todo
                            ->create();

                        $component = (new CreateOptionComponentAction)
                            ->forMenuCycleDayOption($option);

                        foreach ($recipeBatch as $recipe) {
                            $component = $component->attachRecipe($recipe, [], null, $smartSnack = false);
                        }

                        $component = $component->setSortOrder(1)->create();
                    }
                }
            }
        }
//        print_r($row);
//        exit;
        echo "Done! 👍";

    }

    public function createMap($gradeRange, $planType, $startColNum, $numColumns, $startRow, $endRow)
    {

        $cols = $this->getColSpan($startColNum, $numColumns);

        $map = [];


        foreach ($cols as $weekNum => $col) {

            $ingedientCount = 0;
            $weekNum = $weekNum + 1;
            for ($i = $startRow; $i <= $endRow; $i++) {
                $ingedientCount++;
                $map["{gradeRange: '$gradeRange', planType: '$planType', weekCycle: '$weekNum', recipe: '$ingedientCount'}"] = $col . $i;
            }
        }
        return $map;
    }

    public function getColSpan($startColNum, $numColumns)
    {

        $cols = [];

        for ($i = $startColNum - 1; $i <= $startColNum - 1 + $numColumns - 1; $i++) {
            $cols[] = $this->getExcelColumn($i);
        }
        return $cols;
    }

    public function getExcelColumn($n)
    {
        for ($r = ""; $n >= 0; $n = intval($n / 26) - 1)
            $r = chr($n % 26 + 0x41) . $r;

        return $r;
    }

}
