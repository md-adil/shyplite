<?php
use Adil\Shyplite\Downloadable;
use PHPUnit\Framework\TestCase;

require('vendor/autoload.php');

class DownloadableTest extends TestCase {

	public function testHasDownload()
	{
		$downloadable = new Downloadable();
		$this->assertTrue(method_exists($downloadable, 'download'));
	}
}
