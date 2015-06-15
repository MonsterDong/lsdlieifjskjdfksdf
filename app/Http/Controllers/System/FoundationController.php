<?php namespace WangDong\Http\Controllers\System;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use WangDong\Action;
use WangDong\Http\Requests\FoundationRequest;
use WangDong\Http\Controllers\Controller;

use Illuminate\Http\Request;
use WangDong\Module;
use WangDong\Exceptions\RequestException;
use WangDong\Foundation;

class FoundationController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $query = (new Foundation())->newQuery();
        if(\Request::has('module_id') && intval(\Request::input('module_id')) > 0){
            $query->where('module_id','=',\Request::input('module_id'));
        }
        $foundations = $query->with('module','action')->paginate(10);
		return view('foundations.index',['modules'=>Module::all(),'foundations'=>$foundations]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('foundations.create',['modules'=>Module::all(),'actions'=>Action::all()]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(FoundationRequest $request)
	{
        $foundation = new Foundation();
        $foundation->module_id = $request->input('module_id');
        $foundation->action_id = $request->input('action_id');
        $foundation->name = $request->input('name');
        $foundation->permission_code = $request->input('permission_code');
        $foundation->save();
        return redirect()->back()->with('message','添加成功');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request,$id)
	{
		$founcation = Foundation::findOrFail($id);
        $founcation->name = $request->input('name');
        $founcation->permission_code =  $request->input('permission_code');
        $founcation->save();
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
		//
	}

}
