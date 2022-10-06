<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateNotifications;
use App\Http\Resources\NotificationsResource;
use App\Services\NotificationsService;
use App\Models\Notifications;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    
    protected $notificationService;
    protected $storeUpdate;

    public function __construct(NotificationsService $notificationService, StoreUpdateNotifications $storeUpdate)
    {
        $this->notificationService = $notificationService;
        $this->storeUpdate = $storeUpdate;
    }

   
    public function index($establishment)
    {
        $notifications = $this->notificationService->getNotifications($establishment);

        return response()->json(NotificationsResource::collection($notifications));
    
    }

 
    public function store(Request $request)
    {
        $validate = $this->validate($request, $this->storeUpdate->validateNotification());
    
        $notification = $this->notificationService->createNewNotification($request);
        return response()->json(['Notificação criada com sucesso!'], 201);
       
    }

  
    public function show($id)
    {
        $notification = $this->notificationService->getNotification($id);
        if($notification){
        return response()->json(new NotificationsResource($notification));
        }else{
            return response()->json(['Notificação não foi encontrada!'], 404);
        }
    }

   
    public function update(Request $request, $id)
    {
        $validate = $this->validate($request, $this->storeUpdate->validateNotification());

        $notification = $this->notificationService->updateNotification($id, $request);
        return response()->json(new NotificationsResource($notification));
        
    }

   
    public function destroy($id)
    {
        $this->notificationService->deleteNotification($id);
        return response()->json(['Notificação excluida com sucesso!'], 204);
    }
}