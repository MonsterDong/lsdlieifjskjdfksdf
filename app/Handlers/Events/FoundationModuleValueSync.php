<?php namespace WangDong\Handlers\Events;

use WangDong\Events\OnModuleValueChange;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use WangDong\Foundation;

class FoundationModuleValueSync {

	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Handle the event.
	 *
	 * @param  OnModuleValueChange  $event
	 * @return void
	 */
	public function handle(OnModuleValueChange $event)
	{
        return Foundation::where('module_id','=',$event->module->id)->update(['module_value'=>$event->module->value]);
	}

}
