@extends('app-form')
@section('header')
<ol class="breadcrumb">
  <li><a href="{{ url('home') }}">主页</a></li>
  <li class="active">创建货车</li>
</ol>
@endsection
@section('body')
@include('public.form-error')
@include('public.success')
<form class="form-horizontal" method="post" action="">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group">
        <label class="col-md-4 control-label">请选择：</label>
        <div class="col-md-6 city-select" id="cityselect">
            <select class="prov form-control" name="province"></select>
            <select class="city form-control" disabled="disabled" name="city"></select>
            <select class="dist form-control" disabled="disabled" name="district"></select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label" for="address">详细停靠地址：</label>
        <div class="col-md-6">
            <input class="form-control" name="address" id="address" type="text"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label" for="license_plate">牌照：</label>
        <div class="col-md-6">
            <input class="form-control" id="license_plate" name="license_plate" type="text"/>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-6 col-md-offset-4"><button class="btn btn-primary" type="submit">保存</button></div>
    </div>
</form>
<script type="text/javascript">
$("#cityselect").citySelect({
    prov:"湖北",
    city:"武汉",
    dist:"洪山区",
    nodata:"none",
    required:false
});
</script>
@endsection