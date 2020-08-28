<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')-CMS</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-toke" content="{{ csrf_token() }}">
	<meta name="routeName" content="{{ Route::currentRouteName() }}">
	<!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">-->
	<!-- CSS only -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="{{ url('/static/css/admin.css?v='.time()) }}">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	
	<!--falta el cdn de fontawesone-->
	 <!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  	<!-- Ionicons -->
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
	

  	<!-- JavaScript and dependencies -->
	
  
	<!--<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>-->

	<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
	<script src="{{ url('/static/libs/ckeditor/ckeditor.js') }}"></script>
	<!--<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>-->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

	<script src="{{ url('/static/js/admin.js?v='.time()) }}"></script>

	
</head>
<body>
	<div class="wrapper">
		<div class="col1">@include('admin.sidebar')</div>

		<div class="col2">
			<nav class="navbar navbar-expand-lg shadow">
				<div class="collapse navbar-collapse">
					<!--<button class="btn btn-primary" id="menu-toggle">Toggle Menu</button>-->
					<ul class="nav navbar-nav">
						<li class="nav-item">
							<a href="{{ url('/admin') }}" class="nav-link">Dashboard</a>
						</li>
					</ul>

					
				</div>
				<div class="dropdown">
						<a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-expanded="false">
						    <img src="{{ url('/static/images/avatar5.png') }}" class="user-image">
							<span class="hidden-xs">Raul Suarez</span>
						</a>
						<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
							<li class="user-header">
								<img src="{{ url('/static/images/avatar5.png') }}" class="img-circle" alt="User Image">
								<p>
									Raul Suarez <br>
									<small>Miembro desde: </small>
								</p>
							</li>
							<li><a class="dropdown-item" href="#">Another action</a></li>
							<li class="user-footer">
								<div class="pull-left">
									<a href="{{ url('/admin/user/'.Auth::user()->id.'/edit') }}" class="btn btn-primary btn-flat">Perfil</a>
								</div>
								<div class="pull-right">
									<a href="{{ url('/logout') }}" class="btn btn-primary btn-flat">Salir</a>
								</div>
							</li>
							<li></li>
						</ul>
					</div>
			</nav>

			<div class="page">

				<div class="container-fluid">
					<nav aria-label="breadcrumb shadow">
						<ol class="breadcrumb">
							<li class="breadcrumb-item">
								<a href="{{ url('/admin') }}">  <i class="fa fa-table"></i> Dashboard</a>
							</li>
							@section('breadcrumb')
							@show
						</ol>
					</nav>
				</div>
				@if(Session::has('message'))
					<div class="container">
						<div class="mtop16 alert alert-{{ Session::get('typealert') }}" style="display: none;">
							{{ Session::get('message') }}
							@if($errors->any())
								<ul>
									@foreach($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							@endif
							<script type="text/javascript">
								$('.alert').slideDown();
								setTimeout(function(){ $('.alert').slideUp(); }, 10000)
							</script>
							
						</div>
					</div>
				@endif
				@section('content')
				@show

			</div>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  	<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>


  	<script type="text/javascript">
		$(document).ready(function(){
			$(".dropdown-toggle").dropdown();
			$('[data-toggle="tooltip"]').tooltip();
		
			$("#menu-toggle").click(function(e) {
		      e.preventDefault();
		      $("#wrapper").toggleClass("toggled");
		    });


	    })
	</script>
</body>
</html>