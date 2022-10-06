<?php

namespace App\Http\Requests;

class StoreUpdateCashiers
{
   
    public function validateCashier()
    {
        return [
            'initial' => ['required', 'min:1'],
            'fk_establishments' => ['required', 'min:1'],
        ];
        
    }
}