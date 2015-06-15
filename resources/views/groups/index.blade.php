@extends('app-index')

@section('header')
<ol class="breadcrumb">
  <li><a href="{{ url('home') }}">主页</a></li>
  <li class="active">分组管理</li>
</ol>
@endsection
@section('body')
{{--授权模态窗口--}}
@include('modal.authorize')
<script type="text/javascript">
$('#authorize').on('show.bs.modal',function(event){
    var elem = $(event.relatedTarget);
    $.authorizeInit(elem.data('code')); //初始化已经授权的功能
    $('#btn-authorize-ok').click(function(){
        var pms_code = $.getPmsCode();
        elem.data('code',pms_code);
        var elem_id = elem.data('who')+'_code';
        if(elem.data('id')){
            elem_id += elem.data('id');
            $("#show_code"+elem.data('id')).text(pms_code);
        }
        $('#'+elem_id).val(pms_code);
        $('#authorize').modal('hide');
    });
});
</script>
{{--end--}}
{{--删除模态提示框--}}
@include('modal.danger-tip')
{{--表单错误提示--}}
@include('public.form-error')
{{--分组列表--}}
<table class="table table-hover">
    <thead>
        <tr><th>#</th><th>组名</th><th>权限码</th><th>操作</th></tr>
    </thead>
    <tbody>
    @foreach($groups as $group)
    <form action="{{ url('group/update',[$group->id]) }}" method="get">
        <tr>
            <td scope="row">{{ $group->id }}</td>
            <td><input type="text" class="form-control" name="name" value="{{ $group->name }}"/></td>
            <td>
                <span id="show_code{{ $group->id }}"><strong>{{ $group->permission_code }}</strong></span>
                <input type="hidden" id="edit_code{{ $group->id }}" name="permission_code" value="{{ $group->permission_code }}"/>
                (<a  href="#" data-toggle="modal" data-target="#authorize"
                data-code="{{ $group->permission_code }}" data-who="edit" data-id="{{ $group->id }}">授权</a>)
            </td>
            <td>
                <button type="submit" title="保存" class="btn btn-primary btn-sm">
                    <span class="glyphicon glyphicon-save" aria-hidden="true"></span>
                </button>
                <button class="btn btn-danger btn-sm" title="删除" type="button" data-toggle="modal"
                    data-target="#danger-tip" data-delurl="{{ url('group/destroy',[$group->id]) }}" >
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </button>
            </td>
        </tr>
    </form>
    @endforeach
    </tbody>
</table>
{{--列表结束--}}
{{--添加表单--}}
<div class="panel panel-default">
    <div class="panel-body">
        <form class="form-inline" method="post" action="{{ url('/group/store') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="name">组名</label>
                <input class="form-control" type="text" id="name" name="name" value="{{ old('name') }}" placeholder="组名"/>
            </div>
            <div class="form-group">
                <input type="hidden" name="permission_code" id="add_code"/>
                <a href="#" data-toggle="modal" data-target="#authorize" data-code="0" data-who="add">授权</a>
            </div>
            <button class="btn btn-primary" type="submit">添加</button>
        </form>
    </div>
</div>
{{--添加表单结束--}}
@endsection