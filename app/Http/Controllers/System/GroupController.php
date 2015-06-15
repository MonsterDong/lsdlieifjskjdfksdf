<?php namespace WangDong\Http\Controllers\System;

use Illuminate\Support\MessageBag;
use WangDong\Http\Requests;
use WangDong\Http\Controllers\Controller;

use Illuminate\Http\Request;

use WangDong\Group;
use WangDong\Module;

class GroupController extends Controller {

	/**
	 * 显示用户组列表
	 *
	 * @return Response
	 */
	public function index()
	{
        return \View::make('groups.index',['groups'=>Group::all(),'modules'=>Module::with('foundations')->get()]);
	}

	/**
	 * 存储一个新的用户组
	 *
	 * @return Response
	 */
	public function store(Requests\GroupRequest $request)
	{
        Group::create([
            'name' => $request->input('name'),
            'permission_code' => $request->input('permission_code')
        ]);
        return redirect()->back()->with('message', '存储成功');
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Requests\GroupRequest $request,$id)
	{
		$group = Group::findOrFail($id);
        $group->name = $request->input('name');
        $group->permission_code = $request->input('permission_code');
        $group->save();
        return redirect()->back();
	}

	/**
	 * 从数据库删除一个用户组
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Group::destroy($id);
        return redirect()->back();
	}

}
