<?php namespace WangDong\Providers;

use Illuminate\Support\ServiceProvider;
use View;

class ComposerServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		View::composers([
            'WangDong\Http\ViewComposers\UnitComposer' => 'goods.index',
            'WangDong\Http\ViewComposers\GoodsCategoryComposer' => 'goods.index',
        ]);
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
