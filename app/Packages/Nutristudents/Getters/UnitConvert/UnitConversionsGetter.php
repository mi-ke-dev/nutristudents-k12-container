<?php
namespace Bytelaunch\Nutristudents\Getters\UnitConvert;



class UnitConversionsGetter
{

    public function getNutritionScaleFactor($ing_product) {  
        if(!$ing_product){
            return 1;
        }    
        // try {
        //     //code...
        //     $ing_amount = $ing_product->serving_amount;
        // } catch (\Exception $th) {
        //     //throw $th;
        //     dd($th->getMessage(), $ing_product);
        // }
        
        $ing_amount = $ing_product['serving_amount'];
        // dd($ing_amount, $ing_product->toArray());
         $ing_uom = $ing_product['serving_amount_uom'];
        //  dd($ing_product);
            
         $ing_uom_type = $this->uomType($ing_uom);
  
        if ($ing_amount === null) return 0;
  
         $base_amount = null;
         $base_uom = null;
  
        if ($ing_uom_type == "Unit"){
          if ($ing_product['preferred_product_information']->measurement_serving_unit !== null) {
          $base_amount = $ing_product['preferred_product_information']->measurement_serving_unit;
          $base_uom = $ing_product['preferred_product_information']->measurement_serving_unit_uom;
          }
        }
  
        if ($ing_uom_type == "Weight"){
          if($ing_product['preferred_product_information']->measurement_serving_volume !== null) {
          $base_amount = $ing_product['preferred_product_information']->measurement_serving_volume;
          $base_uom = $ing_product['preferred_product_information']->measurement_serving_volume_uom;
          }
          if($ing_product['preferred_product_information']->measurement_serving_weight !== null) {
          $base_amount = $ing_product['preferred_product_information']->measurement_serving_weight;
          $base_uom = $ing_product['preferred_product_information']->measurement_serving_weight_uom;
          }
        }
  
        if ($ing_uom_type == "Volume"){
          if($ing_product['preferred_product_information']->measurement_serving_weight !== null) {
          $base_amount = $ing_product['preferred_product_information']->measurement_serving_weight;
          $base_uom = $ing_product['preferred_product_information']->measurement_serving_weight_uom;
          }
          if($ing_product['preferred_product_information']->measurement_serving_volume !== null) {
          $base_amount = $ing_product['preferred_product_information']->measurement_serving_volume;
          $base_uom = $ing_product['preferred_product_information']->measurement_serving_volume_uom;
          }
        } 
        
        
         $newUom = $base_uom;
         $oldUom = $ing_uom;
  
         $newUomType = $this->uomType($newUom);
         $oldUomType = $this->uomType($oldUom);      
  
         $initAmount = $ing_amount;
         $newAmount = null;
  
        if ($newUomType === $oldUomType && $newUomType === 'Weight') {
          $newAmount = $this->weight($initAmount, $oldUom, $newUom);
        }
  
        if ($newUomType === $oldUomType && $newUomType === 'Volume') {
          $newAmount = $this->volume($initAmount, $oldUom, $newUom);
        }
  
        if ($newUomType === 'Weight' && $oldUomType === 'Volume') {
          $newAmount = $this->volumeToWeight($ing_product['preferred_product_information'], $initAmount, $oldUom, $newUom);
        }
  
        if ($newUomType === 'Volume' && $oldUomType === 'Weight') {
          $newAmount = $this->weightToVolume($ing_product['preferred_product_information'], $initAmount, $oldUom, $newUom);
        }
  
        if ($newUomType === $oldUomType && $newUomType === 'Unit') {
          $newAmount = $initAmount;
        }      
        // dd($newAmount , $base_amount);
        if(!$newAmount || !$base_amount){
            return 0;
        }
         $scale_factor =  $newAmount / $base_amount;
  
        // console.log('Nutrition_$scale_factor', $scale_factor);
  
        if(is_finite($scale_factor) && !is_nan($scale_factor) && $scale_factor !== null){        
          return $scale_factor;
        }else{
          return 0;
        }      
        
      }


      public function uomType($val) {
        $weight = [            
            'Ounce',
            'Gram',
            'LB',
        ];

        $volume = [
            'Gallon',
            'Quart',
            'Pint',
            'Cup',
            'Fluid Ounce',
            'Tablespoon',
            'Teaspoon',
        ];

        $unit = [            
            'Each',
        ];

        if (in_array($val, $unit))
        {
            return "Unit";
        }
        if (in_array($val, $volume) )
        {
            return "Volume";
        }
        if (in_array($val, $weight) )
        {
            return "Weight";
        }

        return "Not Found";
    }
    
    
      /**
     * Calculation start
     */
    public function roundByEight($result){
        return round(($result) * 8) / 8;
        // return (Math.round(($result) * 8) / 8).toFixed(3);
    }

    public function weight($initialWeight, $initialUom, $convertToUom) {

        $grams = $this->convertToGrams($initialWeight, $initialUom);

        $result = $this->convertFromGrams($grams, $convertToUom);

        return $result > 0 ? $result : null; // closes 0.125 : null

    }

    public function volume($initialVolume, $initialUom, $convertToUom) {

         $grams = $this->convertToTeaspoons($initialVolume, $initialUom);

         $result = $this->convertFromTeaspoons($grams, $convertToUom);

        return $result > 0 ? $result : null ;// closes 0.125 : null

    }

    public function volumeToWeight($preferredProduct, $recipeAmount, $recipeUom, $newUom) {
        // Convert Recipe Amount / UOM to preferred UOM
         $baseRecipeAmount = $this->volume($recipeAmount, $recipeUom, $preferredProduct->measurement_serving_volume_uom);

        // Convert preferred Weight UOM to preferred Volume UOM
         $scale = $preferredProduct->measurement_serving_volume / $preferredProduct->measurement_serving_weight;

        // Convert to final volume UOM
        $baseRecipeAmount = $baseRecipeAmount * $scale;

         $result = $this->weight($baseRecipeAmount, $preferredProduct->measurement_serving_weight_uom, $newUom);

        return $result;

    }

    public function weightToVolume($preferredProduct, $recipeAmount, $recipeUom, $newUom) {

        // Convert Recipe Amount / UOM to preferred UOM
         $baseRecipeAmount = $this->weight($recipeAmount, $recipeUom, $preferredProduct->measurement_serving_weight_uom);

        // Convert preferred Weight UOM to preferred Volume UOM
         $scale = $preferredProduct->measurement_serving_weight / $preferredProduct->measurement_serving_volume;

        // Convert to final volume UOM
        $baseRecipeAmount = $baseRecipeAmount * $scale;

         $result = $this->volume($baseRecipeAmount, $preferredProduct->measurement_serving_volume_uom, $newUom);

        return $result;

    }

    public function convertToGrams($initialWeight, $initialUom) {

        if ($initialUom === 'Gram') {
            return $initialWeight;
        }
        if ($initialUom === 'Ounce') {
            return $initialWeight * 28.34952;
        }
        if ($initialUom === 'Pound' || $initialUom === 'LB') {
            return $initialWeight * 453.59237;
        }

        // error
        return -1;
    }
    public function convertFromGrams($initialWeight, $convertToUom) {

        if ($convertToUom === 'Gram') {
            return $initialWeight;
        }
        if ($convertToUom === 'Ounce') {
            return $initialWeight / 28.34952;
        }
        if ($convertToUom === 'Pound' || $convertToUom === 'LB') {
            return $initialWeight / 453.59237;
        }

        // error
        return -1;
    }

    public function convertToTeaspoons($initialVolume, $initialUom) {

        if ($initialUom === 'Gallon') {
            return $initialVolume * 768;
        }
        if ($initialUom === 'Quart') {
            return $initialVolume * 192;
        }
        if ($initialUom === 'Pint') {
            return $initialVolume * 96;
        }
        if ($initialUom === 'Cup') {
            return $initialVolume * 48;
        }
        if ($initialUom === 'Fluid Ounce') {
            return $initialVolume * 6;
        }
        if ($initialUom === 'Tablespoon') {
            return $initialVolume * 3;
        }
        if ($initialUom === 'Teaspoon') {
            return $initialVolume * 1;
        }

        // error
        return -1;
    }
    public function convertFromTeaspoons($initialVolume, $convertToUom) {

        if ($convertToUom === 'Gallon') {
            return $initialVolume / 768;
        }
        if ($convertToUom === 'Quart') {
            return $initialVolume / 192;
        }
        if ($convertToUom === 'Pint') {
            return $initialVolume / 96;
        }
        if ($convertToUom === 'Cup') {
            return $initialVolume / 48;
        }
        if ($convertToUom === 'Fluid Ounce') {
            return $initialVolume / 6;
        }
        if ($convertToUom === 'Tablespoon') {
            return $initialVolume / 3;
        }
        if ($convertToUom === 'Teaspoon') {
            return $initialVolume / 1;
        }

        // error
        return -1;
    }
}

?>