<?php namespace Dishark\Metaeloquent;

use Illuminate\Support\ServiceProvider;
use Dishark\Metaeloquent\Providers\W3cProvider;
use Dishark\Metaeloquent\Providers\OpenGraphProvider;

class MetaEloquentServiceProvider extends ServiceProvider {
	public function register()
	{
		$this->app->bind('dishark.metaeloquent.w3c', W3cProvider::class);
		$this->app->bind('dishark.metaeloquent.og', OpenGraphProvider::class);
	}
}