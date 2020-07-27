@extends('admin.master')

@section('title', 'Categorias')

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{{ url('/admin/categories/0') }}"><i class="fa fa-folder-open" aria-hidden="true"></i>Categorias</a>
</li>
@endsection
@section('content')
<div class="container-fluid">
	<div class="row">
		@if(kvfj(Auth::user()->permissions, 'category_store'))
		<div class="col-md-3">		
			<div class="panel shadow">
				<div class="header">
					<h2 class="title"><i class="fa fa-plus" aria-hidden="true"></i>Agregar Categorias</h2>
				</div>

				<div class="inside">
					{{--<div class="btns">
						<a href="{{ url('/admin/category/add') }}" class="btn btn-primary pull-right"><i class="fa fa-plus" aria-hidden="true">Agregar Categoria</i></a>
					</div>--}}
					{!! Form::open(['url' => '/admin/category/add']) !!}	
						<label for="name">Nombre:</label>
						<div class="input-group">
							<span class="input-group-text" id="basic-addon1"><i class="fa fa-keyboard-o" aria-hidden="true"></i></span>
							{!! Form::text('name', null, ['class' => 'form-control']) !!}
							
						</div>

						<label for="module" class="mtop16">Modulo:</label>
						<div class="input-group">
							<span class="input-group-text" id="basic-addon1"><i class="fa fa-keyboard-o" aria-hidden="true"></i></span>
							{!! Form::select('module', getModulesArray(), 0,['class' => 'form-select']) !!}
							
						</div>

						<label for="icon" class="mtop16">Icono:</label>
						<div class="input-group">
							<span class="input-group-text" id="basic-addon1"><i class="fa fa-keyboard-o" aria-hidden="true"></i></span>
							{!! Form::text('icon', null, ['class' => 'form-control']) !!}
							
						</div>
						{!! Form::submit('Guardar', ['class' => 'btn btn-success mtop16']) !!}
					{!! Form::close() !!}
				</div>
			</div>
		</div>		
		@endif

		<div class="col-md-9">
			<div class="panel shadow">
				<div class="header">
					<h2 class="title"><i class="fa fa-folder-open" aria-hidden="true"></i>Categorias</h2>
				</div>

				<div class="inside">
					<!--<nav class="nav nav-pills nav-fill">-->
					<nav class="navbar navbar-expand-lg navbar-light bg-primary">
						@foreach(getModulesArray() as $m => $k)
							<a href="{{ url('/admin/categories/'.$m) }}" class="nav-link"><i class="fa fa-list"></i>{{ $k }}</a>
						@endforeach
					</nav>
					<table class="table mtop16">
						<thead>
							<tr>
								<th>ID</th>
								<th>Icono</th>
								<th>Categorias</th>
								<th>Slug</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($categories as $category)
							<tr>
								<td>{{ $category->id }}</td>
								<td>{!! htmlspecialchars_decode($category->icono) !!}</td>
								<td>{{ $category->name }}</td>
								<td>{{ $category->slug }}</td>
								<td>
									<div class="opts">
										@if(kvfj(Auth::user()->permissions, 'category_edit'))
										<a href="{{ url('/admin/category/'.$category->id.'/edit') }}" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a>
										@endif
										@if(kvfj(Auth::user()->permissions, 'category_delete'))
										<a href="{{ url('/admin/category/'.$category->id.'/delete') }}" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa fa-trash"></i></a>
										@endif
									</div>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection