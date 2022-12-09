<?php


namespace Bytelaunch\Nutristudents\Getters\Permission;

class PermissionTemplate
{
    public static function options() : array
    {
        return [
            'week_cycles' => 'Week Cycles',
            'recipes' => 'Recipes',
            'ingredients' => 'Ingredients',
            'products' => 'Products'
        ];
    }
}
