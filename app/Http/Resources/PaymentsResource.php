<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentsResource extends JsonResource
{
   
    public function toArray($request)
    {
        if($request){
            return [
                'id' => $this->id,
                'description' => $this->description,
                'value' => $this->value,
                'fk_establishments' => $this->fk_establishments,
                'date' => Carbon::create($this->created_at)->format('d-m-Y'),
            ];
        }
        
    }
}