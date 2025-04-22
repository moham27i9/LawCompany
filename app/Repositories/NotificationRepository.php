<?php

namespace App\Repositories;

class NotificationRepository
{
    public function getAllForUser($user)
    {
        return $user->notifications;
    }

    public function getUnreadForUser($user)
    {
        return $user->unreadNotifications;
    }

    public function markAllAsRead($user)
    {
        return $user->unreadNotifications->markAsRead();
    }

    public function markAsReadById($user, $notificationId)
    {
        $notification = $user->notifications()->findOrFail($notificationId);
        $notification->markAsRead();
        return $notification;
    }

    public function deleteNotification($user, $notificationId)
    {
        return $user->notifications()->findOrFail($notificationId)->delete();
    }
}
