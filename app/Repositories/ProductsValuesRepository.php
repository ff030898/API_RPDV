<?php

namespace App\Repositories;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsValuesRepository
{
    protected $entity;

    public function __construct(Products $product)
    {
        $this->entity = $product;
    }

    public function getCountIDProducts(string $identify)
    {
        $count = $this->entity::where('fk_establishments', $identify)->get();
        $newCount = $count->count();

        return $newCount + 1;
    }


}