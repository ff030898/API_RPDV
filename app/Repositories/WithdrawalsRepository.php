<?php

namespace App\Repositories;

use App\Models\Withdrawals;
use Illuminate\Http\Request;

class WithdrawalsRepository
{
    protected $entity;

    public function __construct(Withdrawals $withdraw)
    {
        $this->entity = $withdraw;
    }

    public function getAll(string $cashiers)
    {
        $withdrawals = $this->entity::where('fk_cashiers', $cashiers)->get();
        return $withdrawals;
    }

    public function getWithdraw(string $id)
    {
        $withdraw = $this->entity::where('id', $id)->first();
        return $withdraw;
    }

    public function createNew(Request $data)
    {
        $withdraw = $data->all();
        $this->entity::create($withdraw);

        return $this->entity;

    }

    public function update(string $identify, Request $data)
    {

        $withdraw = $this->getWithdraw($identify);
        
        $withdraw->desc = $data->input('desc');
        $withdraw->img = $data->input('img');

        $withdraw->save();
    
        return $withdraw;
        
    }

    public function delete(string $identify)
    {
        $withdraw = $this->getWithdraw($identify);
       
        return $withdraw->delete();
        
    }
}