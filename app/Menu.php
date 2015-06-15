<?php namespace WangDong;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model {

    protected $table='menus';

    public $timestamps = false;

    protected $guarded = ['id'];

    public function parent(){
        return $this->belongsTo('WangDong\Menu','parent_id');
    }

    public static function generateSearchCode($parent_id){
        $code_len = 5;$fill_char=0;
        $t = new self();
        $code = $t->where('parent_id','=',$parent_id)->count();
        while(strlen($code) < $code_len){
            $code = $fill_char.$code;
        }
        return $code;
    }
}
