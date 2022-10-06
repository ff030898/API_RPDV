<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ContactsEstablishments extends Model
{
    use HasFactory;

    protected $fillable = ['phone', 'fk_establishments'];

}