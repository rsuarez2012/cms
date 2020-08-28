@extends('master')

@section('title', 'Editar Perfil')

@section('content')
<div class="row mtop32">
	<div class="col-md-4">
		<div class="panel shadow">
			<div class="header">
				<h2 class="title"><i class="far fa-user"></i> Editar Avatar.</h2>
			</div>
			<div class="inside">
				<div class="edit_avatar">
					{!! Form::open(['url' => '/account/edit/avatar', 'id' => 'form_avatar_change', 'files' => true]) !!}
						<a href="#" id="btn_avatar">
						<div class="overlay" id="avatar_change_overlay"><i class="fas fa-camera"></i> </div>
							@if(is_null(Auth::user()->avatar))
								<img src="{{ url('/static/images/avatar5.png') }}">
							@else
								<img src="{{ url('/uploads_users/'.Auth::id().'/av_'.Auth::user()->avatar) }}">
							@endif
						</a>
						{!! Form::file('avatar', ['id' => 'input_file_avatar', 'accept' => 'image/*', 'class' => 'form-control']) !!}
					{!! Form::close() !!}
				</div>
			</div>
		</div>

		<div class="panel shadow mtop32">
			<div class="header">
				<h2 class="title"><i class="fas fa-fingerprint"></i> Cambiar Contraseña.</h2>
			</div>
			<div class="inside">
				{!! Form::open(['url' => '/account/edit/password']) !!}
				<div class="row">
					<div class="col-md-12">
						<label for="actual_password">Contraseña Actual:</label>
						<div class="input-group">
							<span class="input-group-text" id="basic-addon1">
								<i class="far fa-keyboard"></i>
							</span>
							{!! Form::password('actual_password', ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="col-md-12 mtop16">
						<label for="password">Nueva Contraseña:</label>
						<div class="input-group">
							<span class="input-group-text" id="basic-addon1">
								<i class="far fa-keyboard"></i>
							</span>
							{!! Form::password('password', ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="col-md-12 mtop16">
						<label for="confirm_password">Confirmar Contraseña:</label>
						<div class="input-group">
							<span class="input-group-text" id="basic-addon1">
								<i class="far fa-keyboard"></i>
							</span>
							{!! Form::password('confirm_password', ['class' => 'form-control']) !!}
						</div>
					</div>
				</div>
				<div class="row mtop16">
					<div class="col-md-12">
						{!! Form::submit('Actualizar Contraseña', ['class' => 'btn btn-primary']) !!}
					</div>
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>

	<div class="col-md-8">
		<div class="panel shadow">
			<div class="header">
				<h2 class="title"><i class="far fa-address-card"></i> Editar Información.</h2>
			</div>
			<div class="inside">
				{!! Form::open(['url' => '/account/edit/info']) !!}
				<div class="row">
					<div class="col-md-4">
						<label for="name">Nombre:</label>
						<div class="input-group">
							<span class="input-group-text" id="basic-addon1">
								<i class="far fa-keyboard"></i>
							</span>
							{!! Form::text('name', Auth::user()->name	,['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="col-md-4">
						<label for="last_name">Apellido:</label>
						<div class="input-group">
							<span class="input-group-text" id="basic-addon1">
								<i class="far fa-keyboard"></i>
							</span>
							{!! Form::text('last_name', Auth::user()->last_name	,['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="col-md-4">
						<label for="email">Correo electronico:</label>
						<div class="input-group">
							<span class="input-group-text" id="basic-addon1">
								<i class="far fa-keyboard"></i>
							</span>
							{!! Form::text('email', Auth::user()->email	,['class' => 'form-control', 'disabled']) !!}
						</div>
					</div>
				</div>
				<div class="row mtop16">
					<div class="col-md-4">
						<label for="phone">Numero de Telefono:</label>
						<div class="input-group">
							<span class="input-group-text" id="basic-addon1">
								<i class="far fa-keyboard"></i>
							</span>
							{!! Form::number('phone', Auth::user()->phone	,['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="col-md-8">
						<label for="year">Fecha de Nacimiento: Año-Mes-Día</label>
						<div class="input-group">
							<span class="input-group-text" id="basic-addon1">
								<i class="far fa-keyboard"></i>
							</span>
							{!! Form::number('year', $birthday[0],['class' => 'form-control', 'min' => getUserYear()[1], 'max' => getUserYear()[0], 'required']) !!}
							{!! Form::select('month', getMonths('list', $birthday[1]), null,['class' => 'form-select']) !!}
							{!! Form::number('day', $birthday[2],['class' => 'form-control', 'min' => 1, 'max' => 31, 'required']) !!}
						</div>
					</div>
				</div>

				<div class="row mtop16">
					<div class="col-md-4">
						<label for="gender">Genero:</label>
						<div class="input-group">
							<span class="input-group-text" id="basic-addon1">
								<i class="far fa-keyboard"></i>
							</span>
							{!! Form::select('gender', ['0' => 'Sin Especificar', '1' => 'Hombre', '2' => 'Mujer'],Auth::user()->gender,['class' => 'form-select']) !!}
						</div>
					</div>
				</div>
				<div class="row mtop16">
					<div class="col-md-12">
						{!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
						
					</div>
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@endsection