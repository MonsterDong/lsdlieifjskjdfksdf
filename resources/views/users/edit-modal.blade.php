<div class="modal fade bs-example-modal-sm" id="user-edit-modal" tabindex="-1" role="dialog"
aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">编辑</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" >
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="name" class="col-md-4 control-label">姓名</label>
                        <div class="col-md-6"><input class="form-control" name="name" value="" id="name" type="text"/></div>
                    </div>
                    <div class="form-group">
                        <label for="group_id" class="col-md-4 control-label">请选择分组</label>
                        <div class="col-md-6">
                            <select class="form-control" name="group_id" id="group_id">
                                @foreach($groups as $group)
                                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="is_reset_password" name="is_reset_password" value="1"/>是否重置密码
                                </label>
                            </div>
                            <input type="password" name="password" id="new_password" placeholder="请输入新密码" class="form-control"/>
                            <script type="text/javascript">
                            $('#is_reset_password').prop('checked') ? $('#new_password').show() : $('#new_password').hide();
                            $('#is_reset_password').click(function(){
                                $(this).prop('checked') ? $('#new_password').show() : $('#new_password').hide();
                            });
                            </script>
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
<script>
(function($){
    var userEditModal = $('#user-edit-modal');
    var inputs = {
        name:userEditModal.find('#name'),
        group:userEditModal.find('group_id')
    };
    var form = userEditModal.find('form').first();
    var action="{{ url('user/edit') }}";
    $.userInit = function(id){
        form.attr('action',action+"/"+id);
        $.getJSON("{{ url('user/show') }}/" + id,function(user){
            inputs.name.val(user.name);
            inputs.group.val(user.group_id);
        });
    }
})(jQuery);
</script>