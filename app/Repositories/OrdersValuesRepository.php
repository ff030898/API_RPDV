<?php

namespace App\Repositories;

use App\Models\Orders;
use Illuminate\Http\Request;

class OrdersValuesRepository
{
    protected $entity;

    public function __construct(Orders $orders)
    {
        $this->entity = $orders;
    }

    public function getCountIDOrders(string $identify)
    {
        $count = $this->entity::where('fk_establishments', $identify)->get();
        $newCount = $count->count();

        return $newCount + 1;
    }


}