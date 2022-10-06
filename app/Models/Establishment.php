<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Establishment extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'password', 'email_verified', 'avatar', 'cnpj', 'active', 'fk_planes'];

    protected $hidden = [
        'password',
    ];

}