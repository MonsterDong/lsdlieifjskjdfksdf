<?php namespace WangDong\Http\ViewComposers;
/**
 * Created by PhpStorm.
 * User: dongdong
 * Date: 2015/5/12
 * Time: 14:57
 */

use WangDong\Unit;
use Illuminate\Contracts\View\View;

class UnitComposer {

    public function compose(View $view)
    {
        $view->with('units', Unit::all());
    }
} 