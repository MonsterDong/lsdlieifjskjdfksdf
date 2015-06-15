@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>错误!</strong> 请输入正确的信息.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif