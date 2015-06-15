@extends('app-form')
@section('header')
<ol class="breadcrumb">
  <li><a href="{{ url('home') }}">主页</a></li>
  <li><a href="{{ url('user') }}">用户管理</a></li>
  <li class="active">添加用户</li>
</ol>
@endsection
@section('body')
@include('public.form-error')
<form class="form-horizontal" method="post" action="{{ url('user/create') }}">
    @include('users.form-elements')
    <div class="form-group">
        <div class="col-md-6 col-md-offset-4"><button class="btn btn-primary" type="submit">保存</button></div>
    </div>
</form>
@endsection