<?php

namespace App\Http\Requests;

class StoreUpdateNotifications
{
   
    public function validateNotification()
    {
        return [
            'description' => ['required', 'min:3', 'max:50'],
            'type' => ['required', 'min:1', 'max:30'],
            'view' => ['required', 'min:1', 'max:1'],
        ];
        
    }
}