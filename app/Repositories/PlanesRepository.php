<?php

namespace App\Repositories;

use App\Models\Planes;
use Illuminate\Http\Request;

class PlanesRepository
{
    protected $entity;

    public function __construct(Planes $planes)
    {
        $this->entity = $planes;
    }

    public function getAll()
    {
        return $this->entity->all();
    }

    public function getPlane(string $identify)
    {
        $planes = $this->entity::where('id', $identify)->first();
        return $planes;
    }

    public function createNew(Request $data)
    {
        $planes = $data->all();
        $this->entity::create($planes);

        return $this->entity;

    }

    public function update(string $identify, Request $data)
    {

        $plane = $this->getPlane($identify);
        
        $plane->name = $data->input('name');
        $plane->description = $data->input('description');
        $plane->type = $data->input('type');
        $plane->value = $data->input('value');

        $plane->save();
    
        return $plane;
        
    }

    public function delete(string $identify)
    {
        $planes = $this->getPlane($identify);
       
        return $planes->delete();
        
    }
}