<?php

namespace App\Services;

use App\Repositories\ItemsAdicionalsRepository;
use Illuminate\Http\Request;

class ItemsAdicionalsService
{
    protected $repository;

    public function __construct(ItemsAdicionalsRepository $itemRepository)
    {
        $this->repository = $itemRepository;
    }

    public function getItems(string $establishment)
    {
        return $this->repository->getAll($establishment);
    }

    public function createNewItem(Request $data)
    {
        return $this->repository->createNew($data);
    }

    public function getItem(string $identify)
    {
        return $this->repository->getItem($identify);
    }

    public function updateItem(string $identify, $data)
    {
        return $this->repository->update($identify, $data);
    }

    public function deleteItem(string $identify)
    {
        return $this->repository->delete($identify);
    }
}
