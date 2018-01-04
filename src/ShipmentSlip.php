<?php
namespace Adil\Shyplite;
/**
* 
*/
class ShipmentSlip extends Downloadable
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

}