<?php
use Adil\Shyplite\Order;
use Adil\Shyplite\Shyplite;
use PHPUnit\Framework\TestCase;

require('vendor/autoload.php');

class ShypliteTest extends TestCase {
	protected $shyplite;

	public function setUp()
	{
		$this->shyplite = new Shyplite([]);
	}
	public function testOrder()
	{
		$this->assertInstanceOf( Order::class , $this->shyplite->order() );
	}
}