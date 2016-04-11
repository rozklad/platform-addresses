<?php namespace Sanatorium\Addresses\Providers;

use Cartalyst\Support\ServiceProvider;

class CountriesServiceProvider extends ServiceProvider {

	/**
	 * {@inheritDoc}
	 */
	public function boot()
	{
		// Register the attributes namespace
		$this->app['platform.attributes.manager']->registerNamespace(
			$this->app['Sanatorium\Addresses\Models\Countries']
		);

		// Subscribe the registered event handler
		$this->app['events']->subscribe('sanatorium.addresses.countries.handler.event');
	}

	/**
	 * {@inheritDoc}
	 */
	public function register()
	{
		// Register the repository
		$this->bindIf('sanatorium.addresses.countries', 'Sanatorium\Addresses\Repositories\Countries\CountriesRepository');

		// Register the data handler
		$this->bindIf('sanatorium.addresses.countries.handler.data', 'Sanatorium\Addresses\Handlers\Countries\CountriesDataHandler');

		// Register the event handler
		$this->bindIf('sanatorium.addresses.countries.handler.event', 'Sanatorium\Addresses\Handlers\Countries\CountriesEventHandler');

		// Register the validator
		$this->bindIf('sanatorium.addresses.countries.validator', 'Sanatorium\Addresses\Validator\Countries\CountriesValidator');
	}

}
