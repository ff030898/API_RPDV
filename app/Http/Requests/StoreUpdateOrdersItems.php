<?php

namespace App\Http\Requests;

class StoreUpdateOrdersItems
{
   
    public function validateOrderItem()
    {
        return [
            'fk_orders' => ['required', 'min:1'],
            'fk_products' => ['required', 'min:1'],
            'value' => ['required', 'min:1', 'max:10'],
            'total' => ['required', 'min:1', 'max:10'],
            'qtd' => ['required', 'min:1', 'max:10'],
        ];
        
    }
}