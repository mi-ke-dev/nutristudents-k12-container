<?php
if (!function_exists('recipeConvertAccordingStudentCount')) {
  function recipeConvertAccordingStudentCount($sCount, $portion, $recipe)
  {
    // dd($recipe->toArray());
    $pArray = [0, $p1= $portion * 0.25, $p2= $portion * 0.5, $p3= $portion * 0.75];
    $recipeAmount = $recipe->recipe_amount;
    $recipeAmountUmo = $recipe->recipe_amount_uom_id;
    $rUmoName = ($recipe->recipeUnitOfMesurment)?$recipe->recipeUnitOfMesurment->name:'';
    $servingAmount = $recipe->serving_amount;
    $servingAmountUmo = $recipe->serving_amount_uom_id;
    $percentage = $sCount % $portion;
    $sUmoName = ($recipe->unitOfMesurment)?$recipe->unitOfMesurment->name:'';

    //dd($servingAmount);
    $unitArray = array("Cup", "Tablespoon", "Teaspoon", "Fluid Ounce", "Pint", "Quart", "Gallon");
    $weightArray = array("LB", "Gram", "Ounce");
    if (in_array($percentage,  $pArray)) {      
      $floor = $sCount / $portion;
      
      if(in_array($rUmoName, $unitArray, TRUE)){
        return convertToReadAbleFormForIngredients($recipeAmount * $floor, $rUmoName);
        
      }else if(in_array($rUmoName, $weightArray, TRUE)){
        return convertToReadAbleFormWeight($recipeAmount * $floor, $rUmoName);
        // return $recipeAmount * $floor . ' '.$rUmoName;
      }else{
        return $recipeAmount * $floor .' '.$rUmoName;
      }
      
    } else {
      $floor = floor($sCount / $portion);
      $totalAmount = $recipeAmount * $floor;
      $totalAmount2 = $servingAmount * $percentage;
      $newPercentage = $percentage;

      if($recipeAmountUmo == $servingAmountUmo){
        return decToFractionNew(round($totalAmount + $totalAmount2,2), $rUmoName); // .' '.$rUmoName;
      } 
      if($p3 < $percentage){
        $newPercentage = $percentage - $p3;
        $floor = $floor * 1.75;
      }
      elseif($p2 < $percentage){
        $newPercentage = $percentage - $p2;
        $floor = $floor * 1.5;
      }
      elseif($p1 < $percentage){
        $newPercentage = $percentage - $p1;
        $floor = $floor * 1.25;
      } 
      $totalAmount = $recipeAmount * $floor;
      $totalAmount2 = $servingAmount * $newPercentage; 
      if($totalAmount > 0){
        if(in_array($rUmoName, $unitArray, TRUE)){          
          return convertToReadAbleFormForIngredients($recipeAmount * $floor, $rUmoName);
        }else if(in_array($rUmoName, $weightArray, TRUE)){
          
          return convertToReadAbleFormWeight($recipeAmount * $floor, $rUmoName);
        }else{
          return round($totalAmount,2) .' '.$rUmoName .', '.round($totalAmount2,2) .' '.$sUmoName;
        }
        
      } else {
        // return 0;
        return decToFractionNew(round($totalAmount2,2), $sUmoName) ;// .' '.$sUmoName;
      }
       
    }
  }
}

function convertToReadAbleFormWeight($value,$unit){
  if($unit != null){
    if($unit == 'LB'){
      $convertInGram = floor($value * 453.592);
    }
    if($unit == 'Ounce'){
      $convertInGram = floor($value * 28.3495);
    }
    if($unit == 'Gram'){
      $convertInGram = floor($value * 1);
    }
    // return $convertInGram;
  
    $getlb = $convertInGram / 453.592;
    $lb_arr = explode('.',$getlb);
    $lb = $lb_arr[0];

    $remainderOfLB = $convertInGram % 453.592;
    $data = array();
    $lbarray = array();
    $ounceArray = array();
    $gramArray = array();
    if($remainderOfLB > 0){
      if($remainderOfLB > 0){
        $ounceArray = convertSizes($remainderOfLB, 28.3495);
        if($ounceArray['value'] > 0){
          $data[] = convertInUnit($ounceArray,'Ounce');
        }
      }
      if($ounceArray['remainder'] > 0){
        $gramArray = convertSizes($ounceArray['remainder'], 1);
        if($gramArray['value'] > 0){
          $data[] = convertInUnit($gramArray,'Grams');
        }
      }
    }
    if($lb > 0){
      return $lb.' LB, '. implode(', ',$data);
    }else{
      return implode(', ',$data);
    }
  }
}

function convertToReadAbleFormForIngredients($value,$unit){
  $unitArray = array("Cup", "Tablespoon", "Teaspoon", "Fluid Ounce", "Pint", "Quart", "Gallon");
  if($value != null && in_array($unit, $unitArray, TRUE)){
    //dd($unit);
  
    $multiplyFloatValueWithCount = $value;
    $convertInTeaSpoons = 0;
    
    if($multiplyFloatValueWithCount){
      if($unit == 'Cup'){
        $convertInTeaSpoons = $multiplyFloatValueWithCount * 48;
      }
      if($unit == 'Tablespoon'){
        $convertInTeaSpoons = $multiplyFloatValueWithCount * 3;
      }
      if($unit == 'Teaspoon'){
        $convertInTeaSpoons = $multiplyFloatValueWithCount * 1;
      }
      if($unit == 'Fluid Ounce'){
        $convertInTeaSpoons = $multiplyFloatValueWithCount * 6;
      }
      if($unit == 'Pint'){
        $convertInTeaSpoons = $multiplyFloatValueWithCount * 96;
      }
      if($unit == 'Quart'){
        $convertInTeaSpoons = $multiplyFloatValueWithCount * 192;
      }
      if($unit == 'Gallon'){
        $convertInTeaSpoons = $multiplyFloatValueWithCount * 769;
      }
    }
    $minTsp = 0;
    // return $multiplyFloatValueWithCount .'-'. $convertInTeaSpoons .' '.$unit;
    if(is_float($convertInTeaSpoons)){
      $whole = (int) $convertInTeaSpoons;  // 5
      $minTsp  = $convertInTeaSpoons - $whole;
    }
    // return $convertInTeaSpoons . ' '. $minTsp;
    
    $getGallons = $convertInTeaSpoons / 769;

    $gallon_arr = explode('.',$getGallons);
    $gallon = $gallon_arr[0];

    $remainderOfGallon = $convertInTeaSpoons % 769;
    $data = array();
    $quartsArray = array();
    $pintsArray = array();
    $cupsArray = array();
    $ouncesArray = array();
    $tableArray = array();
    $spoonArray = array();

    
    if($remainderOfGallon > 0){
      if($remainderOfGallon > 0){

        $cupsArray = convertSizes($remainderOfGallon, 48);    
        // dd($cupsArray);    
        if($cupsArray['value'] > 0){
          $data[] = convertInUnitInCups($cupsArray,'Cups');
        } 
        if($cupsArray['remainder'] >= 12){
          if($cupsArray['value'] == 0){
            $data[] = convertInUnitInCups($cupsArray,'Cups');
          }
          
          $c = cupsDeduct($cupsArray['remainder']);
          if($c > 0){
            $cupsArray['remainder'] = $cupsArray['remainder'] - $c;
          }
          
        } 
      }
      // dd($remainderOfGallon, $data);
      if(count($cupsArray) > 0 && $cupsArray['remainder'] > 0){
        $tableArray = convertSizes($cupsArray['remainder'], 3);
        if($tableArray['value'] > 0){
          $data[] = convertInUnit($tableArray,'Tablespoon');
        }          
      }
       
      if(count($tableArray) > 0 && $tableArray['remainder'] > 0){
        $spoonArray = convertSizes($tableArray['remainder'], 1);
        if($spoonArray['value'] > 0){
          $data[] = convertInUnitTeaspon($spoonArray,'Teaspoon', $minTsp);
        }  elseif($minTsp){
          $data[] = convertInUnitTeaspon($spoonArray,'Teaspoon', $minTsp);
        }      
      } else {
        $d = convertInUnitTeaspon($spoonArray,'Teaspoon', $minTsp);
        if($d != ''){
          $data[] = $d;
        }
        
      }
        
    }
    // dd($data);
    if($gallon > 0){
      return $gallon.' Gallons, '. implode(', ',$data);
    }else{
      return implode(', ',$data);
    }
    
  }else{
    return true;
  }

}

function convertInUnitTeaspon($array,$type, $minTsp = 0)
{
  $mArray = ['0.25' => '1/4', '0.5'=>'1/2', '0.75'=>'3/4'];
  $tsp = 0;
  $addMin = '';
  if($minTsp > 0){
    // return $minTsp;
    $m = MRound($minTsp, 4);
    // dd(array_keys($mArray));
    // return $m;
    if(in_array($m , array_keys($mArray))){
      $addMin = $mArray[(string) $m].' ';
    } else {
      $tsp = 1;
    }    
  }
  // if($addMin != ''){
  //   dd($addMin);
  // }
  $value = isset($array['value'])?$array['value']:0 + $tsp;
  if($value > 0){
    return $value.' '.$addMin.$type;
  } elseif($addMin != '') {
    return $addMin.$type;
  } else {
    return '';
  }

  
}

function MRound($num,$parts) {
  $res = $num * $parts;
  $res = ceil($res);
  return $res /$parts;
}

function cupsDeduct($reminder =0){
  if($reminder >= 36){
    return 36;
  } elseif($reminder >= 32){
    return 32;
  } elseif($reminder >= 24){
    return 24;
  } elseif($reminder >= 16){
    return 16;
  } elseif($reminder >= 12){
    return 12;
  } else {
    $reminder;
  }
}

function convertInUnitInCups($array,$type){
  $halfCups = [12 => '1/4', 16 => '1/3', 24=>'1/2', 32=>'2/3', 36=>'3/4'];
  if($array['remainder'] >= 12){
    $c= cupsDeduct($array['remainder']);
    if(isset($halfCups[$c])){
      if($array['value'] > 0)
        return $array['value'].' '.$halfCups[$c] .' '. $type;
      else {
        return $halfCups[$c] .' '. $type;
      }
    } else {
      return $array['value'].' '. $type;
    }
    // if($array['remainder'] >= 36){
    //   return $array['value'].' '.$halfCups[36] .' '. $type;
    // } elseif($array['remainder'] >= 32){
    //   return $array['value'].' '.$halfCups[32] .' '. $type;
    // } elseif($array['remainder'] >= 24){
    //   return $array['value'].' '.$halfCups[24] .' '. $type;
    // } elseif($array['remainder'] >= 16){
    //   return $array['value'].' '.$halfCups[16] .' '. $type;
    // } elseif($array['remainder'] >= 12){
    //   return $array['value'].' '.$halfCups[12] .' '. $type;
    // } else{
    //   return $array['value'].' '. $type;
    // }    
  }else{
    return $array['value'].' '.$type;
  }
}

function convertInUnit($array,$type){
  if($array['remainder'] > 0){
    return $array['value'].' '.$type;
  }else{
    return $array['value'].' '.$type;
  }
}

function convertSizes($value,$devided){
  $Value = $value / $devided;
  if($Value > 0 && is_decimal($Value)){ 
    $val_arry = explode('.',$Value);
    $firstVal = $val_arry[0];
    $remainder = $value % $devided;
    return array('value'=>$firstVal, 'remainder'=> $remainder);
  }else{
    return array('value'=>$Value, 'remainder'=> 0);
  }
}

function is_decimal( $val )
{
    return is_numeric( $val ) && floor( $val ) != $val;
}

function weekOfMonth($date) {
  //Get the first day of the month.
  $firstOfMonth = strtotime(date("Y-m-01", $date));
  //Apply above formula.
  return weekOfYear($date) - weekOfYear($firstOfMonth) + 1;
}

function weekOfYear($date) {
  $weekOfYear = intval(date("W", $date));
  if (date('n', $date) == "1" && $weekOfYear > 51) {
      // It's the last week of the previos year.
      return 0;
  }
  else if (date('n', $date) == "12" && $weekOfYear == 1) {
      // It's the first week of the next year.
      return 53;
  }
  else {
      // It's a "normal" week.
      return $weekOfYear;
  }
}

function decToFractionNew($recipeAmount = null, $rUmoName=null) {
  // return $float . ' '.$rUmoName;
  $unitArray = array("Cup", "Tablespoon", "Teaspoon", "Fluid Ounce", "Pint", "Quart", "Gallon");
    $weightArray = array("LB", "Gram", "Ounce");
    // return $recipeAmount  .' '.$rUmoName;

    if(in_array($rUmoName, $unitArray, TRUE)){
        return convertToReadAbleFormForIngredients($recipeAmount , $rUmoName);        
    }else if(in_array($rUmoName, $weightArray, TRUE)){
      return convertToReadAbleFormWeight($recipeAmount , $rUmoName);
    }else{
      return $recipeAmount  .' '.$rUmoName;
    }
}

function decToFraction($float = null, $umoName=null) {
  // 1/2, 1/4, 1/8, 1/16, 1/3 ,2/3, 3/4, 3/8, 5/8, 7/8, 3/16, 5/16, 7/16,
  // 9/16, 11/16, 13/16, 15/16
  // return $float . ' '.$umoName;
  if(is_int($float) || !$float)
    return $float;

  // if(!is_float($float))
  //     return gettype($float). $float;
  $float = floatval($float);
  $whole = floor ( $float );
  $decimal = $float - $whole;
  $leastCommonDenom = 48; // 16 * 3;
  $denominators = array (2, 3, 4, 8, 16, 24, 48 );
  $roundedDecimal = round ( $decimal * $leastCommonDenom ) / $leastCommonDenom;
  if ($roundedDecimal == 0)
      return $whole;
  if ($roundedDecimal == 1)
      return $whole + 1;
  foreach ( $denominators as $d ) {
      if ($roundedDecimal * $d == floor ( $roundedDecimal * $d )) {
          $denom = $d;
          break;
      }
  }
  return ($whole == 0 ? '' : $whole) . " " . ($roundedDecimal * $denom) . "/" . $denom;
}

 