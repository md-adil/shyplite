<?php
namespace Adil\Shyplite\Model;
/**
* 
*/
class Slip extends Model
{
	use Downloadable;
	public $name;
	public $path;

	function __construct(array $attributes)
	{
		parent::__construct($attributes);
		$this->setDownloadableAttributes();
	}

	public function setDownloadableAttributes()
	{
		if(isset($this->attributes['fileName'])) {
			$this->name = $this->attributes['fileName'];
		}
		if(isset($this->attributes['s3Path'])) {
			$path = $this->attributes['s3Path'];
			if(is_array($path)) {
				$this->path = $path[0];
			} else {
				$this->path = $path;
			}
		}
	}
}

