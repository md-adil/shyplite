<?php
namespace Adil\Shyplite;

use Adil\Shyplite\Exceptions\InvalidOrderException;
use Adil\Shyplite\Model\Order as OrderModel;
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
			'json' => [ 'orders' => $orders ]
		]);
		
		$responseData = json_decode((string)$response->getBody(), 1);
		$responseObject = [];
		foreach($orders as $key => $order) {
			$responseElement = null;
			if(isset($responseData[$key])) {
				$responseElement = $responseData[$key];
			}
			$responseObject[] = new OrderModel($order, $responseElement);
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
				if(!is_numeric($value)) throw new InvalidOrderException("Order id should be numeric");
				break;
			case 'orderType':
				if(!$value) throw new InvalidOrderException("Order type cannot be empty");
				break;
			case 'orderDate':
				if(!$value) throw new InvalidOrderException("Order date cannot be empty");
				break;
			case 'modeType':
				if(!$value) throw new InvalidOrderException("Mode Type cannot be empty");
				break;
			case 'customerName':
				if(!$value) throw new InvalidOrderException("Customer name cannot be empty");
				break;
			case 'customerAddress':
				if(!$value) throw new InvalidOrderException("Customer name cannot be empty");
				break;
			case 'customerCity':
				if(!$value) throw new InvalidOrderException("Customer name cannot be empty");
				break;
			case 'customerPinCode':
				if(!$value) throw new InvalidOrderException("Customer pincode cannot be empty");
				if(!is_numeric($value)) throw new InvalidOrderException("Customer pincode should be numeric");
				break;
			case 'customerContact':
				if(!$value) throw new InvalidOrderException("Customer contact cannot be empty");
				if(!is_numeric($value)) throw new InvalidOrderException("Customer contact should be numeric");
				break;
			case 'totalValue':
				if(!$value) throw new InvalidOrderException("Total value cannot be empty");
				if(!is_numeric($value)) throw new InvalidOrderException("Total value should be numeric");
				break;
			case 'categoryName':
				if(!$value) throw new InvalidOrderException("Category name cannot be empty");
				break;
			case 'packageName':
				if(!$value) throw new InvalidOrderException("Package name cannot be empty");
				break;
			case 'quantity':
				if(!$value) throw new InvalidOrderException("Product quantity cannot be empty");
				if(!is_numeric($value)) throw new InvalidOrderException("Product quantity should be numeric");
				break;
			case 'packageLength':
				if(!$value) throw new InvalidOrderException("Package length cannot be empty");
				if(!is_numeric($value)) throw new InvalidOrderException("Package length should be numeric");
				break;
			case 'packageWidth':
				if(!$value) throw new InvalidOrderException("Package width cannot be empty");
				if(!is_numeric($value)) throw new InvalidOrderException("Package width should be numeric");
				break;
			case 'packageHeight':
				if(!$value) throw new InvalidOrderException("Package height cannot be empty");
				if(!is_numeric($value)) throw new InvalidOrderException("Package height should be numeric");
				break;
			case 'packageWeight':
				if(!$value) throw new InvalidOrderException("Package weight cannot be empty");
				f(!is_numeric($value)) throw new InvalidOrderException("Package weight should be numeric");
				break;
			case 'sellerAddressId':
				if(!$value) throw new InvalidOrderException("Seller AddressID cannot be empty");
				f(!is_numeric($value)) throw new InvalidOrderException("Seller AddressID should be numeric");
				break;
			
			default:
				# code...
				break;
		}
	}

	public function cancel($orders)
	{
		$response = $this->app->authRequest()->post($this->configs['ordercancel_uri'], [
			'json' => [ 'orders' => $orders ]
		]);

		return json_decode((string)$response->getBody());
	}
}
