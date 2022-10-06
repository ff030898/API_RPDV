<?php

namespace App\Services;

use App\Repositories\PaymentsRepository;
use Illuminate\Http\Request;

class PaymentsService
{
    protected $repository;

    public function __construct(PaymentsRepository $paymentRepository)
    {
        $this->repository = $paymentRepository;
    }

    public function getPayments(string $establishment)
    {
        return $this->repository->getAll($establishment);
    }

    public function createNewPayment(Request $data)
    {
        return $this->repository->createNew($data);
    }

    public function getPayment(string $identify)
    {
        return $this->repository->getPayment($identify);
    }

    public function updatePayment(string $identify, $data)
    {
        return $this->repository->update($identify, $data);
    }

    public function deletePayment(string $identify)
    {
        return $this->repository->delete($identify);
    }
}