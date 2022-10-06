<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class WithdrawalsResource extends JsonResource
{
   
    public function toArray($request)
    {
        if($request){
            return [
                'id' => $this->id,
                'value' => $this->value,
                'cashier_id' => $this->fk_cashiers,
                'date' => Carbon::create($this->created_at)->format('d-m-Y'),
            ];
        }
        
    }
}