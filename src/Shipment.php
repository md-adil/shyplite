<?php
namespace Adil\Shyplite;

use Adil\Shyplite\Model\Manifest;
use Adil\Shyplite\Model\Slip;
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

	public function getSlip($number)
	{
		// dd($number);
		$response = $this->app->authRequest()->get($this->configs['get_slip_uri'], [
			'query' => [ 'orderID' => $number ]
		]);
		
		return new Slip(json_decode((string)$response->getBody(), 1));
	}

	public function track($number)
	{
		$response = $this->app->authRequest()->get($this->configs['track_uri'] . '/' . $number);
		return json_decode((string)$response->getBody());
	}

	public function getManifest($id)
	{
		$response = $this->app->authRequest()->get($this->configs['manifest_uri'] . '/' . $id);
		return new Manifest(json_decode((string)$response->getBody(), 1));
	}
}

