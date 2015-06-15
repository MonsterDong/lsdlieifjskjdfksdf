<?php namespace WangDong\Http\Controllers\Goods;

use WangDong\Goods;
use WangDong\Http\Requests;
use WangDong\Http\Controllers\Controller;

use Illuminate\Http\Request;
use WangDong\Http\Requests\GoodsRequest;
use Config;
use Validator;

class GoodsController extends Controller {

	/**
	 * 显示商品列表
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
        $paginator = Goods::with('unit','category')->where(function($query)use($request){
            if($request->input('gc_id',0) > 0){
                $query->where('gc_id','=',$request->input('gc_id'));
            }
            if($request->has('name')){
                $query->where('title','like',$request->input('title').'%');
            }
        })->paginate(15);
        $request->flash();
		return view('goods.index',['paginator' => $paginator]);
	}

	/**
	 * 存储一个新的商品
	 *
	 * @return Response
	 */
	public function store(GoodsRequest $request)
	{
        Goods::create($request->all());
        return redirect()->back()->with('message','商品添加成功!');
	}

    /**
     * 上传封面
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function cover(Request $request){
        //检测上传文件是否存在
        if(!$request->hasFile('cover_upload')){
            return view('goods.cover-error',['error'=>'请选择上传文件']);
        }

        //获取上传文件
        $cover = $request->file('cover_upload');

        //验证文件是否为图片
        $validator = Validator::make(['file'=>$cover], ['file'=>'image']);
        if($validator->fails()){
            return view('goods.cover-error',['error'=>'您上传的文件不是图片']);
        }

        //验证图片尺寸是否合格
        $size = getimagesize($cover->getRealPath());
        if($size[0] != Config::get('app.goods.cover.width') || $size[1] != Config::get('app.goods.cover.height')){
            return view('goods.cover-error',['error'=>'您选择的图片尺寸不合适']);
        }

        //保存图片
        $file = $cover->move(Config::get('app.goods.path'),time().'.'.$cover->getClientOriginalExtension());

        return view("goods.cover",[
            'cover'      => 'goodsimage/'.$file->getFilename(),
            'real_cover' => url('goodsimage/'.$file->getFilename())
        ]);
    }

    /**
     * 存储封面
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function coverStore(Request $request,$id){
        $goods = Goods::findOrFail($id);
        $goods->cover = $request->input('cover');
        $goods->save();
        return redirect()->back()->with('message','商品封面设置成功');
    }

	/**
	 * 获取一条商品的信息
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Request $request,$id)
	{
		$goods = Goods::findOrFail($id);
        if($request->ajax()){
            return response()->json($goods->toArray());
        }else{
            exit(0);
        }
	}

	/**
	 * 更新商品信息
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(GoodsRequest $request,$id)
	{
        $goods = Goods::findOrFail($id);
        $goods->fill($request->all())->save();
        return redirect()->back()->withMessage("商品信息更新成功");
	}

    /**
     * 上架商品
     * @param $id 商品编号
     * @param $shelved_at 上架时间
     */
    public function shelve($id,$shelved_at){
        $goods = Goods::findOrFail($id);
        $goods->shelved_at = $shelved_at;
        $goods->save();
        return view('goods.shelved',['goods'=>$goods]);
    }

    /**
     * 下架商品
     * @param $id
     * @return \Illuminate\View\View
     */
    public function remove($id){
        $goods = Goods::findOrFail($id);
        $goods->shelved_at = Config::get('app.empty.date');
        $goods->save();
        return view('goods.removed',['goods'=>$goods]);
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
