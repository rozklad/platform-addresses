<?php namespace Sanatorium\Addresses\Handlers\Address;

use Sanatorium\Addresses\Models\Address;
use Cartalyst\Support\Handlers\EventHandlerInterface as BaseEventHandlerInterface;

interface AddressEventHandlerInterface extends BaseEventHandlerInterface {

	/**
	 * When a address is being created.
	 *
	 * @param  array  $data
	 * @return mixed
	 */
	public function creating(array $data);

	/**
	 * When a address is created.
	 *
	 * @param  \Sanatorium\Addresses\Models\Address  $address
	 * @return mixed
	 */
	public function created(Address $address);

	/**
	 * When a address is being updated.
	 *
	 * @param  \Sanatorium\Addresses\Models\Address  $address
	 * @param  array  $data
	 * @return mixed
	 */
	public function updating(Address $address, array $data);

	/**
	 * When a address is updated.
	 *
	 * @param  \Sanatorium\Addresses\Models\Address  $address
	 * @return mixed
	 */
	public function updated(Address $address);

	/**
	 * When a address is deleted.
	 *
	 * @param  \Sanatorium\Addresses\Models\Address  $address
	 * @return mixed
	 */
	public function deleted(Address $address);

}
