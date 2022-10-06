<?php

namespace App\Repositories;

use App\Models\Clients;
use Illuminate\Http\Request;

class ClientsValuesRepository
{
    protected $entity;
    

    public function __construct(Clients $client)
    {
        $this->entity = $client;
        
    }

    public function getCountIDClients(string $identify)
    {
        $count = $this->entity::where('fk_establishments', $identify)->get();
        $newCount = $count->count();

        return $newCount + 1;
    }


}