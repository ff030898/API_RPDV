<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Clients extends Model
{
    use HasFactory;

    protected $fillable = ['id_establishment', 'name', 'email', 'cpf', 'phone', 'active', 'fk_establishments'];


}