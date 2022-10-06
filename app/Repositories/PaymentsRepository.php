<?php

namespace App\Repositories;

use App\Models\Payments;
use Illuminate\Http\Request;

class PaymentsRepository
{
    protected $entity;

    public function __construct(Payments $payment)
    {
        $this->entity = $payment;
    }

    public function getAll(string $establishment)
    {
        return $this->entity::where('fk_establishments', $establishment)->get();
    }

    public function getPayment(string $identify)
    {
        $payment = $this->entity::where('id', $identify)->first();
        return $payment;
    }

    public function createNew(Request $data)
    {
        $payment = $data->all();
        $this->entity::create($payment);

        return $this->entity;

    }

    public function update(string $identify, Request $data)
    {

        $payment = $this->getPayment($identify);
        
        $payment->description = $data->input('description');
        $payment->value = $data->input('value');

        $payment->save();
    
        return $payment;
        
    }

    public function delete(string $identify)
    {
        $payment = $this->getPayment($identify);
       
        return $payment->delete();
        
    }
}