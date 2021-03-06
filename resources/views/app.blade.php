<!DOCTYPE html>
<html lang="en" ng-app="ManagerApp">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>
	@if(Config::get('app.debug'))
		<link rel="stylesheet" href="{{ asset('build/css/app.css') }}">
		<link rel="stylesheet" href="{{ asset('build/css/components.css') }}">
		<link rel="stylesheet" href="{{ asset('build/css/flaticon.css') }}">
		<link rel="stylesheet" href="{{ asset('build/css/font-awesome.css') }}">
	@else
		<link rel="stylesheet" href="{{ elixir('css/all.css') }}">
	@endif

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Laravel</a>
			</div>

			<div class="collapse navbar-collapse" id="navbar">
				<ul class="nav navbar-nav">
					<li><a href="#/home">Welcome</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if(auth()->guest())
						@if(!Request::is('auth/login'))
							<li><a href="#/login">Login</a></li>
						@endif
						@if(!Request::is('auth/register'))
							<li><a href="{{ url('/auth/register') }}">Register</a></li>
						@endif
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ auth()->user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

<div ng-view></div>

	<!-- Scripts -->
	@if(Config::get('app.debug'))
		<script src="{{ asset('build/js/vendor/jquery.min.js') }}"></script>
		<script src="{{ asset('build/js/vendor/angular.min.js') }}"></script>
		<script src="{{ asset('build/js/vendor/angular-route.min.js') }}"></script>
		<script src="{{ asset('build/js/vendor/angular-resource.min.js') }}"></script>
		<script src="{{ asset('build/js/vendor/angular-animate.min.js') }}"></script>
		<script src="{{ asset('build/js/vendor/angular-messages.min.js') }}"></script>
		<script src="{{ asset('build/js/vendor/ui-bootstrap-tpls.min.js') }}"></script>
		<script src="{{ asset('build/js/vendor/navbar.min.js') }}"></script>
		<script src="{{ asset('build/js/vendor/angular-cookies.min.js') }}"></script>
		<script src="{{ asset('build/js/vendor/query-string.js') }}"></script>
		<script src="{{ asset('build/js/vendor/angular-oauth2.min.js') }}"></script>
		<script src="{{ asset('build/js/vendor/ng-file-upload.min.js') }}"></script>

		<script src="{{ asset('build/js/app.js') }}"></script>
		<!-- Controllers -->
		<script src="{{ asset('build/js/controllers/loginController.js') }}"></script>
		<script src="{{ asset('build/js/controllers/homeController.js') }}"></script>
		<!-- Client Controllers -->
		<script src="{{ asset('build/js/controllers/client/ClientIndexController.js') }}"></script>
		<script src="{{ asset('build/js/controllers/client/ClientCreateController.js') }}"></script>
		<script src="{{ asset('build/js/controllers/client/ClientEditController.js') }}"></script>
		<script src="{{ asset('build/js/controllers/client/ClientDestroyController.js') }}"></script>
		<!-- Project Note Controllers -->
		<script src="{{ asset('build/js/controllers/project-note/ProjectNoteIndexController.js') }}"></script>
		<script src="{{ asset('build/js/controllers/project-note/ProjectNoteCreateController.js') }}"></script>
		<script src="{{ asset('build/js/controllers/project-note/ProjectNoteEditController.js') }}"></script>
		<script src="{{ asset('build/js/controllers/project-note/ProjectNoteDestroyController.js') }}"></script>
		<script src="{{ asset('build/js/controllers/project-note/ProjectNoteShowController.js') }}"></script>
		<!-- Project File Controllers -->
		<script src="{{ asset('build/js/controllers/project-file/ProjectFileIndexController.js') }}"></script>
		<script src="{{ asset('build/js/controllers/project-file/ProjectFileCreateController.js') }}"></script>
		<script src="{{ asset('build/js/controllers/project-file/ProjectFileEditController.js') }}"></script>
		<script src="{{ asset('build/js/controllers/project-file/ProjectFileDestroyController.js') }}"></script>
		<script src="{{ asset('build/js/controllers/project-file/ProjectFileShowController.js') }}"></script>
		<!-- Project Controllers -->
		<script src="{{ asset('build/js/controllers/project/ProjectIndexController.js') }}"></script>
		<script src="{{ asset('build/js/controllers/project/ProjectCreateController.js') }}"></script>
		<script src="{{ asset('build/js/controllers/project/ProjectEditController.js') }}"></script>
		<script src="{{ asset('build/js/controllers/project/ProjectDestroyController.js') }}"></script>
		<script src="{{ asset('build/js/controllers/project/ProjectShowController.js') }}"></script>
		<!-- Project Tasks Controllers -->
		<script src="{{ asset('build/js/controllers/project-task/ProjectTaskIndexController.js') }}"></script>
		<script src="{{ asset('build/js/controllers/project-task/ProjectTaskCreateController.js') }}"></script>
		<script src="{{ asset('build/js/controllers/project-task/ProjectTaskEditController.js') }}"></script>
		<script src="{{ asset('build/js/controllers/project-task/ProjectTaskDestroyController.js') }}"></script>
		<script src="{{ asset('build/js/controllers/project-task/ProjectTaskShowController.js') }}"></script>

		<!-- Services -->
		<script src="{{ asset('build/js/services/urlService.js') }}"></script>
		<script src="{{ asset('build/js/services/clientService.js') }}"></script>
		<script src="{{ asset('build/js/services/projectNoteService.js') }}"></script>
		<script src="{{ asset('build/js/services/projectTaskService.js') }}"></script>
		<script src="{{ asset('build/js/services/projectFileService.js') }}"></script>
		<script src="{{ asset('build/js/services/projectService.js') }}"></script>
		<script src="{{ asset('build/js/services/userService.js') }}"></script>

		<!-- Filters -->
		<script src="{{ asset('build/js/filters/date-br.js') }}"></script>

		<!-- Directives -->
		<script src="{{ asset('build/js/directives/projectFileDownloadDirective.js') }}"></script>
	@else
		<script src="{{ elixir('js/all.js') }}"></script>
	@endif
</body>
</html>
