<?php
namespace Adil\Shyplite\Model;
use GuzzleHttp\Client;
/**
* 
*/
class Manifest extends Model
{
	use Downloadable;
	
	public $name;
	public $path;

	function __construct(array $attributes = []) {
		parent::__construct($attributes);
		$this->setDownloadableAttribute();
	}

	protected function setDownloadableAttribute()
	{
		if(isset($this->attributes['s3Path'])) {
			$this->path = $this->attributes['s3Path'];
		}

		if(isset($this->attributes['name'])) {
			$this->name = $this->attributes['name'];
		}
	}
}

