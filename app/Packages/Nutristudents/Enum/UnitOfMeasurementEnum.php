<?php

namespace Bytelaunch\Nutristudents\Enum;

use Faker\Core\Number;

class UnitOfMeasurementEnum {

    public static function options() : array
    {
        return [
            'Tablespoon' => 'tbsp',
            'Teaspoon' => 'tsp',
            'Fluid' => 'fl',
            'Fluid Ounce' => 'fl oz',
            'Gallon' => 'gal',
            'Quart' => 'qt',
            'Ounce' => 'oz',
            'Gram' => 'g',
            'Each' => 'ea',
            'Pint' => 'pt',
            'LB' => 'lb',
            'Cup' => 'cup'
        ];
    }

    public static function getSortName($cat)
    {
        $opt = self::options();
        if(isset($opt[$cat])){
            return $opt[$cat];
        } else {
            return $cat;
        }
    }
}
