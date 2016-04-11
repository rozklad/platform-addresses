<?php namespace Sanatorium\Addresses\Repositories\Address;

use Cartalyst\Support\Traits;
use Illuminate\Container\Container;
use Symfony\Component\Finder\Finder;

class AddressRepository implements AddressRepositoryInterface {

	use Traits\ContainerTrait, Traits\EventTrait, Traits\RepositoryTrait, Traits\ValidatorTrait;

	/**
	 * The Data handler.
	 *
	 * @var \Sanatorium\Addresses\Handlers\Address\AddressDataHandlerInterface
	 */
	protected $data;

	/**
	 * The Eloquent addresses model.
	 *
	 * @var string
	 */
	protected $model;

	/**
	 * Constructor.
	 *
	 * @param  \Illuminate\Container\Container  $app
	 * @return void
	 */
	public function __construct(Container $app)
	{
		$this->setContainer($app);

		$this->setDispatcher($app['events']);

		$this->data = $app['sanatorium.addresses.address.handler.data'];

		$this->setValidator($app['sanatorium.addresses.address.validator']);

		$this->setModel(get_class($app['Sanatorium\Addresses\Models\Address']));
	}

	/**
	 * {@inheritDoc}
	 */
	public function grid()
	{
		return $this
			->createModel();
	}

	/**
	 * {@inheritDoc}
	 */
	public function findAll()
	{
		return $this->container['cache']->rememberForever('sanatorium.addresses.address.all', function()
		{
			return $this->createModel()->get();
		});
	}

	/**
	 * {@inheritDoc}
	 */
	public function find($id)
	{
		return $this->container['cache']->rememberForever('sanatorium.addresses.address.'.$id, function() use ($id)
		{
			return $this->createModel()->find($id);
		});
	}

	/**
	 * {@inheritDoc}
	 */
	public function validForCreation(array $input)
	{
		return $this->validator->on('create')->validate($input);
	}

	/**
	 * {@inheritDoc}
	 */
	public function validForUpdate($id, array $input)
	{
		return $this->validator->on('update')->validate($input);
	}

	/**
	 * {@inheritDoc}
	 */
	public function store($id, array $input)
	{
		return ! $id ? $this->create($input) : $this->update($id, $input);
	}

	/**
	 * {@inheritDoc}
	 */
	public function create(array $input)
	{
		// Create a new address
		$address = $this->createModel();

		// Fire the 'sanatorium.addresses.address.creating' event
		if ($this->fireEvent('sanatorium.addresses.address.creating', [ $input ]) === false)
		{
			return false;
		}

		// Prepare the submitted data
		$data = $this->data->prepare($input);

		// Validate the submitted data
		$messages = $this->validForCreation($data);

		// Check if the validation returned any errors
		if ($messages->isEmpty())
		{
			// Save the address
			$address->fill($data)->save();

			// Fire the 'sanatorium.addresses.address.created' event
			$this->fireEvent('sanatorium.addresses.address.created', [ $address ]);
		}

		return [ $messages, $address ];
	}

	/**
	 * {@inheritDoc}
	 */
	public function update($id, array $input)
	{
		// Get the address object
		$address = $this->find($id);

		// Fire the 'sanatorium.addresses.address.updating' event
		if ($this->fireEvent('sanatorium.addresses.address.updating', [ $address, $input ]) === false)
		{
			return false;
		}

		// Prepare the submitted data
		$data = $this->data->prepare($input);

		// Validate the submitted data
		$messages = $this->validForUpdate($address, $data);

		// Check if the validation returned any errors
		if ($messages->isEmpty())
		{
			// Update the address
			$address->fill($data)->save();

			// Fire the 'sanatorium.addresses.address.updated' event
			$this->fireEvent('sanatorium.addresses.address.updated', [ $address ]);
		}

		return [ $messages, $address ];
	}

	/**
	 * {@inheritDoc}
	 */
	public function delete($id)
	{
		// Check if the address exists
		if ($address = $this->find($id))
		{
			// Fire the 'sanatorium.addresses.address.deleted' event
			$this->fireEvent('sanatorium.addresses.address.deleted', [ $address ]);

			// Delete the address entry
			$address->delete();

			return true;
		}

		return false;
	}

	/**
	 * {@inheritDoc}
	 */
	public function enable($id)
	{
		$this->validator->bypass();

		return $this->update($id, [ 'enabled' => true ]);
	}

	/**
	 * {@inheritDoc}
	 */
	public function disable($id)
	{
		$this->validator->bypass();

		return $this->update($id, [ 'enabled' => false ]);
	}

}
