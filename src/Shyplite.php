<?php
namespace Adil\Shyplite;

use Adil\Shyplite\Exceptions\MissingTokenException;
use GuzzleHttp\Client;
/**
* 
*/
class Shyplite
{
	protected $token;

	protected $configs = [
		'verified_request' => false,
		'base_uri' => 'https://api.shyplite.com',
		'order_uri' => 'orders',
		'get_slip_uri' => 'getSlip',
		'availablity_uri' => 'getserviceability',
		'track_uri' => 'track',
		'manifest_uri' => 'getManifestPDF',
		'ordercancel_uri' => 'ordercancel'
	];

	function __construct(array $configs = [])
	{
		$this->configs = array_merge($this->configs, $configs);
	}

	public function setToken($token) 
	{
		$this->token = $token;
	}

	public function request(array $headers = []) {
	    $appId = $this->configs['app_id'];
		return new Client([
			'base_uri' => $this->configs['base_uri'],
			'headers' => array_merge([
				"x-appid" =>  $appId,
		        "x-sellerid" => config('shyplite.seller_id'),
		        "Content-Type" =>  'application/json',
			], $headers),
			'verify' => $this->configs['verified_request']
		]);
	}

	public function authRequest() {
		if(!$this->token) {
			throw new MissingTokenException("Token is required to make authenticated request, please set token using '->setToken(\$token)'");
		}
		$secret = $this->token;
		$timestamp = time();
	    $appId = $this->configs['app_id'];
	    $key = $this->configs['key'];
	    $sign = "key:". $key ."id:". $appId. ":timestamp:". $timestamp;
		$authToken = rawurlencode(base64_encode(hash_hmac('sha256', $sign, $secret, true)));
		return $this->request([
			'Authorization' => $authToken,
	        "x-timestamp" =>  $timestamp,
		]);
	}

	public function login($username = null, $password = null)
	{
		$username = $username ?: $this->configs['username'];
		$password = $password ?: $this->configs['password'];

		$response = $this->client()->post('login', [
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
