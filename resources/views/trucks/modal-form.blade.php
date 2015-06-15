<div class="modal fade bs-example-modal-sm" id="truckFormModal" tabindex="-1" role="dialog"
aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">创建货车</h4>
            </div>
            <div class="modal-body">
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
    $("#cityselect").citySelect({
        prov:"湖北",
        city:"武汉",
        dist:"洪山区",
        nodata:"none",
        required:false
    });
</script>