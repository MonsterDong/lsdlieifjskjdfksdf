<?php namespace WangDong;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model {

    protected $guarded = ['id','cover'];

    public function category(){
        return $this->belongsTo('WangDong\GoodsCategory','gc_id');
    }

    public function unit(){
        return $this->belongsTo('WangDong\Unit');
    }

    public function discount(){
        return $this->belongsTo('WangDong\GoodsDiscount','gd_id');
    }
}
