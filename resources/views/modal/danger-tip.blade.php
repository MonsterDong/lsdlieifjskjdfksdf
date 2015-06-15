<div class="modal fade bs-example-modal-sm" id="danger-tip" tabindex="-1" role="dialog"
aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">警告!</h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" role="alert">
                  <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
                  <span class="sr-only">Error:</span>
                  您确定要删除吗?
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" type="button" data-dismiss="modal">关闭</button>
                <button class="btn btn-primary" id="btn-danger-ok" type="button">确定</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$("#danger-tip").on('show.bs.modal',function(event){
    var elem = $(event.relatedTarget);
    $('#btn-danger-ok').click(function(){
        window.location.href = elem.data('delurl');
    });
});
</script>