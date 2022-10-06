<?php

namespace App\Services;

use App\Repositories\TablesOrdersRepository;
use Illuminate\Http\Request;

class TablesOrdersService
{
    protected $repository;

    public function __construct(TablesOrdersRepository $tableRepository)
    {
        $this->repository = $tableRepository;
    }

    public function getTables(string $establishment)
    {
        return $this->repository->getAll($establishment);
    }

    public function createNewTable(Request $data)
    {
        return $this->repository->createNew($data);
    }

    public function getTable(string $identify)
    {
        return $this->repository->getTable($identify);
    }

    public function updateTable(string $identify, $data)
    {
        return $this->repository->update($identify, $data);
    }

    public function deleteTable(string $identify)
    {
        return $this->repository->delete($identify);
    }
}
