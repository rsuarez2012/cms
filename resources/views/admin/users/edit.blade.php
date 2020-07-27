@extends('admin.master')

@section('title', 'Usuarios')

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{{ url('/admin/users') }}"><i class="fa fa-user" aria-hidden="true"></i> Usuario</a>
</li>
@endsection
@section('content')
<div class="container-fluid">
	<div class="page_user">
		
		<div class="row">
			<div class="col-md-4">		
				<div class="panel shadow">
					<div class="header">
						<h2 class="title"><i class="fa fa-user" aria-hidden="true"></i>Infomación</h2>
					</div>

					<div class="inside">
						<div class="mini_profile">
							@if(is_null($user->avatar))
								<img src="{{ url('/static/images/avatar5.png') }}" alt="" class="avatar">
							@else
								<img src="{{ url('/uploads/user/'.$user->id.'/'.$user->avatar) }}" alt="" class="avatar">
							@endif

							<div class="info mtop16">
								<span class="title"><i class="fa fa-user"></i></i> Nombre:</span>
								<span class="text">{{ $user->name }} {{ $user->last_name }}</span>

								<span class="title"><i class="fa fa-user-tie"></i> Estado del Usuario:</span>
								<span class="text">{{ getUserStatusArray(null, $user->status) }}</span>

								<span class="title"><i class="fa fa-envelope-o"></i> Correo Electronico:</span>
								<span class="text">{{ $user->email }}</span>

								<span class="title"><i class="fa fa-calendar"></i> Registrado el:</span>
								<span class="text">{{ $user->created_at }}</span>

								<span class="title"><i class="fa fa-user-shield"></i> Rol de Usuario:</span>
								<span class="text">{{ getRoleArray(null, $user->role) }}</span>

							</div>
							@if(kvfj(Auth::user()->permissions, 'user_banned'))
								@if($user->status == "100")
									<a href="{{ url('/admin/user/'.$user->id.'/banned') }}" class="btn btn-success">Activar Usuario</a>
								@else
									<a href="{{ url('/admin/user/'.$user->id.'/banned') }}" class="btn btn-danger">Suspender Usuario</a>
								@endif
							@endif

						</div>
					</div>
				</div>
			</div>	

			<div class="col-md-8">		
				<div class="panel shadow">
					<div class="header">
						<h2 class="title"><i class="fa fa-edit" aria-hidden="true"></i>Editar Información</h2>
					</div>

					<div class="inside">
						@if(kvfj(Auth::user()->permissions, 'user_edit'))
							{!! Form::open(['url' => '/admin/user/'.$user->id.'/edit']) !!}

							<div class="row">
								<div class="col-md-6">
									<label for="module" class="mtop16">Tipo de Usuario:</label>
									<div class="input-group">
											<span class="input-group-text" id="basic-addon1"><i class="fa fa-keyboard-o" aria-hidden="true"></i></span>
										{!! Form::select('user_type', getRoleArray('list', null), $user->role,['class' => 'form-select']) !!}
										
									</div>
								</div>
							</div>
							<div class="row mtop16">
								<div class="col-md-12">
									{!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
								</div>
							</div>
							{!! Form::close() !!}
						@endif




























						{{--<div class="btns">
							<a href="{{ url('/admin/user/add') }}" class="btn btn-primary pull-right"><i class="fa fa-plus" aria-hidden="true">Agregar Categoria</i></a>
						</div>
						{!! Form::open(['url' => '/admin/'.$user->id.'/edit']) !!}	
							<label for="name">Nombre:</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1"><i class="fa fa-keyboard-o" aria-hidden="true"></i></span>
								</div>
								{!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
								
							</div>

							<label for="module" class="mtop16">Modulo:</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1"><i class="fa fa-keyboard-o" aria-hidden="true"></i></span>
								</div>
								{!! Form::select('module', getModulesArray(), $user->module,['class' => 'form-control custom-select']) !!}
								
							</div>

							<label for="icon" class="mtop16">Icono:</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1"><i class="fa fa-keyboard-o" aria-hidden="true"></i></span>
								</div>
								{!! Form::text('icon', $user->icono, ['class' => 'form-control']) !!}
								
							</div>
							{!! Form::submit('Guardar', ['class' => 'btn btn-success mtop16']) !!}
						{!! Form::close() !!}--}}
					</div>
				</div>
			</div>		
		</div>
	</div>
</div>

@endsection