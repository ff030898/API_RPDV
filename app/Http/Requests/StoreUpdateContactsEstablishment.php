<?php

namespace App\Http\Requests;

class StoreUpdateContactsEstablishment
{
   
    public function validateContact()
    {
        return [
            'phone' => ['required', 'min:10', 'max:11'],
        ];
        
    }
}