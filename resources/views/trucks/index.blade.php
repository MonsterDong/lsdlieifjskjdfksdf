@extends('app-index')

@section('header')
<ol class="breadcrumb">
  <li><a href="{{ url('home') }}">主页</a></li>
  <li class="active">货车管理</li>
</ol>
@endsection
@section('body')
@include('trucks.modal-form')
{{--操作栏--}}
<div class="panel panel-default">
    <div class="panel-body clearfix">
        <button type="button" class="btn btn-primary btn-add" data-target="#truckFormModal" data-toggle="modal"
            data-url="{{ url('trucks/store') }}" title="添加">
            <span class="glyphicon glyphicon-plus"></span> 添加
        </button>
    </div>
</div>
{{--列表--}}
<table class="table table-hover">
    {{--标题--}}
    <thead class="bg-primary">
        <th>牌照</th><th>详细地址</th><th>区</th><th>市</th><th>省</th><th>操作</th>
    </thead>
    {{--行数据--}}
    <tbody>
    @foreach($paginator as $key=>$truck)
        <tr class="active {{ $key % 2 != 0 ? 'success' : '' }}">
            <td>{{ $truck->license_plate }}</td>
            <td class="text-primary">{{ $truck->address }}</td>
            <td>{{ $truck->district }}</td>
            <td>{{ $truck->city }}</td>
            <td>{{ $truck->province }}</td>
            <td>
                <button type="button" class="btn btn-warning btn-sm btn-edit"
                    data-url="{{ url('trucks/update',[$truck->id]) }}"
                    data-target="#truckFormModal"
                    data-toggle="modal"
                    data-id="{{ $truck->id }}">
                    <span class="glyphicon glyphicon-edit"></span> 编辑
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
    {{--分页--}}
    <tfoot>
        <tr><td colspan="100" align="right">{!! $paginator->appends(\Request::all())->render() !!}</td></tr>
    </tfoot>
</table>
{{--js--}}
<script type="text/javascript">
    //初始化添加、修改表单
    var modal = $("#truckFormModal");
    var form = modal.find("form:first");
    modal.find("button[name='ok']").click(function(){
        return form.submit();
    });
    modal.on("show.bs.modal",function(event){
        var button = $(event.relatedTarget);
        form.attr("action",button.data("url"));
        if(button.data("id")){
            $.get("{{ url('trucks/edit') }}/" + button.data("id"),function(data){
                form.find(":input,select").each(function(){
                    var key = $(this).attr("name");
                    data[key] && $(this).val(data[key]);
                });
            },'json');
        }
    });
</script>
@endsection