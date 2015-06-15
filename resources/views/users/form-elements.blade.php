<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="form-group">
    <label for="name" class="col-md-4 control-label">姓名</label>
    <div class="col-md-6"><input class="form-control" name="name" id="name" type="text"/></div>
</div>
<div class="form-group">
    <label for="email" class="col-md-4 control-label">邮箱</label>
    <div class="col-md-6"><input class="form-control" name="email" id="email" type="email"/></div>
</div>
<div class="form-group">
    <label for="password" class="col-md-4 control-label">密码</label>
    <div class="col-md-6"><input class="form-control" name="password" id="password" type="password"/></div>
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

