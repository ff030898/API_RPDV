<?php

namespace App\Repositories;

use App\Models\OrdersItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersItemsRepository
{
    protected $entity;

    public function __construct(OrdersItems $item)
    {
        $this->entity = $item;
    }

    public function getAll(string $identify)
    {
        $items = $this->entity::select(
            'products.id as product_id', 
            'products.desc', 
            'products.img',
            'orders_items.qtd',
            'orders_items.value', 
            'orders_items.total', 
            'orders.id as order_id',
            'orders_items.created_at as date',
            )
            ->join('orders', 'orders.id', '=', 'orders_items.fk_orders')
            ->join('products', 'products.id', '=', 'orders_items.fk_products')
            ->where('orders_items.fk_orders', '=', $identify)
            ->get();

        return $items;
    }

    public function getItem(string $identify, string $products)
    {
        $item = $this->entity::select(
            'products.id as product_id', 
            'products.desc', 
            'products.img',
            'orders_items.qtd',
            'orders_items.value', 
            'orders_items.total', 
            'orders.id as order_id',
            'orders_items.created_at as date',
            )
            ->join('orders', 'orders.id', '=', 'orders_items.fk_orders')
            ->join('products', 'products.id', '=', 'orders_items.fk_products')
            ->where('orders_items.fk_orders', '=', $identify)
            ->where('orders_items.fk_products', '=', $products)
            ->first();

        return $item;
    }

  
    public function createNew(Request $data)
    {
        $item = $data->all();
        $this->entity::create($item);

        return $this->entity;

    }


    public function delete(string $identify, string $products)
    {

        $items = DB::table('orders_items')
        ->where('fk_orders', $identify)
        ->where('fk_products', $products)
        ->delete();
       
        return $items;
        
    }
}