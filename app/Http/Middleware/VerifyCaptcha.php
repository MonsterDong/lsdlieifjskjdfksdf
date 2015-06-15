<?php namespace WangDong\Http\Middleware;

use Closure;

class VerifyCaptcha {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        echo \Session::get('phrase');
        exit;
        if($request->input('phrase') != \Session::get('phrase')){
            return redirect()->back()->withErrors(['captcha'=>'验证码错误']);
        }
		return $next($request);
	}

}
