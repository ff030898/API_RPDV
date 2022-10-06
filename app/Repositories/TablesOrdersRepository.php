<?php

namespace App\Repositories;

use App\Models\TablesOrders;
use Illuminate\Http\Request;

class TablesOrdersRepository
{
    protected $entity;

    public function __construct(TablesOrders $table)
    {
        $this->entity = $table;
    }

    public function getAll(string $identify)
    {
        $tables = $this->entity::where('fk_establishments', $identify)->get();
        return $tables;
    }

    public function getTable(string $identify)
    {
        $table = $this->entity::where('number', $identify)->first();
        return $table;
    }

    public function createNew(Request $data)
    {
        $table = $data->all();
        $this->entity::create($table);

        return $this->entity;
    }

    public function update(string $identify, Request $data)
    {

        $table = $this->getTable($identify);

        $table->open = $data->input('open');

        $table->save();

        return $table;
    }

    public function delete(string $identify)
    {
        $table = $this->getTable($identify);

        return $table->delete();
    }
}
