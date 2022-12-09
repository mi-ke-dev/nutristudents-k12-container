<?php


namespace Bytelaunch\Nutristudents\Getters\MenuCycle;

use Bytelaunch\Nutristudents\Getters\UnitOfMeasurement\GetUnitOfMeasurementGetter;
use Bytelaunch\Nutristudents\Models\FoodOrderStudentCount;
use Bytelaunch\Nutristudents\Models\Ingredient;
use Bytelaunch\Nutristudents\Models\Product;
use Bytelaunch\Nutristudents\Models\MenuCycle;
use Bytelaunch\Nutristudents\Models\MenuCycleDayOption;
use Bytelaunch\Nutristudents\Models\Recipe;
use Bytelaunch\Nutristudents\Models\UnitOfMeasurement;
use Illuminate\Support\Facades\DB;

class MenuCycleCalendarGetter
{
	private MenuCycle $menuCycle;

	public function forMenuCycle(MenuCycle $menuCycle): self
	{
		$this->menuCycle = $menuCycle;
		return $this;
	}

	public function get()
	{
		$this->menuCycle->load(['guideline', 'day','source', 'menuCycleDays.menuCycleDayOptions.menuCycleDayOptionComponents.foodOrderStudentCount'
		// , 'menuCycleDays.menuCycleDayOptions.menuCycleDayOptionComponents.recipe.ingredient_recipes.ingredient.prefer_product'
	]);
		$menu_cycle_all_days = array('', '', '', '', '', '', '');
		$menu_cycle = $this->menuCycle;
		$menu_cycle_mon_options = $menu_cycle_tue_options = $menu_cycle_wed_options = $menu_cycle_thu_options = $menu_cycle_fri_options = $menu_cycle_sat_options = $menu_cycle_sun_options = array();

		// return $menu_cycle;

		foreach ($menu_cycle->menuCycleDays as $menuCycleDay) {
			$menuCycleDay->append('is_assembly_instructions');
			// dd($menuCycleDay->IsAssemblyInstructions, $menuCycleDay->toArray());
			if ($menuCycleDay['day_of_week'] == 'MON') {
				
				
				$menu_cycle_all_days[0] = $menuCycleDay;
				
				$menu_cycle_mon_options = $menuCycleDay->menuCycleDayOptions;
				// $menuCycleDay->menuCycleDayOptions;

				$menu_cycle_mon_options->map(function ($item, $key) {
					$recipes = [];
					$item->menuCycleDayOptionComponents = $item->menuCycleDayOptionComponents->sortBy('recipe.category_sort');
					
					foreach ($item->menuCycleDayOptionComponents as $OptionComponent) {
						$recipes_arr = $OptionComponent->recipe;
						if($recipes_arr){
							$recipes_ar = $recipes_arr->toArray();
							$recipes_ar['option_component_id'] = $OptionComponent->id;
							$recipes_ar['prefer_products'] = $this->getRecipePreferProduct($recipes_arr);
							$recipes_ar['instructions'] = $OptionComponent->cooking_instructions;
							$recipes_ar['dont_count'] = json_decode($OptionComponent->exclude_from);
							$recipes_ar['smartsnack'] = $OptionComponent->smart_snack;

							$recipes_ar['is_override'] = $OptionComponent->is_override;
							$recipes_ar['total_val_override'] = $OptionComponent->total_val_override;
							$recipes_ar['student_count'] = $OptionComponent->student_count;
							$recipes[] = $recipes_ar;
						}
						
					}
					// $recipes = collect($recipes)->sortBy('category_sort')->toArray();
					// if( count($recipes) > 2)
					// dd($recipes);
					$item->recipes = $recipes;
					$item->photo = $item->photo_store_path;
					$item->sort = $item->sort_order;				
				});
				
				// $menu_cycle_mon_options->menuCycleDayOptionComponents = $menu_cycle_mon_options->menuCycleDayOptionComponents->sortBy('recipe.category_sort');
				// if( count($menu_cycle_mon_options) > 1)
				// 	dd($menu_cycle_mon_options->toArray());
				$menu_cycle_all_days[0]->options = $menu_cycle_mon_options;
 				// dd($menu_cycle_mon_options);                  
			}

			if ($menuCycleDay['day_of_week'] == 'TUE') {
				$menu_cycle_all_days[1] = $menuCycleDay;
				$menu_cycle_tue_options = $menuCycleDay->menuCycleDayOptions;
				
				//$menuCycleDay->menuCycleDayOptions;

				$menu_cycle_tue_options->map(function ($item, $key) {
					$recipes = array();
					$item->menuCycleDayOptionComponents = $item->menuCycleDayOptionComponents->sortBy('recipe.category_sort');

					foreach ($item->menuCycleDayOptionComponents as $OptionComponent) {
						
						$recipes_arr = $OptionComponent->recipe;
						if($recipes_arr){
							$recipes_ar = $recipes_arr->toArray();
						
							$recipes_ar['option_component_id'] = $OptionComponent->id;
							// $recipes_ar['meat_total'] = $this->getRecipeProductMeatTotal($recipes_ar['id']);
							// $recipes_ar['grain_total'] = $this->getRecipeProductGrainTotal($recipes_ar['id']);
							$recipes_ar['prefer_products'] = $this->getRecipePreferProduct($recipes_arr);
							$recipes_ar['instructions'] = $OptionComponent->cooking_instructions;
							$recipes_ar['dont_count'] = json_decode($OptionComponent->exclude_from);
							$recipes_ar['smartsnack'] = $OptionComponent->smart_snack;
							$recipes_ar['is_override'] = $OptionComponent->is_override;
							$recipes_ar['total_val_override'] = $OptionComponent->total_val_override;
							$recipes_ar['student_count'] = $OptionComponent->student_count;
							$recipes[] = $recipes_ar;
						}
					}
					$item->recipes = $recipes;
					$item->photo = $item->photo_store_path;
					$item->sort = $item->sort_order;
				});
				$menu_cycle_all_days[1]->options = $menu_cycle_tue_options;
			}

			if ($menuCycleDay['day_of_week'] == 'WED') {
				$menu_cycle_all_days[2] = $menuCycleDay;
				$menu_cycle_wed_options = $menuCycleDay->menuCycleDayOptions;

				$menu_cycle_wed_options->map(function ($item, $key) {
					$recipes = array();
					$item->menuCycleDayOptionComponents = $item->menuCycleDayOptionComponents->sortBy('recipe.category_sort');
					foreach ($item->menuCycleDayOptionComponents as $OptionComponent) {
						$recipes_arr = $OptionComponent->recipe;
						if($recipes_arr){
							$recipes_ar = $recipes_arr->toArray();
						

							$recipes_ar['option_component_id'] = $OptionComponent->id;
							// $recipes_ar['meat_total'] = $this->getRecipeProductMeatTotal($recipes_ar['id']);
							// $recipes_ar['grain_total'] = $this->getRecipeProductGrainTotal($recipes_ar['id']);
							$recipes_ar['prefer_products'] = $this->getRecipePreferProduct($recipes_arr);
							$recipes_ar['instructions'] = $OptionComponent->cooking_instructions;
							$recipes_ar['dont_count'] = json_decode($OptionComponent->exclude_from);
							$recipes_ar['smartsnack'] = $OptionComponent->smart_snack;
							$recipes_ar['is_override'] = $OptionComponent->is_override;
							$recipes_ar['total_val_override'] = $OptionComponent->total_val_override;
							$recipes_ar['student_count'] = $OptionComponent->student_count;

							$recipes[] = $recipes_ar;
						}
					}
					$item->recipes = $recipes;
					$item->photo = $item->photo_store_path;
					$item->sort = $item->sort_order;
				});
				$menu_cycle_all_days[2]->options = $menu_cycle_wed_options;
			}

			if ($menuCycleDay['day_of_week'] == 'THU') {
				$menu_cycle_all_days[3] = $menuCycleDay;
				$menu_cycle_thu_options = $menuCycleDay->menuCycleDayOptions;

				$menu_cycle_thu_options->map(function ($item, $key) {
					$recipes = array();
					$item->menuCycleDayOptionComponents = $item->menuCycleDayOptionComponents->sortBy('recipe.category_sort');
					foreach ($item->menuCycleDayOptionComponents as $OptionComponent) {
						$recipes_arr = $OptionComponent->recipe;
						if($recipes_arr){
							$recipes_ar = $recipes_arr->toArray();
						
							$recipes_ar['option_component_id'] = $OptionComponent->id;
							// $recipes_ar['meat_total'] = $this->getRecipeProductMeatTotal($recipes_ar['id']);
							// $recipes_ar['grain_total'] = $this->getRecipeProductGrainTotal($recipes_ar['id']);
							$recipes_ar['prefer_products'] = $this->getRecipePreferProduct($recipes_arr);
							$recipes_ar['instructions'] = $OptionComponent->cooking_instructions;
							$recipes_ar['dont_count'] = json_decode($OptionComponent->exclude_from);
							$recipes_ar['smartsnack'] = $OptionComponent->smart_snack;
							$recipes_ar['is_override'] = $OptionComponent->is_override;
							$recipes_ar['total_val_override'] = $OptionComponent->total_val_override;
							$recipes_ar['student_count'] = $OptionComponent->student_count;
							$recipes[] = $recipes_ar;
						}
					}
					$item->recipes = $recipes;
					$item->photo = $item->photo_store_path;
					$item->sort = $item->sort_order;
				});
				$menu_cycle_all_days[3]->options = $menu_cycle_thu_options;
			}

			if ($menuCycleDay['day_of_week'] == 'FRI') {
				$menu_cycle_all_days[4] = $menuCycleDay;
				$menu_cycle_fri_options = $menuCycleDay->menuCycleDayOptions;

				$menu_cycle_fri_options->map(function ($item, $key) {
					$recipes = array();
					$item->menuCycleDayOptionComponents = $item->menuCycleDayOptionComponents->sortBy('recipe.category_sort');
					foreach ($item->menuCycleDayOptionComponents as $OptionComponent) {
						$recipes_arr = $OptionComponent->recipe;
						if($recipes_arr){
							$recipes_ar = $recipes_arr->toArray();
						
							$recipes_ar['option_component_id'] = $OptionComponent->id;
							// $recipes_ar['meat_total'] = $this->getRecipeProductMeatTotal($recipes_ar['id']);
							// $recipes_ar['grain_total'] = $this->getRecipeProductGrainTotal($recipes_ar['id']);
							$recipes_ar['prefer_products'] = $this->getRecipePreferProduct($recipes_arr);
							$recipes_ar['instructions'] = $OptionComponent->cooking_instructions;
							$recipes_ar['dont_count'] = json_decode($OptionComponent->exclude_from);
							$recipes_ar['smartsnack'] = $OptionComponent->smart_snack;
							$recipes_ar['is_override'] = $OptionComponent->is_override;
							$recipes_ar['total_val_override'] = $OptionComponent->total_val_override;
							$recipes_ar['student_count'] = $OptionComponent->student_count;
							$recipes[] = $recipes_ar;
						}
					}
					$item->recipes = $recipes;
					$item->photo = $item->photo_store_path;
					$item->sort = $item->sort_order;
				});
				$menu_cycle_all_days[4]->options = $menu_cycle_fri_options;
			}

			if ($menuCycleDay['day_of_week'] == 'SAT') {
				$menu_cycle_all_days[5] = $menuCycleDay;
				$menu_cycle_sat_options = $menuCycleDay->menuCycleDayOptions;

				$menu_cycle_sat_options->map(function ($item, $key) {
					$recipes = array();
					$item->menuCycleDayOptionComponents = $item->menuCycleDayOptionComponents->sortBy('recipe.category_sort');

					foreach ($item->menuCycleDayOptionComponents as $OptionComponent) {
						$recipes_arr = $OptionComponent->recipe;
						if($recipes_arr){
							$recipes_ar = $recipes_arr->toArray();
						
							$recipes_ar['option_component_id'] = $OptionComponent->id;
							// $recipes_ar['meat_total'] = $this->getRecipeProductMeatTotal($recipes_ar['id']);
							// $recipes_ar['grain_total'] = $this->getRecipeProductGrainTotal($recipes_ar['id']);
							$recipes_ar['prefer_products'] = $this->getRecipePreferProduct($recipes_arr);
							$recipes_ar['instructions'] = $OptionComponent->cooking_instructions;
							$recipes_ar['dont_count'] = json_decode($OptionComponent->exclude_from);
							$recipes_ar['smartsnack'] = $OptionComponent->smart_snack;
							$recipes_ar['is_override'] = $OptionComponent->is_override;
							$recipes_ar['total_val_override'] = $OptionComponent->total_val_override;
							$recipes_ar['student_count'] = $OptionComponent->student_count;
							$recipes[] = $recipes_ar;
						}
					}
					$item->recipes = $recipes;
					$item->photo = $item->photo_store_path;
					$item->sort = $item->sort_order;
				});
				$menu_cycle_all_days[5]->options = $menu_cycle_sat_options;
			}

			if ($menuCycleDay['day_of_week'] == 'SUN') {
				$menu_cycle_all_days[6] = $menuCycleDay;
				$menu_cycle_sun_options = $menuCycleDay->menuCycleDayOptions;

				$menu_cycle_sun_options->map(function ($item, $key) {
					$recipes = array();
					$item->menuCycleDayOptionComponents = $item->menuCycleDayOptionComponents->sortBy('recipe.category_sort');
					
					foreach ($item->menuCycleDayOptionComponents as $OptionComponent) {
						$recipes_arr = $OptionComponent->recipe;
						if($recipes_arr){
							$recipes_ar = $recipes_arr->toArray();
						
							$recipes_ar['option_component_id'] = $OptionComponent->id;
							// $recipes_ar['meat_total'] = $this->getRecipeProductMeatTotal($recipes_ar['id']);
							// $recipes_ar['grain_total'] = $this->getRecipeProductGrainTotal($recipes_ar['id']);
							$recipes_ar['prefer_products'] = $this->getRecipePreferProduct($recipes_arr);
							$recipes_ar['instructions'] = $OptionComponent->cooking_instructions;
							$recipes_ar['dont_count'] = json_decode($OptionComponent->exclude_from);
							$recipes_ar['smartsnack'] = $OptionComponent->smart_snack;
							$recipes_ar['is_override'] = $OptionComponent->is_override;
							$recipes_ar['total_val_override'] = $OptionComponent->total_val_override;
							$recipes_ar['student_count'] = $OptionComponent->student_count;
							$recipes[] = $recipes_ar;
						}
					}
					$item->recipes = $recipes;
					$item->photo = $item->photo_store_path;
					$item->sort = $item->sort_order;
				});
				$menu_cycle_all_days[6]->options = $menu_cycle_sun_options;
			}
		}

		//dd($menu_cycle_tue_options);

		//setup other days and components...
		$menu_cycle->menuCycleDays = $menu_cycle_all_days;
		return $menu_cycle;
	}

	public function getRecipePreferProduct($recipe)
	{
		$prefer_products = array();

		// $ing_ids = DB::table('ingredient_recipe')->where('recipe_id', '=', $recipe_id)->get();
		$ing_ids = $recipe->ingredient_recipes;

		foreach ($ing_ids as $ing_id) {
			$IngredientData  = $ing_id->ingredient;
			// Ingredient::find($ing_id->ingredient_id);
			if (!empty($IngredientData)) {
				$prefer_product  = $IngredientData->prefer_product;
				// Product::find($IngredientData->prefer_product_id);
				if ($prefer_product) {

					$prefer_product->serving_amount = $ing_id->serving_amount;
					$prefer_product->serving_amount_uom = $this->getUOMNameByID($ing_id->serving_amount_uom_id);

					$prefer_product->serving_measurement_weight_uom_name = $this->getUOMNameByID($prefer_product->serving_measurement_weight_uom_id);
					$prefer_product->serving_measurement_volume_uom_name = $this->getUOMNameByID($prefer_product->serving_measurement_volume_uom_id);

					$prefer_product->usda_componenent_serving_meat = (!is_null($ing_id->usda_componenent_meat_override) && $ing_id->usda_componenent_meat_override >= 0) ? $ing_id->usda_componenent_meat_override : $ing_id->usda_componenent_meat;

					$prefer_product->usda_componenent_serving_grain = (!is_null($ing_id->usda_componenent_grain_override) && $ing_id->usda_componenent_grain_override >= 0) ? $ing_id->usda_componenent_grain_override : $ing_id->usda_componenent_grain;

					$prefer_product->usda_componenent_serving_fruit = (!is_null($ing_id->usda_componenent_fruit_override) && $ing_id->usda_componenent_fruit_override >= 0) ? $ing_id->usda_componenent_fruit_override : $ing_id->usda_componenent_fruit;

					$prefer_product->usda_componenent_serving_milk = (!is_null($ing_id->usda_componenent_milk_override) && $ing_id->usda_componenent_milk_override >= 0) ? $ing_id->usda_componenent_milk_override : $ing_id->usda_componenent_milk;

					$prefer_product->usda_componenent_serving_veg = (!is_null($ing_id->usda_componenent_veg_override) && $ing_id->usda_componenent_veg_override >= 0) ? $ing_id->usda_componenent_veg_override : $ing_id->usda_componenent_veg;

					$prefer_product->usda_componenent_serving_veggrn = (!is_null($ing_id->usda_componenent_veggrn_override) && $ing_id->usda_componenent_veggrn_override >= 0) ? $ing_id->usda_componenent_veggrn_override : $ing_id->usda_componenent_veggrn;

					$prefer_product->usda_componenent_serving_vegred = (!is_null($ing_id->usda_componenent_vegred_override) && $ing_id->usda_componenent_vegred_override >= 0) ? $ing_id->usda_componenent_vegred_override : $ing_id->usda_componenent_vegred;

					$prefer_product->usda_componenent_serving_vegleg = (!is_null($ing_id->usda_componenent_vegleg_override) && $ing_id->usda_componenent_vegleg_override >= 0) ? $ing_id->usda_componenent_vegleg_override : $ing_id->usda_componenent_vegleg;

					$prefer_product->usda_componenent_serving_vegstar = (!is_null($ing_id->usda_componenent_vegstar_override) && $ing_id->usda_componenent_vegstar_override >= 0) ? $ing_id->usda_componenent_vegstar_override : $ing_id->usda_componenent_vegstar;

					$prefer_product->usda_componenent_serving_vegothr = (!is_null($ing_id->usda_componenent_vegothr_override) && $ing_id->usda_componenent_vegothr_override >= 0) ? $ing_id->usda_componenent_vegothr_override : $ing_id->usda_componenent_vegothr;

					$prefer_products[] = $prefer_product;
				}
			}
		}

		return $prefer_products;
	}

	public function getRecipePreferProduct2($recipe_id)
	{
		$prefer_products = array();

		$ing_ids = DB::table('ingredient_recipe')->where('recipe_id', '=', $recipe_id)->get();

		foreach ($ing_ids as $ing_id) {
			$IngredientData  = Ingredient::find($ing_id->ingredient_id);
			if (!empty($IngredientData)) {
				$prefer_product  = Product::find($IngredientData->prefer_product_id);
				if ($prefer_product) {

					$prefer_product->serving_amount = $ing_id->serving_amount;
					$prefer_product->serving_amount_uom = $this->getUOMNameByID($ing_id->serving_amount_uom_id);

					$prefer_product->serving_measurement_weight_uom_name = $this->getUOMNameByID($prefer_product->serving_measurement_weight_uom_id);
					$prefer_product->serving_measurement_volume_uom_name = $this->getUOMNameByID($prefer_product->serving_measurement_volume_uom_id);

					$prefer_product->usda_componenent_serving_meat = (!is_null($ing_id->usda_componenent_meat_override) && $ing_id->usda_componenent_meat_override >= 0) ? $ing_id->usda_componenent_meat_override : $ing_id->usda_componenent_meat;

					$prefer_product->usda_componenent_serving_grain = (!is_null($ing_id->usda_componenent_grain_override) && $ing_id->usda_componenent_grain_override >= 0) ? $ing_id->usda_componenent_grain_override : $ing_id->usda_componenent_grain;

					$prefer_product->usda_componenent_serving_fruit = (!is_null($ing_id->usda_componenent_fruit_override) && $ing_id->usda_componenent_fruit_override >= 0) ? $ing_id->usda_componenent_fruit_override : $ing_id->usda_componenent_fruit;

					$prefer_product->usda_componenent_serving_milk = (!is_null($ing_id->usda_componenent_milk_override) && $ing_id->usda_componenent_milk_override >= 0) ? $ing_id->usda_componenent_milk_override : $ing_id->usda_componenent_milk;

					$prefer_product->usda_componenent_serving_veg = (!is_null($ing_id->usda_componenent_veg_override) && $ing_id->usda_componenent_veg_override >= 0) ? $ing_id->usda_componenent_veg_override : $ing_id->usda_componenent_veg;

					$prefer_product->usda_componenent_serving_veggrn = (!is_null($ing_id->usda_componenent_veggrn_override) && $ing_id->usda_componenent_veggrn_override >= 0) ? $ing_id->usda_componenent_veggrn_override : $ing_id->usda_componenent_veggrn;

					$prefer_product->usda_componenent_serving_vegred = (!is_null($ing_id->usda_componenent_vegred_override) && $ing_id->usda_componenent_vegred_override >= 0) ? $ing_id->usda_componenent_vegred_override : $ing_id->usda_componenent_vegred;

					$prefer_product->usda_componenent_serving_vegleg = (!is_null($ing_id->usda_componenent_vegleg_override) && $ing_id->usda_componenent_vegleg_override >= 0) ? $ing_id->usda_componenent_vegleg_override : $ing_id->usda_componenent_vegleg;

					$prefer_product->usda_componenent_serving_vegstar = (!is_null($ing_id->usda_componenent_vegstar_override) && $ing_id->usda_componenent_vegstar_override >= 0) ? $ing_id->usda_componenent_vegstar_override : $ing_id->usda_componenent_vegstar;

					$prefer_product->usda_componenent_serving_vegothr = (!is_null($ing_id->usda_componenent_vegothr_override) && $ing_id->usda_componenent_vegothr_override >= 0) ? $ing_id->usda_componenent_vegothr_override : $ing_id->usda_componenent_vegothr;

					$prefer_products[] = $prefer_product;
				}
			}
		}

		return $prefer_products;
	}

	public function getUOMNameByID($uomId = NULL)
	{ 
		if($uomId){
			return (new GetUnitOfMeasurementGetter())->setUnitId($uomId)->getName();
		}
		return $uomId;
			// return $uomname = ($uomId != NULL) ? UnitOfMeasurement::find($uomId)->name : NULL;
	}

	 
}
