<?php

namespace Bytelaunch\Nutristudents\Enum;

use Faker\Core\Number;

class CategoryEnum {
    public const ENTREE = 'Entree';
    public const MEAT = 'Meat';
    public const GRAIN = 'Grain';
    public const SIDE = 'Side';
    public const VEGETABLE = 'Vegetable';
    public const FRUIT = 'Fruit';
    public const MILK = 'Milk';
    public const SAUCE = 'Sauce';
    public const SALADBAR = 'Salad Bar';

    public static function options() : array
    {
        return [
            self::ENTREE => 'Entree',
            self::MEAT => 'Meat',
            self::GRAIN => 'Grain',
            self::SIDE => 'Side',
            self::SALADBAR => 'Salad Bar',            
            self::VEGETABLE => 'Vegetable',
            self::FRUIT => 'Fruit',
            self::MILK => 'Milk',
            self::SAUCE => 'Sauce',
        ];
    }

    public static function getNumber($cat)
    {
        $categories = array_keys(self::options());
        return array_search($cat, $categories);
    }
}
