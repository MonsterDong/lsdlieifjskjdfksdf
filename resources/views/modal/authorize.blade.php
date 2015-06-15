<div class="modal fade bs-example-modal-sm" id="authorize" tabindex="-1" role="dialog"
aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title">授权</h3>
            </div>
            <div class="modal-body">
            <form action="">
                @foreach($modules as $module)
                <div class="form-group">
                    <h4>
                        <label class="checkbox-inline">
                            <input type="checkbox" class="module"  value="{{ $module->id }}"> {{ $module->name }}
                        </label>
                    </h4>
                    <p>
                    @foreach($module->foundations as $foundation)
                        <label class="checkbox-inline">
                          <input type="checkbox" class="pms module module_{{ $module->id }}" value="{{ $foundation->permission_code }}"> {{ $foundation->name }}
                        </label>
                    @endforeach
                    </p>
                </div>
                @endforeach
            </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" type="button" data-dismiss="modal">关闭</button>
                <button class="btn btn-primary" id="btn-authorize-ok" type="button">确定</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
(function($){
    $(".module").click(function(){
        var b = $(this).is(':checked');
        $(".module_"+$(this).val()).each(function(){
            $(this).prop('checked',b);
        });
    });
    $.authorizeInit = function(pms_code){
        $('.pms').each(function(){
            $(this).prop('checked',($(this).val() & pms_code) > 0);
        });
    }
    $.getPmsCode = function(){
        var pms_code = 0;
        $('.pms:checked').each(function(){
            pms_code = pms_code | $(this).val();
        });
        return pms_code;
    }
})(jQuery);
</script>