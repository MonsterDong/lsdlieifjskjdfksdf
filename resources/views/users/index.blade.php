@extends('app-index')
{{--设置导航条--}}
@section('header')
<ol class="breadcrumb">
  <li><a href="{{ url('home') }}">主页</a></li>
  <li class="active">用户管理</li>
</ol>
@endsection
@section('body')
{{--危险操作提示确认窗口，默认提示删除--}}
@include('modal.danger-tip')
{{--编辑模态窗口--}}
@include('users.edit-modal')
{{--添加模态窗口--}}
@include('users.create-modal')
<script>
//编辑模态窗口数据提交
$("#user-edit-modal").on("show.bs.modal",function(event){
    var elem = $(event.relatedTarget);
    $.userInit(elem.data('id')); //表单初始化
    var form = $(this).find('form').first();
    var userEditModal = $(this);
    form.ajaxForm();
    $(this).find("button[name='ok']").click(function(){
        form.ajaxSubmit(function(user){
            var tr = $('#tr_'+elem.data('id'));
            tr.find('td').eq(0).html(user.name);
            var option = form.find("select[name='group_id'] option:selected");
            tr.find('td').eq(2).html(option.text());
            userEditModal.modal('hide');
            return false;
        });
    });
});
//模态窗口添加
$("#user-create-modal").on("show.bs.modal",function(event) {
    var form = $(this).find('form').first();
    $(this).find("button[name='ok']").click(function(){
        return form.submit();
    });
});
</script>
{{--操作栏--}}
<div class="panel panel-default">
    <div class="panel-body">
        <div class="pull-left" style="padding-right: 10px;">
            <a title="添加" class="btn btn-primary" href="{{ url('user/create') }}" role="button"><span class="glyphicon glyphicon-plus"></span></a>
            <button class="btn btn-primary" title="模态添加" data-target="#user-create-modal" data-toggle="modal" >
            <span class="glyphicon glyphicon-plus"></span></button>
        </div>
        <div class="pull-left">
            <form class="form-inline" action="{{ url('user') }}" method="get">
                <div class="form-group">
                    <select class="form-control" name="group_id" id="group_id">
                        <option value="0">请选择用户组</option>
                        @foreach($groups as $group)
                            @if($group->id == \Request::input('group_id')))
                                <option value="{{ $group->id }}" selected>{{ $group->name }}</option>
                            @else
                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <input class="form-control" name="key_word" placeholder="关键字" value="{{ \Request::input('key_word') }}" type="text"/>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit" title="查询"><span class="glyphicon glyphicon-search"></span></button>
                </div>
                <div class="form-group">
                    <a href="{{ url('user') }}" title="刷新" class="btn btn-info" role="button">
                        <span class="glyphicon glyphicon-refresh"></span>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
{{--用户列表--}}
<table class="table">
    <thead>
        <tr><th>姓名</th><th>邮箱</th><th>所属组</th><th>创建时间</th><th>操作</th></tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr id="tr_{{ $user->id }}">
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->group->name }}</td>
            <td>{{ $user->created_at }}</td>
            {{--操作--}}
            <td>
                <a title="编辑" class="btn btn-warning btn-sm" href="{{ url('user/edit',[$user->id]) }}">
                    <span class="glyphicon glyphicon-edit"></span>
                </a>
                <a title="模态编辑" class="btn btn-warning btn-sm"
                    data-id="{{ $user->id }}"
                    data-toggle="modal"
                    href="#user-edit-modal">
                    <span class="glyphicon glyphicon-edit"></span>
                </a>
                <button title="删除" class="btn btn-danger btn-sm" type="button" data-toggle="modal"
                    data-target="#danger-tip" data-delurl="{{ url('user/destroy',[$user->id]) }}" >
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
    {{--分页--}}
    <tfoot>
        <tr><td colspan="100" align="right">{!! $users->appends(\Request::all())->render() !!}</td></tr>
    </tfoot>
</table>
@endsection