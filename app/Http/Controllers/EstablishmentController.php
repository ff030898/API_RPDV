<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Payments;
use App\Models\Settings;
use App\Models\Notifications;
use App\Http\Requests\StoreUpdateEstablishment;
use App\Http\Resources\EstablishmentResource;
use App\Services\EstablishmentService;
use Illuminate\Http\Request;

class EstablishmentController extends Controller
{

    protected $establishmentService;
    protected $storeUpdate;
    protected $payment;
    protected $setting;
    protected $notification;

    public function __construct(
        EstablishmentService $establishmentService,
        StoreUpdateEstablishment $storeUpdate,
        Payments $payment,
        Settings $setting,
        Notifications $notification
    ) {
        $this->establishmentService = $establishmentService;
        $this->storeUpdate = $storeUpdate;
        $this->payment = $payment;
        $this->setting = $setting;
        $this->notification = $notification;
    }


    public function index()
    {
        $establishments = $this->establishmentService->getEstablishments();

        return response()->json(EstablishmentResource::collection($establishments));
    }


    public function store(Request $request)
    {

        $validate = $this->validate($request, $this->storeUpdate->validateEstablishment());

        if ($validate) {
            $establishment = $this->establishmentService->createNewEstablishment($request);

            if ($establishment) {
                $dataPayment = array();
                $dataPayment = [
                    'description' => 'Mensalidade de Setembro',
                    'value' => 0,
                    'fk_establishments' => $establishment->id
                ];

                $this->payment::create($dataPayment);

                $dataSetting = array();
                $dataSetting = [
                    'open' => 0,
                    'day_closed' => 0,
                    'orders_tables' => 1,
                    'max_withdraw' => 1000,
                    'payment_day' => date('d'),
                    'open_time_orders' => '00:00:00',
                    'closed_time_orders' => '00:00:00',
                    'orders_time_limit' => '01:00:00',
                    'fk_establishments' => $establishment->id
                ];

                $this->setting::create($dataSetting);

                $dataNotification = array();
                $dataNotification = [
                    'description' => 'Bem vindo ao RPDV',
                    'type' => 'alert',
                    'view' => 0,
                    'fk_establishments' => $establishment->id
                ];

                $this->notification::create($dataNotification);

                return response()->json(['Estabelecimento cadastrado com sucesso!'], 201);
            } else {
                return response()->json(['Já existe um estabelecimento cadastrado com esse email!'], 500);
            }
        }
    }


    public function show($id)
    {
        $establishment = $this->establishmentService->getEstablishment($id);
        if ($establishment) {
            return response()->json(new EstablishmentResource($establishment));
        } else {
            return response()->json(['Estabelecimento não foi encontrado!'], 404);
        }
    }


    public function update(Request $request, $id)
    {

        $validate = $this->validate($request, $this->storeUpdate->validateEstablishment());

        if ($validate) {
            $establishment = $this->establishmentService->updateEstablishment($id, $request);
            return response()->json(['Estabelecimento alterado com sucesso! '], 201);
        }
    }


    public function destroy($id)
    {
        $establishment = $this->establishmentService->deleteEstablishment($id);
        return response()->json(['Estabelecimento excluido com sucesso!'], 204);
    }
}
