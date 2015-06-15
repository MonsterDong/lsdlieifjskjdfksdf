<?php namespace WangDong\Http\Controllers\System;

use WangDong\Http\Requests\ModuleRequest;
use WangDong\Http\Controllers\Controller;

use Illuminate\Http\Request;
use WangDong\Module;

class ModuleController extends Controller {

	/**
	 * 显示系统模块列表
	 *
	 * @return Response
	 */
	public function index()
	{
		return \View::make('modules.index',['modules'=>Module::all()]);
	}

	/**
	 * 新添一个模块到数据库
	 *
	 * @return Response
	 */
	public function store(ModuleRequest $request)
	{
		$module = new Module();
        $module->name = $request->input('name');
        $module->value = $request->input('value');
        $module->save();
        return redirect()->back();
	}

	/**
	 * 更新系统模块到数据库
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(ModuleRequest $request,$id)
	{
        //value属性做了冗余，如果修改则触发OnModuleValueChage事件
        //所以在这里使用事物
        \DB::transaction(function() use($request,$id){
            $module = Module::findOrFail($id);
            $module->name = $request->input('name');
            $module->value = $request->input('value');
            $module->save();
        });
        return redirect()->back();
	}

    /**
     * 删除一个模块
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id){
        Module::destroy($id);
        return redirect()->back();
    }
}
