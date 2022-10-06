<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Settings extends Model
{
    use HasFactory;

    protected $fillable = [
        'open', 
        'day_closed',
        'orders_tables', 
        'max_withdraw', 
        'payment_day', 
        'open_time_orders', 
        'closed_time_orders', 
        'orders_time_limit',
        'fk_establishments'
    ];

}