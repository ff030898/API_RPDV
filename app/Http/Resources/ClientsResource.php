<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientsResource extends JsonResource
{
   
    public function toArray($request)
    {
        if($request){
            return [
                'id' => $this->id,
                'id_sass' => $this->id_establishment,
                'name' => $this->name,
                'email' => $this->email,
                'cpf' => $this->cpf,
                'phone' => $this->phone,
                'active' => $this->active === 1 ? true : false,
                'id_adress' => $this->id_adress,
                'cep' => $this->cep,
                'public_place' => $this->public_place,
                'city' => $this->city,
                'uf' => $this->uf,
                'complement' => $this->complement,
                'reference' => $this->reference,
                'number_place' => $this->number_place,
                'created_at' => Carbon::create($this->date)->format('d-m-Y'),
            ];
        }
        
    }
}