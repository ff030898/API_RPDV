<?php

namespace App\Services;

use App\Repositories\OrdersRepository;
use Illuminate\Http\Request;

class OrdersService
{
    protected $repository;

    public function __construct(OrdersRepository $orderRepository)
    {
        $this->repository = $orderRepository;
    }

    public function getOrders(string $identify, string $cashier)
    {
        return $this->repository->getAll($identify, $cashier);
    }

    public function createNewOrder(Request $data)
    {
        return $this->repository->createNew($data);
    }

    public function getOrder(string $identify)
    {
        return $this->repository->getOrder($identify);
    }

    public function updateOrder(string $identify, $data)
    {
        return $this->repository->update($identify, $data);
    }

    public function deleteOrder(string $identify)
    {
        return $this->repository->delete($identify);
    }
}