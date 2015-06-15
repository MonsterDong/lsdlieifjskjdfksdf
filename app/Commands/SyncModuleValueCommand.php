<?php namespace WangDong\Commands;

use WangDong\Commands\Command;

use Illuminate\Contracts\Bus\SelfHandling;

use WangDong\Foundation;

class SyncModuleValueCommand extends Command implements SelfHandling {

    protected  $module_id,$module_value;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($module_id,$value)
	{
        $this->module_id = $module_id;
        $this->module_value = $value;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
        return Foundation::where('module_id','=',$this->module_id)->update(['module_value'=>$this->module_value]);
	}

}
