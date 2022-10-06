<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSettings;
use App\Http\Resources\SettingsResource;
use App\Services\SettingsService;
use App\Models\Settings;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    
    protected $settingService;
    protected $storeUpdate;

    public function __construct(SettingsService $settingService, StoreUpdateSettings $storeUpdate)
    {
        $this->settingService = $settingService;
        $this->storeUpdate = $storeUpdate;
    }

   
    public function index()
    {
        $settings = $this->settingService->getSettings();

        return response()->json(SettingsResource::collection($settings));
    
    }

 
    public function store(Request $request)
    {
        $validate = $this->validate($request, $this->storeUpdate->validateSetting());
    
        $setting = $this->settingService->createNewSetting($request);
        return response()->json(['Configuração inserida com sucesso!'], 201);
       
    }

  
    public function show($establishment)
    {
        $setting = $this->settingService->getSetting($establishment);
        if($setting){
        return response()->json(new SettingsResource($setting));
        }else{
            return response()->json(['Configuração não foi encontrada!'], 404);
        }
    }

   
    public function update(Request $request, $id)
    {
        $validate = $this->validate($request, $this->storeUpdate->validateSetting());

        $setting = $this->settingService->updateSetting($id, $request);
        return response()->json(new SettingsResource($setting));
        
    }

   
    public function destroy($id)
    {
        $this->settingService->deleteSetting($id);
        return response()->json(['Configuração excluida com sucesso!'], 204);
    }
}