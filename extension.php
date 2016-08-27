<?php

use Illuminate\Foundation\Application;
use Cartalyst\Extensions\ExtensionInterface;
use Cartalyst\Settings\Repository as Settings;
use Cartalyst\Permissions\Container as Permissions;

return [

	/*
	|--------------------------------------------------------------------------
	| Name
	|--------------------------------------------------------------------------
	|
	| This is your extension name and it is only required for
	| presentational purposes.
	|
	*/

	'name' => 'Addresses',

	/*
	|--------------------------------------------------------------------------
	| Slug
	|--------------------------------------------------------------------------
	|
	| This is your extension unique identifier and should not be changed as
	| it will be recognized as a new extension.
	|
	| Ideally, this should match the folder structure within the extensions
	| folder, but this is completely optional.
	|
	*/

	'slug' => 'sanatorium/addresses',

	/*
	|--------------------------------------------------------------------------
	| Author
	|--------------------------------------------------------------------------
	|
	| Because everybody deserves credit for their work, right?
	|
	*/

	'author' => 'Sanatorium',

	/*
	|--------------------------------------------------------------------------
	| Description
	|--------------------------------------------------------------------------
	|
	| One or two sentences describing the extension for users to view when
	| they are installing the extension.
	|
	*/

	'description' => 'Address manager',

	/*
	|--------------------------------------------------------------------------
	| Version
	|--------------------------------------------------------------------------
	|
	| Version should be a string that can be used with version_compare().
	| This is how the extensions versions are compared.
	|
	*/

	'version' => '3.0.2',

	/*
	|--------------------------------------------------------------------------
	| Requirements
	|--------------------------------------------------------------------------
	|
	| List here all the extensions that this extension requires to work.
	| This is used in conjunction with composer, so you should put the
	| same extension dependencies on your main composer.json require
	| key, so that they get resolved using composer, however you
	| can use without composer, at which point you'll have to
	| ensure that the required extensions are available.
	|
	*/

	'require' => [
		'platform/users',
	],

	/*
	|--------------------------------------------------------------------------
	| Autoload Logic
	|--------------------------------------------------------------------------
	|
	| You can define here your extension autoloading logic, it may either
	| be 'composer', 'platform' or a 'Closure'.
	|
	| If composer is defined, your composer.json file specifies the autoloading
	| logic.
	|
	| If platform is defined, your extension receives convetion autoloading
	| based on the Platform standards.
	|
	| If a Closure is defined, it should take two parameters as defined
	| bellow:
	|
	|	object \Composer\Autoload\ClassLoader      $loader
	|	object \Illuminate\Foundation\Application  $app
	|
	| Supported: "composer", "platform", "Closure"
	|
	*/

	'autoload' => 'composer',

	/*
	|--------------------------------------------------------------------------
	| Service Providers
	|--------------------------------------------------------------------------
	|
	| Define your extension service providers here. They will be dynamically
	| registered without having to include them in app/config/app.php.
	|
	*/

	'providers' => [

		'Sanatorium\Addresses\Providers\AddressServiceProvider',
		'Sanatorium\Addresses\Providers\CountriesServiceProvider',

	],

	/*
	|--------------------------------------------------------------------------
	| Routes
	|--------------------------------------------------------------------------
	|
	| Closure that is called when the extension is started. You can register
	| any custom routing logic here.
	|
	| The closure parameters are:
	|
	|	object \Cartalyst\Extensions\ExtensionInterface  $extension
	|	object \Illuminate\Foundation\Application        $app
	|
	*/

	'routes' => function(ExtensionInterface $extension, Application $app)
	{
		Route::group([
				'prefix'    => admin_uri().'/addresses/addresses',
				'namespace' => 'Sanatorium\Addresses\Controllers\Admin',
			], function()
			{
				Route::get('/' , ['as' => 'admin.sanatorium.addresses.addresses.all', 'uses' => 'AddressesController@index']);
				Route::post('/', ['as' => 'admin.sanatorium.addresses.addresses.all', 'uses' => 'AddressesController@executeAction']);

				Route::get('grid', ['as' => 'admin.sanatorium.addresses.addresses.grid', 'uses' => 'AddressesController@grid']);

				Route::get('create' , ['as' => 'admin.sanatorium.addresses.addresses.create', 'uses' => 'AddressesController@create']);
				Route::post('create', ['as' => 'admin.sanatorium.addresses.addresses.create', 'uses' => 'AddressesController@store']);

				Route::get('{id}'   , ['as' => 'admin.sanatorium.addresses.addresses.edit'  , 'uses' => 'AddressesController@edit']);
				Route::post('{id}'  , ['as' => 'admin.sanatorium.addresses.addresses.edit'  , 'uses' => 'AddressesController@update']);

				Route::delete('{id}', ['as' => 'admin.sanatorium.addresses.addresses.delete', 'uses' => 'AddressesController@delete']);
			});

		Route::group([
			'prefix'    => 'addresses/addresses',
			'namespace' => 'Sanatorium\Addresses\Controllers\Frontend',
		], function()
		{
			Route::get('/', ['as' => 'sanatorium.addresses.addresses.index', 'uses' => 'AddressesController@index']);
		});

					Route::group([
				'prefix'    => admin_uri().'/addresses/countries',
				'namespace' => 'Sanatorium\Addresses\Controllers\Admin',
			], function()
			{
				Route::get('/' , ['as' => 'admin.sanatorium.addresses.countries.all', 'uses' => 'CountriesController@index']);
				Route::post('/', ['as' => 'admin.sanatorium.addresses.countries.all', 'uses' => 'CountriesController@executeAction']);

				Route::get('grid', ['as' => 'admin.sanatorium.addresses.countries.grid', 'uses' => 'CountriesController@grid']);

				Route::get('create' , ['as' => 'admin.sanatorium.addresses.countries.create', 'uses' => 'CountriesController@create']);
				Route::post('create', ['as' => 'admin.sanatorium.addresses.countries.create', 'uses' => 'CountriesController@store']);

				Route::get('{id}'   , ['as' => 'admin.sanatorium.addresses.countries.edit'  , 'uses' => 'CountriesController@edit']);
				Route::post('{id}'  , ['as' => 'admin.sanatorium.addresses.countries.edit'  , 'uses' => 'CountriesController@update']);

				Route::delete('{id}', ['as' => 'admin.sanatorium.addresses.countries.delete', 'uses' => 'CountriesController@delete']);
			});

		Route::group([
			'prefix'    => 'addresses/countries',
			'namespace' => 'Sanatorium\Addresses\Controllers\Frontend',
		], function()
		{
			Route::get('/', ['as' => 'sanatorium.addresses.countries.index', 'uses' => 'CountriesController@index']);
		});
	},

	/*
	|--------------------------------------------------------------------------
	| Database Seeds
	|--------------------------------------------------------------------------
	|
	| Platform provides a very simple way to seed your database with test
	| data using seed classes. All seed classes should be stored on the
	| `database/seeds` directory within your extension folder.
	|
	| The order you register your seed classes on the array below
	| matters, as they will be ran in the exact same order.
	|
	| The seeds array should follow the following structure:
	|
	|	Vendor\Namespace\Database\Seeds\FooSeeder
	|	Vendor\Namespace\Database\Seeds\BarSeeder
	|
	*/

	'seeds' => [

		'Sanatorium\Addresses\Database\Seeds\CountriesTableSeeder',

	],

	/*
	|--------------------------------------------------------------------------
	| Permissions
	|--------------------------------------------------------------------------
	|
	| Register here all the permissions that this extension has. These will
	| be shown in the user management area to build a graphical interface
	| where permissions can be selected to allow or deny user access.
	|
	| For detailed instructions on how to register the permissions, please
	| refer to the following url https://cartalyst.com/manual/permissions
	|
	*/

	'permissions' => function(Permissions $permissions)
	{
		$permissions->group('address', function($g)
		{
			$g->name = 'Addresses';

			$g->permission('address.index', function($p)
			{
				$p->label = trans('sanatorium/addresses::addresses/permissions.index');

				$p->controller('Sanatorium\Addresses\Controllers\Admin\AddressesController', 'index, grid');
			});

			$g->permission('address.create', function($p)
			{
				$p->label = trans('sanatorium/addresses::addresses/permissions.create');

				$p->controller('Sanatorium\Addresses\Controllers\Admin\AddressesController', 'create, store');
			});

			$g->permission('address.edit', function($p)
			{
				$p->label = trans('sanatorium/addresses::addresses/permissions.edit');

				$p->controller('Sanatorium\Addresses\Controllers\Admin\AddressesController', 'edit, update');
			});

			$g->permission('address.delete', function($p)
			{
				$p->label = trans('sanatorium/addresses::addresses/permissions.delete');

				$p->controller('Sanatorium\Addresses\Controllers\Admin\AddressesController', 'delete');
			});
		});

		$permissions->group('countries', function($g)
		{
			$g->name = 'Countries';

			$g->permission('countries.index', function($p)
			{
				$p->label = trans('sanatorium/addresses::countries/permissions.index');

				$p->controller('Sanatorium\Addresses\Controllers\Admin\CountriesController', 'index, grid');
			});

			$g->permission('countries.create', function($p)
			{
				$p->label = trans('sanatorium/addresses::countries/permissions.create');

				$p->controller('Sanatorium\Addresses\Controllers\Admin\CountriesController', 'create, store');
			});

			$g->permission('countries.edit', function($p)
			{
				$p->label = trans('sanatorium/addresses::countries/permissions.edit');

				$p->controller('Sanatorium\Addresses\Controllers\Admin\CountriesController', 'edit, update');
			});

			$g->permission('countries.delete', function($p)
			{
				$p->label = trans('sanatorium/addresses::countries/permissions.delete');

				$p->controller('Sanatorium\Addresses\Controllers\Admin\CountriesController', 'delete');
			});
		});
	},

	/*
	|--------------------------------------------------------------------------
	| Widgets
	|--------------------------------------------------------------------------
	|
	| Closure that is called when the extension is started. You can register
	| all your custom widgets here. Of course, Platform will guess the
	| widget class for you, this is just for custom widgets or if you
	| do not wish to make a new class for a very small widget.
	|
	*/

	'widgets' => function()
	{

	},

	/*
	|--------------------------------------------------------------------------
	| Settings
	|--------------------------------------------------------------------------
	|
	| Register any settings for your extension. You can also configure
	| the namespace and group that a setting belongs to.
	|
	*/

	'settings' => function(Settings $settings, Application $app)
	{

	},

	/*
	|--------------------------------------------------------------------------
	| Menus
	|--------------------------------------------------------------------------
	|
	| You may specify the default various menu hierarchy for your extension.
	| You can provide a recursive array of menu children and their children.
	| These will be created upon installation, synchronized upon upgrading
	| and removed upon uninstallation.
	|
	| Menu children are automatically put at the end of the menu for extensions
	| installed through the Operations extension.
	|
	| The default order (for extensions installed initially) can be
	| found by editing app/config/platform.php.
	|
	*/

	'menus' => [

		'admin' => [
			[
				'slug' => 'admin-sanatorium-addresses',
				'name' => 'Addresses',
				'class' => 'fa fa-envelope',
				'uri' => 'addresses',
				'regex' => '/:admin\/addresses/i',
				'children' => [
					[
						'class' => 'fa fa-envelope',
						'name' => 'Addresses',
						'uri' => 'addresses/addresses',
						'regex' => '/:admin\/addresses\/address/i',
						'slug' => 'admin-sanatorium-addresses-address',
					],
					[
						'class' => 'fa fa-globe',
						'name' => 'Countries',
						'uri' => 'addresses/countries',
						'regex' => '/:admin\/addresses\/countries/i',
						'slug' => 'admin-sanatorium-addresses-countries',
					],
				],
			],
		],
		'main' => [
			
		],
	],

];
