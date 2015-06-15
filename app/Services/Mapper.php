<?php
/**
 * Created by PhpStorm.
 * User: dongdong
 * Date: 2015/5/13
 * Time: 14:52
 */

namespace WangDong\Services;


class Mapper {

    public static function  __callStatic($name, $arguments) {

        $classname = 'WangDong\\'.studly_case($name);

        $ret = call_user_func(array($classname,'find'),$arguments[0]);

        if(is_null($ret)){
            return '--';
        }

        return $ret->name;
    }

} 