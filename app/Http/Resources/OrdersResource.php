<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OrdersResource extends JsonResource
{
   
    public function toArray($request)
    {
        if($request){
            return [
                'id' => $this->id,
                'id_sass' => $this->id_establishment,
                'status' => $this->status,
                'payment' => $this->payment ? true : false,
                'payment_type' => $this->payment_type,
                'description' => $this->description,
                'subtotal' => $this->subtotal,
                'rate' => $this->rate,
                'discount' => $this->discount,
                'rate_extra' => $this->rate_extra,
                'paid' => $this->paid,
                'change' => $this->change,
                'total' => $this->total,
                'type' => $this->type,
                'deliveryman' => $this->deliveryman,
                'client_id' => $this->client_id,
                'client_sass' => $this->client_establishment,
                'client_phone' =>$this->client_phone,
                'client_name' =>$this->client_name,
                'cashier_id' => $this->cashier_id,
                'cashier_sass' => $this->cashier_establishment,
                'establishment_id' => $this->establishment_id,
                'establishment_name' => $this->establishment_name,
                'created_at' => Carbon::create($this->date)->format('d-m-Y'),
            ];
        }
        
    }
}