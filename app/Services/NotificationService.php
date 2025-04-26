<?php

namespace App\Services;

use App\Repositories\NotificationRepository;

class NotificationService
{
    protected $notificationRepository;

    public function __construct(NotificationRepository $repo)
    {
        $this->notificationRepository = $repo;
    }

    public function getAll($user)
    {
        return $this->notificationRepository->getAllForUser($user);
    }

    public function getUnread($user)
    {
        return $this->notificationRepository->getUnreadForUser($user);
    }

    public function markAllAsRead($user)
    {
        return $this->notificationRepository->markAllAsRead($user);
    }

    public function markAsRead($user, $id)
    {
        return $this->notificationRepository->markAsReadById($user, $id);
    }

    public function delete($user, $id)
    {
        return $this->notificationRepository->deleteNotification($user, $id);
    }
}
