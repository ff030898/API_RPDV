<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateClients;
use App\Http\Resources\ClientsResource;
use App\Services\ClientsService;
use App\Models\Clients;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    
    protected $clientService;
    protected $storeUpdate;

    public function __construct(ClientsService $clientService, StoreUpdateClients $storeUpdate)
    {
        $this->clientService = $clientService;
        $this->storeUpdate = $storeUpdate;
    }

   
    public function index($id)
    {
        $clients = $this->clientService->getClients($id);

        return response()->json(ClientsResource::collection($clients));
    
    }

 
    public function store(Request $request)
    {
        $validate = $this->validate($request, $this->storeUpdate->validateClient());
    
        $client = $this->clientService->createNewClient($request);
        return response()->json(['Cliente inserido com sucesso!'], 201);
       
    }

  
    public function show($id)
    {
        $client = $this->clientService->getClient($id);
        if($client){
        return response()->json(new ClientsResource($client));
        }else{
            return response()->json(['Cliente não foi encontrado!'], 404);
        }
    }

   
    public function update(Request $request, $id)
    {
        $validate = $this->validate($request, $this->storeUpdate->validateClient());

        $client = $this->clientService->updateClient($id, $request);
        return response()->json(new ClientsResource($client));
        
    }

   
    public function destroy($id)
    {
        $this->clientService->deleteClient($id);
        return response()->json(['Cliente excluido com sucesso!'], 204);
    }
}