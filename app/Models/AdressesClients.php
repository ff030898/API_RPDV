<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class AdressesClients extends Model
{
    use HasFactory;

    protected $fillable = ['cep', 'public_place', 'city', 'uf', 'complement', 'reference', 'number_place', 'fk_clients'];

}