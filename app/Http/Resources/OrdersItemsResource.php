<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OrdersItemsResource extends JsonResource
{
   
    public function toArray($request)
    {
        if($request){
            return [
                'product_id' => $this->product_id,
                'desc' => $this->desc,
                'image' => $this->img,
                'qtd' => $this->qtd,
                'value' => $this->value,
                'total' => $this->total,
                'order_id' => $this->order_id,
                'created_at' => Carbon::create($this->date)->format('d-m-Y'),
            ];
        }
        
    }
}