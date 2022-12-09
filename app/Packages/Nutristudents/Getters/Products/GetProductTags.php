<?php


namespace Bytelaunch\Nutristudents\Getters\Products;


use Bytelaunch\Nutristudents\Models\Product;

class GetProductTags
{
    private Product $product;

    public function forProduct(Product $product) : self
    {
        $this->product = $product;
        return $this;
    }

    public function get() : array
    {
        return $this->product->with('tags')->get()->pluck('tags')->flatten()->pluck('name')->toArray();
    }


}
