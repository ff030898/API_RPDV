<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
{
   
    public function toArray($request)
    {
        if($request){
            return [
                'id' => $this->id,
                'id_sass' => $this->id_establishment,
                'desc' => $this->desc,
                'image' => $this->img,
                'value_und' => $this->value_und,
                'value_brt' => $this->value_brt,
                'value_pro' => $this->value_pro,
                'sale' => $this->sale === 0 ? false : true,
                'categorie_id' => $this->id_categorie,
                'categorie_desc' => $this->categorie,
                'establishment_id' => $this->fk_establishments,
                'created_at' => Carbon::create($this->date)->format('d-m-Y'),
            ];
        }
        
    }
}