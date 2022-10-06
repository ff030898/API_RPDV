<?php

namespace App\Repositories;

use App\Models\Notifications;
use Illuminate\Http\Request;

class NotificationsRepository
{
    protected $entity;

    public function __construct(Notifications $notification)
    {
        $this->entity = $notification;
    }

    public function getAll(string $establishment)
    {
        return $this->entity::where('fk_establishments', $establishment)->get();
    }

    public function getNotification(string $identify)
    {
        $notification = $this->entity::where('id', $identify)->first();
        return $notification;
    }

    public function createNew(Request $data)
    {
        $notification = $data->all();
        $this->entity::create($notification);

        return $this->entity;

    }

    public function update(string $identify, Request $data)
    {

        $notification = $this->getNotification($identify);
        
        $notification->description = $data->input('description');
        $notification->type = $data->input('type');
        $notification->view = $data->input('view');

        $notification->save();
    
        return $notification;
        
    }

    public function delete(string $identify)
    {
        $notification = $this->getNotification($identify);
       
        return $notification->delete();
        
    }
}