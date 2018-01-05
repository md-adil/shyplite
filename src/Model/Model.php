<?php
namespace Adil\Shyplite\Model;

class Model {

	protected $attributes = [];

	public function __construct(array $attributes = [])
	{
		$this->attributes = $attributes;
	}

	public function __get($name)
	{
		if(isset($this->attributes[$name]))
		{
			return $this->attributes[$name];
		}
		return null;
	}

	public function __set($name, $val)
	{
		$this->attributes[$name] = $val;
	}

	public function toArray()
	{
		return $this->attributes;
	}
}


