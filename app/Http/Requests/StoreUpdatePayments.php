<?php

namespace App\Http\Requests;

class StoreUpdatePayments
{
   
    public function validatePayment()
    {
        return [
            'description' => ['required', 'min:3', 'max:50'],
            'value' => ['required', 'min:1', 'max:10'],
        ];
        
    }
}