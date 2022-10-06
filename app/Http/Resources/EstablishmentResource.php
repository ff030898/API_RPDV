<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class EstablishmentResource extends JsonResource
{
   
    public function toArray($request)
    {
        if($request){
            return [
                'id' => $this->id,
                'name' => $this->name,
                'email' => $this->email,
                'email_verified' => $this->email_verified ? true : false,
                'avatar' => $this->avatar,
                'cnpj' => $this->cnpj,
                'active' => $this->active === 1 ? true : false,
                'id_adress' => $this->id_adress,
                'cep' => $this->cep,
                'public_place' => $this->public_place,
                'city' => $this->city,
                'uf' => $this->uf,
                'complement' => $this->complement,
                'reference' => $this->reference,
                'number_place' => $this->number_place,
                'id_plane' => $this->id_plane,
                'plane' => $this->plane,
                'description_plane' => $this->description,
                'type_plane' => $this->type,
                'value_plane' => $this->value,
                'created_at' => Carbon::create($this->date)->format('d-m-Y'),
            ];
        }
        
    }
}