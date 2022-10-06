<?php

namespace App\Http\Requests;

class StoreUpdateSettings
{
   
    public function validateSetting()
    {
        return [
            'open' => ['required'],
            'orders_tables' => ['required'],
            'max_withdraw' => ['required', 'min:1', 'max:10'],
            'payment_day' => ['required', 'min:1', 'max:2'],
            'open_time_orders' => ['required'],
            'closed_time_orders' => ['required'],
            'orders_time_limit' => ['required'],
        ];
        
    }
}