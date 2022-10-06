<?php

namespace App\Services;

use App\Repositories\NotificationsRepository;
use Illuminate\Http\Request;

class NotificationsService
{
    protected $repository;

    public function __construct(NotificationsRepository $notificationRepository)
    {
        $this->repository = $notificationRepository;
    }

    public function getNotifications(string $establishment)
    {
        return $this->repository->getAll($establishment);
    }

    public function createNewNotification(Request $data)
    {
        return $this->repository->createNew($data);
    }

    public function getNotification(string $identify)
    {
        return $this->repository->getNotification($identify);
    }

    public function updateNotification(string $identify, $data)
    {
        return $this->repository->update($identify, $data);
    }

    public function deleteNotification(string $identify)
    {
        return $this->repository->delete($identify);
    }
}