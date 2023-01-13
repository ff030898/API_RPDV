<?php

namespace App\Repositories;

use App\Models\Establishment;
use App\Models\AdressesEstablishment;
use App\Models\Planes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class EstablishmentRepository
{
    protected $entity;
    protected $entityAdress;
    protected $entityPlanes;

    public function __construct(Establishment $establishment, AdressesEstablishment $adress, Planes $planes)
    {
        $this->entity = $establishment;
        $this->entityAdress = $adress;
        $this->entityPlanes = $planes;
    }

    public function getAll()
    {

        $establishment = $this->entity::select(
            'establishments.id',
            'establishments.name',
            'establishments.email',
            'establishments.email_verified',
            'establishments.avatar',
            'establishments.cnpj',
            'establishments.active',
            'establishments.created_at as date',
            'adresses_establishments.id as id_adress',
            'adresses_establishments.cep',
            'adresses_establishments.public_place',
            'adresses_establishments.city',
            'adresses_establishments.uf',
            'adresses_establishments.complement',
            'adresses_establishments.reference',
            'adresses_establishments.number_place',
            'planes.id as id_plane',
            'planes.name as plane',
            'planes.type',
            'planes.description',
            'planes.value'
        )
            ->join('adresses_establishments', 'establishments.id', '=', 'adresses_establishments.fk_establishments')
            ->join('planes', 'planes.id', '=', 'establishments.fk_planes')
            ->where('establishments.active', '=', 1)
            ->get();

        return $establishment;
    }

    public function getEstablishment(string $identify)
    {
        $establishment = $this->entity::select(
            'establishments.id',
            'establishments.name',
            'establishments.email',
            'establishments.email_verified',
            'establishments.avatar',
            'establishments.cnpj',
            'establishments.active',
            'establishments.created_at as date',
            'adresses_establishments.id as id_adress',
            'adresses_establishments.cep',
            'adresses_establishments.public_place',
            'adresses_establishments.city',
            'adresses_establishments.uf',
            'adresses_establishments.complement',
            'adresses_establishments.reference',
            'adresses_establishments.number_place',
            'planes.id as id_plane',
            'planes.name as plane',
            'planes.type',
            'planes.description',
            'planes.value'
        )
            ->join('adresses_establishments', 'establishments.id', '=', 'adresses_establishments.fk_establishments')
            ->join('planes', 'planes.id', '=', 'establishments.fk_planes')
            ->where('establishments.id', '=', $identify)
            ->where('establishments.active', '=', 1)
            ->first();
        return $establishment;
    }

    public function createNew(Request $data)
    {
        $emailVerify = $this->entity::where('email', $data['email'])->first();

        if (!$emailVerify) {
            $data['password'] = Crypt::encrypt($data['password']);
            $data['active'] = true;
            //$data['fk_planes'] = 1;

            $establishment = $this->entity::create($data->all());

            $dataAdress = array();
            $dataAdress = [
                'cep' => '00000000',
                'public_place' => 'Não definido',
                'city' => 'Não definido',
                'uf' => 'ND',
                'complement' => 'Não definido',
                'reference' => 'Não definido',
                'number_place' => 0,
                'fk_establishments' => $establishment->id,
            ];

            $this->entityAdress::create($dataAdress);

            return $establishment;
            // CHAMAR CONTROLLER DE VALIDAÇÃO DE EMAIL
        }


    }

    public function update(string $identify, Request $data)
    {

        $establishment = $this->getEstablishment($identify);
        $establishment->name = $data->input('name');
        $establishment->avatar = $data->input('avatar');
        $establishment->cnpj = $data->input('cnpj');
        $establishment->active = $data->input('active');
        $establishment->fk_planes = $data->input('fk_planes');

        if ($data->hasFile('avatar')) {

            $allowedfileExtension = ['jpg', 'png'];
            $file = $data->file('avatar');
            $extenstion = $file->getClientOriginalExtension();
            $check = in_array($extenstion, $allowedfileExtension);

            if ($check) {
                $name = time() . '_' . $file->getClientOriginalName();
                $file->move('images/establishments', $name);
                $establishment->avatar = $name;
            }
        }

        $establishment->save();

        $adress = $this->entityAdress::where('id', $establishment->id_adress)->first();
        $adress->cep = $data->input('cep');
        $adress->public_place = $data->input('public_place');
        $adress->city = $data->input('city');
        $adress->uf = $data->input('uf');
        $adress->complement = $data->input('complement');
        $adress->reference = $data->input('reference');
        $adress->number_place = $data->input('number_place');

        $adress->save();


        return $establishment;
    }

    public function delete(string $identify)
    {
        $establishment = $this->getEstablishment($identify);
        $establishment->active = 0;
        $establishment->save();

        return $establishment;
    }
}
