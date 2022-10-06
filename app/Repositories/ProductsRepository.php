<?php

namespace App\Repositories;

use App\Models\Products;
use App\Repositories\ProductsValuesRepository;
use Illuminate\Http\Request;

class ProductsRepository
{
    protected $entity;
    protected $repositoryValues;

    public function __construct(Products $product, ProductsValuesRepository $repositoryValues)
    {
        $this->entity = $product;
        $this->repositoryValues = $repositoryValues;
    }

    public function getAll(string $identify)
    {
        $products = $this->entity::select(
            'products.id',
            'products.id_establishment',
            'products.desc',
            'products.img',
            'products.value_und',
            'products.value_brt',
            'products.value_pro',
            'products.sale',
            'products.fk_establishments',
            'products.created_at as date',
            'categories.id as id_categorie',
            'categories.desc as categorie'
            )
            ->join('categories', 'categories.id', '=', 'products.fk_categories')
            ->where('products.fk_establishments', '=', $identify)
            ->get();

        return $products;
    }

    public function getProduct(string $identify)
    {
        $product = $this->entity::select(
            'products.id',
            'products.id_establishment',
            'products.desc',
            'products.img',
            'products.value_und',
            'products.value_brt',
            'products.value_pro',
            'products.sale',
            'products.fk_establishments',
            'products.created_at as date',
            'categories.id as id_categorie',
            'categories.desc as categorie'
            )
            ->join('categories', 'categories.id', '=', 'products.fk_categories')
            ->where('products.id', '=', $identify)->first();

        return $product;
    }

    public function createNew(Request $data)
    {
        $newId = $this->repositoryValues->getCountIDProducts($data->input('fk_establishments'));

        $product = new Products();

        // image upload
        if ($data->hasFile('img')) {

            $allowedfileExtension = ['jpg', 'png'];
            $file = $data->file('img');
            $extenstion = $file->getClientOriginalExtension();
            $check = in_array($extenstion, $allowedfileExtension);

            if ($check) {
                $name = time() . '_' . $file->getClientOriginalName();
                $file->move('images/products', $name);
                $product->img = $name;
            }
        }

        $product->id_establishment = $newId;
        $product->desc = $data->input('desc');
        $product->value_und = $data->input('value_und');
        $product->value_brt = $data->input('value_brt');
        $product->value_pro = $data->input('value_pro');
        $product->sale = $data->input('sale');
        $product->fk_categories = $data->input('fk_categories');
        $product->fk_establishments = $data->input('fk_establishments');

        $product->save();

        return $this->entity;

    }

    public function update(string $identify, Request $data)
    {

        $product = $this->getProduct($identify);

        if ($data->hasFile('img')) {

            $allowedfileExtension = ['jpg', 'png'];
            $file = $data->file('img');
            $extenstion = $file->getClientOriginalExtension();
            $check = in_array($extenstion, $allowedfileExtension);

            if ($check) {
                $name = time() . '_' . $file->getClientOriginalName();
                $file->move('images/products', $name);
                $product->img = $name;
            }
        }

        $product->desc = $data->input('desc');
        $product->value_und = $data->input('value_und');
        $product->value_brt = $data->input('value_brt');
        $product->value_pro = $data->input('value_pro');
        $product->sale = $data->input('sale');
        $product->fk_categories = $data->input('fk_categories');



        $product->save();

        return $product;

    }

    public function delete(string $identify)
    {
        $product = $this->getProduct($identify);

        return $product->delete();

    }
}
