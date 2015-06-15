@if(Session::has('message'))
<div role="alert" class="alert alert-success alert-dismissible fade in">
    <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
    <strong>{{ Session::get('message') }}</strong>
</div>
@endif