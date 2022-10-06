<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TablesOrdersResource extends JsonResource
{

    public function toArray($request)
    {
        if ($request) {
            return [
                'id' => $this->id,
                'number' => $this->number,
                'open' => $this->open ? true : false,
                'establishment_id' => $this->fk_establishments,
                'order_id' => $this->fk_orders,
                'date' => Carbon::create($this->created_at)->format('d-m-Y'),
            ];
        }
    }
}
