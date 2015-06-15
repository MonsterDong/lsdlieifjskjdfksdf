<?php namespace WangDong\Http\Controllers\System;

use WangDong\Http\Requests\ActionRequest;
use WangDong\Http\Controllers\Controller;

use Illuminate\Http\Request;
use WangDong\Action;

class ActionController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return \View::make('actions.index',['actions'=>Action::all()]);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(ActionRequest $request)
    {
        $action = new Action();
        $action->name = $request->input('name');
        $action->value = $request->input('value');
        $action->save();
        return redirect()->back();
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(ActionRequest $request,$id)
	{
        \DB::transaction(function() use($request,$id){
            $action = Action::findOrFail($id);
            $action->name = $request->input('name');
            $action->value = $request->input('value');
            $action->save();
        });
        return redirect()->back();
	}
}
