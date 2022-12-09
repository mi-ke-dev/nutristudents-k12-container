<?php


namespace Bytelaunch\Nutristudents\Actions\Products;


use Bytelaunch\Nutristudents\Models\Allergen;
use Bytelaunch\Nutristudents\Models\Component;
use Bytelaunch\Nutristudents\Models\Distributor;
use Bytelaunch\Nutristudents\Models\Product;
use Bytelaunch\Nutristudents\Models\Tag;
use Bytelaunch\Nutristudents\Models\UnitOfMeasurement;
use Bytelaunch\Nutristudents\Models\Category;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;

class UpdateProductAction
{

    private $tags = [];
    private $components = [];
    private $allergens = [];
    private $secondSubCategories = [];

    private $distrubutor;

    // private ?string $name = null;
    // private ?string $manufacturer = null;
    // private ?string $manufacturerNumber = null;   
    // private ?string $gtin = null;
    // private ?int $yield = null; 
    // private ?string $primaryCategoryId;
    // private ?string $primarySubCategoryId;
    // private ?float $caseWeight = null;
    // private ?float $subCaseWeight = null;
    // private ?float $caseVolume = null;
    // private ?float $subCaseVolume = null;
    // private ?int $caseQuantity = null;
    // private ?int $subCaseQuantity = null;
    // private ?int $servingMeasurementWeight = null;
    // private ?int $servingMeasurementVolume = null;
    // private ?int $servingMeasurementUnit = null;
    // private ?float $usdaComponentMeatServing = null;
    // private ?float $usdaComponentGrainServing = null;
    // private ?float $usdaComponentFruitServing = null;
    // private ?float $usdaComponentMilkServing = null;
    // private ?float $usdaComponentVegServing = null;
    // private ?float $usdaComponentVegLegServing = null;
    // private ?float $usdaComponentVegRedServing = null;
    // private ?float $usdaComponentVegGrnServing = null;
    // private ?float $usdaComponentVegStarServing = null;
    // private ?float $usdaComponentVegOthrServing = null;
    // private ?int $nutritionFactWeight = null;
    // private ?int $nutritionFactVolume = null;
    // private ?int $nutritionFactUnit = null;
    // private ?float $nutritionFactCalories = null;
    // private ?float $nutritionFactCalFat = null;
    // private ?float $nutritionFactTotalFat = null;
    // private ?float $nutritionFactSatFat = null;
    // private ?float $nutritionFactTransFat = null;
    // private ?float $nutritionFactPolySatFat = null;
    // private ?float $nutritionFactMonoSatFat = null;
    // private ?float $nutritionFactCholesterol = null;
    // private ?float $nutritionFactSodium = null;
    // private ?float $nutritionFactPotassium = null;
    // private ?float $nutritionFactCarbs = null;
    // private ?float $nutritionFactFiber = null;
    // private ?float $nutritionFactSugar = null;
    // private ?float $nutritionFactProtein = null;
    // private ?float $nutritionFactVitaminA = null;
    // private ?float $nutritionFactVitaminB6 = null;
    // private ?float $nutritionFactVitaminB12 = null;
    // private ?float $nutritionFactVitaminC = null;
    // private ?float $nutritionFactVitaminD = null;
    // private ?float $nutritionFactVitaminE = null;
    // private ?float $nutritionFactCalcium = null;
    // private ?float $nutritionFactIron = null;
    // private ?float $nutritionFactMagnesium = null;
    // private ?float $nutritionFactCoblamin = null;
    // private ?float $nutritionFactThiamin = null;
    // private ?float $nutritionFactRiboflavin = null;
    // private ?float $nutritionFactNiacin = null;
    // private ?float $nutritionFactZinc = null;
    // private ?float $nutritionFactWater = null;
    // private ?float $nutritionFactAsh = null;

    // private ?string $caseWeightUomId = null;
    // private ?string $subCaseWeightUomId = null;
    // private ?string $caseVolumeUomId = null;
    // private ?string $subCaseVolumeUomId = null;
    // private ?string $servingMeasurementWeightUomId = null;
    // private ?string $servingMeasurementVolumeUomId = null;
    // private ?string $servingMeasurementUnitUomId = null;
    // private ?string $nutritionFactWeightUomId = null;
    // private ?string $nutritionFactVolumeUomId = null;
    // private ?string $nutritionFactUnitUomId = null;

    private Product $product;


    public function setProduct(Product $product): self
    {
        $this->product = $product;
        return $this;
    }

    public function attachAllergen(Allergen $allergen): self
    {
        $this->allergens[] = $allergen;
        return $this;
    }

    public function attachComponent(Component $component, Component $subComponent = null, $primary = false): self
    {
        // todo

        $this->components[] = $component;
        return $this;
    }

    public function attachSecondSubCategories(Category $secondSubCategories): self
    {
        $this->secondSubCategories[] = $secondSubCategories;
        return $this;
    }

    public function attachTag(string $tag): self
    {
        $tag = Tag::firstOrCreate(['name' => $tag]);
        $this->tags[] = $tag;
        return $this;
    }


    public function setName(string $name): self
    {
        $this->product->name = $name;
        return $this;
    }

    public function setDistrubutor(Distributor $distrubutor): self
    {
        $this->product->distributor_id = $distrubutor->id;
        return $this;
    }

    public function setManufacturer(string $manufacturer): self
    {
        $this->product->manufacturer = $manufacturer;
        return $this;
    }

    public function setManufacturerNumber(string $manufacturerNumber): self
    {
        $this->product->manufacturer_sku = $manufacturerNumber;
        return $this;
    }

    public function setGTINNumber(string $gtin): self
    {
        $this->product->gtin = $gtin;
        return $this;
    }

    public function setYieldPercentage(?int $yield): self
    {
        $this->product->yield = $yield;
        return $this;
    }

    public function setUserId(?int $user_id): self
    {
        $this->product->user_id = $user_id;
        return $this;
    }

    

    public function setPrimaryCategoryId(string $primaryCategoryId): self
    {
        $this->product->primary_category_id = $primaryCategoryId;
        return $this;
    }

    public function setPrimarySubCategoryId(string $primarySubCategoryId): self
    {
        $this->product->primary_sub_category_id = $primarySubCategoryId;
        return $this;
    }


    public function setCaseWeight(?float $caseWeight, UnitOfMeasurement $unitOfMeasurement): self
    {
        $this->product->case_weight = $caseWeight;
        $this->product->case_weight_uom_id = $unitOfMeasurement->id;
        return $this;
    }

    public function setSubCaseWeight(?float $subCaseWeight, UnitOfMeasurement $unitOfMeasurement): self
    {
        $this->product->sub_case_weight = $subCaseWeight;
        $this->product->sub_case_weight_uom_id = $unitOfMeasurement->id;
        return $this;
    }

    public function setCaseVolume(?float $caseVolume, UnitOfMeasurement $unitOfMeasurement): self
    {
        $this->product->case_volume = $caseVolume;
        $this->product->case_volume_uom_id  = $unitOfMeasurement->id;
        return $this;
    }

    public function setSubCaseVolume(?float $subCaseVolume, UnitOfMeasurement $unitOfMeasurement): self
    {
        $this->product->sub_case_volume = $subCaseVolume;
        $this->product->sub_case_volume_uom_id = $unitOfMeasurement->id;
        return $this;
    }

    public function setCaseQuantity(?int $caseQuantity): self
    {
        $this->product->case_quantity = $caseQuantity;
        return $this;
    }

    public function setSubCaseQuantity(?int $subCaseQuantity): self
    {
        $this->product->sub_case_quantity = $subCaseQuantity;
        return $this;
    }

    public function setServingMeasurementWeight(?float $servingMeasurementWeight, UnitOfMeasurement $unitOfMeasurement): self
    {
        $this->product->serving_measurement_weight = $servingMeasurementWeight;
        $this->product->serving_measurement_weight_uom_id = $unitOfMeasurement->id;        
        return $this;
    }

    public function setServingMeasurementVolume(?float $servingMeasurementVolume, UnitOfMeasurement $unitOfMeasurement): self
    {
        $this->product->serving_measurement_volume = $servingMeasurementVolume;
        $this->product->serving_measurement_volume_uom_id = $unitOfMeasurement->id;
        return $this;
    }

    public function setServingMeasurementUnit(?float $servingMeasurementUnit, UnitOfMeasurement $unitOfMeasurement): self
    {
        $this->product->serving_measurement_unit = $servingMeasurementUnit;
        $this->product->serving_measurement_unit_uom_id = $unitOfMeasurement->id;
        return $this;
    }

    public function setUsdaComponentMeatServing(?float $usdaComponentMeatServing): self
    {
        $this->product->usda_componenent_serving_meat = $usdaComponentMeatServing;
        return $this;
    }

    public function setUsdaComponentGrainServing(?float $usdaComponentGrainServing): self
    {
        $this->product->usda_componenent_serving_grain = $usdaComponentGrainServing;
        return $this;
    }

    public function setUsdaComponentFruitServing(?float $usdaComponentFruitServing): self
    {
        $this->product->usda_componenent_serving_fruit = $usdaComponentFruitServing;
        return $this;
    }

    public function setUsdaComponentMilkServing(?float $usdaComponentMilkServing): self
    {
        $this->product->usda_componenent_serving_milk = $usdaComponentMilkServing;
        return $this;
    }

    public function setUsdaComponentVegServing(?float $usdaComponentVegServing): self
    {
        $this->product->usda_componenent_serving_veg = $usdaComponentVegServing;
        return $this;
    }

    public function setUsdaComponentVegLegServing(?float $usdaComponentVegLegServing): self
    {
        $this->product->usda_componenent_serving_vegleg = $usdaComponentVegLegServing;
        return $this;
    }

    public function setUsdaComponentVegRedServing(?float $usdaComponentVegRedServing): self
    {
        $this->product->usda_componenent_serving_vegred = $usdaComponentVegRedServing;
        return $this;
    }

    public function setUsdaComponentVegGrnServing(?float $usdaComponentVegGrnServing): self
    {
        $this->product->usda_componenent_serving_veggrn = $usdaComponentVegGrnServing;
        return $this;
    }

    public function setUsdaComponentVegStarServing(?float $usdaComponentVegStarServing): self
    {
        $this->product->usda_componenent_serving_vegstar = $usdaComponentVegStarServing;
        return $this;
    }

    public function setUsdaComponentVegOthrServing(?float $usdaComponentVegOthrServing): self
    {
        $this->product->usda_componenent_serving_vegothr = $usdaComponentVegOthrServing;
        return $this;
    }

    public function setNutritionFactWeight(?float $nutritionFactWeight, UnitOfMeasurement $unitOfMeasurement): self
    {
        $this->product->nutrition_facts_weight = $nutritionFactWeight;
        $this->product->nutrition_facts_weight_uom_id = $unitOfMeasurement->id;
        return $this;
    }

    public function setNutritionFactVolume(?float $nutritionFactVolume, UnitOfMeasurement $unitOfMeasurement): self
    {
        $this->product->nutrition_facts_volume = $nutritionFactVolume;
        $this->product->nutrition_facts_volume_uom_id = $unitOfMeasurement->id;
        return $this;
    }

    public function setNutritionFactUnit(?float $nutritionFactUnit, UnitOfMeasurement $unitOfMeasurement): self
    {
        $this->product->nutrition_facts_unit = $nutritionFactUnit;
        $this->product->nutrition_facts_unit_uom_id = $unitOfMeasurement->id;
        return $this;
    }

    public function setNutritionFactCalories(?float $nutritionFactCalories): self
    {
        $this->product->nutrition_facts_calories = $nutritionFactCalories;
        return $this;
    }

    public function setNutritionFactCalFat(?float $nutritionFactCalFat): self
    {
        $this->product->nutrition_facts_calfat  = $nutritionFactCalFat;
        return $this;
    }

    public function setNutritionFactTotalFat(?float $nutritionFactTotalFat): self
    {
        $this->product->nutrition_facts_totalfat  = $nutritionFactTotalFat;
        return $this;
    }

    public function setNutritionFactSatFat(?float $nutritionFactSatFat): self
    {
        $this->product->nutrition_facts_satfat  = $nutritionFactSatFat;
        return $this;
    }

    public function setNutritionFactTransFat(?float $nutritionFactTransFat): self
    {
        $this->product->nutrition_facts_transfat  = $nutritionFactTransFat;
        return $this;
    }

    public function setNutritionFactPolySatFat(?float $nutritionFactPolySatFat): self
    {
        $this->product->nutrition_facts_polysatfat  = $nutritionFactPolySatFat;
        return $this;
    }

    public function setNutritionFactMonoSatFat(?float $nutritionFactMonoSatFat): self
    {
        $this->product->nutrition_facts_monosatfat  = $nutritionFactMonoSatFat;
        return $this;
    }

    public function setNutritionFactCholesterol(?float $nutritionFactCholesterol): self
    {
        $this->product->nutrition_facts_cholesterol  = $nutritionFactCholesterol;
        return $this;
    }

    public function setNutritionFactSodium(?float $nutritionFactSodium): self
    {
        $this->product->nutrition_facts_sodium  = $nutritionFactSodium;
        return $this;
    }

    public function setNutritionFactPotassium(?float $nutritionFactPotassium): self
    {
        $this->product->nutrition_facts_potassium  = $nutritionFactPotassium;
        return $this;
    }

    public function setNutritionFactCarbs(?float $nutritionFactCarbs): self
    {
        $this->product->nutrition_facts_carbs  = $nutritionFactCarbs;
        return $this;
    }

    public function setNutritionFactFiber(?float $nutritionFactFiber): self
    {
        $this->product->nutrition_facts_fiber  = $nutritionFactFiber;
        return $this;
    }

    public function setNutritionFactSugar(?float $nutritionFactSugar): self
    {
        $this->product->nutrition_facts_sugar  = $nutritionFactSugar;
        return $this;
    }

    public function setNutritionFactProtein(?float $nutritionFactProtein): self
    {
        $this->product->nutrition_facts_protein  = $nutritionFactProtein;
        return $this;
    }

    public function setNutritionFactVitaminA(?float $nutritionFactVitaminA): self
    {
        $this->product->nutrition_facts_vitamina  = $nutritionFactVitaminA;
        return $this;
    }

    public function setNutritionFactVitaminB6(?float $nutritionFactVitaminB6): self
    {
        $this->product->nutrition_facts_vitaminb6  = $nutritionFactVitaminB6;
        return $this;
    }

    public function setNutritionFactVitaminB12(?float $nutritionFactVitaminB12): self
    {
        $this->product->nutrition_facts_vitaminb12  = $nutritionFactVitaminB12;
        return $this;
    }

    public function setNutritionFactVitaminC(?float $nutritionFactVitaminC): self
    {
        $this->product->nutrition_facts_vitaminc  = $nutritionFactVitaminC;
        return $this;
    }

    public function setNutritionFactVitaminD(?float $nutritionFactVitaminD): self
    {
        $this->product->nutrition_facts_vitamind  = $nutritionFactVitaminD;
        return $this;
    }

    public function setNutritionFactVitaminE(?float $nutritionFactVitaminE): self
    {
        $this->product->nutrition_facts_vitamine  = $nutritionFactVitaminE;
        return $this;
    }

    public function setNutritionFactCalcium(?float $nutritionFactCalcium): self
    {
        $this->product->nutrition_facts_calcium  = $nutritionFactCalcium;
        return $this;
    }

    public function setNutritionFactIron(?float $nutritionFactIron): self
    {
        $this->product->nutrition_facts_iron  = $nutritionFactIron;
        return $this;
    }

    public function setNutritionFactMagnesium(?float $nutritionFactMagnesium): self
    {
        $this->product->nutrition_facts_magnesium  = $nutritionFactMagnesium;
        return $this;
    }

    public function setNutritionFactCoblamin(?float $nutritionFactCoblamin): self
    {
        $this->product->nutrition_facts_coblamin  = $nutritionFactCoblamin;
        return $this;
    }

    public function setNutritionFactThiamin(?float $nutritionFactThiamin): self
    {
        $this->product->nutrition_facts_thiamin  = $nutritionFactThiamin;
        return $this;
    }

    public function setNutritionFactRiboflavin(?float $nutritionFactRiboflavin): self
    {
        $this->product->nutrition_facts_riboflavin  = $nutritionFactRiboflavin;
        return $this;
    }

    public function setNutritionFactNiacin(?float $nutritionFactNiacin): self
    {
        $this->product->nutrition_facts_niacin  = $nutritionFactNiacin;
        return $this;
    }

    public function setNutritionFactZinc(?float $nutritionFactZinc): self
    {
        $this->product->nutrition_facts_zinc  = $nutritionFactZinc;
        return $this;
    }

    public function setNutritionFactWater(?float $nutritionFactWater): self
    {
        $this->product->nutrition_facts_water  = $nutritionFactWater;
        return $this;
    }

    public function setNutritionFactAsh(?float $nutritionFactAsh): self
    {
        $this->product->nutrition_facts_ash  = $nutritionFactAsh;
        return $this;
    }


    public function update(): Product
    {        
        $this->product->save();

        $product = $this->product;

        $product = (new SyncAllergenAction)
                ->forProduct($product)
                ->attachAllergens($this->allergens)
                ->attach();


        $product = (new SyncTagAction)
                ->forProduct($product)
                ->attachTags($this->tags)
                ->attach();


        // $product = (new SyncComponentAction())
        //         ->forProduct($product)
        //         ->attachComponents($this->components)
        //         ->attach();          

        $product = (new SyncSecondSubCategoryAction)
                ->forProduct($product)
                ->attachSecondSubCategories($this->secondSubCategories)
                ->attach();

        return $product;


    }


}
