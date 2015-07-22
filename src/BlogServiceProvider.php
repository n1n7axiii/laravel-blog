<?php namespace N1n7aXIII\Blog;

use Illuminate\Support\ServiceProvider;

class BlogServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		require __DIR__.'/routes.php';

        $this->loadViewsFrom(__DIR__.'/views', 'blog');

        $this->publishes([
            __DIR__.'/config/blog.php' => config_path('blog.php'),
            __DIR__.'/views' => base_path('resources/views/vendor/blog'),
            __DIR__.'/database/migrations' => database_path('/migrations'),
        ]);

        if (glob(__DIR__.'/model/publish/*.php')) {
            $this->publishes([
                __DIR__.'/model/publish' => app_path('/'),
            ]);
            \File::deleteDirectory(__DIR__.'/model/publish/', true);
        }
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

}
