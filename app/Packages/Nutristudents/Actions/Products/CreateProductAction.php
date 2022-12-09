<?php


namespace Bytelaunch\Nutristudents\Actions\Products;

use Bytelaunch\Nutristudents\Getters\Tenants\GetCurrentTenantGetter;
use Bytelaunch\Nutristudents\Models\Allergen;
use Bytelaunch\Nutristudents\Models\Component;
use Bytelaunch\Nutristudents\Models\Distributor;
use Bytelaunch\Nutristudents\Models\Product;
use Bytelaunch\Nutristudents\Models\Tag;
use Bytelaunch\Nutristudents\Models\UnitOfMeasurement;
use Bytelaunch\Nutristudents\Models\Category;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;

class CreateProductAction
{

    private $tags = [];
    private $components = [];
    private $allergens = [];
    private $secondSubCategories = [];

    private $distrubutor;

    private ?string $name = null;
    private ?string $manufacturer = null;
    private ?string $manufacturerNumber = null;
    private ?string $gtin = null;
    private ?int $yield = null;
    private ?string $primaryCategoryId;
    private ?string $primarySubCategoryId;
    private ?float $caseWeight = null;    
    private ?float $subCaseWeight = null;
    private ?float $caseVolume = null;
    private ?float $subCaseVolume = null;
    private ?int $caseQuantity = null;
    private ?int $subCaseQuantity = null;
    private ?int $servingMeasurementWeight = null;
    private ?int $servingMeasurementVolume = null;
    private ?int $servingMeasurementUnit = null;
    private ?float $usdaComponentMeatServing = null;
    private ?float $usdaComponentGrainServing = null;
    private ?float $usdaComponentFruitServing = null;
    private ?float $usdaComponentMilkServing = null;
    private ?float $usdaComponentVegServing = null;
    private ?float $usdaComponentVegLegServing = null;
    private ?float $usdaComponentVegRedServing = null;
    private ?float $usdaComponentVegGrnServing = null;
    private ?float $usdaComponentVegStarServing = null;
    private ?float $usdaComponentVegOthrServing = null;
    private ?int $nutritionFactWeight = null;
    private ?int $nutritionFactVolume = null;
    private ?int $nutritionFactUnit = null;
    private ?float $nutritionFactCalories = null;
    private ?float $nutritionFactCalFat = null;
    private ?float $nutritionFactTotalFat = null;
    private ?float $nutritionFactSatFat = null;
    private ?float $nutritionFactTransFat = null;
    private ?float $nutritionFactPolySatFat = null;
    private ?float $nutritionFactMonoSatFat = null;
    private ?float $nutritionFactCholesterol = null;
    private ?float $nutritionFactSodium = null;
    private ?float $nutritionFactPotassium = null;
    private ?float $nutritionFactCarbs = null;
    private ?float $nutritionFactFiber = null;
    private ?float $nutritionFactSugar = null;
    private ?float $nutritionFactProtein = null;
    private ?float $nutritionFactVitaminA = null;
    private ?float $nutritionFactVitaminB6 = null;
    private ?float $nutritionFactVitaminB12 = null;
    private ?float $nutritionFactVitaminC = null;
    private ?float $nutritionFactVitaminD = null;
    private ?float $nutritionFactVitaminE = null;
    private ?float $nutritionFactCalcium = null;
    private ?float $nutritionFactIron = null;
    private ?float $nutritionFactMagnesium = null;
    private ?float $nutritionFactCoblamin = null;
    private ?float $nutritionFactThiamin = null;
    private ?float $nutritionFactRiboflavin = null;
    private ?float $nutritionFactNiacin = null;
    private ?float $nutritionFactZinc = null;
    private ?float $nutritionFactWater = null;
    private ?float $nutritionFactAsh = null;

    private ?string $caseWeightUomId = null;
    private ?string $subCaseWeightUomId = null;
    private ?string $caseVolumeUomId = null;
    private ?string $subCaseVolumeUomId = null;
    private ?string $servingMeasurementWeightUomId = null;
    private ?string $servingMeasurementVolumeUomId = null;
    private ?string $servingMeasurementUnitUomId = null;
    private ?string $nutritionFactWeightUomId = null;
    private ?string $nutritionFactVolumeUomId = null;
    private ?string $nutritionFactUnitUomId = null;
    private ?string $userId = null;

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
        $this->name = $name;
        return $this;
    }

    public function setUserId(?int $userId): self
    {
        $this->user_id = $userId;
        return $this;
    }

    public function setDistrubutor(Distributor $distrubutor): self
    {
        $this->distrubutor = $distrubutor;
        return $this;
    }

    public function setManufacturer(string $manufacturer): self
    {
        $this->manufacturer = $manufacturer;
        return $this;
    }

    public function setManufacturerNumber(string $manufacturerNumber): self
    {
        $this->manufacturerNumber = $manufacturerNumber;
        return $this;
    }

    public function setGTINNumber(string $gtin): self
    {
        $this->gtin = $gtin;
        return $this;
    }

    public function setYieldPercentage(?int $yield): self
    {
        $this->yield = $yield;
        return $this;
    }

    public function setPrimaryCategoryId(string $primaryCategoryId): self
    {
        $this->primaryCategoryId = $primaryCategoryId;
        return $this;
    }

    public function setPrimarySubCategoryId(string $primarySubCategoryId): self
    {
        $this->primarySubCategoryId = $primarySubCategoryId;
        return $this;
    }


    public function setCaseWeight(?float $caseWeight, UnitOfMeasurement $unitOfMeasurement): self
    {   
        $this->caseWeight = $caseWeight;
        $this->caseWeightUomId = $unitOfMeasurement->id;
        return $this;
    }

    public function setSubCaseWeight(?float $subCaseWeight, UnitOfMeasurement $unitOfMeasurement): self
    {
        $this->subCaseWeight = $subCaseWeight;
        $this->subCaseWeightUomId = $unitOfMeasurement->id;
        return $this;
    }

    public function setCaseVolume(?float $caseVolume, UnitOfMeasurement $unitOfMeasurement): self
    {
        $this->caseVolume = $caseVolume;
        $this->caseVolumeUomId = $unitOfMeasurement->id;
        return $this;
    }

    public function setSubCaseVolume(?float $subCaseVolume, UnitOfMeasurement $unitOfMeasurement): self
    {
        $this->subCaseVolume = $subCaseVolume;
        $this->subCaseVolumeUomId = $unitOfMeasurement->id;
        return $this;
    }

    public function setCaseQuantity(?int $caseQuantity): self
    {
        $this->caseQuantity = $caseQuantity;
        return $this;
    }

    public function setSubCaseQuantity(?int $subCaseQuantity): self
    {
        $this->subCaseQuantity = $subCaseQuantity;
        return $this;
    }

    public function setServingMeasurementWeight(?float $servingMeasurementWeight, UnitOfMeasurement $unitOfMeasurement): self
    {
        $this->servingMeasurementWeight = $servingMeasurementWeight;
        $this->servingMeasurementWeightUomId = $unitOfMeasurement->id;
        return $this;
    }

    public function setServingMeasurementVolume(?float $servingMeasurementVolume, UnitOfMeasurement $unitOfMeasurement): self
    {
        $this->servingMeasurementVolume = $servingMeasurementVolume;
        $this->servingMeasurementVolumeUomId = $unitOfMeasurement->id;
        return $this;
    }

    public function setServingMeasurementUnit(?float $servingMeasurementUnit, UnitOfMeasurement $unitOfMeasurement): self
    {
        $this->servingMeasurementUnit = $servingMeasurementUnit;
        $this->servingMeasurementUnitUomId = $unitOfMeasurement->id;
        return $this;
    }

    public function setUsdaComponentMeatServing(?float $usdaComponentMeatServing): self
    {
        $this->usdaComponentMeatServing = $usdaComponentMeatServing;
        return $this;
    }

    public function setUsdaComponentGrainServing(?float $usdaComponentGrainServing): self
    {
        $this->usdaComponentGrainServing = $usdaComponentGrainServing;
        return $this;
    }

    public function setUsdaComponentFruitServing(?float $usdaComponentFruitServing): self
    {
        $this->usdaComponentFruitServing = $usdaComponentFruitServing;
        return $this;
    }

    public function setUsdaComponentMilkServing(?float $usdaComponentMilkServing): self
    {
        $this->usdaComponentMilkServing = $usdaComponentMilkServing;
        return $this;
    }

    public function setUsdaComponentVegServing(?float $usdaComponentVegServing): self
    {
        $this->usdaComponentVegServing = $usdaComponentVegServing;
        return $this;
    }

    public function setUsdaComponentVegLegServing(?float $usdaComponentVegLegServing): self
    {
        $this->usdaComponentVegLegServing = $usdaComponentVegLegServing;
        return $this;
    }

    public function setUsdaComponentVegRedServing(?float $usdaComponentVegRedServing): self
    {
        $this->usdaComponentVegRedServing = $usdaComponentVegRedServing;
        return $this;
    }

    public function setUsdaComponentVegGrnServing(?float $usdaComponentVegGrnServing): self
    {
        $this->usdaComponentVegGrnServing = $usdaComponentVegGrnServing;
        return $this;
    }

    public function setUsdaComponentVegStarServing(?float $usdaComponentVegStarServing): self
    {
        $this->usdaComponentVegStarServing = $usdaComponentVegStarServing;
        return $this;
    }

    public function setUsdaComponentVegOthrServing(?float $usdaComponentVegOthrServing): self
    {
        $this->usdaComponentVegOthrServing = $usdaComponentVegOthrServing;
        return $this;
    }

    public function setNutritionFactWeight(?float $nutritionFactWeight, UnitOfMeasurement $unitOfMeasurement): self
    {
        $this->nutritionFactWeight = $nutritionFactWeight;
        $this->nutritionFactWeightUomId = $unitOfMeasurement->id;
        return $this;
    }

    public function setNutritionFactVolume(?float $nutritionFactVolume, UnitOfMeasurement $unitOfMeasurement): self
    {
        $this->nutritionFactVolume = $nutritionFactVolume;
        $this->nutritionFactVolumeUomId = $unitOfMeasurement->id;
        return $this;
    }

    public function setNutritionFactUnit(?float $nutritionFactUnit, UnitOfMeasurement $unitOfMeasurement): self
    {
        $this->nutritionFactUnit = $nutritionFactUnit;
        $this->nutritionFactUnitUomId = $unitOfMeasurement->id;
        return $this;
    }

    public function setNutritionFactCalories(?float $nutritionFactCalories): self
    {
        $this->nutritionFactCalories = $nutritionFactCalories;
        return $this;
    }

    public function setNutritionFactCalFat(?float $nutritionFactCalFat): self
    {
        $this->nutritionFactCalFat = $nutritionFactCalFat;
        return $this;
    }

    public function setNutritionFactTotalFat(?float $nutritionFactTotalFat): self
    {
        $this->nutritionFactTotalFat = $nutritionFactTotalFat;
        return $this;
    }

    public function setNutritionFactSatFat(?float $nutritionFactSatFat): self
    {
        $this->nutritionFactSatFat = $nutritionFactSatFat;
        return $this;
    }

    public function setNutritionFactTransFat(?float $nutritionFactTransFat): self
    {
        $this->nutritionFactTransFat = $nutritionFactTransFat;
        return $this;
    }

    public function setNutritionFactPolySatFat(?float $nutritionFactPolySatFat): self
    {
        $this->nutritionFactPolySatFat = $nutritionFactPolySatFat;
        return $this;
    }

    public function setNutritionFactMonoSatFat(?float $nutritionFactMonoSatFat): self
    {
        $this->nutritionFactMonoSatFat = $nutritionFactMonoSatFat;
        return $this;
    }

    public function setNutritionFactCholesterol(?float $nutritionFactCholesterol): self
    {
        $this->nutritionFactCholesterol = $nutritionFactCholesterol;
        return $this;
    }

    public function setNutritionFactSodium(?float $nutritionFactSodium): self
    {
        $this->nutritionFactSodium = $nutritionFactSodium;
        return $this;
    }

    public function setNutritionFactPotassium(?float $nutritionFactPotassium): self
    {
        $this->nutritionFactPotassium = $nutritionFactPotassium;
        return $this;
    }

    public function setNutritionFactCarbs(?float $nutritionFactCarbs): self
    {
        $this->nutritionFactCarbs = $nutritionFactCarbs;
        return $this;
    }

    public function setNutritionFactFiber(?float $nutritionFactFiber): self
    {
        $this->nutritionFactFiber = $nutritionFactFiber;
        return $this;
    }

    public function setNutritionFactSugar(?float $nutritionFactSugar): self
    {
        $this->nutritionFactSugar = $nutritionFactSugar;
        return $this;
    }

    public function setNutritionFactProtein(?float $nutritionFactProtein): self
    {
        $this->nutritionFactProtein = $nutritionFactProtein;
        return $this;
    }

    public function setNutritionFactVitaminA(?float $nutritionFactVitaminA): self
    {
        $this->nutritionFactVitaminA = $nutritionFactVitaminA;
        return $this;
    }

    public function setNutritionFactVitaminB6(?float $nutritionFactVitaminB6): self
    {
        $this->nutritionFactVitaminB6 = $nutritionFactVitaminB6;
        return $this;
    }

    public function setNutritionFactVitaminB12(?float $nutritionFactVitaminB12): self
    {
        $this->nutritionFactVitaminB12 = $nutritionFactVitaminB12;
        return $this;
    }

    public function setNutritionFactVitaminC(?float $nutritionFactVitaminC): self
    {
        $this->nutritionFactVitaminC = $nutritionFactVitaminC;
        return $this;
    }

    public function setNutritionFactVitaminD(?float $nutritionFactVitaminD): self
    {
        $this->nutritionFactVitaminD = $nutritionFactVitaminD;
        return $this;
    }

    public function setNutritionFactVitaminE(?float $nutritionFactVitaminE): self
    {
        $this->nutritionFactVitaminE = $nutritionFactVitaminE;
        return $this;
    }

    public function setNutritionFactCalcium(?float $nutritionFactCalcium): self
    {
        $this->nutritionFactCalcium = $nutritionFactCalcium;
        return $this;
    }

    public function setNutritionFactIron(?float $nutritionFactIron): self
    {
        $this->nutritionFactIron = $nutritionFactIron;
        return $this;
    }

    public function setNutritionFactMagnesium(?float $nutritionFactMagnesium): self
    {
        $this->nutritionFactMagnesium = $nutritionFactMagnesium;
        return $this;
    }

    public function setNutritionFactCoblamin(?float $nutritionFactCoblamin): self
    {
        $this->nutritionFactCoblamin = $nutritionFactCoblamin;
        return $this;
    }

    public function setNutritionFactThiamin(?float $nutritionFactThiamin): self
    {
        $this->nutritionFactThiamin = $nutritionFactThiamin;
        return $this;
    }

    public function setNutritionFactRiboflavin(?float $nutritionFactRiboflavin): self
    {
        $this->nutritionFactRiboflavin = $nutritionFactRiboflavin;
        return $this;
    }

    public function setNutritionFactNiacin(?float $nutritionFactNiacin): self
    {
        $this->nutritionFactNiacin = $nutritionFactNiacin;
        return $this;
    }

    public function setNutritionFactZinc(?float $nutritionFactZinc): self
    {
        $this->nutritionFactZinc = $nutritionFactZinc;
        return $this;
    }

    public function setNutritionFactWater(?float $nutritionFactWater): self
    {
        $this->nutritionFactWater = $nutritionFactWater;
        return $this;
    }

    public function setNutritionFactAsh(?float $nutritionFactAsh): self
    {
        $this->nutritionFactAsh = $nutritionFactAsh;
        return $this;
    }


    public function create(): Product
    {
        //dd($this->user_id);
        $tenant_id = (new GetCurrentTenantGetter)->first()->id;
        $product = Product::create([
            'tenant_id' => $tenant_id,
            'name' => $this->name,
            'manufacturer_sku' => $this->manufacturerNumber,
            'manufacturer' => $this->manufacturer,
            'gtin' => $this->gtin,
            'yield' => $this->yield,
            'primary_category_id' => $this->primaryCategoryId,
            'primary_sub_category_id' => $this->primarySubCategoryId,
            'case_volume' => $this->caseVolume,
            'case_weight' => $this->caseWeight,
            'nutrition_facts_ash' => $this->nutritionFactAsh,
            'nutrition_facts_calcium' => $this->nutritionFactCalcium,
            'nutrition_facts_calfat' => $this->nutritionFactCalFat,
            'nutrition_facts_calories' => $this->nutritionFactCalories,
            'nutrition_facts_carbs' => $this->nutritionFactCarbs,
            'nutrition_facts_cholesterol' => $this->nutritionFactCholesterol,
            'nutrition_facts_coblamin' => $this->nutritionFactCoblamin,
            'nutrition_facts_fiber' => $this->nutritionFactFiber,
            'nutrition_facts_iron' => $this->nutritionFactIron,
            'nutrition_facts_magnesium' => $this->nutritionFactMagnesium,
            'nutrition_facts_monosatfat' => $this->nutritionFactMonoSatFat,
            'nutrition_facts_niacin' => $this->nutritionFactNiacin,
            'nutrition_facts_polysatfat' => $this->nutritionFactPolySatFat,
            'nutrition_facts_potassium' => $this->nutritionFactPotassium,
            'nutrition_facts_protein' => $this->nutritionFactProtein,
            'nutrition_facts_riboflavin' => $this->nutritionFactRiboflavin,
            'nutrition_facts_satfat' => $this->nutritionFactSatFat,
            'nutrition_facts_sodium' => $this->nutritionFactSodium,
            'nutrition_facts_sugar' => $this->nutritionFactSugar,
            'nutrition_facts_thiamin' => $this->nutritionFactThiamin,
            'nutrition_facts_totalfat' => $this->nutritionFactTotalFat,
            'nutrition_facts_transfat' => $this->nutritionFactTransFat,
            'nutrition_facts_unit' => $this->nutritionFactUnit,
            'nutrition_facts_vitamina' => $this->nutritionFactVitaminA,
            'nutrition_facts_vitaminb12' => $this->nutritionFactVitaminB12,
            'nutrition_facts_vitaminb6' => $this->nutritionFactVitaminB6,
            'nutrition_facts_vitaminc' => $this->nutritionFactVitaminC,
            'nutrition_facts_vitamind' => $this->nutritionFactVitaminD,
            'nutrition_facts_vitamine' => $this->nutritionFactVitaminE,
            'nutrition_facts_volume' => $this->nutritionFactVolume,
            'nutrition_facts_water' => $this->nutritionFactWater,
            'nutrition_facts_weight' => $this->nutritionFactWeight,
            'nutrition_facts_zinc' => $this->nutritionFactZinc,
            'serving_measurement_unit' => $this->servingMeasurementUnit,
            'serving_measurement_volume' => $this->servingMeasurementVolume,
            'serving_measurement_weight' => $this->servingMeasurementWeight,
            'usda_componenent_serving_fruit' => $this->usdaComponentFruitServing,
            'usda_componenent_serving_milk' => $this->usdaComponentMilkServing,
            'usda_componenent_serving_grain' => $this->usdaComponentGrainServing,
            'usda_componenent_serving_meat' => $this->usdaComponentMeatServing,
            'usda_componenent_serving_veg' => $this->usdaComponentVegServing,
            'usda_componenent_serving_veggrn' => $this->usdaComponentVegGrnServing,
            'usda_componenent_serving_vegleg' => $this->usdaComponentVegLegServing,
            'usda_componenent_serving_vegothr' => $this->usdaComponentVegOthrServing,
            'usda_componenent_serving_vegred' => $this->usdaComponentVegRedServing,
            'usda_componenent_serving_vegstar' => $this->usdaComponentVegStarServing,
            'sub_case_weight' => $this->subCaseWeight,
            'sub_case_quantity' => $this->subCaseQuantity,
            'case_quantity' => $this->caseQuantity,
            'distributor_id' => $this->distrubutor,
            'sub_case_volume' => $this->subCaseVolume,
            'case_weight_uom_id' => $this->caseWeightUomId,
            'sub_case_weight_uom_id' => $this->subCaseWeightUomId,
            'case_volume_uom_id' => $this->caseVolumeUomId,
            'sub_case_volume_uom_id' => $this->subCaseVolumeUomId,
            'serving_measurement_weight_uom_id' => $this->servingMeasurementWeightUomId,
            'serving_measurement_volume_uom_id' => $this->servingMeasurementVolumeUomId,
            'serving_measurement_unit_uom_id' => $this->servingMeasurementUnitUomId,
            'nutrition_facts_weight_uom_id' => $this->nutritionFactWeightUomId,
            'nutrition_facts_volume_uom_id' => $this->nutritionFactVolumeUomId,
            'nutrition_facts_unit_uom_id' => $this->nutritionFactUnitUomId
            // ,
            // 'user_id' => $this->user_id
        ]);

        if (isset($this->distrubutor)) {
            $product = (new AssociateDistributorAction())
                ->forProduct($product)
                ->setDistributor($this->distrubutor)
                ->associate();
        }

        if (count($this->allergens) > 0) {
            $product = (new AttachAllergenAction)
                ->forProduct($product)
                ->attachAllergens($this->allergens)
                ->attach();
        }

        if (count($this->components) > 0) {
            $product = (new AttachComponentAction())
                ->forProduct($product)
                ->attachComponents($this->components)
                ->attach();
        }

        if (count($this->tags) > 0) {
            $product = (new AttachTagAction())
                ->forProduct($product)
                ->attachTags($this->tags)
                ->attach();
        }

        if (count($this->secondSubCategories) > 0) {
            $product = (new AttachSecondSubCategoryAction())
                ->forProduct($product)
                ->attachSecondSubCategories($this->secondSubCategories)
                ->attach();
        }

        return $product;


    }


}
