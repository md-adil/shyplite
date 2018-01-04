<?php
namespace Adil\Shyplite;
use GuzzleHttp\Client;
/**
* 
*/
class Manifest
{
	public $name;
	public $path;

	function __construct($response) {
		$this->name = $response->name;
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