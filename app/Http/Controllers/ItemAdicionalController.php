<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateItemsAdicionals;
use App\Http\Resources\ItemsAdicionalsResource;
use App\Services\ItemsAdicionalsService;
use Illuminate\Http\Request;

class ItemAdicionalController extends Controller
{

    protected $itemService;
    protected $storeUpdate;

    public function __construct(ItemsAdicionalsService $itemService, StoreUpdateItemsAdicionals $storeUpdate)
    {
        $this->itemService = $itemService;
        $this->storeUpdate = $storeUpdate;
    }


    public function index($establishment)
    {
        $items = $this->itemService->getItems($establishment);

        return response()->json(ItemsAdicionalsResource::collection($items));
    }


    public function store(Request $request)
    {
        $validate = $this->validate($request, $this->storeUpdate->validateItem());

        if ($validate) {
            $this->itemService->createNewItem($request);
            return response()->json(['Item inserido com sucesso!'], 201);
        }
    }


    public function show($id)
    {
        $item = $this->itemService->getItem($id);
        if ($item) {
            return response()->json(new ItemsAdicionalsResource($item));
        } else {
            return response()->json(['Item não foi encontrado!'], 404);
        }
    }


    public function update(Request $request, $id)
    {
        $validate = $this->validate($request, $this->storeUpdate->validateItem());

        if ($validate) {
            $item = $this->itemService->updateItem($id, $request);
            return response()->json(new ItemsAdicionalsResource($item));
        }
    }


    public function destroy($id)
    {
        $this->itemService->deleteItem($id);
        return response()->json(['Item excluido com sucesso!'], 204);
    }
}
