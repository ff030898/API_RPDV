<?php

namespace App\Services;

use App\Repositories\EstablishmentRepository;
use Illuminate\Http\Request;

class EstablishmentService
{
    protected $repository;

    public function __construct(EstablishmentRepository $establishmentRepository)
    {
        $this->repository = $establishmentRepository;
    }

    public function getEstablishments()
    {
        return $this->repository->getAll();
    }

    public function createNewEstablishment(Request $data)
    {
        return $this->repository->createNew($data);
    }

    public function getEstablishment(string $identify)
    {
        return $this->repository->getEstablishment($identify);
    }

    public function updateEstablishment(string $identify, $data)
    {
        return $this->repository->update($identify, $data);
    }

    public function deleteEstablishment(string $identify)
    {
        return $this->repository->delete($identify);
    }
}