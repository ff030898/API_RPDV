<?php

namespace App\Repositories;

use App\Models\ItemsAdicionals;
use Illuminate\Http\Request;

class ItemsAdicionalsRepository
{
    protected $entity;

    public function __construct(ItemsAdicionals $item)
    {
        $this->entity = $item;
    }

    public function getAll(string $identify)
    {
        $items = $this->entity::where('fk_establishments', $identify)->get();
        return $items;
    }

    public function getItem(string $identify)
    {
        $item = $this->entity::where('id', $identify)->first();
        return $item;
    }

    public function createNew(Request $data)
    {
        $item = $data->all();
        $this->entity::create($item);

        return $this->entity;
    }

    public function update(string $identify, Request $data)
    {

        $item = $this->getItem($identify);

        $item->description = $data->input('description');
        $item->value = $data->input('value');

        $item->save();

        return $item;
    }

    public function delete(string $identify)
    {
        $item = $this->getItem($identify);

        return $item->delete();
    }
}
