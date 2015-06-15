<?php namespace WangDong;

use Illuminate\Database\Eloquent\Model;
use WangDong\Events\OnModuleValueChange;

class Module extends Model {

    public $timestamps = false;

    protected $guarded = ['id'];

    public function __construct(array $attributes = array()){
        parent::__construct($attributes);

        //注册事件
        static::updated(function($module){
            if($module->isDirty('value')){
                event(new OnModuleValueChange($module));
            }
        });
    }

    public function foundations(){
        return $this->hasMany('WangDong\Foundation');
    }

    public function actions(){
        return $this->belongsToMany('WangDong\Action','foundations');
    }
}
