<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateOrders;
use App\Http\Resources\OrdersResource;
use App\Services\OrdersService;
use App\Models\Orders;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    
    protected $orderService;
    protected $storeUpdate;

    public function __construct(OrdersService $orderService, StoreUpdateOrders $storeUpdate)
    {
        $this->orderService = $orderService;
        $this->storeUpdate = $storeUpdate;
    }

   
    public function index($id, $cashier)
    {
        $orders = $this->orderService->getOrders($id, $cashier);

        return response()->json(OrdersResource::collection($orders));
    
    }

 
    public function store(Request $request)
    {
        $validate = $this->validate($request, $this->storeUpdate->validateOrder());
    
        $order = $this->orderService->createNewOrder($request);
        if($order){
            return response()->json(['Pedido criado com sucesso!'], 201);
        }
        
    }

  
    public function show($id)
    {
        $order = $this->orderService->getOrder($id);
        if($order){
        return response()->json(new OrdersResource($order));
        }else{
            return response()->json(['Pedido não foi encontrado!'], 404);
        }
    }

   
    public function update(Request $request, $id)
    {
        $validate = $this->validate($request, $this->storeUpdate->validateOrder());

        $order = $this->orderService->updateOrder($id, $request);
        if($order){
            return response()->json(new OrdersResource($order));
        }
        
    }

   
    public function destroy($id)
    {
        $order = $this->orderService->deleteOrder($id);
        if($order){
           return response()->json(['Pedido cancelado!'], 204);
        }
    }
}