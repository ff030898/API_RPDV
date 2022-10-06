<?php

namespace App\Repositories;

use App\Models\Orders;
use Illuminate\Http\Request;
use App\Repositories\OrdersValuesRepository;

class OrdersRepository
{
    protected $entity;
    protected $repositoryValues;

    public function __construct(Orders $order, OrdersValuesRepository $repositoryValues)
    {
        $this->entity = $order;
        $this->repositoryValues = $repositoryValues;
    }

    public function getAll(string $identify, string $cashier)
    {
        if($cashier != 0){
            $orders = $this->entity::select(
                'orders.id', 
                'orders.id_establishment', 
                'orders.status', 
                'orders.payment', 
                'orders.payment_type', 
                'orders.description',
                'orders.subtotal',
                'orders.rate',
                'orders.discount',
                'orders.rate_extra',
                'orders.paid',
                'orders.change',
                'orders.total',
                'orders.type',
                'orders.deliveryman',
                'orders.created_at as date',
                'clients.id as client_id',
                'clients.id_establishment as client_establishment',
                'clients.phone as client_phone',
                'clients.name as client_name',
                'cashiers.id as cashier_id',
                'cashiers.cashier_establishments as cashier_establishment',
                'establishments.id as establishment_id',
                'establishments.name as establishment_name',
                )
                ->join('clients', 'clients.id', '=', 'orders.fk_clients')
                ->join('cashiers', 'cashiers.id', '=', 'orders.fk_cashiers')
                ->join('establishments', 'establishments.id', '=', 'orders.fk_establishments')
                ->where('orders.fk_establishments', '=', $identify)
                ->where('orders.fk_cashiers', '=', $cashier)
                ->get();

                return $orders;

        }else{
            $orders = $this->entity::select(
                'orders.id', 
                'orders.id_establishment', 
                'orders.status', 
                'orders.payment', 
                'orders.payment_type', 
                'orders.description',
                'orders.subtotal',
                'orders.rate',
                'orders.discount',
                'orders.rate_extra',
                'orders.paid',
                'orders.change',
                'orders.total',
                'orders.type',
                'orders.deliveryman',
                'orders.created_at as date',
                'clients.id as client_id',
                'clients.id_establishment as client_establishment',
                'clients.phone as client_phone',
                'clients.name as client_name',
                'cashiers.id as cashier_id',
                'cashiers.cashier_establishments as cashier_establishment',
                'establishments.id as establishment_id',
                'establishments.name as establishment_name',
                )
                ->join('clients', 'clients.id', '=', 'orders.fk_clients')
                ->join('cashiers', 'cashiers.id', '=', 'orders.fk_cashiers')
                ->join('establishments', 'establishments.id', '=', 'orders.fk_establishments')
                ->where('orders.fk_establishments', '=', $identify)
                ->get();

                return $orders;
        }
            
        
    }

    public function getOrder(string $id)
    {

        $order = $this->entity::select(
                'orders.id', 
                'orders.id_establishment', 
                'orders.status', 
                'orders.payment', 
                'orders.payment_type', 
                'orders.description',
                'orders.subtotal',
                'orders.rate',
                'orders.discount',
                'orders.rate_extra',
                'orders.paid',
                'orders.change',
                'orders.total',
                'orders.type',
                'orders.deliveryman',
                'orders.created_at as date',
                'clients.id as client_id',
                'clients.id_establishment as client_establishment',
                'clients.phone as client_phone',
                'clients.name as client_name',
                'cashiers.id as cashier_id',
                'cashiers.cashier_establishments as cashier_establishment',
                'establishments.id as establishment_id',
                'establishments.name as establishment_name',
            )
            ->join('clients', 'clients.id', '=', 'orders.fk_clients')
            ->join('cashiers', 'cashiers.id', '=', 'orders.fk_cashiers')
            ->join('establishments', 'establishments.id', '=', 'orders.fk_establishments')
            ->where('orders.id', '=', $id)
            ->first();

        return $order;
    }

    public function createNew(Request $data)
    {
        $newId = $this->repositoryValues->getCountIDOrders($data->input('fk_establishments'));
        $data['id_establishment'] = $newId;

        $order = $data->all();
        $this->entity::create($order);

        return $this->entity;
    }

    public function update(string $identify, Request $data)
    {

        $order = $this->getOrder($identify);
        
        $order->status = $data->input('status');
        $order->payment = $data->input('payment');
        $order->payment_type = $data->input('payment_type');
        $order->description = $data->input('description');
        $order->subtotal = $data->input('subtotal');
        $order->rate = $data->input('rate');
        $order->discount = $data->input('discount');
        $order->rate_extra = $data->input('rate_extra');
        $order->paid = $data->input('paid');
        $order->change = $data->input('change');
        $order->total = $data->input('total');
        $order->type = $data->input('type');
        $order->deliveryman = $data->input('deliveryman');

        $order->save();

        return $order;
        
    }

    public function delete(string $identify)
    {
        $order = $this->getOrder($identify);

        return $order->delete();
    }
}