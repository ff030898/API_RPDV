<?php

namespace App\Services;

use App\Repositories\ClientsRepository;
use Illuminate\Http\Request;

class ClientsService
{
    protected $repository;

    public function __construct(ClientsRepository $clientRepository)
    {
        $this->repository = $clientRepository;
    }

    public function getClients(string $identify)
    {
        return $this->repository->getAll($identify);
    }

    public function createNewClient(Request $data)
    {
        return $this->repository->createNew($data);
    }

    public function getClient(string $identify)
    {
        return $this->repository->getClient($identify);
    }

    public function updateClient(string $identify, $data)
    {
        return $this->repository->update($identify, $data);
    }

    public function deleteClient(string $identify)
    {
        return $this->repository->delete($identify);
    }
}