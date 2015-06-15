<?php namespace WangDong\Handlers\Events;

use WangDong\Events\OnActionValueChange;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use WangDong\Foundation;

class FoundationActionValueSync {

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
	 * @param  OnActionValueChange  $event
	 * @return void
	 */
	public function handle(OnActionValueChange $event)
	{
		return Foundation::where('action_id','=',$event->action->id)->update(['action_value'=>$event->action->value]);
	}

}
