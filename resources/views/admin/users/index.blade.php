@extends('admin.master')

@section('title', 'Usuarios')

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{{ url('/admin.users') }}"><i class="fa fa-users" aria-hidden="true"></i>Usuarios</a>
</li>
@endsection
@section('content')
<div class="container-fluid">
	<div class="panel shadow">
		<div class="header">
			<h2 class="title"><i class="fa fa-users"></i>Usuarios</h2>
		</div>
		<div class="inside">
			<div class="row">
				<div class="col-md-2 offset-md-10">
					<div class="dropdown">
						<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 100%;">
							<i class="fa fa-filter"></i> filtrar
						</button>
						<div class="dropdown-menu" aria.labelledby="dropdownMenuButton">
							<a href="{{ url('/admin/users/all') }}" class="dropdown-item"><i class="fa fa-list"></i> Todos</a>
							<a href="{{ url('/admin/users/0') }}" class="dropdown-item"><i class="fa fa-unlink"></i>No Verificados</a>
							<a href="{{ url('/admin/users/1') }}" class="dropdown-item"><i class="fa fa-check"></i> Verificados</a>
							<a href="{{ url('/admin/users/100') }}" class="dropdown-item"><i class="fa fa-sign-out"></i>Suspendidos</a>
						</div>
					</div>
				</div>
			</div>

			<table class="table mtop16">
				<thead>
					<tr>
						<th>ID</th>
						<th>Nombres</th>
						<th>Apellidos</th>
						<th>Email</th>
						<th>Role</th>
						<th>Estado</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach($users as $user)
					<tr>
						<td>{{ $user->id }}</td>
						<td>{{ $user->name }}</td>
						<td>{{ $user->last_name }}</td>
						<td>{{ $user->email }}</td>
						<td>{{ getRoleArray(null, $user->role) }}</td>
						<td>{{ getUserStatusArray(null, $user->status) }}</td>
						<td>
							<div class="opts">
								@if(kvfj(Auth::user()->permissions, 'user_edit'))
								<a href="{{ url('/admin/user/'.$user->id.'/edit') }}" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a>
								@endif
								@if(kvfj(Auth::user()->permissions, 'user_permissions'))
								<a href="{{ url('/admin/user/'.$user->id.'/permissions') }}" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Permisos"><i class="fa fa-cogs"></i></a>
								@endif
							</div>
						</td>
					</tr>
					@endforeach
					<tr>
						<td colspan="7">{!! $users->render() !!}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

@endsection