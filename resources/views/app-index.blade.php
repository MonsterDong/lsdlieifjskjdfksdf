@extends('app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                @yield('header')
                <div class="panel-body">
                    {{--如果有返回消息则提示成功--}}
                    @include('public.success')
                    {{--表单错误提示--}}
                    @include('public.form-error')
                    @yield('body')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection