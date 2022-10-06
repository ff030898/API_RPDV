<?php

namespace App\Services;

use App\Repositories\OrdersItemsRepository;
use Illuminate\Http\Request;

class OrdersItemsService
{
    protected $repository;

    public function __construct(OrdersItemsRepository $orderitemRepository)
    {
        $this->repository = $orderitemRepository;
    }

    public function getOrdersItems(string $identify)
    {
        return $this->repository->getAll($identify);
    }

    public function getItem(string $identify, string $product)
    {
        return $this->repository->getItem($identify, $product);
    }

    public function createNewOrderItem(Request $data)
    {
        return $this->repository->createNew($data);
    }

    public function deleteOrderItem(string $identify, string $product)
    {
        return $this->repository->delete($identify, $product);
    }
}