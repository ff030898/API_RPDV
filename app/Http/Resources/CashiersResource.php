<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CashiersResource extends JsonResource
{
   
    public function toArray($request)
    {
        if($request){
            return [
                'id' => $this->id,
                'id_sass' => $this->cashier_establishments,
                'open' => $this->open ? true : false,
                'initial' => $this->initial,
                'money' => $this->money,
                'debit' => $this->debit,
                'credit' => $this->credit,
                'others' => $this->others,
                'delivery_fee' => $this->delivery_fee,
                'table_fee' => $this->table_fee,
                'withdraw' => $this->withdraw,
                'subtotal' => $this->subtotal,
                'total' => $this->total,
                'establishment_id' => $this->fk_establishments,
                'created_at' => Carbon::create($this->date)->format('d-m-Y'),
            ];
        }
        
    }
}