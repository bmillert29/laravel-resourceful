<?php

namespace Nowendwell\Resourceful;

use Illuminate\Support\ServiceProvider;

class ResourcefulServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerGeneratorCommand();
        $this->registerViewsCommand();
        $this->registerExtendRoutesCommand();
        $this->registerControllerCommand();
        $this->registerBindModelToRouteCommand();
    }

    private function registerGeneratorCommand()
    {
        $this->app->singleton( 'command.nowendwell.resource', function( $app )
		{
            return $app['Nowendwell\Resourceful\Commands\ResourceMakeCommand'];
        });

        $this->commands( 'command.nowendwell.resource' );
    }

    private function registerViewsCommand()
    {
        $this->app->singleton('command.nowendwell.views', function($app) {
            return $app['Nowendwell\Resourceful\Commands\ViewsMakeCommand'];
        });

        $this->commands( 'command.nowendwell.views' );
    }

    private function registerExtendRoutesCommand()
    {
        $this->app->singleton( 'command.nowendwell.extendroutes', function($app)
		{
            return $app['Nowendwell\Resourceful\Commands\ExtendRoutesWithResourceCommand'];
        });

        $this->commands( 'command.nowendwell.extendroutes' );
    }

    private function registerControllerCommand()
    {
        $this->app->singleton( 'command.nowendwell.controller', function($app)
		{
            return $app['Nowendwell\Resourceful\Commands\ControllerMakeCommand'];
        });

        $this->commands( 'command.nowendwell.controller' );
    }

    private function registerBindModelToRouteCommand()
    {
        $this->app->singleton('command.nowendwell.bindmodel', function($app)
		{
            return $app['Nowendwell\Resourceful\Commands\BindModelToRouteCommand'];
        });

        $this->commands( 'command.nowendwell.bindmodel' );
    }

}
