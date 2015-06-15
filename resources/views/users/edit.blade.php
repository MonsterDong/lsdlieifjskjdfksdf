@extends('app-form')
@section('header')
<ol class="breadcrumb">
  <li><a href="{{ url('home') }}">主页</a></li>
  <li><a href="{{ url('user') }}">用户管理</a></li>
  <li class="active">修改用户</li>
</ol>
@endsection
@section('body')
@include('public.form-error')
<form class="form-horizontal" method="post" action="{{ url('user/edit',[$user->id]) }}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label for="name" class="col-md-4 control-label">姓名</label>
        <div class="col-md-6"><input class="form-control" name="name" value="{{ $user->name }}" id="name" type="text"/></div>
    </div>
    <div class="form-group">
        <label for="group_id" class="col-md-4 control-label">请选择分组</label>
        <div class="col-md-6">
            <select class="form-control" name="group_id" id="group_id">
                @foreach($groups as $group)
                    @if($group->id == $user->group_id)
                        <option value="{{ $group->id }}" selected>{{ $group->name }}</option>
                    @else
                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <div class="checkbox">
                <label>
                    <input type="checkbox" id="is_reset_password" name="is_reset_password" value="1"/>是否重置密码
                </label>
            </div>
            <input type="password" name="password" id="new_password" placeholder="请输入新密码" class="form-control"/>
            <script type="text/javascript">
            $('#is_reset_password').prop('checked') ? $('#new_password').show() : $('#new_password').hide();
            $('#is_reset_password').click(function(){
                $(this).prop('checked') ? $('#new_password').show() : $('#new_password').hide();
            });
            </script>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-6 col-md-offset-4"><button class="btn btn-primary" type="submit">保存</button></div>
    </div>
</form>
@endsection