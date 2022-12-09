<?php

declare(strict_types=1);

use Bytelaunch\Nutristudents\Actions\Tenants\MasterToReleaseTenantUpdateAction;
use Bytelaunch\Nutristudents\Actions\Tenants\SetTenantsIdAction;
use Bytelaunch\Nutristudents\Actions\Tenants\UpdateAllTenantsDataAction;
use Bytelaunch\Nutristudents\Http\Controllers\Auth\SimpleLoginController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
     

    // Route::post('/vapor/signed-storage-url', 
    //     '\Laravel\Vapor\Http\Controllers\SignedStorageUrlController@store'); // 👈 Add this
    Route::post('/vapor/signed-storage-url', '\Laravel\Vapor\Http\Controllers\SignedStorageUrlController@store');

});

Route::middleware([
    'web',
    'universal',
    'auth',
    InitializeTenancyByDomain::class,
])->group(function () {


//Sizing Calculator
    Route::get('/sizing-calculator', [Bytelaunch\Nutristudents\Http\Controllers\SizingCalculatorController::class, 'index'])->name('sizing-calculator');
    Route::get('/get-sizing-calculator-data', [Bytelaunch\Nutristudents\Http\Controllers\SizingCalculatorController::class, 'getRecord'])->name('get-sizing-calculator-data');
    Route::get('sizing-calculator/download-assembly-instructions/{menuCycleDayOption}', [Bytelaunch\Nutristudents\Http\Controllers\SizingCalculatorController::class, 'downloadAssemblyInstructionsForSizingCalculator'])->name('sizing-calculator.download-assembly-instructions');

    Route::get('sizing-calculator/download-recipe-card/{menuCycleDayOptionComponent}/{headCount?}', [Bytelaunch\Nutristudents\Http\Controllers\SizingCalculatorController::class, 'downloadRecipeCardForSizingCalculator'])->name('sizing-calculator.download-recipe-card');
    Route::get('sizing-calculator/download-card/{id}/{headCount?}', [Bytelaunch\Nutristudents\Http\Controllers\SizingCalculatorController::class, 'downloadRecipeCardForSizingCalculatorFromSearch'])->name('sizing-calculator.download-card');

    Route::get('sizing-calculator/export-all', [Bytelaunch\Nutristudents\Http\Controllers\SizingCalculatorController::class, 'exportAll'])->name('sizing-calculator.export-all');


    Route::get('/group-meal-prep', [Bytelaunch\Nutristudents\Http\Controllers\GroupMealPrepController::class, 'index'])->name('group-meal-prep');

    Route::get('/get-group-meal-prep-data', [Bytelaunch\Nutristudents\Http\Controllers\GroupMealPrepController::class, 'getRecord'])->name('get-group-meal-prep-data');

    Route::post('/export-prep-report', [Bytelaunch\Nutristudents\Http\Controllers\GroupMealPrepController::class, 'exportPrepReport'])->name('group-meal-prep.export-prep-report');

    Route::post('/export-prep-report-all', [Bytelaunch\Nutristudents\Http\Controllers\GroupMealPrepController::class, 'exportAll'])->name('group-meal-prep.export-all');


// FoodProductionReport
    Route::get('/food-production-report', [Bytelaunch\Nutristudents\Http\Controllers\FoodProductionReportController::class, 'index'])->name('food-production-report');

    Route::get('/get-food-production-report-data', [Bytelaunch\Nutristudents\Http\Controllers\FoodProductionReportController::class, 'getRecord'])->name('get-food-production-report-data');
    

//user info get header ajax:
    Route::post('/user-info', [Bytelaunch\Nutristudents\Http\Controllers\UserController::class, 'getCurrentUserInfo'])->name('user-info');

//healpstate info get header ajax:
    Route::post('/helpstate-info', [Bytelaunch\Nutristudents\Http\Controllers\HelpStateController::class, 'getCurrentHelpStateInfo'])->name('helpstate-info');


    Route::get('/products', [Bytelaunch\Nutristudents\Http\Controllers\ProductController::class, 'index'])->name('products');

    Route::post('/product-copy/{product}', [Bytelaunch\Nutristudents\Http\Controllers\ProductController::class, 'product_copy'])->name('product_copy');

    Route::post('/product-delete/{product}', [Bytelaunch\Nutristudents\Http\Controllers\ProductController::class, 'product_delete'])->name('product_delete');

    Route::post('/product-search-filter', [Bytelaunch\Nutristudents\Http\Controllers\ProductController::class, 'product_search_filter']);

    Route::get('/products-edit/id/{product}', [Bytelaunch\Nutristudents\Http\Controllers\ProductController::class, 'products_edit'])->name('products_edit');
    Route::post('/products-edit/id/{product}', [Bytelaunch\Nutristudents\Http\Controllers\ProductController::class, 'products_edit_save'])->name('products_edit_save');

    Route::get('/products-add', [Bytelaunch\Nutristudents\Http\Controllers\ProductController::class, 'products_add'])->name('products_add');
    Route::post('/products-add', [Bytelaunch\Nutristudents\Http\Controllers\ProductController::class, 'products_add_save'])->name('products_add_save');

    Route::post('/get_prod_subcategories', [Bytelaunch\Nutristudents\Http\Controllers\ProductController::class, 'get_prod_subcategories']);

    /**
     * Menu Creation Group
     */
    Route::get('/menu-creation-groups', [Bytelaunch\Nutristudents\Http\Controllers\MenuCreationGroupsController::class, 'index'])->name('menu-creation-groups');
    Route::get('/menu-creation-groups/add', [Bytelaunch\Nutristudents\Http\Controllers\MenuCreationGroupsController::class, 'create'])->name('menu-creation-groups.add');
    Route::post('/menu-creation-groups-add-save', [Bytelaunch\Nutristudents\Http\Controllers\MenuCreationGroupsController::class, 'store'])->name('menu-creation-groups-add-save');
    Route::post('/search-filter', [Bytelaunch\Nutristudents\Http\Controllers\MenuCreationGroupsController::class, 'searchFilter'])->name('search-filter');
    Route::get('/menu-creation-groups-edit/{id}', [Bytelaunch\Nutristudents\Http\Controllers\MenuCreationGroupsController::class, 'edit'])->name('menu-creation-groups-edit');
    Route::post('/menu-creation-groups-edit-save/{id}', [Bytelaunch\Nutristudents\Http\Controllers\MenuCreationGroupsController::class, 'update'])->name('menu-creation-groups-edit-save');
    Route::post('/group-delete/{group}', [Bytelaunch\Nutristudents\Http\Controllers\MenuCreationGroupsController::class, 'groupDelete'])->name('group-delete');
    Route::post('/search-site-offerings', [Bytelaunch\Nutristudents\Http\Controllers\MenuCreationGroupsController::class, 'siteOfferingSearch']);
   
    Route::post('/add-menu-creation-site-offering', [Bytelaunch\Nutristudents\Http\Controllers\MenuCreationGroupsController::class, 'addMenuCreationSiteOffering']);

    /**
     * Meal Preparation Group
     */
    Route::get('/meal-preparation-groups', [Bytelaunch\Nutristudents\Http\Controllers\MealPreparationGroupsController::class, 'index'])->name('meal-preparation-groups');
    Route::get('/meal-preparation-groups/add', [Bytelaunch\Nutristudents\Http\Controllers\MealPreparationGroupsController::class, 'create'])->name('meal-preparation-groups.add');
    Route::post('/meal-preparation-groups-add-save', [Bytelaunch\Nutristudents\Http\Controllers\MealPreparationGroupsController::class, 'store'])->name('meal-preparation-groups-add-save');
    Route::post('/meal-preparation-groups-search-site-offerings', [Bytelaunch\Nutristudents\Http\Controllers\MealPreparationGroupsController::class, 'searchSiteOffering']);

    Route::post('/meal-preparation-groups-search-filter', [Bytelaunch\Nutristudents\Http\Controllers\MealPreparationGroupsController::class, 'searchFilter'])->name('meal-preparation-groups-search-filter');


    Route::get('/meal-preparation-groups-edit/{id}', [Bytelaunch\Nutristudents\Http\Controllers\MealPreparationGroupsController::class, 'edit'])->name('meal-preparation-groups-edit');
    Route::post('/meal-preparation-groups-edit-save/{id}', [Bytelaunch\Nutristudents\Http\Controllers\MealPreparationGroupsController::class, 'update'])->name('meal-preparation-groups-edit-save');
    Route::post('/meal-preparation-groups-delete/{group}', [Bytelaunch\Nutristudents\Http\Controllers\MealPreparationGroupsController::class, 'groupDelete'])->name('meal-preparation-groups.group-delete');


// recipe routes define here *************************** //

    Route::get('/recipes', [Bytelaunch\Nutristudents\Http\Controllers\RecipeController::class, 'index'])->name('recipes');

    Route::post('/favorite-recipes', [Bytelaunch\Nutristudents\Http\Controllers\RecipeController::class, 'getFavorite'])->name('getFavorite');

    Route::get('/recipes-add', [Bytelaunch\Nutristudents\Http\Controllers\RecipeController::class, 'recipeAddMethod'])->name('recipes-add');
    Route::post('/recipes-add', [Bytelaunch\Nutristudents\Http\Controllers\RecipeController::class, 'recipeAddSaveMethod'])->name('recipes-add-save');

    Route::get('/recipes-edit/id/{recipe}', [Bytelaunch\Nutristudents\Http\Controllers\RecipeController::class, 'recipeEditMethod'])->name('recipes-edit');
    Route::post('/recipes-edit/id/{recipe}', [Bytelaunch\Nutristudents\Http\Controllers\RecipeController::class, 'recipeEditSaveMethod'])->name('recipes-edit-save');

    Route::post('/recipe-copy/{recipe}', [Bytelaunch\Nutristudents\Http\Controllers\RecipeController::class, 'recipeCopy'])->name('recipe-copy');

    Route::post('/recipe-delete/{recipe}', [Bytelaunch\Nutristudents\Http\Controllers\RecipeController::class, 'recipeDelete'])->name('recipe-delete');

    Route::post('/recipe-search-filter', [Bytelaunch\Nutristudents\Http\Controllers\RecipeController::class, 'recipeSearchFilter'])->name('recipe-search-filter');
    Route::post('/recipe-ingredient-search-modal', [Bytelaunch\Nutristudents\Http\Controllers\RecipeController::class, 'recipeIngredientSearchModal']);
    Route::post('/get_ingredient_prefer_product', [Bytelaunch\Nutristudents\Http\Controllers\RecipeController::class, 'get_ingredient_prefer_product']);
    Route::post('/get-recipe-haccps-names', [Bytelaunch\Nutristudents\Http\Controllers\RecipeController::class, 'getHaccpNamesAjax']);
    Route::post('/get-haccp-description-cooking-instructions', [Bytelaunch\Nutristudents\Http\Controllers\RecipeController::class, 'getHaccpDescriptionAjax']);
    Route::post('/get-selected-uom-type-values', [Bytelaunch\Nutristudents\Http\Controllers\RecipeController::class, 'getSelectedUOMTypeVals']);


    Route::get('/ingredients', [Bytelaunch\Nutristudents\Http\Controllers\IngredientController::class, 'index'])->name('ingredients');

    Route::get('/ingredients-add', [Bytelaunch\Nutristudents\Http\Controllers\IngredientController::class, 'ingredientAddMethod'])->name('ingredients-add');
    Route::post('/ingredients-add', [Bytelaunch\Nutristudents\Http\Controllers\IngredientController::class, 'ingredientAddSaveMethod'])->name('ingredients-add-save');;

    Route::get('/ingredients-edit/id/{ingredient}', [Bytelaunch\Nutristudents\Http\Controllers\IngredientController::class, 'ingredientEditMethod'])->name('ingredients-edit');
    Route::post('/ingredients-edit/id/{ingredient}', [Bytelaunch\Nutristudents\Http\Controllers\IngredientController::class, 'ingredientEditSaveMethod'])->name('ingredients-edit-save');

    Route::post('/ingredient-copy/{ingredient}', [Bytelaunch\Nutristudents\Http\Controllers\IngredientController::class, 'ingredientCopy'])->name('ingredient-copy');

    Route::post('/ingredient-delete/{ingredient}', [Bytelaunch\Nutristudents\Http\Controllers\IngredientController::class, 'ingredientDelete'])->name('ingredient-delete');

    Route::post('/ingredient-search-filter', [Bytelaunch\Nutristudents\Http\Controllers\IngredientController::class, 'ingredientSearchFilter'])->name('ingredient-search-filter');
    Route::post('/ingredient-product-search-modal', [Bytelaunch\Nutristudents\Http\Controllers\IngredientController::class, 'ingredientProductSearchModal']);


    Route::get('/haccp-snippets', [Bytelaunch\Nutristudents\Http\Controllers\HaccpController::class, 'index'])->name('haccp-snippets');

    Route::get('/haccp-snippet-add', [Bytelaunch\Nutristudents\Http\Controllers\HaccpController::class, 'create'])->name('haccp-snippet-add');
    Route::post('/haccp-snippet-add', [Bytelaunch\Nutristudents\Http\Controllers\HaccpController::class, 'store'])->name('haccp-snippet-add-save');

    Route::get('/haccp-snippet-edit/id/{haccp}', [Bytelaunch\Nutristudents\Http\Controllers\HaccpController::class, 'edit'])->name('haccp-snippet-edit');
    Route::post('/haccp-snippet-edit/id/{haccp}', [Bytelaunch\Nutristudents\Http\Controllers\HaccpController::class, 'update'])->name('haccp-snippet-edit-save');

    Route::post('/haccp-snippet-copy/{haccp}', [Bytelaunch\Nutristudents\Http\Controllers\HaccpController::class, 'copy'])->name('haccp-snippet-copy');

    Route::post('/haccp-snippet-delete/{haccp}', [Bytelaunch\Nutristudents\Http\Controllers\HaccpController::class, 'destroy'])->name('haccp-snippet-delete');

    Route::post('/haccp-search-filter', [Bytelaunch\Nutristudents\Http\Controllers\HaccpController::class, 'search'])->name('haccp-search-filter');


// group routes define here *************************** //
    Route::get('/groups', [Bytelaunch\Nutristudents\Http\Controllers\GroupController::class, 'index'])->name('groups');

    Route::get('/edit-group/id/{group}', [Bytelaunch\Nutristudents\Http\Controllers\GroupController::class, 'edit'])->name('edit-group');
    Route::post('/edit-group/id/{group}', [Bytelaunch\Nutristudents\Http\Controllers\GroupController::class, 'update'])->name('edit-group-save');

    Route::post('/group-search', [Bytelaunch\Nutristudents\Http\Controllers\GroupController::class, 'search'])->name('group-search');

    Route::post('/group-site-search-modal', [Bytelaunch\Nutristudents\Http\Controllers\GroupController::class, 'groupSiteSearchModal'])->name('group-site-search-modal');
    Route::post('/group-user-search-modal', [Bytelaunch\Nutristudents\Http\Controllers\GroupController::class, 'groupUserSearchModal'])->name('group-user-search-modal');


// site routes define here *************************** //
    Route::get('/sites', [Bytelaunch\Nutristudents\Http\Controllers\SiteController::class, 'index'])->name('sites');

    Route::get('/edit-site/id/{site}', [Bytelaunch\Nutristudents\Http\Controllers\SiteController::class, 'edit'])->name('edit-site');
    Route::post('/edit-site/id/{site}', [Bytelaunch\Nutristudents\Http\Controllers\SiteController::class, 'update'])->name('edit-site-save');

    Route::post('/site-search', [Bytelaunch\Nutristudents\Http\Controllers\SiteController::class, 'search'])->name('site-search');
    Route::post('/site-offering-get-guidelines', [Bytelaunch\Nutristudents\Http\Controllers\SiteController::class, 'siteOfferingGetGuidelines']);


// guidelines routes define here *************************** //
    Route::get('/guidelines', [Bytelaunch\Nutristudents\Http\Controllers\GuidelineController::class, 'index'])->name('guidelines');

    Route::get('/add-guideline', [Bytelaunch\Nutristudents\Http\Controllers\GuidelineController::class, 'create'])->name('add-guideline');
    Route::post('/add-guideline', [Bytelaunch\Nutristudents\Http\Controllers\GuidelineController::class, 'store'])->name('add-guideline-save');

    Route::get('/edit-guideline/id/{guideline}', [Bytelaunch\Nutristudents\Http\Controllers\GuidelineController::class, 'edit'])->name('edit-guideline');
    Route::post('/edit-guideline/id/{guideline}', [Bytelaunch\Nutristudents\Http\Controllers\GuidelineController::class, 'update'])->name('edit-guideline-save');

    Route::post('/copy-guideline/{guideline}', [Bytelaunch\Nutristudents\Http\Controllers\GuidelineController::class, 'copy'])->name('copy-guideline');

    Route::post('/delete-guideline/{guideline}', [Bytelaunch\Nutristudents\Http\Controllers\GuidelineController::class, 'destroy'])->name('delete-guideline');

    Route::post('/guideline-search', [Bytelaunch\Nutristudents\Http\Controllers\GuidelineController::class, 'search'])->name('guideline-search');


// week cycle list routes define here *************************** //
    Route::get('/week-cycles', [Bytelaunch\Nutristudents\Http\Controllers\WeekCycleController::class, 'index'])->name('week-cycles');
    Route::get('/menu-detail', [Bytelaunch\Nutristudents\Http\Controllers\WeekCycleController::class, 'menu_detail'])->name('menu-detail');

    Route::post('/week-cycle-list-filter', [Bytelaunch\Nutristudents\Http\Controllers\WeekCycleController::class, 'onWeekCycleListFilter']);
    Route::post('/week-cycle-user-list-filter', [Bytelaunch\Nutristudents\Http\Controllers\WeekCycleController::class, 'onWeekCycleUserListFilter']);

    Route::post('/get-week-cycle-list', [Bytelaunch\Nutristudents\Http\Controllers\WeekCycleController::class, 'getWeekCycleList']);

    Route::post('/week-cycle-delete/id/{menucycle}', [Bytelaunch\Nutristudents\Http\Controllers\WeekCycleController::class, 'delete'])->name('week-cycle-delete');

    Route::post('/week-cycle-duplicate/id/{menucycle}', [Bytelaunch\Nutristudents\Http\Controllers\WeekCycleController::class, 'duplicate'])->name('week-cycle-duplicate');


// add menu cycle routes define here *************************** //
    Route::get('/menu-cycle-add', [Bytelaunch\Nutristudents\Http\Controllers\MenuCycleController::class, 'index'])->name('menu-cycle-add');
    Route::post('/menu-cycle-add', [Bytelaunch\Nutristudents\Http\Controllers\MenuCycleController::class, 'store'])->name('menu-cycle-add-save');

    Route::get('/menu-cycle-edit/id/{menucycle}', [Bytelaunch\Nutristudents\Http\Controllers\MenuCycleController::class, 'edit'])->name('menu-cycle-edit');
    Route::post('/menu-cycle-edit/id/{menucycle}', [Bytelaunch\Nutristudents\Http\Controllers\MenuCycleController::class, 'update'])->name('menu-cycle-edit-save');
    Route::get('/menu-cycle-delete/id/{menucycle}', [Bytelaunch\Nutristudents\Http\Controllers\MenuCycleController::class, 'delete'])->name('menu-cycle-delete');
    Route::post('/menu-cycle-option-recipe-delete/id/{MenuCycleDayOptionComponent}', [Bytelaunch\Nutristudents\Http\Controllers\MenuCycleController::class, 'deleteMenuCycleDayOptionComponents'])->name('menu-cycle-day-option-component');


    Route::post('/menu-cycle-day-copy', [Bytelaunch\Nutristudents\Http\Controllers\MenuCycleController::class, 'copyDay'])->name('menu-cycle-day-copy');
    Route::post('/excluded-date', [Bytelaunch\Nutristudents\Http\Controllers\MenuCycleController::class, 'excludedDate'])->name('excluded-date');

    Route::post('/menu-cycle-delete-day', [Bytelaunch\Nutristudents\Http\Controllers\MenuCycleController::class, 'deleteDay'])->name('menu-cycle-delete-day');
    Route::get('/download-recipe-card/{id}', [Bytelaunch\Nutristudents\Http\Controllers\MenuCycleController::class, 'downloadRecipeCard'])->name('download-recipe-card');

    Route::get('/download-fpr/{id}', [Bytelaunch\Nutristudents\Http\Controllers\MenuCycleController::class, 'downloadFpr'])->name('download-fpr');
    Route::get('/download-assembly-instructions/{menuCycleDay}', [Bytelaunch\Nutristudents\Http\Controllers\MenuCycleController::class, 'downloadAssemblyInstructions'])->name('download-assembly-instructions');

    Route::post('/menu-cycle-option-delete/id/{menucycledayoption}', [Bytelaunch\Nutristudents\Http\Controllers\MenuCycleController::class, 'option_delete'])->name('menu-cycle-option-delete');

    Route::post('/menu-cycle-recipes-search-modal', [Bytelaunch\Nutristudents\Http\Controllers\MenuCycleController::class, 'menucycleRecipeSearchModal']);
    Route::post('/get_recipe_ingredient_prefer_product', [Bytelaunch\Nutristudents\Http\Controllers\MenuCycleController::class, 'getRecipeIngredientPreferProduct']);

    Route::post('/menu-cycle-get-meal-types', [Bytelaunch\Nutristudents\Http\Controllers\MenuCycleController::class, 'menuCycleGetMealTypes']);
    Route::post('/menu-cycle-get-offering-sites', [Bytelaunch\Nutristudents\Http\Controllers\MenuCycleController::class, 'menuCycleGetOfferingSites']);
    Route::post('/get-component-limits-from-guideline', [Bytelaunch\Nutristudents\Http\Controllers\MenuCycleController::class, 'getLimitsByGuideline']);
    Route::post('/get-offring', [Bytelaunch\Nutristudents\Http\Controllers\MenuCycleController::class, 'getOffrings']);
    Route::post('/get-offring-for-group', [Bytelaunch\Nutristudents\Http\Controllers\MenuCycleController::class, 'getOffringsForGroup']);
    Route::post('/get-guideline', [Bytelaunch\Nutristudents\Http\Controllers\MenuCycleController::class, 'getGuideline']);
    Route::post('/get-guideline-for-group', [Bytelaunch\Nutristudents\Http\Controllers\MenuCycleController::class, 'getGuidelineForGroup']);
    Route::get('/get-recipe-total-vals/{recipe_id}', [Bytelaunch\Nutristudents\Http\Controllers\MenuCycleController::class, 'getRecipeTotal']);

    Route::get('/help-states', [Bytelaunch\Nutristudents\Http\Controllers\HelpStateController::class, 'index'])->name('help-states');

    Route::get('/add-help-state', [Bytelaunch\Nutristudents\Http\Controllers\HelpStateController::class, 'create'])->name('add-help-state');
    Route::post('/add-help-state', [Bytelaunch\Nutristudents\Http\Controllers\HelpStateController::class, 'store'])->name('add-help-state-save');

    Route::get('/edit-help-state/id/{helpstate}', [Bytelaunch\Nutristudents\Http\Controllers\HelpStateController::class, 'edit'])->name('edit-help-state');
    Route::post('/edit-help-state/id/{helpstate}', [Bytelaunch\Nutristudents\Http\Controllers\HelpStateController::class, 'update'])->name('edit-help-state-save');

    Route::post('/delete-help-state/{helpstate}', [Bytelaunch\Nutristudents\Http\Controllers\HelpStateController::class, 'destroy'])->name('delete-help-state');

    Route::post('/search-help-state', [Bytelaunch\Nutristudents\Http\Controllers\HelpStateController::class, 'search'])->name('search-help-state');

    Route::get('/special-days', [Bytelaunch\Nutristudents\Http\Controllers\ExcludeDayController::class, 'index'])->name('special-days');

    Route::post('/no-meal-day', [Bytelaunch\Nutristudents\Http\Controllers\ExcludeDayController::class, 'noMealDay'])->name('no-meal-day');
    Route::post('/add-meal-day', [Bytelaunch\Nutristudents\Http\Controllers\ExcludeDayController::class, 'addMealDay'])->name('add-meal-day');

    Route::get('/add-special-days', [Bytelaunch\Nutristudents\Http\Controllers\ExcludeDayController::class, 'create'])->name('add-special-days');
    Route::post('/add-special-days', [Bytelaunch\Nutristudents\Http\Controllers\ExcludeDayController::class, 'store'])->name('add-special-days-save');
    Route::post('/delete-special-days/{ExcludeDay}', [Bytelaunch\Nutristudents\Http\Controllers\ExcludeDayController::class, 'destroy'])->name('delete-special-days');

    // calendars routes define here *************************** //
    Route::get('/menu-planner', [Bytelaunch\Nutristudents\Http\Controllers\CalendarsController::class, 'index'])->name('calendars');
    Route::get('/add-count', [Bytelaunch\Nutristudents\Http\Controllers\CalendarsController::class, 'add_count'])->name('add-count');
    Route::post('/get-menu-cycle-calender/{menuCycle}', [Bytelaunch\Nutristudents\Http\Controllers\CalendarsController::class, 'getMenuCycleDetail'])->name('getMenuCycleDetail');
    Route::post('/menu-planner/save-student-count', [Bytelaunch\Nutristudents\Http\Controllers\CalendarsController::class, 'saveStudentCount'])->name('menu-planner.saveStudentCount');

    Route::get('/load-menu-planner/{mealType}/{ageGradeOffering}/{day}/{month}/{year}/{site}/{guide_line_id}/{type?}/{offering_id?}', [Bytelaunch\Nutristudents\Http\Controllers\CalendarsController::class, 'loadMenuPlanner'])->name('load-menu-planner');

    Route::get('/load-menu-planner-by-week/{mealType}/{ageGradeOffering}/{day}/{month}/{year}/{site}/{guide_line_id}/{type?}/{offering_id?}/{weeks?}', [Bytelaunch\Nutristudents\Http\Controllers\CalendarsController::class, 'loadMenuPlannerByWeek'])->name('load-menu-planner-by-week');

    // Route::get('//{weeks?}', [Bytelaunch\Nutristudents\Http\Controllers\CalendarsController::class, 'loadMenuPlannerByWeek'])->name('load-menu-planner-by-week');

 
    Route::get('/load-exclude-dates/{site}/{guide_line_id}', [Bytelaunch\Nutristudents\Http\Controllers\CalendarsController::class, 'loadExcludeDates'])->name('load-exclude-dates');
    Route::get('/load-menu-search/{mealType}/{ageGradeOffering}/{day}/{month}/{year}/{site}/{search}', [Bytelaunch\Nutristudents\Http\Controllers\CalendarsController::class, 'loadMenuSearch'])->name('load-menu-search');


// setup(mealtype, age/grade, days) routes define here *************************** //
    Route::get('/setup', [Bytelaunch\Nutristudents\Http\Controllers\SetupController::class, 'index'])->name('setup');

    Route::post('/add-mealtype', [Bytelaunch\Nutristudents\Http\Controllers\SetupController::class, 'add_mealtype'])->name('add-mealtype-save');
    Route::post('/edit-mealtype', [Bytelaunch\Nutristudents\Http\Controllers\SetupController::class, 'edit_mealtype'])->name('edit-mealtype');
    Route::post('/edit-mealtype/id/{mealtype}', [Bytelaunch\Nutristudents\Http\Controllers\SetupController::class, 'update_mealtype'])->name('edit-mealtype-save');
    Route::post('/delete-mealtype/{mealtype}', [Bytelaunch\Nutristudents\Http\Controllers\SetupController::class, 'destroy_mealtype'])->name('delete-mealtype');


    Route::post('/add-agegrade-offering', [Bytelaunch\Nutristudents\Http\Controllers\SetupController::class, 'add_agegrade_offering'])->name('add-agegrade-offering-save');
    Route::post('/edit-agegrade-offering', [Bytelaunch\Nutristudents\Http\Controllers\SetupController::class, 'edit_agegrade_offering'])->name('edit-agegrade-offering');
    Route::post('/edit-agegrade-offering/id/{agegradeoffering}', [Bytelaunch\Nutristudents\Http\Controllers\SetupController::class, 'update_agegrade_offering'])->name('edit-agegrade-offering-save');
    Route::post('/delete-agegrade-offering/{agegradeoffering}', [Bytelaunch\Nutristudents\Http\Controllers\SetupController::class, 'destroy_agegrade_offering'])->name('delete-agegrade-offering');


    Route::post('/add-days', [Bytelaunch\Nutristudents\Http\Controllers\SetupController::class, 'add_days'])->name('add-days-save');
    Route::post('/edit-days', [Bytelaunch\Nutristudents\Http\Controllers\SetupController::class, 'edit_days'])->name('edit-days');
    Route::post('/edit-days/id/{days}', [Bytelaunch\Nutristudents\Http\Controllers\SetupController::class, 'update_days'])->name('edit-days-save');
    Route::post('/delete-days/{days}', [Bytelaunch\Nutristudents\Http\Controllers\SetupController::class, 'destroy_days'])->name('delete-days');

    Route::post('/search-offerings', [Bytelaunch\Nutristudents\Http\Controllers\GlobleController::class, 'SearchOffering']);

    Route::post('/search-groups', [Bytelaunch\Nutristudents\Http\Controllers\GlobleController::class, 'SearchGroups']);
});


Route::group(['middleware' => [
    'web',
    'universal',
    'auth',
    'useradmin',
    InitializeTenancyByDomain::class,
]], function () {

//group add/remove actions only for admin users:

    Route::get('/add-group', [Bytelaunch\Nutristudents\Http\Controllers\GroupController::class, 'create'])->name('add-group');
    Route::post('/add-group', [Bytelaunch\Nutristudents\Http\Controllers\GroupController::class, 'store'])->name('add-group-save');

    Route::post('/delete-group/{group}', [Bytelaunch\Nutristudents\Http\Controllers\GroupController::class, 'destroy'])->name('delete-group');

//site add/remove actions only for admin sites:

    Route::get('/add-site', [Bytelaunch\Nutristudents\Http\Controllers\SiteController::class, 'create'])->name('add-site');
    Route::post('/add-site', [Bytelaunch\Nutristudents\Http\Controllers\SiteController::class, 'store'])->name('add-site-save');

    Route::post('/delete-site/{site}', [Bytelaunch\Nutristudents\Http\Controllers\SiteController::class, 'destroy'])->name('delete-site');


// user routes define here *************************** //
    Route::get('/users', [Bytelaunch\Nutristudents\Http\Controllers\UserController::class, 'index'])->name('users');

    Route::get('/add-user', [Bytelaunch\Nutristudents\Http\Controllers\UserController::class, 'create'])->name('add-user');
    Route::post('/add-user', [Bytelaunch\Nutristudents\Http\Controllers\UserController::class, 'store'])->name('add-user-save');

    Route::get('/edit-user/id/{user}', [Bytelaunch\Nutristudents\Http\Controllers\UserController::class, 'edit'])->name('edit-user');
    Route::post('/edit-user/id/{user}', [Bytelaunch\Nutristudents\Http\Controllers\UserController::class, 'update'])->name('edit-user-save');

    Route::post('/delete-user/{user}', [Bytelaunch\Nutristudents\Http\Controllers\UserController::class, 'destroy'])->name('delete-user');

    Route::post('/user-search', [Bytelaunch\Nutristudents\Http\Controllers\UserController::class, 'search'])->name('user-search');

    Route::post('/user-site-search-modal', [Bytelaunch\Nutristudents\Http\Controllers\UserController::class, 'userSiteSearchModal'])->name('user-site-search-modal');
    Route::post('/user-group-search-modal', [Bytelaunch\Nutristudents\Http\Controllers\UserController::class, 'userGroupSearchModal'])->name('user-group-search-modal');



// help states routes define here *************************** //


// product subcategories routes define here *************************** //
    Route::get('/product-categories', [Bytelaunch\Nutristudents\Http\Controllers\ProductCategoryController::class, 'index'])->name('product-categories');

    Route::get('/add-product-category', [Bytelaunch\Nutristudents\Http\Controllers\ProductCategoryController::class, 'create'])->name('add-product-category');
    Route::post('/add-product-category', [Bytelaunch\Nutristudents\Http\Controllers\ProductCategoryController::class, 'store'])->name('add-product-category-save');

    Route::get('/edit-product-category/id/{category}', [Bytelaunch\Nutristudents\Http\Controllers\ProductCategoryController::class, 'edit'])->name('edit-product-category');
    Route::post('/edit-product-category/id/{category}', [Bytelaunch\Nutristudents\Http\Controllers\ProductCategoryController::class, 'update'])->name('edit-product-category-save');

    Route::post('/delete-product-category/{category}', [Bytelaunch\Nutristudents\Http\Controllers\ProductCategoryController::class, 'destroy'])->name('delete-product-category');

    Route::post('/prod-sub-category-search', [Bytelaunch\Nutristudents\Http\Controllers\ProductCategoryController::class, 'search'])->name('prod-sub-category-search');

    //Product Excel Import 
    Route::get('/product-world-Sync-excel-import', [Bytelaunch\Nutristudents\Http\Controllers\ProductImportController::class, 'worldSyncProduct1'])->name('product-world-Sync-excel-import');

    Route::post('/import_sync_product_store', [Bytelaunch\Nutristudents\Http\Controllers\ProductImportController::class, 'importSyncProductUploadStore'])->name('import_sync_product_store');

    //cn Product Import
    Route::get('/product-cn-excel-import', [Bytelaunch\Nutristudents\Http\Controllers\ProductImportController::class, 'cnProductImportExcel'])->name('product-cn-excel-import');

    Route::post('/import_cn_product_store', [Bytelaunch\Nutristudents\Http\Controllers\ProductImportController::class, 'importCnProductUploadStore'])->name('import_cn_product_store');
    

// product distributors routes define here *************************** //
    Route::get('/product-distributors', [Bytelaunch\Nutristudents\Http\Controllers\DistributorController::class, 'index'])->name('product-distributors');

    Route::get('/add-product-distributor', [Bytelaunch\Nutristudents\Http\Controllers\DistributorController::class, 'create'])->name('add-product-distributor');
    Route::post('/add-product-distributor', [Bytelaunch\Nutristudents\Http\Controllers\DistributorController::class, 'store'])->name('add-product-distributor-save');

    Route::get('/edit-product-distributor/id/{distributor}', [Bytelaunch\Nutristudents\Http\Controllers\DistributorController::class, 'edit'])->name('edit-product-distributor');
    Route::post('/edit-product-distributor/id/{distributor}', [Bytelaunch\Nutristudents\Http\Controllers\DistributorController::class, 'update'])->name('edit-product-distributor-save');

    Route::post('/delete-product-distributor/{distributor}', [Bytelaunch\Nutristudents\Http\Controllers\DistributorController::class, 'destroy'])->name('delete-product-distributor');

    Route::post('/search-product-distributor', [Bytelaunch\Nutristudents\Http\Controllers\DistributorController::class, 'search'])->name('search-product-distributor');


// food orders routes define here *************************** //
    Route::get('/food-orders', [Bytelaunch\Nutristudents\Http\Controllers\FoodOrderController::class, 'index'])->name('food-orders');
    Route::get('/foodorder-detail', [Bytelaunch\Nutristudents\Http\Controllers\FoodOrderController::class, 'food_order_deatil'])->name('foodorder-detail');

    Route::get('/add-food-order', [Bytelaunch\Nutristudents\Http\Controllers\FoodOrderController::class, 'addFoodOrderMethod'])->name('add-food-order');


    Route::get('/CreateFoodOrders', [Bytelaunch\Nutristudents\Http\Controllers\FoodOrderController::class, 'create'])->name('CreateFoodOrders');

    Route::get('/foodorderdetail-next', [Bytelaunch\Nutristudents\Http\Controllers\FoodOrderController::class, 'addFoodOrdernext'])->name('foodorderdetail-next');

    Route::get('/CreateFoodOrders-next', [Bytelaunch\Nutristudents\Http\Controllers\FoodOrderController::class, 'createFoodOrdernext'])->name('CreateFoodOrders-next');

    Route::get('/set-tenant-id', function() {
       (new SetTenantsIdAction)->add();
       echo "Done";die;
    });

    Route::any('/update-tenant-data', function() {
       (new MasterToReleaseTenantUpdateAction)->add();
    //    dd("Done");
       return redirect()->back();
    })->name('update-tenant-data');
    
});


Route::middleware([
    'web',
    'universal',
    InitializeTenancyByDomain::class,
])->group(function () {

    Route::get('/', function() {

        return redirect(route('login-simple'));
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');

    });

    Route::get('/menu', [Bytelaunch\Nutristudents\Http\Controllers\FrontPageController::class, 'getMenuPage'])->name('menu');

    Route::get('/home', [Bytelaunch\Nutristudents\Http\Controllers\FrontPageController::class, 'getMainHomePage'])->name('home');

    // Route::get('/secretlogin', function() {
    //     Auth::loginUsingId(1);
    //     redirect('/menu-planner');
    // });


    Route::get('/login-page', [SimpleLoginController::class, 'loginForm' ])->name('login');
    Route::post('/login-page', [SimpleLoginController::class, 'login' ])->name('login-simple');
});
