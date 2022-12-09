<?php


namespace Bytelaunch\Nutristudents\Actions\Products;

use Bytelaunch\Nutristudents\Getters\Tenants\GetCurrentTenantGetter;
use Bytelaunch\Nutristudents\Models\Allergen;
use Bytelaunch\Nutristudents\Models\Component;
use Bytelaunch\Nutristudents\Models\Distributor;
use Bytelaunch\Nutristudents\Models\Ingredient;
use Bytelaunch\Nutristudents\Models\Product;
use Bytelaunch\Nutristudents\Models\Recipe;
use Bytelaunch\Nutristudents\Models\Tag;
use Bytelaunch\Nutristudents\Models\UnitOfMeasurement;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;

class CopyProductAction
{

    private Product $product;

    public function sourceProduct(Product $product) : self
    {
        $this->product = $product;
        return $this;
    }

    public function copy()
    {
        $newProduct = $this->product->replicate();
        $newProduct->name .= ' (Copy)';
        $newProduct->tenant_id = (new GetCurrentTenantGetter)->first()->id;        
        $newProduct->save();

        if($this->product->allergens->count() > 0){
            (new AttachAllergenAction)
                ->forProduct($newProduct)
                ->attachAllergens($this->product->allergens)
                ->attach();
        }
        if($this->product->components->count() > 0){
            (new AttachComponentAction())
                ->forProduct($newProduct)
                ->attachComponents($this->product->components)
                ->attach();
        }

        if ($this->product->tags->count() > 0) {
            $newProduct = (new AttachTagAction())
                ->forProduct($newProduct)
                ->attachTags($this->product->tags)
                ->attach();
        }
        // $newProduct->ingredients()->saveMany($this->product->ingredients);

        return $newProduct;

    }






}
