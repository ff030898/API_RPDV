<?php

namespace App\Services;

use App\Repositories\PlanesRepository;
use Illuminate\Http\Request;

class PlanesService
{
    protected $repository;

    public function __construct(PlanesRepository $planeRepository)
    {
        $this->repository = $planeRepository;
    }

    public function getPlanes()
    {
        return $this->repository->getAll();
    }

    public function createNewPlane(Request $data)
    {
        return $this->repository->createNew($data);
    }

    public function getPlane(string $identify)
    {
        return $this->repository->getPlane($identify);
    }

    public function updatePlane(string $identify, $data)
    {
        return $this->repository->update($identify, $data);
    }

    public function deletePlane(string $identify)
    {
        return $this->repository->delete($identify);
    }
}