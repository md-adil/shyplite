<?php
namespace Adil\Shyplite;
/**
* 
*/
class Shipment
{
	protected $app;
	protected $configs;

	function __construct(Shyplite $app, $configs)
	{
		$this->app = $app;
		$this->configs = $configs;
	}

	public function getSlip()
	{
		return new ShipmentSlip($response);
	}

	public function track($number)
	{
		$response = $this->app->authRequest()->get($this->configs['track_uri'] + '/' + $number);
		return json_decode((string)$response->getBody());
	}

	public function getManifest()
	{
		$response = $this->app->authRequest()->get($this->configs['manifest_uri'])
		return new Manifest(json_decode((string)$response->getBody()));
	}
}
