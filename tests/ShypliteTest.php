<?php
use Adil\Shyplite\Order;
use Adil\Shyplite\Shyplite;
use PHPUnit\Framework\TestCase;

require('vendor/autoload.php');

class ShypliteTest extends TestCase {
	protected $shyplite;

	public function setUp()
	{
		$config = require('config.php');
		$this->shyplite = new Shyplite($config);
		$this->shyplite->setToken($config['token']);
	}
	public function testOrder()
	{
		$this->assertInstanceOf( Order::class , $this->shyplite->order() );
	}

	public function testPrice()
	{
		$data = [
			"sourcePin" => "110062",
			"destinationPin" => "208019",
			"orderType" => 2,
			"modeType" => 1,
			"length" => 1,
			"width" => 1,
			"height" => 1,
			"weight" => 0.5,
			"invoiceValue" => 2
		];

		$res = $this->shyplite->prices()->calculate($data);
		$this->assertTrue(is_int($res->calculatedPrice));
	}
}