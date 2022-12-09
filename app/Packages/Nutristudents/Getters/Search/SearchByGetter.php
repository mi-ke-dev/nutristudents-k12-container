<?php


namespace Bytelaunch\Nutristudents\Getters\Search;


use Bytelaunch\Nutristudents\Models\Recipe;
use Illuminate\Support\Str;

class SearchByGetter
{
    public function search($query, $key, $vals = "")
    {
        if($vals && $vals != ''){
            $valsArray = explode(' ', $vals);
            foreach($valsArray as $valArray){                
                $query->where(function($q) use($valArray, $key){
                    $singular = Str::singular(strtolower($valArray));
                    $plural = Str::plural(strtolower($valArray));
                    $q->whereRaw("LOWER($key) LIKE '%" . strtolower($valArray) . "%'");
                    $q->orWhereRaw("LOWER($key) LIKE '%" . strtolower($singular) . "%'");
                    $q->orWhereRaw("LOWER($key) LIKE '%" . strtolower($plural) . "%'");
                });
            }
        }
        return $query;
    }


}
