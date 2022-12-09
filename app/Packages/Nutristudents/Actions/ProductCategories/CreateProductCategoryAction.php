<?php


namespace Bytelaunch\Nutristudents\Actions\ProductCategories;

use Bytelaunch\Nutristudents\Getters\Tenants\GetCurrentTenantGetter;
use Bytelaunch\Nutristudents\Models\Category;

class CreateProductCategoryAction
{
    private string $name;
    private ?string $parent_id = null;

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function setParent($parent_cat_id): self
    {
        $this->parent_id = $parent_cat_id;
        return $this;
    }


    public function create(): Category
    {
        $tenant_id = (new GetCurrentTenantGetter)->first()->id;

        $productcategory = Category::create([
            'tenant_id' => $tenant_id, 
            'name' => $this->name,
            'parent_id' => $this->parent_id,
        ]);

        return $productcategory;
    }
}
