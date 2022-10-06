<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanesResource extends JsonResource
{
   
    public function toArray($request)
    {
        if($request){
            return [
                'id' => $this->id,
                'name' => $this->name,
                'description' => $this->description,
                'type' => $this->type,
                'value' => $this->value,
                'date' => Carbon::create($this->created_at)->format('d-m-Y'),
            ];
        }
        
    }
}