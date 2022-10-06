<?php

namespace App\Http\Requests;

class StoreUpdateTablesOrders
{

    public function validateTable()
    {
        return [
            'number' => ['required', 'min:1', 'max:10'],
            'open' => ['required'],
            'fk_establishments' => ['required', 'min:1'],
            'fk_orders' => ['required', 'min:1'],
        ];
    }
}
