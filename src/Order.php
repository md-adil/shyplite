<?php
namespace Adil\Shyplite;
/**
* 
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

		$response = $this->app->authRequest()->put($this->configs['order'], [
			'json' => $orders
		]);

		return json_decode((string)$response->getBody());
	}

	protected function validate($orders) {
		foreach($orders as $order) {
			foreach ($order as $key => $value) {
				$this->validateOrderDetail($key, $value)
			}
		}
	}

	protected function validateOrderDetail($field, $value)
	{
		switch ($field) {
			case 'orderId':
				# code...
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
