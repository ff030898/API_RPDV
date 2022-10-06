<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePayments;
use App\Http\Resources\PaymentsResource;
use App\Services\PaymentsService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    protected $paymentService;
    protected $storeUpdate;

    public function __construct(PaymentsService $paymentService, StoreUpdatePayments $storeUpdate)
    {
        $this->paymentService = $paymentService;
        $this->storeUpdate = $storeUpdate;
    }


    public function index($establishment)
    {
        $payments = $this->paymentService->getPayments($establishment);

        return response()->json(PaymentsResource::collection($payments));
    }


    public function store(Request $request)
    {
        $validate = $this->validate($request, $this->storeUpdate->validatePayment());

        if ($validate) {
            $this->paymentService->createNewPayment($request);
            return response()->json(['Pagamento inserido com sucesso!'], 201);
        }
    }


    public function show($id)
    {
        $payment = $this->paymentService->getPayment($id);
        if ($payment) {
            return response()->json(new PaymentsResource($payment));
        } else {
            return response()->json(['Pagamento não foi encontrado!'], 404);
        }
    }


    public function update(Request $request, $id)
    {
        $validate = $this->validate($request, $this->storeUpdate->validatePayment());
        if ($validate) {
            $payment = $this->paymentService->updatePayment($id, $request);
            return response()->json(new PaymentsResource($payment));
        }
    }


    public function destroy($id)
    {
        $this->paymentService->deletePayment($id);
        return response()->json(['Pagamento excluido com sucesso!'], 204);
    }
}
