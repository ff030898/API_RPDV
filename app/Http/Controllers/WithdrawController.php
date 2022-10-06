<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateWithdrawals;
use App\Http\Resources\WithdrawalsResource;
use App\Services\WithdrawalsService;
use App\Models\Withdrawals;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    
    protected $withdrawService;
    protected $storeUpdate;

    public function __construct(WithdrawalsService $withdrawService, StoreUpdateWithdrawals $storeUpdate)
    {
        $this->withdrawService = $withdrawService;
        $this->storeUpdate = $storeUpdate;
    }

   
    public function index($cashier)
    {
        $withdrawals = $this->withdrawService->getWithdrawals($cashier);

        return response()->json(WithdrawalsResource::collection($withdrawals));
    
    }

 
    public function store(Request $request)
    {
        $validate = $this->validate($request, $this->storeUpdate->validateWithdraw());
    
        $withdraw = $this->withdrawService->createNewWithdraw($request);
        return response()->json(['Retirada inserida com sucesso!'], 201);
       
    }

  
    public function show($id)
    {
        $withdraw = $this->withdrawService->getWithdraw($id);
        if($withdraw){
        return response()->json(new WithdrawalsResource($withdraw));
        }else{
            return response()->json(['Retirada não foi encontrada!'], 404);
        }
    }

   
    public function update(Request $request, $id)
    {
        $validate = $this->validate($request, $this->storeUpdate->validateWithdraw());

        $withdraw = $this->withdrawService->updateWithdraw($id, $request);
        return response()->json(new WithdrawalsResource($withdraw));
        
    }

   
    public function destroy($id)
    {
        $this->withdrawService->deleteWithdraw($id);
        return response()->json(['Retirada excluida com sucesso!'], 204);
    }
}