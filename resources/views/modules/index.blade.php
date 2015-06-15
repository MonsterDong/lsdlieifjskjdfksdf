@extends('app-index')

@section('header')
<ol class="breadcrumb">
  <li><a href="{{ url('home') }}">主页</a></li>
  <li class="active">系统模块</li>
</ol>
@endsection
@section('body')
@include('modal.danger-tip')
<script type="text/javascript">
$("#danger-tip").on('show.bs.modal',function(event){
    var button = $(event.relatedTarget);
    var id = button.data('id');
    $('#btn-danger-ok').click(function(){
        window.location.href = "{{ url('module/destroy') }}/" + id;
    });
});
</script>
@include('public.form-error')
<table class="table">
    <thead>
        <tr>
            <th>#</th><th>值</th><th>名称</th><th>操作</th>
        </tr>
    </thead>
    <tbody>
        @foreach($modules as $module)
        <form action="{{ url('module/update',[$module->id]) }}" method="get">
            <tr>
                <td>{{ $module->id }}</td>
                <td width="300"><input class="form-control" type="text" value="{{ $module->value }}" name="value"/></td>
                <td width="300"><input type="text" name="name" class="form-control" value="{{ $module->name }}"/></td>
                <td>
                    <button class="btn btn-primary btn-sm" title="保存" type="submit"><span class="glyphicon glyphicon-save"></span></button>
                    <button class="btn btn-danger btn-sm" title="删除" type="button" data-toggle="modal" data-target="#danger-tip" data-delurl="{{ url('module/destroy',[$module->id]) }}" >
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                    </button>
                </td>
            </tr>
        </form>
        @endforeach
    </tbody>
</table>
<div class="panel panel-default">
    <div class="panel-body">
        <form class="form-inline" action="{{ url('module/store') }}" method="post">
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