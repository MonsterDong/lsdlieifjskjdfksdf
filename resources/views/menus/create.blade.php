@extends('app-form')
@section('header')
<ol class="breadcrumb">
  <li><a href="{{ url('home') }}">主页</a></li>
  <li><a href="{{ url('menu') }}">菜单管理</a></li>
  @if($parent)
  <li><a href="{{ url('menu',[$parent->id]) }}">{{ $parent->name }}</a></li>
  @endif
  <li class="active">添加菜单</li>
</ol>
@endsection
@section('body')
<form class="form-horizontal" method="post" action="{{ url('menu/create') }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label for="parent_id" class="col-md-4 control-label">父菜单</label>
        <div class="col-md-6">
            @if(is_null($parent))
                <input type="hidden" name="parent_id" value="0"/>
                顶层菜单
            @else
                <input type="hidden" name="parent_id" value="{{ $parent->id }}"/>
                {{ $parent->name }}
            @endif
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-md-4 control-label">名称</label>
        <div class="col-md-6"><input id="name" name="name" class="form-control" type="text"/></div>
    </div>
    <div class="form-group">
        <label for="url" class="col-md-4 control-label">地址</label>
        <div class="col-md-6"><input id="url" name="url" class="form-control" type="text"/></div>
    </div>
    <div class="form-group">
        <label for="iconv" class="col-md-4 control-label">图标</label>
        <div class="col-md-6"><input id="iconv" name="iconv" class="form-control" type="text"/></div>
    </div>
    <div class="form-group">
        <label for="weight" class="col-md-4 control-label">权重</label>
        <div class="col-md-6"><input id="weight" name="weight" class="form-control" type="number"/></div>
    </div>
    <div class="form-group">
        <div class="col-md-6 col-md-offset-4"><button class="btn btn-primary" type="submit">保存</button></div>
    </div>
</form>
@endsection