@extends('app-index')

@section('header')
<ol class="breadcrumb">
  <li><a href="{{ url('home') }}">主页</a></li>
  <li class="active">系统动作</li>
</ol>
@endsection
@section('body')
@include('public.form-error')
<table class="table">
    <thead>
        <tr><th>#</th><th>值</th><th>名称</th><th>操作</th></tr>
    </thead>
    <tbody>
        @foreach($actions as $action)
        <form action="{{ url('action/update',[$action->id]) }}" method="get">
            <tr>
                <td>{{ $action->id }}</td>
                <td width="300"><input class="form-control" type="text" name="value" value="{{ $action->value }}"/></td>
                <td width="300"><input type="text" name="name" class="form-control" value="{{ $action->name }}"/></td>
                <td><button title="保存" class="btn btn-primary btn-sm" type="submit"><span class="glyphicon glyphicon-save"></span></button></td>
            </tr>
        </form>
        @endforeach
    </tbody>
</table>
<div class="panel panel-default">
    <div class="panel-body">
        <form class="form-inline" action="{{ url('action/store') }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="name">名称</label>
                <input type="text" id="name" name="name" placeholder="名称" class="form-control"/>
            </div>
            <div class="form-group">
                <label for="value">值</label>
                <input type="text" id="value" name="value" placeholder="值" class="form-control"/>
            </div>
            <button class="btn btn-primary" type="submit">添加</button>
        </form>
    </div>
</div>
@endsection