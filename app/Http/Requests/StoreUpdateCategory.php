<?php

namespace App\Http\Requests;

class StoreUpdateCategory
{

    public function validateCategory()
    {
        return [
            'desc' => ['required', 'min:3', 'max:50'],
        ];

    }
}
