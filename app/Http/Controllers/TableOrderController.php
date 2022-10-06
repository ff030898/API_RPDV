<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateTablesOrders;
use App\Http\Resources\TablesOrdersResource;
use App\Services\TablesOrdersService;
use Illuminate\Http\Request;

class TableOrderController extends Controller
{

    protected $tableService;
    protected $storeUpdate;

    public function __construct(TablesOrdersService $tableService, StoreUpdateTablesOrders $storeUpdate)
    {
        $this->tableService = $tableService;
        $this->storeUpdate = $storeUpdate;
    }


    public function index($establishment)
    {
        $tables = $this->tableService->getTables($establishment);

        return response()->json(TablesOrdersResource::collection($tables));
    }


    public function store(Request $request)
    {
        $validate = $this->validate($request, $this->storeUpdate->validateTable());

        if ($validate) {
            $this->tableService->createNewTable($request);
            return response()->json(['Mesa aberta com sucesso!'], 201);
        }
    }


    public function show($id)
    {
        $table = $this->tableService->getTable($id);
        if ($table) {
            return response()->json(new TablesOrdersResource($table));
        } else {
            return response()->json(['Mesa não foi encontrado!'], 404);
        }
    }


    public function update(Request $request, $id)
    {
        $validate = $this->validate($request, $this->storeUpdate->validateTable());

        if ($validate) {
            $table = $this->tableService->updateTable($id, $request);
            return response()->json(new TablesOrdersResource($table));
        }
    }


    public function destroy($id)
    {
        $this->tableService->deleteTable($id);
        return response()->json(['Mesa excluido com sucesso!'], 204);
    }
}
