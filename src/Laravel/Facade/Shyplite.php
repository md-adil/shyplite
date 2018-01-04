<?php
namespace Adil\Shyplite\Laravel\Facade;

use Illuminate\Support\Facades\Facade;
use Adil\Shyplite\Shyplite;
/**
* 
*/
class Shyplite extends Facade
{
	protected static function getFacadeAccessor() { return Shyplite::class; }
}
