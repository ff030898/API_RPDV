<?php

namespace App\Repositories;

use App\Models\Cashiers;
use App\Models\Settings;
use Illuminate\Http\Request;
use App\Repositories\CashiersValuesRepository;

class CashiersRepository
{
    protected $entity;
    protected $entitySetting;
    protected $repositoryValues;

    public function __construct(Cashiers $cashier, Settings $setting, CashiersValuesRepository $repositoryValues)
    {
        $this->entity = $cashier;
        $this->entitySetting = $setting;
        $this->repositoryValues = $repositoryValues;
    }

    public function getAll(string $identify)
    {
        $cashiers = $this->entity::select(
            'cashiers.id',
            'cashiers.cashier_establishments',
            'cashiers.open',
            'cashiers.initial',
            'cashiers.money',
            'cashiers.debit',
            'cashiers.credit',
            'cashiers.others',
            'cashiers.delivery_fee',
            'cashiers.table_fee',
            'cashiers.withdraw',
            'cashiers.subtotal',
            'cashiers.total',
            'cashiers.fk_establishments',
            'cashiers.created_at as date',
        )
            ->where('cashiers.fk_establishments', '=', $identify)
            ->where('cashiers.open', '=', 0)
            ->get();

        return $cashiers;
    }

    public function getCashier(string $identify)
    {
        $this->repositoryValues->setUpdateCashierOpen($identify);

        $cashier = $this->entity::select(
            'cashiers.id',
            'cashiers.cashier_establishments',
            'cashiers.open',
            'cashiers.initial',
            'cashiers.money',
            'cashiers.debit',
            'cashiers.credit',
            'cashiers.others',
            'cashiers.delivery_fee',
            'cashiers.table_fee',
            'cashiers.withdraw',
            'cashiers.subtotal',
            'cashiers.total',
            'cashiers.fk_establishments',
            'cashiers.created_at as date',
        )
            ->where('cashiers.fk_establishments', '=', $identify)
            ->where('cashiers.open', '=', 1)
            ->first();

        return $cashier;
    }

    public function createNew(Request $data)
    {
        $cashier = $this->getCashier($data->input('fk_establishments'));


        if ($cashier === null) {
            $data['open'] = 1;
            $newId = $this->repositoryValues->getCountIDCashier($data->input('fk_establishments'));
            $data['cashier_establishments'] = $newId;
            $data['money'] = 0;
            $data['debit'] = 0;
            $data['credit'] = 0;
            $data['others'] = 0;
            $data['delivery_fee'] = 0;
            $data['table_fee'] = 0;
            $data['withdraw'] = 0;
            $data['subtotal'] = 0;
            $data['total'] = $data->input('initial');


            $cashier = $data->all();
            $this->entity::create($cashier);

            $setting = $this->entitySetting::where('fk_establishments', $data->input('fk_establishments'))->first();
            $setting->open = 1;
            $setting->save();

            return $this->entity;
        }
    }

    public function update(string $identify, Request $data)
    {

        $cashier = $this->getCashier($identify);

        $cashier->initial = $data->input('initial');

        $cashier->save();

        return $cashier;
    }

    public function delete(string $identify)
    {
        $cashier = $this->getCashier($identify);
        $cashier->open = 0;
        $cashier->save();

        $setting = $this->entitySetting::where('fk_establishments', $cashier->fk_establishments)->first();
        $setting->open = 0;
        $setting->save();

        // CHAMAR CONTROLLER DE IMPRIMIR DADOS DO CAIXA

        return $cashier;
    }
}
