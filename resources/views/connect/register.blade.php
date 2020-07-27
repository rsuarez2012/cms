@extends('connect.master')

@section('title', 'Registrarse')

@section('content')
	<div class="box box_register shadow">
		<div class="header">
			<a href="{{ url('/') }}">
				<img src="{{ url('/static/images/american-express.png') }}">
			</a>
		</div>
		<div class="inside">
			{!! Form::open(['url' => '/register']) !!}
				<label for="name">Nombre:</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<div class="input-group-text">@</div>
					</div>
					{!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
				</div>
				<label for="last_name" class="mtop16">Apellido:</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<div class="input-group-text">@</div>
					</div>
					{!! Form::text('last_name', null, ['class' => 'form-control', 'required']) !!}
				</div>
				<label for="email" class="mtop16">Correo Electrónico</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<div class="input-group-text">@</div>
					</div>
					{!! Form::email('email', null, ['class' => 'form-control', 'required']) !!}
				</div>
				<label for="password" class="mtop16">Contraseña</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<div class="input-group-text">@</div>
					</div>
					{!! Form::password('password', ['class' => 'form-control', 'required']) !!}
				</div>
				<label for="confirm_password" class="mtop16">Confirmar Contraseña</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<div class="input-group-text">@</div>
					</div>
					{!! Form::password('confirm_password', ['class' => 'form-control', 'required']) !!}
				</div>
				{!! Form::submit('Registrarse', ['class' => 'btn btn-success mtop16']) !!}
				{!! Form::close() !!}

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
			
			<div class="footer mtop16">
				<a href="{{ url('/login') }}">Ya tengo una cuenta, Ingresar</a>
			</div>
		</div>
	</div>
@endsection