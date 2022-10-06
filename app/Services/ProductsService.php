<?php

namespace App\Services;

use App\Repositories\ProductsRepository;
use Illuminate\Http\Request;

class ProductsService
{
    protected $repository;

    public function __construct(ProductsRepository $productRepository)
    {
        $this->repository = $productRepository;
    }

    public function getProducts(string $identify)
    {
        return $this->repository->getAll($identify);
    }

    public function createNewProduct(Request $data)
    {
        return $this->repository->createNew($data);
    }

    public function getProduct(string $identify)
    {
        return $this->repository->getProduct($identify);
    }

    public function updateProduct(string $identify, $data)
    {
        return $this->repository->update($identify, $data);
    }

    public function deleteProduct(string $identify)
    {
        return $this->repository->delete($identify);
    }
}