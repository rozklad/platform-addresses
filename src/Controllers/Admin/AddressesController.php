<?php namespace Sanatorium\Addresses\Controllers\Admin;

use Platform\Access\Controllers\AdminController;
use Sanatorium\Addresses\Repositories\Address\AddressRepositoryInterface;

class AddressesController extends AdminController {

	/**
	 * {@inheritDoc}
	 */
	protected $csrfWhitelist = [
		'executeAction',
	];

	/**
	 * The Addresses repository.
	 *
	 * @var \Sanatorium\Addresses\Repositories\Address\AddressRepositoryInterface
	 */
	protected $addresses;

	/**
	 * Holds all the mass actions we can execute.
	 *
	 * @var array
	 */
	protected $actions = [
		'delete',
		'enable',
		'disable',
	];

	/**
	 * Constructor.
	 *
	 * @param  \Sanatorium\Addresses\Repositories\Address\AddressRepositoryInterface  $addresses
	 * @return void
	 */
	public function __construct(AddressRepositoryInterface $addresses)
	{
		parent::__construct();

		$this->addresses = $addresses;
	}

	/**
	 * Display a listing of address.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		return view('sanatorium/addresses::addresses.index');
	}

	/**
	 * Datasource for the address Data Grid.
	 *
	 * @return \Cartalyst\DataGrid\DataGrid
	 */
	public function grid()
	{
		$data = $this->addresses->grid();

		$columns = [
			'id',
			'label',
			'name',
			'address_line_1',
			'address_line_2',
			'address_line_3',
			'postcode',
			'country',
			'city',
			'street',
			'street_number',
			'ic',
			'dic',
			'type',
			'created_at',
		];

		$settings = [
			'sort'      => 'created_at',
			'direction' => 'desc',
		];

		$transformer = function($element)
		{
			$element->edit_uri = route('admin.sanatorium.addresses.addresses.edit', $element->id);

			return $element;
		};

		return datagrid($data, $columns, $settings, $transformer);
	}

	/**
	 * Show the form for creating new address.
	 *
	 * @return \Illuminate\View\View
	 */
	public function create()
	{
		return $this->showForm('create');
	}

	/**
	 * Handle posting of the form for creating new address.
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store()
	{
		return $this->processForm('create');
	}

	/**
	 * Show the form for updating address.
	 *
	 * @param  int  $id
	 * @return mixed
	 */
	public function edit($id)
	{
		return $this->showForm('update', $id);
	}

	/**
	 * Handle posting of the form for updating address.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update($id)
	{
		return $this->processForm('update', $id);
	}

	/**
	 * Remove the specified address.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete($id)
	{
		$type = $this->addresses->delete($id) ? 'success' : 'error';

		$this->alerts->{$type}(
			trans("sanatorium/addresses::addresses/message.{$type}.delete")
		);

		return redirect()->route('admin.sanatorium.addresses.addresses.all');
	}

	/**
	 * Executes the mass action.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function executeAction()
	{
		$action = request()->input('action');

		if (in_array($action, $this->actions))
		{
			foreach (request()->input('rows', []) as $row)
			{
				$this->addresses->{$action}($row);
			}

			return response('Success');
		}

		return response('Failed', 500);
	}

	/**
	 * Shows the form.
	 *
	 * @param  string  $mode
	 * @param  int  $id
	 * @return mixed
	 */
	protected function showForm($mode, $id = null)
	{
		// Do we have a address identifier?
		if (isset($id))
		{
			if ( ! $address = $this->addresses->find($id))
			{
				$this->alerts->error(trans('sanatorium/addresses::addresses/message.not_found', compact('id')));

				return redirect()->route('admin.sanatorium.addresses.addresses.all');
			}
		}
		else
		{
			$address = $this->addresses->createModel();
		}

		// Show the page
		return view('sanatorium/addresses::addresses.form', compact('mode', 'address'));
	}

	/**
	 * Processes the form.
	 *
	 * @param  string  $mode
	 * @param  int  $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	protected function processForm($mode, $id = null)
	{
		// Store the address
		list($messages) = $this->addresses->store($id, request()->all());

		// Do we have any errors?
		if ($messages->isEmpty())
		{
			$this->alerts->success(trans("sanatorium/addresses::addresses/message.success.{$mode}"));

			return redirect()->route('admin.sanatorium.addresses.addresses.all');
		}

		$this->alerts->error($messages, 'form');

		return redirect()->back()->withInput();
	}

}
