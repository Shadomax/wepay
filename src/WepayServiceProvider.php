<?php

namespace Erss400\Wepay;

use Illuminate\Support\ServiceProvider;

/**
 * 
 */
class WepayServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->publishes([
			__DIR__.'/../config/wepay.php' => config_path('wepay.php'),
		]);
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->mergeConfigFrom( __DIR__.'/../config/wepay.php', 'wepay'); 

		$this->app->singleton('wepay', function($app) { 
			$config = $app->make('config'); 

			$client_id = $config->get('wepay.client_id');
			$client_secret = $config->get('wepay.client_secret');
			$api_version = $config->get('wepay.api_version');
			$environment = $config->get('wepay.environment');
			$access_token = $config->get('wepay.access_token');

			return new WepayService($client_id, $client_secret, $api_version, $environment, $access_token); 
		});
	}

	public function provides() 
	{ 
		return ['wepay']; 
	}
}