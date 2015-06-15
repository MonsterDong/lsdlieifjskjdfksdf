<?php namespace WangDong;

use Illuminate\Database\Eloquent\Model;

use WangDong\Events\OnActionValueChange;

class Action extends Model {

    public $timestamps = false;

    protected $guarded = ['id'];

    public function __construct(array $attributes = array()){
        parent::__construct($attributes);

        //注册事件
        static::updated(function($action){
            if($action->isDirty('value')){
                event(new OnActionValueChange($action));
            }
        });
    }

}
