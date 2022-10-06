<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePlanes;
use App\Http\Resources\PlanesResource;
use App\Services\PlanesService;
use App\Models\Planes;
use Illuminate\Http\Request;

class PlanesController extends Controller
{
    
    protected $planesService;
    protected $storeUpdate;

    public function __construct(PlanesService $planesService, StoreUpdatePlanes $storeUpdate)
    {
        $this->planesService = $planesService;
        $this->storeUpdate = $storeUpdate;
    }

   
    public function index()
    {
        $planes = $this->planesService->getPlanes();

        return response()->json(PlanesResource::collection($planes));
    
    }

 
    public function store(Request $request)
    {
        $validate = $this->validate($request, $this->storeUpdate->validatePlane());
    
        $plane = $this->planesService->createNewPlane($request);
        return response()->json(['Plano inserido com sucesso!'], 201);
       
    }

  
    public function show($id)
    {
        $plane = $this->planesService->getPlane($id);
        if($plane){
        return response()->json(new PlanesResource($plane ));
        }else{
            return response()->json(['Plano não foi encontrado!'], 404);
        }
    }

   
    public function update(Request $request, $id)
    {
        $validate = $this->validate($request, $this->storeUpdate->validatePlane());

        $plane = $this->planesService->updatePlane($id, $request);
        return response()->json(new PlanesResource($plane));
        
    }

   
    public function destroy($id)
    {
        $this->planesService->deletePlane($id);
        return response()->json(['Plano excluido com sucesso!'], 204);
    }
}