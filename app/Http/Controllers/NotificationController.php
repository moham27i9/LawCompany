<?php

namespace App\Http\Controllers;

use App\Services\NotificationService;
use App\Traits\ApiResponseTrait;

class NotificationController extends Controller
{
    use ApiResponseTrait;

    protected $service;

    public function __construct(NotificationService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->successResponse(
            $this->service->getAll(auth()->user()), 'جميع الإشعارات');
    }

    public function unread()
    {
        return $this->successResponse(
            $this->service->getUnread(auth()->user()), 'الإشعارات الجديدة');
    }

    public function markAll()
    {
        $this->service->markAllAsRead(auth()->user());
        return $this->successResponse(null, 'تم تعليم الكل كمقروء');
    }

    public function markOne($id)
    {
        return $this->successResponse(
            $this->service->markAsRead(auth()->user(), $id),
            'تم تعليم الإشعار كمقروء');
    }

    public function destroy($id)
    {
        $this->service->delete(auth()->user(), $id);
        return $this->successResponse(null, 'تم حذف الإشعار');
    }
}

