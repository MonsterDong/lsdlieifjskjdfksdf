<?php namespace WangDong\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use WangDong\Foundation;

class EventServiceProvider extends ServiceProvider {

	/**
	 * The event handler mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [
		'WangDong\Events\OnModuleValueChange' => [
			'WangDong\Handlers\Events\FoundationModuleValueSync'
		],
        'WangDong\Events\OnActionValueChange' => [
            'WangDong\Handlers\Events\FoundationActionValueSync'
        ]
	];

	/**
	 * Register any other events for your application.
	 *
	 * @param  \Illuminate\Contracts\Events\Dispatcher  $events
	 * @return void
	 */
	public function boot(DispatcherContract $events)
	{
		parent::boot($events);
        /*
        Menu::created(function($menu){
            if($menu->parent){
                $menu->level = $menu->parent->level + 1;
                if($menu->level == 3){
                    $menu->permission_code = Menu::where('level','>=',3)->max('permission_code') * 2;
                    $menu->permission_code = $menu->permission_code ? $menu->permission_code : 1;
                    $cur = $menu;
                    while($parent = $cur->parent){
                        $parent->permission_code = $parent->permission_code | $menu->permission_code;
                        $cur = $cur->parent;
                    }
                }
                $menu->push();
            }
        });*/
        //注册用户添加事件
        //添加冗余
        //生成权限码
        Foundation::creating(function($foundation){
            //同步冗余信息
            $foundation->module_value = $foundation->module->value;
            $foundation->action_value = $foundation->action->value;
            if(empty($foundation->permission_code)){
                //设置权限码
                $new_permission_code = $foundation->max('permission_code') * 2;
                if($new_permission_code == 0)
                    $new_permission_code = 1;
                $foundation->permission_code = $new_permission_code;
            }
        });

        \Event::listen('auth.login',function($user,$remember){
            \Session::set('auth_user_group',$user->group);
        });

	}

}
