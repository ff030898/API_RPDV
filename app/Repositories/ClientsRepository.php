<?php

namespace App\Repositories;

use App\Models\Clients;
use App\Repositories\ClientsValuesRepository;
use App\Models\AdressesClients;
use Illuminate\Http\Request;

class ClientsRepository
{
    protected $entity;
    protected $entityAdress;
    protected $repositoryValues;

    public function __construct(Clients $client, AdressesClients $adress, ClientsValuesRepository $repositoryValues)
    {
        $this->entity = $client;
        $this->entityAdress = $adress;
        $this->repositoryValues = $repositoryValues;
    }

    public function getAll($identify)
    {
        $clients = $this->entity::select(
            'clients.id',
            'clients.id_establishment', 
            'clients.name', 
            'clients.email', 
            'clients.cpf', 
            'clients.phone', 
            'clients.active', 
            'clients.created_at as date', 
            'adresses_clients.id as id_adress',
            'adresses_clients.cep',
            'adresses_clients.public_place',
            'adresses_clients.city',
            'adresses_clients.uf',
            'adresses_clients.complement',
            'adresses_clients.reference',
            'adresses_clients.number_place'
            )
            ->join('adresses_clients', 'clients.id', '=', 'adresses_clients.fk_clients')
            ->where('clients.fk_establishments', '=', $identify)
            ->where('clients.active', '=', 1)
            ->get();

        return $clients;
    }

    public function getClient(string $identify)
    {
        $client = $this->entity::select(
            'clients.id',
            'clients.id_establishment', 
            'clients.name', 
            'clients.email', 
            'clients.cpf', 
            'clients.phone', 
            'clients.active', 
            'clients.created_at as date', 
            'adresses_clients.id as id_adress',
            'adresses_clients.cep',
            'adresses_clients.public_place',
            'adresses_clients.city',
            'adresses_clients.uf',
            'adresses_clients.complement',
            'adresses_clients.reference',
            'adresses_clients.number_place'
            )
            ->join('adresses_clients', 'clients.id', '=', 'adresses_clients.fk_clients')
            ->where('clients.id', '=', $identify)
            ->first();

        return $client;
    }

    public function createNew(Request $data)
    {
        $newId = $this->repositoryValues->getCountIDClients($data->input('fk_establishments'));

        $dataClient = array();
        $dataClient = [
            'id_establishment' => $newId,
            'name' => $data->input('name'),
            'email' => $data->input('email'),
            'cpf' => $data->input('cpf'),
            'phone' => $data->input('phone'),
            'active' => 1,
            'fk_establishments' => $data->input('fk_establishments'),
        ];

        $client = $this->entity::create($dataClient);

        $dataAdress = array();
        $dataAdress = [
            'cep' => $data->input('cep'),
            'public_place' => $data->input('public_place'),
            'city' => $data->input('city'),
            'uf' => $data->input('uf'),
            'complement' => $data->input('complement'),
            'reference' => $data->input('reference'),
            'number_place' => $data->input('number_place'),
            'fk_clients' => $client->id 
        ];

        $adress = $this->entityAdress::create($dataAdress);

        return $client;

    }

    public function update(string $identify, Request $data)
    {

        $client = $this->getClient($identify);
        
        $client->name = $data->input('name');
        $client->email = $data->input('email');
        $client->cpf = $data->input('cpf');
        $client->phone = $data->input('phone');

        $client->save();

        $adress = $this->entityAdress::where('id', $client->id_adress)->first();
        $adress->cep = $data->input('cep');
        $adress->public_place = $data->input('public_place');
        $adress->city = $data->input('city');
        $adress->uf = $data->input('uf');
        $adress->complement = $data->input('complement');
        $adress->reference = $data->input('reference');
        $adress->number_place = $data->input('number_place');
        
        $adress->save();

        return $client;
        
    }

    public function delete(string $identify)
    {
        $client = $this->getClient($identify);
        $client->active = 0;
        $client->save();
       
        return $client;
        
    }
}