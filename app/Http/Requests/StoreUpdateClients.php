<?php

namespace App\Http\Requests;

class StoreUpdateClients
{
   
    public function validateClient()
    {
        return [
            'name' => ['required', 'min:3', 'max:80'],
            'phone' => ['required', 'min:10', 'max:11'],
            'cep' => ['required', 'min:8', 'max:8'],
            'public_place' => ['required', 'min:5', 'max:80'],
            'city' => ['required', 'min:5', 'max:80'],
            'uf' => ['required', 'min:2', 'max:2'],
            'number_place' => ['required', 'min:1', 'max:5'],
        ];
        
    }
}