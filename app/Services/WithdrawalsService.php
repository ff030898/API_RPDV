<?php

namespace App\Services;

use App\Repositories\WithdrawalsRepository;
use Illuminate\Http\Request;

class WithdrawalsService
{
    protected $repository;

    public function __construct(WithdrawalsRepository $withdrawRepository)
    {
        $this->repository = $withdrawRepository;
    }

    public function getWithdrawals($cashier)
    {
        return $this->repository->getAll($cashier);
    }

    public function createNewWithdraw(Request $data)
    {
        return $this->repository->createNew($data);
    }

    public function getWithdraw(string $identify)
    {
        return $this->repository->getWithdraw($identify);
    }

    public function updateWithdraw(string $identify, $data)
    {
        return $this->repository->update($identify, $data);
    }

    public function deleteWithdraw(string $identify)
    {
        return $this->repository->delete($identify);
    }
}