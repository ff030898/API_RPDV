<?php

namespace App\Repositories;

use App\Models\Cashiers;
use App\Models\Orders;
use App\Models\Withdrawals;

class CashiersValuesRepository
{
    protected $entity;
    protected $entityOrders;
    protected $entityWithdraw;

    public function __construct(Cashiers $cashier, Orders $orders, Withdrawals $withdraw)
    {
        $this->entity = $cashier;
        $this->entityOrders = $orders;
        $this->entityWithdraw = $withdraw;
    }

    public function getCountIDCashier(string $identify)
    {
        $count = $this->entity::where('fk_establishments', $identify)->get();
        $newCount = $count->count();

        return $newCount + 1;
    }

    public function setUpdateCashierOpen(string $identify){

        $cashier = $this->entity::select('cashiers.*')
            ->where('cashiers.fk_establishments', '=', $identify)
            ->where('cashiers.open', '=', 1)
            ->first();

        if($cashier !== null){

            $ordersMoney = $this->entityOrders::where('fk_establishments', $identify)
            ->where('fk_cashiers', '=', $cashier->id)
            ->where('payment', '=', 1)
            ->where('payment_type', '=', 'money')
            ->sum('total');

            $ordersDebit = $this->entityOrders::where('fk_establishments', $identify)
                ->where('fk_cashiers', '=', $cashier->id)
                ->where('payment', '=', 1)
                ->where('payment_type', '=', 'debit')
                ->sum('total');

            $ordersCredit = $this->entityOrders::where('fk_establishments', $identify)
            ->where('fk_cashiers', '=', $cashier->id)
            ->where('payment', '=', 1)
            ->where('payment_type', '=', 'credit')
            ->sum('total');

            $ordersOthers = $this->entityOrders::where('fk_establishments', $identify)
            ->where('fk_cashiers', '=', $cashier->id)
            ->where('payment', '=', 1)
            ->where('payment_type', '=', 'others')
            ->sum('total');

            $ordersDelivery_fee = $this->entityOrders::where('fk_establishments', $identify)
            ->where('fk_cashiers', '=', $cashier->id)
            ->where('payment', '=', 1)
            ->where('type', '=', 'delivery')
            ->sum('rate');

            $ordersTable_fee = $this->entityOrders::where('fk_establishments', $identify)
            ->where('fk_cashiers', '=', $cashier->id)
            ->where('payment', '=', 1)
            ->where('type', '=', 'table')
            ->sum('rate');

            $ordersWithdraw = $this->entityWithdraw::where('fk_cashiers', $cashier->id)
            ->sum('value');

            $sumMoney = $ordersMoney;
            $sumDebit = $ordersDebit;
            $sumCredit = $ordersCredit;
            $sumOthers = $ordersOthers;
            $sumDelivery_fee = $ordersDelivery_fee;
            $sumTable_fee = $ordersTable_fee;
            $sumWithdrawals = $ordersWithdraw;

            $cashier->money = $sumMoney;
            $cashier->debit = $sumDebit;
            $cashier->credit = $sumCredit;
            $cashier->others = $sumOthers;
            $cashier->delivery_fee = $sumDelivery_fee;
            $cashier->table_fee = $sumTable_fee;
            $cashier->withdraw = $sumWithdrawals;
            $cashier->subtotal = ($sumMoney + $sumDebit + $sumCredit + $sumOthers);
            $cashier->total = ( ($cashier->initial + $cashier->subtotal) - $sumWithdrawals);

            $cashier->save();

        }



    }



}
