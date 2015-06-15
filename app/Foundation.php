<?php namespace WangDong;

use Illuminate\Database\Eloquent\Model;

class Foundation extends Model {

    public $timestamps = false;

    protected $guarded = ['id'];

    public function module(){
        return $this->belongsTo('WangDong\Module');
    }

    public function action(){
        return $this->belongsTo('WangDong\Action');
    }

}
