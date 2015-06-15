<?php
/**
 * Created by PhpStorm.
 * User: dongdong
 * Date: 2015/3/31
 * Time: 11:06
 */

namespace WangDong\Exceptions;


class RequestException extends \Exception {

    public function __construct($message = "", $code = 0, Exception $previous = null) {
        parent::__construct($message,$code,$previous);
        if(empty($this->message)){
            $this->message = '客户端请求异常';
        }
    }
} 