<?php
/**
 * Created by PhpStorm.
 * User: dongdong
 * Date: 2015/5/12
 * Time: 16:10
 */

namespace WangDong\Http\ViewComposers;


use Illuminate\Contracts\View\View;
use WangDong\GoodsCategory;

class GoodsCategoryComposer {

    public function compose(View $view){
        $view->with('goods_categories',GoodsCategory::all());
    }
} 