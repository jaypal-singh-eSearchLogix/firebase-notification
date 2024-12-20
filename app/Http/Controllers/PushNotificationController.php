<?php

namespace App\Http\Controllers;

use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;

class PushNotificationController extends Controller
{
    public function sendPushNotification()
    {
        $firebase = (new Factory)->withServiceAccount(__DIR__ . '/../../../config/firebase_credentials.json');

        $messaging = $firebase->createMessaging();

        $message = CloudMessage::fromArray([
            'token' => 'dhz4JFFNVzpb08zuvUDulR:APA91bEvmsno0l9LkLtsiYFKI496cVtPfAfdpS7dPgS7Do4054riyKWNWpYAxY6Iv868630XR5kzrICQ7kgu1UkmtnC-sK_KNzCNYR_bp9HbH28R3tTOvLA',
            'notification' => [
                'title' => 'Hello from Firebase!',
                'body' => 'This is a test notification.',
                'image'=> 'https://demo4app.com/vagaceratops/new/public/home/assets/images/fav.png'
            ],
        ]);

        $messaging->send($message);

        return response()->json(['message' => 'Push notification sent successfully']);
    }
}
