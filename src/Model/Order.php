<?php
namespace Adil\Shyplite\Responses;

class Order extends Model {
	
	protected $_error;
	public $id;
	function __construct(array $attributes, $response)
	{
		parent::__construct($attributes);
		$this->setResponse($response);
	}

	protected function setResponse($response)
	{
		if(!$response) return;
		if(isset($response->success)) {
			$this->id = $response->success;
		}
		if(isset($response->error)) {
			$this->_error = $response->error;
		}
	}

	public function hasError()
	{
		return !!$this->_error;
	}

	public function getError()
	{
		return $this->_error;
	}
}
