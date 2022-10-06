<?php

namespace App\Http\Requests;

class StoreUpdatePlanes
{
   
    public function validatePlane()
    {
        return [
            'name' => ['required', 'min:3', 'max:80'],
            'description' => ['required', 'min:3', 'max:80'],
            'type' => ['required', 'min:3', 'max:80'],
            'value' => ['required', 'min:1', 'max:10'],
        ];
        
    }
}