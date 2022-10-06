<?php

namespace App\Http\Requests;

class StoreUpdateOrders
{
   
    public function validateOrder()
    {
        return [
            'status' => ['required', 'min:1', 'max:50'],
            'payment' => ['required', 'min:1'],
            'payment_type' => ['required', 'min:1', 'max:50'],
            'description' => ['required', 'min:1', 'max:80'],
            'subtotal' => ['required', 'min:1', 'max:10'],
            'rate' => ['required', 'min:1', 'max:10'],
            'discount' => ['required', 'min:1', 'max:10'],
            'rate_extra' => ['required', 'min:1', 'max:10'],
            'paid' => ['required', 'min:1', 'max:10'],
            'change' => ['required', 'min:1', 'max:10'],
            'total' => ['required', 'min:1', 'max:10'],
            'type' => ['required', 'min:1', 'max:50'],
           
        ];
        
    }
}