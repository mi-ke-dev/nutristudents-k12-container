<?php


namespace Bytelaunch\Nutristudents\Actions\Products;


use Bytelaunch\Nutristudents\Models\Allergen;
use Bytelaunch\Nutristudents\Models\Component;
use Bytelaunch\Nutristudents\Models\Distributor;
use Bytelaunch\Nutristudents\Models\Product;
use Bytelaunch\Nutristudents\Models\Tag;
use Bytelaunch\Nutristudents\Models\UnitOfMeasurement;
use Bytelaunch\Nutristudents\Models\Category;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;

class SyncSecondSubCategoryAction
{

    private $secondSubCategories = [];
    private Product $product;


    public function forProduct(Product $product) : self
    {
        $this->product = $product;
        return $this;
    }

    public function attachSecondSubCategory(Category $secondSubCategories): self
    {
        $this->secondSubCategories[] = $secondSubCategories;
        return $this;
    }


    public function attachSecondSubCategories($secondSubCategories): self
    {
        $this->secondSubCategories = $secondSubCategories;
        return $this;
    }

    public function attach() : Product
    {
        if (count($this->secondSubCategories) > 0) {
            $this->product->categories()->sync(collect($this->secondSubCategories)->pluck('id')->toArray());
        }else{
            $this->product->categories()->sync([]);
        }

        return $this->product;
    }



}
