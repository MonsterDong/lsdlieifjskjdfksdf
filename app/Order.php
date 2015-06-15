<?php namespace WangDong;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo('WangDong\User');
    }

    public function goods(){
        return $this->belongsTo('WangDong\Goods');
    }

}
