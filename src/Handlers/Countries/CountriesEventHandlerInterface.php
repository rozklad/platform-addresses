<?php namespace Sanatorium\Addresses\Handlers\Countries;

use Sanatorium\Addresses\Models\Countries;
use Cartalyst\Support\Handlers\EventHandlerInterface as BaseEventHandlerInterface;

interface CountriesEventHandlerInterface extends BaseEventHandlerInterface {

	/**
	 * When a countries is being created.
	 *
	 * @param  array  $data
	 * @return mixed
	 */
	public function creating(array $data);

	/**
	 * When a countries is created.
	 *
	 * @param  \Sanatorium\Addresses\Models\Countries  $countries
	 * @return mixed
	 */
	public function created(Countries $countries);

	/**
	 * When a countries is being updated.
	 *
	 * @param  \Sanatorium\Addresses\Models\Countries  $countries
	 * @param  array  $data
	 * @return mixed
	 */
	public function updating(Countries $countries, array $data);

	/**
	 * When a countries is updated.
	 *
	 * @param  \Sanatorium\Addresses\Models\Countries  $countries
	 * @return mixed
	 */
	public function updated(Countries $countries);

	/**
	 * When a countries is deleted.
	 *
	 * @param  \Sanatorium\Addresses\Models\Countries  $countries
	 * @return mixed
	 */
	public function deleted(Countries $countries);

}
