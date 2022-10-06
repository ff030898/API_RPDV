<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCashiers;
use App\Http\Resources\CashiersResource;
use App\Services\CashiersService;
use App\Models\Cashiers;
use Illuminate\Http\Request;

class CashierController extends Controller
{

    protected $cashierService;
    protected $storeUpdate;

    public function __construct(CashiersService $cashierService, StoreUpdateCashiers $storeUpdate)
    {
        $this->cashierService = $cashierService;
        $this->storeUpdate = $storeUpdate;
    }


    public function index($id)
    {
        $cashiers = $this->cashierService->getCashiers($id);

        return response()->json(CashiersResource::collection($cashiers));
    }


    public function store(Request $request)
    {
        $validate = $this->validate($request, $this->storeUpdate->validateCashier());

        if ($validate) {
            $cashier = $this->cashierService->createNewCashier($request);
            if ($cashier) {
                return response()->json(['Caixa inserido com sucesso!'], 201);
            } else {
                return response()->json(['Já existe um caixa em aberto!'], 500);
            }
        }
    }


    public function show($id)
    {
        $cashier = $this->cashierService->getCashier($id);
        if ($cashier) {
            return response()->json(new CashiersResource($cashier));
        } else {
            return response()->json(['Caixa não foi encontrado!'], 404);
        }
    }


    public function update(Request $request, $id)
    {
        $validate = $this->validate($request, $this->storeUpdate->validateCashier());

        if ($validate) {
            $cashier = $this->cashierService->updateCashier($id, $request);
            if ($cashier) {
                return response()->json(new CashiersResource($cashier));
            }
        }
    }


    public function destroy($id)
    {
        $cashier = $this->cashierService->deleteCashier($id);
        if ($cashier) {
            return response()->json(['Caixa excluido com sucesso!'], 204);
        }
    }
}
