<?php

namespace App\Http\Requests;

class StoreUpdateEstablishment
{
   
    public function validateEstablishment()
    {
        return [
            'name' => ['required', 'min:3', 'max:80'],
            'email' => ['required', 'min:3', 'max:80'],
        ];
        
    }
}