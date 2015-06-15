@extends('app-form')
@section('header')
<ol class="breadcrumb">
  <li><a href="{{ url('home') }}">主页</a></li>
  <li><a href="{{ url('foundation') }}">系统基础管理</a></li>
  <li class="active">添加</li>
</ol>
@endsection
@section('body')
@include('public.form-error')
<form method="post" class="form-horizontal" action="{{ url('foundation/create') }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label class="col-md-4 control-label">选择模块</label>
        <div class="col-md-6">
            <select class="form-control" name="module_id" id="module_id">
                @foreach($modules as $module)
                    <option value="{{ $module->id }}">{{ $module->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label">选择动作</label>
        <div class="col-md-6">
            <select class="form-control" name="action_id" id="action_id">
                @foreach($actions as $action)
                    <option value="{{ $action->id }}">{{ $action->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label" for="name">名称</label>
        <div class="col-md-6">
            <input class="form-control" id="name" name="name" value="{{ old('name') }}" type="text"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label" for="permission_code">权限码</label>
        <div class="col-md-6">
            <input class="form-control" placeholder="不输入则系统自动生成" id="permission_code" name="permission_code" value="{{ old('permission_code') }}" type="text"/>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                添加
            </button>
        </div>
    </div>
</form>

@endsection