<?php namespace Sanatorium\Addresses\Providers;

use Cartalyst\Support\ServiceProvider;

class AddressServiceProvider extends ServiceProvider {

	/**
	 * {@inheritDoc}
	 */
	public function boot()
	{
		// Register the attributes namespace
		$this->app['platform.attributes.manager']->registerNamespace(
			$this->app['Sanatorium\Addresses\Models\Address']
		);

		// Subscribe the registered event handler
		$this->app['events']->subscribe('sanatorium.addresses.address.handler.event');

		// Register all the default hooks
        $this->registerHooks();
	}

	/**
	 * {@inheritDoc}
	 */
	public function register()
	{
		// Register the repository
		$this->bindIf('sanatorium.addresses.address', 'Sanatorium\Addresses\Repositories\Address\AddressRepository');

		// Register the data handler
		$this->bindIf('sanatorium.addresses.address.handler.data', 'Sanatorium\Addresses\Handlers\Address\AddressDataHandler');

		// Register the event handler
		$this->bindIf('sanatorium.addresses.address.handler.event', 'Sanatorium\Addresses\Handlers\Address\AddressEventHandler');

		// Register the validator
		$this->bindIf('sanatorium.addresses.address.validator', 'Sanatorium\Addresses\Validator\Address\AddressValidator');
	}

	/**
     * Register all hooks.
     *
     * @return void
     */
    protected function registerHooks()
    {
        $hooks = [
            [
            	'position' => 'register.after',
            	'hook' => 'sanatorium/addresses::hooks.register',
            ]
        ];

        $manager = $this->app['sanatorium.hooks.manager'];

        foreach ($hooks as $item) {
        	extract($item);
            $manager->registerHook($position, $hook);
        }
    }

}
