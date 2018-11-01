<?php
namespace Adil\Shyplite;

class Price {
	protected $app;
	protected $configs;

	function __construct(Shyplite $app, array $configs)
	{
		$this->app = $app;
		$this->configs = $configs;
	}

	public function calculate(array $data)
	{
		$uri = $this->configs['calculateprice'];
		$response = $this->app->authRequest()->post( $uri, $data );
		return json_decode((string)$response->getBody());
	}
}
