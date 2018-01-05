<?php
namespace Adil\Shyplite\Laravel\Facade;

use Illuminate\Support\Facades\Facade;
use Adil\Shyplite\Shyplite as ShypliteCore;
/**
* 
*/
class Shyplite extends Facade
{
	protected static function getFacadeAccessor() { return ShypliteCore::class; }
}
