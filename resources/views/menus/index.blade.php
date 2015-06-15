@extends('app-index')

@section('header')
<ol class="breadcrumb">
    <li><a href="{{ url('home') }}">主页</a></li>
    @if(is_null($parent))
    <li class="active">菜单管理</li>
    @else
    <li><a href="{{ url('menu') }}">菜单管理</a></li>
    <li class="active">{{ $parent->name }}</li>
    @endif
</ol>
@endsection
@section('body')
<div class="panel panel-default">
    <div class="panel-body">
        <a class="btn btn-primary" role="button" title="添加" href="{{ url('menu/create',[\Route::input('parent_id')]) }}">
            <span class="glyphicon glyphicon-plus"></span>
        </a>
    </div>
</div>
<table class="table">
    <thead>
        <tr>
            <th>菜单名</th><th>地址</th><th>图标</th><th>权重</th><th>操作</th>
        </tr>
    </thead>
    <tbody>
    @foreach($menus as $menu)
    <form action="{{ url('menu/update',[$menu->id]) }}" method="get">
        <tr>
            <td><input class="form-control" type="text" value="{{ $menu->name  }}" name="name"/></td>
            <td><input class="form-control" type="text" value="{{ $menu->url }}" name="url"/></td>
            <td><input class="form-control" type="text" name="iconv" value="{{ $menu->iconv  }}"/></td>
            <td width="200"><input class="form-control" type="number" name="weight" value="{{ $menu->weight }}"/></td>
            <td>
                <a class="btn btn-primary btn-sm" role="button" title="添加" href="{{ url('menu/create',[$menu->id]) }}">
                    <span class="glyphicon glyphicon-plus"></span>
                </a>
                <a href="{{ url('menu',[$menu->id]) }}" title="打开" class="btn btn-info btn-sm" role="button">
                    <span class="glyphicon glyphicon-folder-open"></span>
                </a>
                <button type="submit" title="保存" class="btn btn-warning btn-sm">
                    <span class="glyphicon glyphicon-save" aria-hidden="true"></span>
                </button>
                <button class="btn btn-danger btn-sm" title="删除" type="button" data-toggle="modal"
                    data-target="#danger-tip" data-delurl="{{ url('menu/destroy',[$menu->id]) }}" >
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </button>
            </td>
        </tr>
    </form>
    @endforeach
    </tbody>
</table>
@endsection

