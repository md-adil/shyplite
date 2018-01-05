<?php
namespace Adil\Shyplite\Laravel;
use Illuminate\Support\ServiceProvider;
use Adil\Shyplite\Shyplite;
/**
* 
*/
class ShypliteServiceProvider extends ServiceProvider
{
	
	public function register()
    {
        $this->app->singleton(Shyplite::class, function ($app) {
            return new Shyplite($app['config']['shyplite']);
        });
    }
}
