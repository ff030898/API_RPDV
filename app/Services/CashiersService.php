<?php

namespace App\Services;

use App\Repositories\CashiersRepository;
use Illuminate\Http\Request;

class CashiersService
{
    protected $repository;

    public function __construct(CashiersRepository $cashierRepository)
    {
        $this->repository = $cashierRepository;
    }

    public function getCashiers(string $identify)
    {
        return $this->repository->getAll($identify);
    }

    public function createNewCashier(Request $data)
    {
        return $this->repository->createNew($data);
    }

    public function getCashier(string $identify)
    {
        return $this->repository->getCashier($identify);
    }

    public function updateCashier(string $identify, $data)
    {
        return $this->repository->update($identify, $data);
    }

    public function deleteCashier(string $identify)
    {
        return $this->repository->delete($identify);
    }
}