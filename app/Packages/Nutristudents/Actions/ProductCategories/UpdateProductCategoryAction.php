<?php


namespace Bytelaunch\Nutristudents\Actions\ProductCategories;

use Bytelaunch\Nutristudents\Models\Category;

class UpdateProductCategoryAction
{
    private string $name;
    private Category $productcategory;
    private ?string $parent_id = null;

    public function setProductCategory(Category $category): self
    {
        $this->productcategory = $category;
        return $this;
    }

    public function setName(string $name): self
    {
        $this->productcategory->name = $name;
        return $this;
    }

    public function setParent($parent_cat_id): self
    {
        $this->productcategory->parent_id = $parent_cat_id;
        return $this;
    }


    public function update(): Category
    {
        $this->productcategory->save();
        $productcategory = $this->productcategory;
        return $productcategory;
    }
}
