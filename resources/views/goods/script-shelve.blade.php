<script type="text/javascript">
(function($){
    var shelve = $("#shelve_form_{{ $goods->id }}");
    shelve.datetimepicker({
       language:'zh-CN',
       weekStart: 1,
       todayBtn:  'linked',
       autoclose: 1,
       todayHighlight: 1,
       startView: 2,
       minView: 2,
       forceParse: 0
   });
   shelve.find('.shelve').tooltip({title:'请选择上架时间'});;
})(jQuery);
</script>