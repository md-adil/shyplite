<?php
namespace Adil\Shyplite;
/**
* 
*/
class Service
{
	protected $app;

	function __construct(Shyplite $app, $configs)
	{
		$this->app = $app;
		$this->configs = $configs;
	}

	public function availability($source, $destination)
	{
		$uri = implode('/', [
			$this->configs['availablity_uri'], $source, $destination
		]);
		$response = $this->app->authRequest()->get( $uri );
		return json_decode((string)$response->getBody());
	}
}
