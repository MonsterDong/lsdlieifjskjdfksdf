<?php namespace WangDong\Http\Controllers\Goods;

use WangDong\Http\Requests;
use WangDong\Http\Controllers\Controller;

use Illuminate\Http\Request;
use WangDong\Http\Requests\TruckRequest;
use WangDong\Truck;

class TruckController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
        $paginator = Truck::paginate(15);
		return view('trucks.index',['paginator'=>$paginator]);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @param TruckRequest $request
     * @return Response
     */
	public function getCreate()
	{
        return view('trucks.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function postStore(TruckRequest $request)
	{
        Truck::create($request->all());

        return redirect()->back()->with('message','货车添加成功!');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getShow(Request $request,$id)
	{

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit(Request $request,$id)
	{
        $truck = Truck::findOrFail($id);
        if($request->ajax()){
            return response()->json($truck->toArray());
        }
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postUpdate(TruckRequest $request,$id)
	{
        $truck = Truck::findOrFail($id);
        $truck->fill($request->all())->save();
        return redirect()->back()->withMessage("货车信息更新成功");
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
