<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')-MADECMS</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-toke" content="{{ csrf_token() }}">
	<meta name="routeName" content="{{ Route::currentRouteName() }}">
	<!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">-->
	<!-- CSS only -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="{{ url('/static/css/style.css?v='.time()) }}">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	
	<!--falta el cdn de fontawesone-->
	 <!-- Font Awesome -->
	<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">-->
  	<!-- Ionicons -->
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
	
  	<!-- JavaScript and dependencies -->
	<script src="https://kit.fontawesome.com/686513f964.js" crossorigin="anonymous"></script>
  
	<!--<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>-->

	<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
	<!--<script src="{{ url('/static/libs/ckeditor/ckeditor.js') }}"></script>-->
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="{{ url('/static/js/site.js?v='.time()) }}"></script>

	
</head>
<body>
	<nav class="navbar navbar-expand-lg shadow">
		<div class="container">
			<a class="navbar-brand" href="{{ url('/') }}">
				<img src="{{ url('/static/images/american-express.png') }}">
			</a>
		    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse">
		    	<ul class="navbar-nav ml-auto">
		    		<li class="nav-item">
		    			<a href="{{ url('/') }}" class="nav-link">
		    				<i class="fas fa-home"></i> Home
		    			</a>
		    		</li>
		    		<li class="nav-item">
		    			<a href="{{ url('/') }}" class="nav-link">
		    				<i class="fas fa-store-alt"></i> Tienda
		    			</a>
		    		</li>
		    		<li class="nav-item">
		    			<a href="{{ url('/') }}" class="nav-link">
		    				<i class="fas fa-id-card-alt"></i> Sobre Nosotros
		    			</a>
		    		</li>
		    		<li class="nav-item">
		    			<a href="{{ url('/') }}" class="nav-link">
		    				<i class="far fa-envelope-open"></i> Contactanos
		    			</a>
		    		</li>
		    		<li class="nav-item">
		    			<a href="{{ url('/car') }}" class="nav-link">
		    				<i class="fas fa-shopping-cart"></i> <span class="car_number">0</span>
		    			</a>
		    		</li>
		    		@if(Auth::guest())
			    		<li class="nav-item link-acc">
			    			<a href="{{ url('/login') }}" class="nav-link btn"><i class="fas fa-fingerprint"></i> Ingresar</a>
			    			<a href="{{ url('/register') }}" class="nav-link btn"><i class="far fa-user-circle"></i> Crear Cuenta</a>
			    		</li>
		    		@else
		    			<li class="nav-item link-user dropdown">
		    				<a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
		    					@if(is_null(Auth::user()->avatar)) 
		    						<img src="{{ url('/static/images/avatar5.png') }}"> 
		    					@else
		    						<img src="{{ url('/uploads_users/'.Auth::id().'/av_'.Auth::user()->avatar) }}"> 
		    					@endif 
		    					Hola: {{ Auth::user()->name }}</a>
		    				<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
		    					@if(Auth::user()->role == "1")
									<li>
						            	<a class="dropdown-item" href="{{ url('/admin') }}">
						            		<i class="fas fa-home"></i> Administración
						            	</a>
						            </li>
						            <li><hr class="dropdown-divider"></li>
		    					@endif
					            <li>
					            	<a class="dropdown-item" href="{{ url('/account/edit') }}">
					            		<i class="fas fa-address-card"></i> Editar Información
					            	</a>
					            </li>
					            <li>
					            	<a class="dropdown-item" href="{{ url('/logout') }}">
					            		<i class="fas fa-sign-out-alt"></i> Salir
					            	</a>
					            </li>
					        </ul>
			    			<!--<a href="{{ url('/logout') }}" class="nav-link btn"><i class="fa fa-home"></i> Salir</a>-->
			    		</li>
		    		@endif
		    	</ul>
		    </div>
		</div>
	</nav>
	
	<div class="wrapper">
		<div class="container">
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

			@yield('content')
			@show
		</div>
	</div>






	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  	<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
	
</body>
</html>