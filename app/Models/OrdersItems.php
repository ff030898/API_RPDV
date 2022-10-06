<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class OrdersItems extends Model
{
    use HasFactory;

    protected $fillable = [
        'fk_orders',
        'fk_products',
        'value', 
        'total',
        'qtd', 
    ];


}