<?php


namespace Bytelaunch\Nutristudents\Actions\Products;


use Bytelaunch\Nutristudents\Models\Tag;
use Bytelaunch\Nutristudents\Models\Component;
use Bytelaunch\Nutristudents\Models\Distributor;
use Bytelaunch\Nutristudents\Models\Product;
use Bytelaunch\Nutristudents\Models\UnitOfMeasurement;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;

class AttachTagAction
{

    private $tags = [];
    private Product $product;


    public function forProduct(Product $product) : self
    {
        $this->product = $product;
        return $this;
    }

    public function attachTag(string $tag): self
    {
        $tag = Tag::firstOrCreate(['name' => $tag]);
        $this->tags[] = $tag;
        return $this;
    }


    public function attachTags($tags): self
    {
        $this->tags = $tags;
        return $this;
    }

    public function attach() : Product
    {
        if (count($this->tags) > 0) {
            $this->product->tags()->saveMany($this->tags);
        }

        return $this->product;
    }



}
