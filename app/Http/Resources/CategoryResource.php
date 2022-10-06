<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
   
    public function toArray($request)
    {
        if($request){
            return [
                'id' => $this->id,
                'categorie' => $this->desc,
                'image' => $this->img,
                'date' => Carbon::create($this->created_at)->format('d-m-Y'),
            ];
        }
        
    }
}