<?php namespace WangDong\Http\Middleware;

use Closure;
use Illuminate\Contracts\Routing\Middleware;
use WangDong\Foundation;

class VerifyPermission implements Middleware {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        $uri = explode('/',$request->path());
        if(count($uri) < 1){
            return $next($request);
        }
        $module_value = $uri[0];
        $action_value = count($uri) > 1 ? $uri[1] : 'index';
        $foundation = Foundation::where('module_value','=',$module_value)
            ->where('action_value','=',$action_value)->firstOrFail();
        $auth_user_group = \Session::get('auth_user_group');
        if(($foundation->permission_code & $auth_user_group->permission_code) <= 0){
            return abort(403,'Forbidden');
        }
		return $next($request);
	}

}
