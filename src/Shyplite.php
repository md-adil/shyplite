<?php
namespace Adil\Shyplite;

use Adil\Shyplite\Exceptions\MissingTokenException;
use GuzzleHttp\Client;
use Closure;
/**
* 
*/
class Shyplite
{
	protected $token;

	protected $configs = [
		'verified_request' => false,
		'base_uri' => 'https://api.shyplite.com',
		'order_uri' => 'order',
		'get_slip_uri' => 'getSlip',
		'availablity_uri' => 'getserviceability',
		'track_uri' => 'track',
		'manifest_uri' => 'getManifestPDF',
		'ordercancel_uri' => 'ordercancel'
	];

	protected $askToken;

	function __construct(array $configs = [])
	{
		$this->configs = array_merge($this->configs, $configs);
	}

	public function setToken($token) 
	{
		$this->token = $token;
	}
	
	public function askToken(Closure $cb)
	{
		$this->askToken = $cb;
	}

	public function getToken() 
	{
		return $this->token;
	}

	public function request(array $headers = []) {
	    $appId = $this->configs['app_id'];
		return new Client([
			'base_uri' => $this->configs['base_uri'],
			'headers' => array_merge([
				"x-appid" =>  $appId,
		        "Content-Type" =>  'application/json',
			], $headers),
			'verify' => $this->configs['verified_request']
		]);
	}

	public function authRequest() {
		if($this->askToken) {
			$this->token = call_user_func($this->askToken, $this);
		}
		if(!$this->token) {
			throw new MissingTokenException("Token is required to make authenticated request, please set token using '->setToken(\$token)'");
		}
		list($authToken, $timestamp) = $this->getAuthToken($this->token);
		return $this->request([
			'Authorization' => $authToken,
		    'x-sellerid' => $this->configs['seller_id'],
	        'x-timestamp' =>  $timestamp,
		]);
	}

	protected function getAuthToken($secret)
	{
		$timestamp = time();
	    $appId = $this->configs['app_id'];
	    $key = $this->configs['key'];
	    $sign = "key:". $key . "id:" . $appId . ":timestamp:". $timestamp;
		$authToken = rawurlencode(base64_encode(hash_hmac('sha256', $sign, $secret, true)));
		return [ $authToken, $timestamp ];
	}

	public function login($username = null, $password = null)
	{
		$username = $username ?: $this->configs['username'];
		$password = $password ?: $this->configs['password'];
		list($authToken, $timestamp) = $this->getAuthToken($this->configs['secret']);
		// die($authToken);
		$response = $this->request([
			'Authorization' => $authToken,
	        "x-timestamp" =>  $timestamp,
	        "Content-Type" =>  'application/x-www-form-urlencoded',
		])->post('login', [
			'form_params' => [
				'emailID' => $username,
				'password' => $password,
			]
		]);

		return json_decode((string)$response->getBody());
	}

	public function order()
	{
		return new Order($this, $this->configs);
	}

	public function shipment()
	{
		return new Shipment($this, $this->configs);
	}

	public function service()
	{
		return new Service($this, $this->configs);
	}
}
