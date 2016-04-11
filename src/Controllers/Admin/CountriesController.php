<?php namespace Sanatorium\Addresses\Controllers\Admin;

use Platform\Access\Controllers\AdminController;
use Sanatorium\Addresses\Repositories\Countries\CountriesRepositoryInterface;

class CountriesController extends AdminController {

	/**
	 * {@inheritDoc}
	 */
	protected $csrfWhitelist = [
		'executeAction',
	];

	/**
	 * The Addresses repository.
	 *
	 * @var \Sanatorium\Addresses\Repositories\Countries\CountriesRepositoryInterface
	 */
	protected $countries;

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
	 * @param  \Sanatorium\Addresses\Repositories\Countries\CountriesRepositoryInterface  $countries
	 * @return void
	 */
	public function __construct(CountriesRepositoryInterface $countries)
	{
		parent::__construct();

		$this->countries = $countries;
	}

	/**
	 * Display a listing of countries.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		return view('sanatorium/addresses::countries.index');
	}

	/**
	 * Datasource for the countries Data Grid.
	 *
	 * @return \Cartalyst\DataGrid\DataGrid
	 */
	public function grid()
	{
		$data = $this->countries->grid();

		$columns = [
			'id',
			'name_simple',
			'name',
			'cca2',
			'ccn3',
			'cca3',
			'cioc',
			'currency',
			'callingCode',
			'capital',
			'altSpellings',
			'region',
			'subregion',
			'tld',
			'languages',
			'translations',
			'latlng',
			'demonym',
			'landlocked',
			'borders',
			'area',
			'code',
			'delivering',
			'created_at',
		];

		$settings = [
			'sort'      => 'created_at',
			'direction' => 'desc',
		];

		$transformer = function($element)
		{
			$element->edit_uri = route('admin.sanatorium.addresses.countries.edit', $element->id);

			return $element;
		};

		return datagrid($data, $columns, $settings, $transformer);
	}

	/**
	 * Show the form for creating new countries.
	 *
	 * @return \Illuminate\View\View
	 */
	public function create()
	{
		return $this->showForm('create');
	}

	/**
	 * Handle posting of the form for creating new countries.
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store()
	{
		return $this->processForm('create');
	}

	/**
	 * Show the form for updating countries.
	 *
	 * @param  int  $id
	 * @return mixed
	 */
	public function edit($id)
	{
		return $this->showForm('update', $id);
	}

	/**
	 * Handle posting of the form for updating countries.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update($id)
	{
		return $this->processForm('update', $id);
	}

	/**
	 * Remove the specified countries.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete($id)
	{
		$type = $this->countries->delete($id) ? 'success' : 'error';

		$this->alerts->{$type}(
			trans("sanatorium/addresses::countries/message.{$type}.delete")
		);

		return redirect()->route('admin.sanatorium.addresses.countries.all');
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
				$this->countries->{$action}($row);
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
		// Do we have a countries identifier?
		if (isset($id))
		{
			if ( ! $countries = $this->countries->find($id))
			{
				$this->alerts->error(trans('sanatorium/addresses::countries/message.not_found', compact('id')));

				return redirect()->route('admin.sanatorium.addresses.countries.all');
			}
		}
		else
		{
			$countries = $this->countries->createModel();
		}

		// Show the page
		return view('sanatorium/addresses::countries.form', compact('mode', 'countries'));
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
		// Store the countries
		list($messages) = $this->countries->store($id, request()->all());

		// Do we have any errors?
		if ($messages->isEmpty())
		{
			$this->alerts->success(trans("sanatorium/addresses::countries/message.success.{$mode}"));

			return redirect()->route('admin.sanatorium.addresses.countries.all');
		}

		$this->alerts->error($messages, 'form');

		return redirect()->back()->withInput();
	}

}
