<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingsResource extends JsonResource
{
   
    public function toArray($request)
    {
        if($request){
            return [
                'id' => $this->id,
                'open' => $this->open ? true : false,
                'day_closed' => $this->day_closed,
                'orders_tables' => $this->orders_tables ? true : false,
                'max_withdraw'  => $this->max_withdraw,
                'payment_day' => $this->payment_day,
                'open_time_orders' => $this->open_time_orders,
                'closed_time_orders' => $this->closed_time_orders,
                'orders_time_limit'  => $this->orders_time_limit,
                'establishment_id' => $this->fk_establishments,
                'date' => Carbon::create($this->created_at)->format('d-m-Y'),
            ];
        }
        
    }
}