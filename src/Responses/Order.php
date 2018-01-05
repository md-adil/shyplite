<?php
namespace Adil\Shyplite\Responses;

class Order {
	
	protected $_error;

	function __construct(array $order, $response)
	{
		$this->setFields($order);
		$this->setResponse($response);
	}

	protected function setFields($order)
	{
		foreach($order as $field => $value) {
			$this->{$field} = $value;
		}
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

	public function __get($prop)
	{
		return null;
	}
}
