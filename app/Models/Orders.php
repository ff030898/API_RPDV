<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_establishment',
        'status', 
        'payment', 
        'payment_type', 
        'description', 
        'subtotal', 
        'rate', 
        'discount',
        'rate_extra',
        'paid',
        'change', 
        'total',
        'type',
        'deliveryman',
        'fk_cashiers',
        'fk_clients',
        'fk_establishments'
    ];


}