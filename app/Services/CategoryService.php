<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryService
{
    protected $repository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->repository = $categoryRepository;
    }

    public function getCategories()
    {
        return $this->repository->getAll();
    }

    public function createNewCategory(Request $data)
    {
        return $this->repository->createNew($data);
    }

    public function getCategory(string $identify)
    {
        return $this->repository->getCategory($identify);
    }

    public function updateCategory(string $identify, $data)
    {
        return $this->repository->update($identify, $data);
    }

    public function deleteCategory(string $identify)
    {
        return $this->repository->delete($identify);
    }
}