<?php namespace WangDong\Events;

use WangDong\Events\Event;

use Illuminate\Queue\SerializesModels;

class OnModuleValueChange extends Event {

	use SerializesModels;

    public $module;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct($module)
	{
		$this->module = $module;
	}

}
