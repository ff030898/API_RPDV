<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationsResource extends JsonResource
{
   
    public function toArray($request)
    {
        if($request){
            return [
                'id' => $this->id,
                'description' => $this->description,
                'type' => $this->type,
                'view' => $this->view ? true : false,
                'fk_establishments' => $this->fk_establishments,
                'date' => Carbon::create($this->created_at)->format('d-m-Y'),
            ];
        }
        
    }
}