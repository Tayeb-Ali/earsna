<?php

namespace App\Http\Controllers\API;

//use Google\Cloud\Storage\Notification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//use Kreait\Firebase\Exception\FirebaseException;
//use Kreait\Firebase\Exception\MessagingException;
//use Kreait\Firebase\Messaging;
//use Kreait\Firebase\Messaging\CloudMessage;

class FirebaseAPIController extends Controller
{

    /**
     * @throws MessagingException
     * @throws FirebaseException
     */
    public function test(Request $_r)
    {
        $messaging = app('firebase.messaging');

        $topic = 'news';
        $title = 'My Notification Title';
        $body = 'My Notification Body';
        $imageUrl = 'http://lorempixel.com/400/200/';

//        $message = CloudMessage::withTarget('topic', $topic)
//            ->withNotification($notification) // optional
//            ->withData($data) // optional
//        ;

        $message = CloudMessage::fromArray([
            'topic' => $topic,
            'notification' => [
                'title' => $_r->title,
                'body' => $_r->body,
                'imageUrl' => $_r->imageUrl,
            ], // optional
            'data' => [/* data array */], // optional
        ]);

        return $messaging->send($message);

//        dd($info);
    }


    public function setToken(Request $_r)
    {
        $user = auth()->user();
        if (isset($user)) {
            $user->device_token = $_r->device_token;
            $user->save();
            return response()->json(['success' => true, 'message' => 'Token saved successfully']);
        }
        return response()->json(['success' => false, 'message' => 'Token not set']);
    }

    public function setTopics(Request $_r)
    {
        $user = auth()->user();
        if (isset($user)) {
            $user->topics = $_r->topics;
            $user->save();
            return response()->json(['success' => true, 'message' => 'Token saved successfully']);
        }
        return response()->json(['success' => false, 'message' => 'Token not set']);
    }

}