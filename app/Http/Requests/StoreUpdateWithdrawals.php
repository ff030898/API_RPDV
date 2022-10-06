<?php

namespace App\Http\Requests;

class StoreUpdateWithdrawals
{
   
    public function validateWithdraw()
    {
        return [
            'value' => ['required', 'min:1', 'max:10'],
        ];
        
    }
}