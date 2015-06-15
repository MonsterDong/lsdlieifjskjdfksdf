<?php namespace WangDong\Http\Controllers\System;

use WangDong\Http\Requests\MenuRequest;
use WangDong\Http\Controllers\Controller;

use Illuminate\Http\Request;
use WangDong\Menu;
use WangDong\Exceptions\RequestException;

class MenuController extends Controller {

	/**
	 * 显示权限列表
	 *
	 * @return Response
	 */
	public function index($parent_id=0)
	{
        return view('menus.index',[
            'menus' => Menu::where('parent_id','=',$parent_id)->get(),
            'parent' => Menu::find($parent_id)
        ]);
	}

	/**
	 * 显示用于创建权限的表单
	 *
	 * @return Response
	 */
	public function create($id=0)
	{
        return view('menus.create',['parent'=>Menu::find($id)]);
	}

	/**
	 * 存储一个新的权限到数据库
	 *
	 * @return Response
	 */
	public function store(MenuRequest $request)
	{
        //if($request->input('parent_id'))
        //$parent = Menu::find($request->input('parent_id'));
        //添加菜单
        $menu = new Menu();
        $menu->name = $request->input('name');
        $menu->parent_id = $request->input('parent_id',0);
        $menu->url = $request->input('url');
        $menu->iconv = $request->input('iconv');
        $menu->weight = $request->input('weight');
        $menu->save();
        return redirect()->back();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(MenuRequest $request,$id)
	{
        $menu = Menu::find($id);
        $menu->name = $request->input('name');
        $menu->url = $request->input('url');
        $menu->iconv = $request->input('iconv');
        $menu->weight = $request->input('weight');
        $menu->save();
        return redirect()->back()->with('message','保存成功');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
