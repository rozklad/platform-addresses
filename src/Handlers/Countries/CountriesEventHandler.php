<?php namespace Sanatorium\Addresses\Handlers\Countries;

use Illuminate\Events\Dispatcher;
use Sanatorium\Addresses\Models\Countries;
use Cartalyst\Support\Handlers\EventHandler as BaseEventHandler;

class CountriesEventHandler extends BaseEventHandler implements CountriesEventHandlerInterface {

	/**
	 * {@inheritDoc}
	 */
	public function subscribe(Dispatcher $dispatcher)
	{
		$dispatcher->listen('sanatorium.addresses.countries.creating', __CLASS__.'@creating');
		$dispatcher->listen('sanatorium.addresses.countries.created', __CLASS__.'@created');

		$dispatcher->listen('sanatorium.addresses.countries.updating', __CLASS__.'@updating');
		$dispatcher->listen('sanatorium.addresses.countries.updated', __CLASS__.'@updated');

		$dispatcher->listen('sanatorium.addresses.countries.deleted', __CLASS__.'@deleted');
	}

	/**
	 * {@inheritDoc}
	 */
	public function creating(array $data)
	{

	}

	/**
	 * {@inheritDoc}
	 */
	public function created(Countries $countries)
	{
		$this->flushCache($countries);
	}

	/**
	 * {@inheritDoc}
	 */
	public function updating(Countries $countries, array $data)
	{

	}

	/**
	 * {@inheritDoc}
	 */
	public function updated(Countries $countries)
	{
		$this->flushCache($countries);
	}

	/**
	 * {@inheritDoc}
	 */
	public function deleted(Countries $countries)
	{
		$this->flushCache($countries);
	}

	/**
	 * Flush the cache.
	 *
	 * @param  \Sanatorium\Addresses\Models\Countries  $countries
	 * @return void
	 */
	protected function flushCache(Countries $countries)
	{
		$this->app['cache']->forget('sanatorium.addresses.countries.all');

		$this->app['cache']->forget('sanatorium.addresses.countries.'.$countries->id);
	}

}
