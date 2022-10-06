<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Products extends Model
{
    use HasFactory;

    protected $fillable = ['id_establishment', 'desc', 'img', 'value_und', 'value_peq', 'value_brt', 'value_pro', 'sale', 'fk_categories', 'fk_establishments'];

}