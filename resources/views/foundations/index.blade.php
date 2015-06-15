@extends('app-index')
@section('header')
<ol class="breadcrumb">
  <li><a href="{{ url('home') }}">主页</a></li>
  <li class="active">系统功能</li>
</ol>
@endsection
@section('body')
@include('modal.danger-tip')
<div class="panel panel-default">
    <div class="panel-body">
        <div class="pull-left" style="margin-right: 10px;">
             <a href="{{ url('foundation/create') }}" class="btn btn-primary" role="button" title="添加">
                <span class="glyphicon glyphicon-plus"></span>
            </a>
        </div>
        <div class="pull-left">
            <form class="form-inline" action="{{ url('foundation') }}" method="get">
                <div class="form-group">
                    <select class="form-control" name="module_id" id="module_id">
                        <option value="0">全部模块</option>
                        @foreach($modules as $module)
                            @if($module->id == \Request::input('module_id'))
                                <option value="{{ $module->id }}" selected>{{ $module->name }}</option>
                            @else
                                <option value="{{ $module->id }}">{{ $module->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <button class="btn btn-primary" type="submit" title="查询"><span class="glyphicon glyphicon-search"></span></button>
            </form>
        </div>
    </div>
</div>
<table class="table">
    <thead>
        <tr>
            <th>#</th><th>名称</th><th>模块</th><th>动作</th><th>权限码</th><th>操作</th>
        </tr>
    </thead>
    <tbody>
        @foreach($foundations as $foundation)
        <form action="{{ url('foundation/update',[$foundation->id]) }}" method="get">
            <tr>
                <td>{{ $foundation->id }}</td>
                <td width="300"><input type="text" name="name" class="form-control" value="{{ $foundation->name }}"/></td>
                <td>{{ $foundation->module->name }}({{ $foundation->module_value }})</td>
                <td>{{ $foundation->action->name }}({{ $foundation->action_value }})</td>
                <td width="100"><input class="form-control" type="text" name="permission_code" value="{{ $foundation->permission_code }}"/></td>
                <td>
                    <button title="更新" class="btn btn-primary btn-sm" type="submit"><span class="glyphicon glyphicon-save"></span></button>
                    <button title="删除" class="btn btn-danger btn-sm" type="button" data-toggle="modal" data-target="#danger-tip" data-id="{{ $foundation->id  }}" >
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </button>
                </td>
            </tr>
        </form>
        @endforeach
    </tbody>
    <tfoot>
        <tr><td colspan="100" align="right">{!! $foundations->appends(\Request::all())->render() !!}</td></tr>
    </tfoot>
</table>
@endsection