<?php

namespace App\Http\Controllers;

use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Validator;
use Crypt;
use App\Notification;
class userControl extends Controller
{
    public function index(){
        return view('index');
    }
    public function send(Request $request){
        if(isset($request->title)){
            $notification = new Notification();
            $title = $request->title;
            $message = isset($request->message)?$request->message:'';
            $imageUrl = isset($request->image_url)?$request->image_url:'';
            $action = isset($request->action)?$request->action:'';
            $actionDestination = isset($request->action_destination)?$request->action_destination:'';

        }
        if($actionDestination ==''){
            $action = '';
        }

        $notification->setTitle($title);
        $notification->setMessage($message);
        $notification->setImage($imageUrl);
        $notification->setAction($action);
        $notification->setActionDestination($actionDestination);

        $firebase_token = $request->firebase_token;
        $firebase_api = $request->firebase_api;

        $topic = $request->topic;
        $requestData = $notification->getNotificatin();

        if($request->send_to=='topic'){
            $fields = array(
                'to' => '/topics/' . $topic,
                'data' => $requestData,
            );

        }else{

            $fields = array(
                'to' => $firebase_token,
                'data' => $requestData,
            );
        }

        $url = 'https://fcm.googleapis.com/fcm/send';

        $headers = array(
            'Authorization: key=' . $firebase_api,
            'Content-Type: application/json'
        );

        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarily
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // Execute post
        $result = curl_exec($ch);
        if($result === FALSE){
            die('Curl failed: ' . curl_error($ch));
        }

        // Close connection
        curl_close($ch);
dd(json_encode($fields,JSON_PRETTY_PRINT));
//        return json_encode($fields,JSON_PRETTY_PRINT).'</pre></p><h3>Response </h3><p><pre>' . $result;


    }

}
