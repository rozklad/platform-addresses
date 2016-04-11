<?php namespace Sanatorium\Addresses\Repositories\Countries;

use Cartalyst\Support\Traits;
use Illuminate\Container\Container;
use Symfony\Component\Finder\Finder;

class CountriesRepository implements CountriesRepositoryInterface {

	use Traits\ContainerTrait, Traits\EventTrait, Traits\RepositoryTrait, Traits\ValidatorTrait;

	/**
	 * The Data handler.
	 *
	 * @var \Sanatorium\Addresses\Handlers\Countries\CountriesDataHandlerInterface
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

		$this->data = $app['sanatorium.addresses.countries.handler.data'];

		$this->setValidator($app['sanatorium.addresses.countries.validator']);

		$this->setModel(get_class($app['Sanatorium\Addresses\Models\Countries']));
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
		return $this->container['cache']->rememberForever('sanatorium.addresses.countries.all', function()
		{
			return $this->createModel()->get();
		});
	}

	/**
	 * {@inheritDoc}
	 */
	public function find($id)
	{
		return $this->container['cache']->rememberForever('sanatorium.addresses.countries.'.$id, function() use ($id)
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
		// Create a new countries
		$countries = $this->createModel();

		// Fire the 'sanatorium.addresses.countries.creating' event
		if ($this->fireEvent('sanatorium.addresses.countries.creating', [ $input ]) === false)
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
			// Save the countries
			$countries->fill($data)->save();

			// Fire the 'sanatorium.addresses.countries.created' event
			$this->fireEvent('sanatorium.addresses.countries.created', [ $countries ]);
		}

		return [ $messages, $countries ];
	}

	/**
	 * {@inheritDoc}
	 */
	public function update($id, array $input)
	{
		// Get the countries object
		$countries = $this->find($id);

		// Fire the 'sanatorium.addresses.countries.updating' event
		if ($this->fireEvent('sanatorium.addresses.countries.updating', [ $countries, $input ]) === false)
		{
			return false;
		}

		// Prepare the submitted data
		$data = $this->data->prepare($input);

		// Validate the submitted data
		$messages = $this->validForUpdate($countries, $data);

		// Check if the validation returned any errors
		if ($messages->isEmpty())
		{
			// Update the countries
			$countries->fill($data)->save();

			// Fire the 'sanatorium.addresses.countries.updated' event
			$this->fireEvent('sanatorium.addresses.countries.updated', [ $countries ]);
		}

		return [ $messages, $countries ];
	}

	/**
	 * {@inheritDoc}
	 */
	public function delete($id)
	{
		// Check if the countries exists
		if ($countries = $this->find($id))
		{
			// Fire the 'sanatorium.addresses.countries.deleted' event
			$this->fireEvent('sanatorium.addresses.countries.deleted', [ $countries ]);

			// Delete the countries entry
			$countries->delete();

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
