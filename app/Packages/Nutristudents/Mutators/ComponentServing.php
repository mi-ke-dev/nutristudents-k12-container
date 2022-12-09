<?php


namespace App\Packages\Nutristudents\Mutators;


class ComponentServing
{
    public static function value($input) {
    
        //if ($input == "NaN") {
        if (is_nan($input)) {            
            return null;
        }

        return $input;
    }
}
