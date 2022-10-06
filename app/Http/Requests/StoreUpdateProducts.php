<?php

namespace App\Http\Requests;

class StoreUpdateProducts
{
   
    public function validateProduct()
    {
        return [
            'desc' => ['required', 'min:3', 'max:80'],
            'value_und' => ['required', 'min:1', 'max:10']
        ];
        
    }
}