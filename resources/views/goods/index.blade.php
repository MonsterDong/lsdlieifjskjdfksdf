@extends('app-index')

@section('header')
<ol class="breadcrumb">
  <li><a href="{{ url('home') }}">主页</a></li>
  <li class="active">商品管理</li>
</ol>
@endsection
@section('body')
@include('goods.modal-form')
@include('goods.modal-form-cover')
@include('goods.modal-shelve')
@include('goods.modal-removed')
{{--操作栏--}}
<div class="panel panel-default">
    <div class="panel-body clearfix">
        <div class="pull-left">
            <button type="button" class="btn btn-primary btn-add"
                data-url="{{ url('goods/store') }}" title="添加">
                <span class="glyphicon glyphicon-plus"></span> 添加
            </button>
        </div>
        <div class="pull-left" style="margin-left: 10px;">
            <form id="goodsSearchForm" class="form-inline" method="get" action="{{ url('goods') }}">
                <div class="form-group">
                    <select class="form-control" name="gc_id">
                        <option value="0">所有类型</option>
                        @foreach($goods_categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="标题" value="{{ old('title') }}" name="title"/>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit" title="查询"><span class="glyphicon glyphicon-search"></span></button>
                </div>
                <div class="form-group">
                    <a href="{{ url('goods') }}" title="刷新" class="btn btn-info" role="button">
                        <span class="glyphicon glyphicon-refresh"></span>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
{{--商品列表--}}
<table class="table table-hover">
    <thead class="bg-primary">
        <th>商品标题</th><th>单价</th><th>重量</th><th>单位</th><th>类型</th><th>封面</th><th>上架时间</th><th>操作</th>
    </thead>
    <tbody>
    @foreach($paginator as $key=>$goods)
        <tr class="active {{ $key % 2 != 0 ? 'success' : '' }}">
            <td>{{ $goods->title }}</td>
            <td class="text-primary">{{ $goods->price }}</td>
            <td class="text-primary">{{ $goods->weight }}</td>
            <td>{{ $goods->unit->name }}</td>
            <td>{{ $goods->category->name }}</td>
            <td>
                @if(!empty($goods->cover))
                <a  class="cover"
                    data-cover="{{ url($goods->cover) }}" >
                    <span class="glyphicon glyphicon-picture"></span>
                </a>
                @endif
                <a href="#goodsCoverModal"
                    data-toggle="modal"
                    data-url="{{ url('goods/cover-store',[$goods->id]) }}"
                    data-realcover = "{{ url($goods->cover) }}"
                    data-id="{{ $goods->id }}"
                    data-cover="{{ $goods->cover }}">
                    <span class="glyphicon glyphicon-edit"></span>
                </a>
            </td>
            <td width="250" id="warn_{{ $goods->id }}">
                @if(strtotime($goods->shelved_at) > 0)
                    @include('goods.shelved')
                @else
                    @include('goods.removed')
                @endif
            </td>
            <td>
                <button type="button" class="btn btn-warning btn-sm btn-edit"
                    data-url="{{ url('goods/update',[$goods->id]) }}"
                    data-id="{{ $goods->id }}">
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
{{--JS脚本--}}
<script type="text/javascript">
    //初始化添加、修改表单
    var modal = $("#goodsFormModal");
    var form = modal.find("#goodsForm");
    modal.find("button[name='ok']").click(function(){
        return form.submit();
    });
    //添加
    $(".btn-add").click(function(){
        form.attr("action",$(this).data('url'));
        modal.modal('show');
    });
    //修改
    $(".btn-edit").click(function(){
        form.attr("action",$(this).data('url'));
        $.getJSON("{{ url('goods/show') }}/"+$(this).data("id"),function(goods){
            form.find("input,select").each(function(){
                var name = $(this).attr("name");
                goods[name] && $(this).val(goods[name]);
            });
            modal.modal('show');
        });
    });
    //封面设置
    $("#goodsCoverModal").on("show.bs.modal",function(event){
        var button = $(event.relatedTarget);
        var modal = $(this),
            form = modal.find("#goodsCoverStoreForm");
        if(button.data("cover")){
            modal.find("#cover_img").attr("src",button.data("realcover"));
        }else{
            modal.find("#cover_img").attr("src","{{ url('goodsimage/default.png') }}");
        }
        form.attr("action",button.data("url"));

        modal.find("button[name='ok']").click(function(){
            return form.submit();
        });
    });
    //搜索表单赋值
    $("#goodsSearchForm").find("select[name='gc_id']:first").val("{{ old('gc_id',0) }}");
    //展示封面图片
    $(".cover").tooltip({
        html:true,
        placement:'left',
        template:'<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner" style="max-width:300px; background-color: #BBBBBB; padding: 3px;"></div></div>',
        title:function(){
            return '<img src="'+$(this).data('cover')+'" alt="" />';
        }
    });
    //商品下架
    $(".table").delegate('.removed',"click",function(){
        var id = $(this).data("id");
        var warn = $($(this).data("warn"));
        var $btn = $(this).button('loading');
        $.get("{{ url('goods/remove') }}/"+id,function(html){
             warn.html(html);
             $btn.button('reset');
        });
    });
    //对tooltip效果设置
    $(".table").delegate(".shelve",'show.bs.tooltip', function () {
        var id = $(this).data("id");
        var shelved_at = $("#shelved_at_"+id).val();
        if(shelved_at != ""){
            return false;
        }
    });
    //上架
    $(".table").delegate('.shelve','click',function(){
        var id = $(this).data("id");
        var warn = $($(this).data("warn"));
        var shelved_at = $("#shelved_at_"+id).val();
        if(shelved_at == ""){
            return false;
        }
        var $btn = $(this).button('loading');
        $.get("{{ url('goods/shelve') }}/"+id+"/"+shelved_at,function(html){
            warn.html(html);
            $btn.button('reset');
        });
    });
</script>
@endsection