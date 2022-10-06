<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class TablesOrders extends Model
{
    use HasFactory;

    protected $fillable = ['number', 'open', 'fk_establishments', 'fk_orders'];
}
