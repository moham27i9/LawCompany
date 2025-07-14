<?php

namespace App\Broadcasting;

use Illuminate\Notifications\Notification;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification as FirebaseNotification;
use Kreait\Firebase\Factory;

class FcmChannel
{
    public function send($notifiable, Notification $notification)
    {
        if (!$notifiable->fcm_token) {
            \Log::info("🚫 No FCM token for user ID {$notifiable->id}");
            return;
        }

        // جلب بيانات الإشعار من الـ Notification
        $data = $notification->toFcm($notifiable);

        try {
            // تحميل إعدادات الخدمة من الملف
            $factory = (new Factory)->withServiceAccount(
                storage_path('app/firebase/firebase_credentials.json')
            );

            $messaging = $factory->createMessaging();

            $message = CloudMessage::withTarget('token', $data['token'])
                ->withNotification(FirebaseNotification::create(
                    $data['notification']['title'],
                    $data['notification']['body']
                ))
                ->withData($data['data']);

            \Log::info('📦 FCM message being sent: ', ['message' => $message]);

            $messaging->send($message);

            \Log::info('✅ FCM message sent successfully to user ID ' . $notifiable->id);
        } catch (\Throwable $e) {
            \Log::error('❌ FCM message failed:', [
                'user_id' => $notifiable->id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
