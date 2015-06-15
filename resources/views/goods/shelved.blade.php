<div class="input-group input-group-sm date form_date" id="shelve_form_{{ $goods->id }}" data-date-format="yyyy-mm-dd">
    <input class="form-control" type="text" id="shelved_at_{{ $goods->id }}" value="{{ $goods->shelved_at }}" readonly>
    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
    <span class="input-group-addon shelve" data-loading-text="更新中..." data-warn="#warn_{{ $goods->id }}" data-id="{{ $goods->id }}">
        <a><span class="glyphicon glyphicon-save"></span></a>
    </span>
    <span class="input-group-btn"><button class="btn btn-danger removed" data-loading-text="下架中..." name="removed" data-warn="#warn_{{ $goods->id }}" data-id="{{ $goods->id }}">
        <span class="glyphicon glyphicon-remove-circle"></span>
    </button></span>
</div>
@include('goods.script-shelve')