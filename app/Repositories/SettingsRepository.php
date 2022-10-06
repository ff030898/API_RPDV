<?php

namespace App\Repositories;

use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsRepository
{
    protected $entity;

    public function __construct(Settings $setting)
    {
        $this->entity = $setting;
    }

    public function getAll()
    {
        return $this->entity->all();
    }

    public function getSetting(string $identify)
    {
        $setting = $this->entity::where('fk_establishments', $identify)->first();
        return $setting;
    }

    public function createNew(Request $data)
    {
        $setting = $data->all();
        $this->entity::create($setting);

        return $this->entity;

    }

    public function update(string $identify, Request $data)
    {

        $setting = $this->getSetting($identify);
    
        $setting->open = $data->input('open');
        $setting->day_closed = $data->input('day_closed');
        $setting->orders_tables = $data->input('orders_tables');
        $setting->max_withdraw = $data->input('max_withdraw');
        $setting->payment_day = $data->input('payment_day');
        $setting->open_time_orders= $data->input('open_time_orders');
        $setting->closed_time_orders = $data->input('closed_time_orders');
        $setting->orders_time_limit = $data->input('orders_time_limit');

        $setting->save();
    
        return $setting;
        
    }

    public function delete(string $identify)
    {
        $setting = $this->getSetting($identify);
       
        return $setting->delete();
        
    }
}