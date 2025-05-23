<?php

namespace App\Services\Cometchat;

class User
{

	/**
	 * Creates a new user
	 * @param  var $uid
	 * @param  var $name
	 * @return array $data
	 */
	public function create($parameters)
	{
		return $this->request('users', 'POST', [
			'uid'  => $parameters['uid'],
			'name' => $parameters['name'],
			'avatar' => $parameters['avatar'] ?? url('uploads/users/user.png')
		]);
	}

	/**
	 * Get registered user
	 * @param  var $uid
	 * @return mixed
	 */
	public function get($uid)
	{
		return $this->request("users/{$uid}", 'GET');
	}

	/**
	 * Make an HTTP request to cometchat
	 * @param  var $url
	 * @param  var $method
	 * @param  array  $parameters
	 * @return mixed
	 */
	protected function request($url, $method, array $parameters = [])
	{
	    $headers = array(
	    	'Accept: application/json',
	        'Content-Type: application/json',
	        'apikey: '.config('cometchat.apiKey'),
	        'appid: '.config('cometchat.appId')
	    );

	    $curlopt_post = false;

	    if ($method == 'POST') {
	    	$curlopt_post = true;
	    }

	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, "https://api-us.cometchat.io/v3.0/{$url}");
	    curl_setopt($ch, CURLOPT_POST, $curlopt_post);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	    if ($method == 'POST') {
	    	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
	    }
	    $result = curl_exec($ch);
	    if ($result === FALSE) {
	        die(curl_error($ch));
	    }
	    curl_close($ch);
	    return $result;
	}

}