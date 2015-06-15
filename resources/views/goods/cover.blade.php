{{--商品封面上传后的回调页面，用于将上传成功后的信息回显到父页面--}}
<script type="text/javascript">
window.parent.document.getElementById("cover").value = "{{ $cover }}";
window.parent.document.getElementById("cover_img").src = "{{ $real_cover }}";
</script>