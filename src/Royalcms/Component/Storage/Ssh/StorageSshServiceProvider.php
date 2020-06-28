<?php

namespace Royalcms\Component\Storage\Ssh;

use Illuminate\Contracts\Support\DeferrableProvider;
use Royalcms\Component\Storage\Ssh\Ssh2;
use Royalcms\Component\Storage\StorageServiceProvider;
use Royalcms\Component\Support\ServiceProvider;

class StorageSshServiceProvider extends ServiceProvider implements DeferrableProvider
{
	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        /**
         * Create an instance of the ssh2 driver.
         *
         * @param  array  $config
         * @return \Royalcms\Component\Contracts\Filesystem\Filesystem
         */
        $this->royalcms['storage']->extend('ssh2', function ($royalcms, array $config) {
            return $royalcms['storage']->adapt(
                $royalcms['storage']->createFilesystem(
                    new Ssh2($config),
                    $config
                )
            );
        });

	}

    /**
     * Get the events that trigger this service provider to register.
     *
     * @return array
     */
    public function when()
    {
        return [StorageServiceProvider::class];
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

}
