<?php namespace WangDong\Events;

use WangDong\Events\Event;

use Illuminate\Queue\SerializesModels;

class OnActionValueChange extends Event {

	use SerializesModels;

    public $action;
	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct($action)
	{
		$this->action = $action;
	}

}
