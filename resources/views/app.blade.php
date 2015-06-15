<!DOCTYPE html>
<html lang="cn">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>
	<!--
	<link href="/css/app.css" rel="stylesheet">
	-->
	<!-- 新 Bootstrap 核心 CSS 文件 -->
	<link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.2/css/bootstrap.min.css">
	<!-- Fonts 
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
    -->
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!-- Scripts -->
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="http://cdn.bootcss.com/jquery/1.11.2/jquery.min.js"></script>
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="http://cdn.bootcss.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <!--jquery.form-->
    <script src="/js/jquery.form.js"></script>
    <!--日期插件-->
    <script src="/js/datetimepicker/bootstrap-datetimepicker.min.js"></script>
    <script src="/js/datetimepicker/locales/bootstrap-datetimepicker.zh-CN.js"></script>
    <link rel="stylesheet" href="/js/datetimepicker/css/bootstrap-datetimepicker.min.css"/>
    {{--城市联动select插件--}}
    <script src="/js/cityselect/jquery.cityselect.js"></script>
    <!--样式-->
    <link rel="stylesheet" href="/css/app.css"/>
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><span class="glyphicon glyphicon-user"></span>dongdong</a>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="/"><span class="glyphicon glyphicon-home"></span>&nbsp;主页</a></li>
					<li class="dropdown" role="presentation">
					    <a class="toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
					        系统管理<span class="caret"></span>
					    </a>
					    <ul class="dropdown-menu" role="menu">
					        <li><a href="{{ url('module')  }}">系统模块</a></li>
					        <li><a href="{{ url('action')  }}">系统动作</a></li>
					        <li><a href="{{ url('foundation')  }}">系统功能</a></li>
					        <li><a href="{{ url('menu')  }}">菜单管理</a></li>
					        <li><a href="{{ url('group')  }}">分组管理</a></li>
					        <li><a href="{{ url('user') }}">用户管理</a></li>
					    </ul>
					</li>
					<li class="dropdown" role="presentation">
                        <a class="toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                            其他<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">其他1</a></li>
                            <li><a href="#">其他2</a></li>
                            <li><a href="#">其他3</a></li>
                        </ul>
                    </li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="/auth/login">登陆</a></li>
						<li><a href="/auth/register">注册</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="/auth/logout">注销</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>
	@yield('content')
</body>
</html>
