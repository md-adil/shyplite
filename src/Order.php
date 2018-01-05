<?php
namespace Adil\Shyplite;

use Adil\Shyplite\Exceptions\InvalidOrderException;
use Adil\Shyplite\Responses\Order as OrderResponse;
/**
* @author Md Adil
*/
class Order
{
	protected $app;
	protected $orders = [];
	protected $configs;

	function __construct(Shyplite $app, $configs)
	{
		$this->app = $app;
		$this->configs = $configs;
	}

	public function add($order)
	{
		$this->orders[] = $order;
	}

	public function create($orders = [])
	{
		$orders = $orders ?: $this->orders;
		$this->validate($orders);

		$response = $this->app->authRequest()->put($this->configs['order_uri'], [
			'json' => $orders
		]);
		
		$responseData = json_decode((string)$response->getBody());
		$responseObject = [];
		foreach($orders as $key => $order) {
			$responseElement = null;
			if(isset($responseData[$key])) {
				$responseElement = $responseData[$key];
			}
			$responseObject[] = new OrderResponse($order, $responseElement);
		}
		return $responseObject;
	}

	protected function validate($orders) {
		if(count($orders) > 25) {
			throw new InvalidOrderException("It seems order numbers has been exceeded, max 25 orders willbe posted on single request", 1);
			
		}
		foreach($orders as $order) {
			foreach ($order as $key => $value) {
				$this->validateOrderDetail($key, $value);
			}
		}
	}

	protected function validateOrderDetail($field, $value)
	{
		switch ($field) {
			case 'orderId':
				if(!$value) throw new InvalidOrderException("Order id cannot be empty");
				break;
			case 'orderType':
				# code...
				break;
			case 'orderDate':
				# code...
				break;
			case 'modeType':
				# code...
				break;
			case 'customerName':
				# code...
				break;
			case 'customerAddress':
				# code...
				break;
			case 'customerCity':
				# code...
				break;
			case 'customerPinCode':
				# code...
				break;
			case 'customerContact':
				# code...
				break;
			case 'totalValue':
				# code...
				break;
			case 'categoryName':
				# code...
				break;
			case 'packageName':
				# code...
				break;
			case 'quantity':
				# code...
				break;
			case 'packageLength':
				# code...
				break;
			case 'packageWidth':
				# code...
				break;
			case 'packageHeight':
				# code...
				break;
			case 'packageWeight':
				# code...
				break;
			case 'sellerAddressId':
				# code...
				break;
			
			default:
				# code...
				break;
		}
	}

	public function cancel($orders)
	{
		$response = $this->app->authRequest()->post($this->configs['ordercancel_uri'], [
			'json' => $orders
		]);

		return json_decode((string)$response->getBody());
	}
}
