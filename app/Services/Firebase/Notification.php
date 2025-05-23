<?php

namespace App\Services\Firebase;

class Notification
{
	public function send($token, $message, $title = '', $data = array())
	{
	    $fields = [
	        'to' => $token,
	        'notification' => [
	            'body'   => $message,
	            'title'     => $title,
	            'subtitle'  => '',
	            'tickerText'    => '',
	            'vibrate'   => 1,
	            'sound'     => 1,
	            'largeIcon' => 'large_icon',
	            'smallIcon' => 'small_icon',
	        ],
	        'data' => $data
	    ];

	    $headers = array(
	        'Content-Type:application/json',
	        'Authorization:key='.config('firebase.googleAPIKey')
	    );

	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
	    curl_setopt($ch, CURLOPT_POST, true);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields, JSON_FORCE_OBJECT));
	    $result = curl_exec($ch);
	    if ($result === FALSE) {
	        die('FCM Send Error: ' . curl_error($ch));
	    }
	    curl_close($ch);
	    return $result;
	}
}
