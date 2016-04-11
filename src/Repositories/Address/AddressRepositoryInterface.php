<?php namespace Sanatorium\Addresses\Repositories\Address;

interface AddressRepositoryInterface {

	/**
	 * Returns a dataset compatible with data grid.
	 *
	 * @return \Sanatorium\Addresses\Models\Address
	 */
	public function grid();

	/**
	 * Returns all the addresses entries.
	 *
	 * @return \Sanatorium\Addresses\Models\Address
	 */
	public function findAll();

	/**
	 * Returns a addresses entry by its primary key.
	 *
	 * @param  int  $id
	 * @return \Sanatorium\Addresses\Models\Address
	 */
	public function find($id);

	/**
	 * Determines if the given addresses is valid for creation.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Support\MessageBag
	 */
	public function validForCreation(array $data);

	/**
	 * Determines if the given addresses is valid for update.
	 *
	 * @param  int  $id
	 * @param  array  $data
	 * @return \Illuminate\Support\MessageBag
	 */
	public function validForUpdate($id, array $data);

	/**
	 * Creates or updates the given addresses.
	 *
	 * @param  int  $id
	 * @param  array  $input
	 * @return bool|array
	 */
	public function store($id, array $input);

	/**
	 * Creates a addresses entry with the given data.
	 *
	 * @param  array  $data
	 * @return \Sanatorium\Addresses\Models\Address
	 */
	public function create(array $data);

	/**
	 * Updates the addresses entry with the given data.
	 *
	 * @param  int  $id
	 * @param  array  $data
	 * @return \Sanatorium\Addresses\Models\Address
	 */
	public function update($id, array $data);

	/**
	 * Deletes the addresses entry.
	 *
	 * @param  int  $id
	 * @return bool
	 */
	public function delete($id);

}
