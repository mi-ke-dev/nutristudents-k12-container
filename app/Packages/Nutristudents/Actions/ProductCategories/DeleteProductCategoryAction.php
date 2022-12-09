<?php


namespace Bytelaunch\Nutristudents\Actions\ProductCategories;

use Bytelaunch\Nutristudents\Models\Category;

class DeleteProductCategoryAction
{
    private Category $productcategory;

    public function sourceProductCategory(Category $productcategory) : self
    {
        $this->productcategory = $productcategory;
        return $this;
    }

    public function deleteProductCategory()
    {
        $this->productcategory->delete();
    }

}
