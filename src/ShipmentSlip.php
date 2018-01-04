<?php
namespace Adil\Shyplite;
/**
* 
*/
class ShipmentSlip
{
	public $name;
	public $path;

	function __construct($response)
	{
		$this->name = $response->fileName;
		$this->path = $response->s3Path;
		
		foreach($response as $key => $val) {
			$this->{$key} = $val;
		}
	}

	public function download($path)
	{
		$client = new Client();
		$client->get($this->path, [
			'sink' => $path + '/' + $this->name
		]);
	}
}