<div class="input-group input-group-sm date form_date" id="shelve_form_{{ $goods->id }}" data-date-format="yyyy-mm-dd" data-link-field="shelved_at" data-link-format="yyyy-mm-dd">
    <input class="form-control" placeholder="请选择上架时间" id="shelved_at_{{ $goods->id }}" type="text" value="" readonly>
    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
    <span class="input-group-btn"><button class="btn btn-success shelve" data-loading-text="上架中..." data-warn="#warn_{{ $goods->id }}" data-id="{{ $goods->id }}">
        <span class=" glyphicon glyphicon-ok-circle"></span>
    </button></span>
</div>
@include('goods.script-shelve')
