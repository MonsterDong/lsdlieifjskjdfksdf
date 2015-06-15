<script type="text/javascript">
    var p = window.parent,
        form = p.document.getElementById("goodsCoverForm"),
        errorFormGroup = p.document.getElementById("errorFormGroup"),
        errorText = p.document.getElementById("errorText");

    errorFormGroup.style.display = "";
    errorText.innerHTML = "{{ $error }}";
</script>