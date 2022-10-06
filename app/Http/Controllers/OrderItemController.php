<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateOrdersItems;
use App\Http\Resources\OrdersItemsResource;
use App\Services\OrdersItemsService;
use App\Models\OrdersItems;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    
    protected $itemService;
    protected $storeUpdate;

    public function __construct(OrdersItemsService $itemService, StoreUpdateOrdersItems $storeUpdate)
    {
        $this->itemService = $itemService;
        $this->storeUpdate = $storeUpdate;
    }

   
    public function index($id)
    {
        $items = $this->itemService->getOrdersItems($id);

        return response()->json(OrdersItemsResource::collection($items));
    
    }

    public function show($order, $product)
    {
        $item = $this->itemService->getItem($order, $product);


        if($item){
        return response()->json(new OrdersItemsResource($item));
        }else{
            return response()->json(['Item não foi encontrado!'], 404);
        }
    
    }

 
    public function store(Request $request)
    {
        $validate = $this->validate($request, $this->storeUpdate->validateOrderItem());
    
        $item = $this->itemService->createNewOrderItem($request);
        return response()->json(['Item inserido com sucesso!'], 201);
       
    }

  
    public function destroy($order, $product)
    {
        $this->itemService->deleteOrderItem($order, $product);
        return response()->json(['Itens excluido com sucesso!'], 204);
    }
}