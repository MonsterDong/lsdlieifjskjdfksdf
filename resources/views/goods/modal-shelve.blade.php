<div class="modal fade" id="goodsShelveModal" tabindex="-1" role="dialog"
aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <div class="input-group date form_date" data-date-format="yyyy/mm/dd" data-link-field="shelved_at" data-link-format="yyyy/mm/dd">
                    <input class="form-control" id="dtp1" placeholder="请选择上架时间" type="text" value="" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
                <input type="hidden" name="shelved_at" id="shelved_at" value="" />
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
    var modal = $("#goodsShelveModal");
    var dtp = modal.find(".form_date").datetimepicker({
        language:'zh-CN',
        weekStart: 1,
        todayBtn:  'linked',
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
    });
    dtp.datetimepicker("setStartDate",new Date());
    modal.find("#dtp1,#shelved_at").val((new Date()).toLocaleDateString());
})(jQuery);
</script>