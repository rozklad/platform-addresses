<?php namespace Sanatorium\Addresses\Handlers\Address;

use Illuminate\Events\Dispatcher;
use Sanatorium\Addresses\Models\Address;
use Cartalyst\Support\Handlers\EventHandler as BaseEventHandler;

class AddressEventHandler extends BaseEventHandler implements AddressEventHandlerInterface {

	/**
	 * {@inheritDoc}
	 */
	public function subscribe(Dispatcher $dispatcher)
	{
		$dispatcher->listen('sanatorium.addresses.address.creating', __CLASS__.'@creating');
		$dispatcher->listen('sanatorium.addresses.address.created', __CLASS__.'@created');

		$dispatcher->listen('sanatorium.addresses.address.updating', __CLASS__.'@updating');
		$dispatcher->listen('sanatorium.addresses.address.updated', __CLASS__.'@updated');

		$dispatcher->listen('sanatorium.addresses.address.deleted', __CLASS__.'@deleted');
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
	public function created(Address $address)
	{
		$this->flushCache($address);
	}

	/**
	 * {@inheritDoc}
	 */
	public function updating(Address $address, array $data)
	{

	}

	/**
	 * {@inheritDoc}
	 */
	public function updated(Address $address)
	{
		$this->flushCache($address);
	}

	/**
	 * {@inheritDoc}
	 */
	public function deleted(Address $address)
	{
		$this->flushCache($address);
	}

	/**
	 * Flush the cache.
	 *
	 * @param  \Sanatorium\Addresses\Models\Address  $address
	 * @return void
	 */
	protected function flushCache(Address $address)
	{
		$this->app['cache']->forget('sanatorium.addresses.address.all');

		$this->app['cache']->forget('sanatorium.addresses.address.'.$address->id);
	}

}
