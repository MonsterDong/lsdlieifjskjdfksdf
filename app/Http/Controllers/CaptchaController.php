<?php namespace WangDong\Http\Controllers;

use Gregwar\Captcha\CaptchaBuilder;
use WangDong\Http\Requests;
use WangDong\Http\Controllers\Controller;

use Illuminate\Http\Request;

class CaptchaController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($ide)
	{
        $builder = new CaptchaBuilder;
        $builder->build(150,32);
        \Session::set("{$ide}_phrase",$builder->getPhrase()); //存储验证码
        return response($builder->output())->header('Content-type','image/jpeg');
	}
}
