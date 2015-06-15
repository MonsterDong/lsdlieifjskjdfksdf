<?php
/**
 * Created by PhpStorm.
 * User: dongdong
 * Date: 2015/3/24
 * Time: 11:43
 */

namespace WangDong;
use Illuminate\Database\Eloquent\Model;

class Group extends Model {

    /**
     * 定义模型操作的数据库表
     *
     * @var string
    */
    protected $table = 'groups';

    /**
     * 创建组时忽略id
     *
     * @var array
    */
    protected $guarded = ['id'];

    /**
     * 取消时间戳
     *
     * @var bool
    */
    public $timestamps = false;

    /**
     * 定义组和用户，一对多的关系
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users(){
        return $this->hasMany('Wangdong\User');
    }
} 