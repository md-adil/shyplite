<?php
namespace Adil\Shyplite\Model;
use GuzzleHttp\Client;
/**
* 
*/
trait Downloadable
{
	public function download($path)
	{
		$client = new Client();
		$client->get($this->path, [
			'sink' => $path . '/' . $this->name
		]);
	}
}

