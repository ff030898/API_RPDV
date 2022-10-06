<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Cashiers extends Model
{
    use HasFactory;

    protected $fillable = [
        'cashier_establishments', 
        'open', 
        'initial', 
        'money', 
        'debit', 
        'credit', 
        'others',
        'delivery_fee',
        'table_fee',
        'withdraw',
        'subtotal', 
        'total', 
        'fk_establishments'
    ];


}