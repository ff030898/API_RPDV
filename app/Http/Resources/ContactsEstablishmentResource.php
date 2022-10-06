<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactsEstablishmentResource extends JsonResource
{
   
    public function toArray($request)
    {
        if($request){
            return [
                'id' => $this->id,
                'phone' => $this->phone,
                'establishments' => $this->fk_establishments,
                'created_at' => Carbon::create($this->created_at)->format('d-m-Y'),
            ];
        }
        
    }
}