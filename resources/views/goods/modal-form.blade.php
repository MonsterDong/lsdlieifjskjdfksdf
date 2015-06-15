<div class="modal fade" id="goodsFormModal" tabindex="-1" role="dialog"
aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">商品表单</h4>
            </div>
            <div class="modal-body">
                <form id="goodsForm" class="form-horizontal" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                        <label for="title" class="col-md-4 control-label">商品标题</label>
                        <div class="col-md-6">
                        <input class="form-control" name="title" placeholder="请输入1-64个字符" id="title" maxlength="64" type="text"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">类型</label>
                        <div class="col-md-6">
                            <select class="form-control" name="gc_id">
                            @foreach($goods_categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price" class="col-md-4 control-label">单价</label>
                        <div class="col-md-6"><input class="form-control" name="price" id="price" type="number"/></div>
                    </div>
                    <div class="form-group">
                        <lable class="col-md-4 control-label" for="weight">重量</lable>
                        <div class="col-md-6"><input class="form-control" type="number" name="weight" id="weight"/></div>
                    </div>
                    <div class="form-group">
                        <label for="unit" class="col-md-4 control-label">单位</label>
                        <div class="col-md-6">
                        <select name="unit_id" class="form-control">
                        @foreach($units as $unit)
                            <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                        @endforeach
                        </select>
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