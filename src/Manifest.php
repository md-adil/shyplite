<?php
namespace Adil\Shyplite;
use GuzzleHttp\Client;
/**
* 
*/
class Manifest extends Downloadable
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
}
