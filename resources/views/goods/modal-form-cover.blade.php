<div class="modal fade" id="goodsCoverModal" tabindex="-1" role="dialog"
aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">商品封面设置</h4>
            </div>
            <div class="modal-body">
                <iframe src="" frameborder="0" style="display: none;" name="coverIframe"></iframe>
                <form id="goodsCoverForm" action="{{ url('goods/cover') }}" target="coverIframe" class="form-horizontal" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group" id="errorFormGroup" style="display: none;">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="alert alert-danger alert-dismissible" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <strong>错误!</strong> <span id="errorText"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-md-offset-3">
                            <input name="cover_upload" type="file"/>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-success btn-xs" id="upload" type="button">
                                <span class="glyphicon glyphicon-upload"></span>
                            </button>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-7 col-md-offset-3">
                            <span class="bg-info">请选择大小为{{ Config::get('app.goods.cover.width') }}x{{ Config::get('app.goods.cover.height') }}的图片</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-7 col-md-offset-3">
                            <img id="cover_img" src="{{ url('goodsimage/default.png') }}" alt="商品封面" width="{{ Config::get('app.goods.cover.width') }}px" height="{{ Config::get('app.goods.cover.height') }}px"/>
                        </div>
                    </div>
                </form>
                <form id="goodsCoverStoreForm" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="cover" id="cover" value=""/>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" type="button" data-dismiss="modal">关闭</button>
                <button class="btn btn-primary" name="ok" type="button">确定</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    (function($){
        var form = $("#goodsCoverForm"),
            upload = form.find("#upload");

        upload.click(function(){
            form.find("#errorFormGroup").hide();
            form.find("#errorText").text("");
            return form.submit();
        });
    })(jQuery);
</script>