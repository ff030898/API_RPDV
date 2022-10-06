<?php

namespace App\Http\Requests;

class StoreUpdateItemsAdicionals
{

    public function validateItem()
    {
        return [
            'description' => ['required', 'min:3', 'max:100'],
            'value' => ['required', 'min:1', 'max:10'],
            'fk_establishments' => ['required', 'min:1'],
        ];
    }
}
