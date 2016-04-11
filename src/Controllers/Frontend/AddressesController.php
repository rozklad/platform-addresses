<?php namespace Sanatorium\Addresses\Controllers\Frontend;

use Platform\Foundation\Controllers\Controller;

class AddressesController extends Controller {

	/**
	 * Return the main view.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		return view('sanatorium/addresses::index');
	}

}
