<?php namespace WangDong\Http\Controllers\System;

use WangDong\Group;
use WangDong\Http\Requests;
use WangDong\Http\Controllers\Controller;

use Illuminate\Http\Request;
use WangDong\User;

class UserController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$users = User::with('group')->where(function($query) use($request){
            if($request->has('group_id') && $request->input('group_id') > 0){
                $query->where('group_id','=',$request->input('group_id'));
            }
            if($request->has('key_word')){
                $query->where(function($query)use($request){
                    $query->where('email','like',$request->input('key_word').'%')
                        ->orwhere('name','like',$request->input('key_word').'%');
                });
            }
        })->paginate(10);
        return view('users.index',['users'=>$users,'groups'=>Group::all()]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('users.create',['groups'=>Group::all()]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Requests\UserRequest $request)
	{
        //$group = Group::findOrFail($request->input('group_id'));
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->group_id = $request->input('group_id');
        $user->save();
        return redirect()->back()->with('message','添加成功');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Request $request,$id)
	{
        $user = User::findOrFail($id);
		if($request->ajax()){
            return response()->json($user->toArray());
        }else{
            //目前不需要显示用户详情的页面
            exit(0);
        }
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return view('users.edit',['user'=>User::findOrFail($id),'groups'=>Group::all()]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Requests\UserRequest $request,$id)
	{
		$user = User::findOrFail($id);
        $user->group_id = Group::findOrFail($request->input('group_id'))->id;
        $user->name = $request->input('name');
        if($request->has('is_reset_password')){
            $user->password = bcrypt($request->input('password'));
        }
        $user->save();
        if($request->ajax()){
            return response()->json($user->toArray());
        }
        return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		User::destroy($id);
        return redirect()->back();
	}

}
