<?php
namespace Adil\Shyplite;

use GuzzleHttp\Client;
/**
* 
*/
class Downloadable
{
	
	public $name;
	public $path;
	
	public function download($path)
	{
		$client = new Client();
		$client->get($this->path, [
			'sink' => $path + '/' + $this->name
		]);
	}
}
