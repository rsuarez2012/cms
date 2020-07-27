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
		<div class="col-md-3">		
			<div class="panel shadow">
				<div class="header">
					<h2 class="title"><i class="fa fa-edit" aria-hidden="true"></i>Editar Categoria</h2>
				</div>

				<div class="inside">
					{{--<div class="btns">
						<a href="{{ url('/admin/category/add') }}" class="btn btn-primary pull-right"><i class="fa fa-plus" aria-hidden="true">Agregar Categoria</i></a>
					</div>--}}
					{!! Form::open(['url' => '/admin/category/'.$category->id.'/edit']) !!}	
						<label for="name">Nombre:</label>
						<div class="input-group">
							<span class="input-group-text" id="basic-addon1"><i class="fa fa-keyboard-o" aria-hidden="true"></i></span>
							{!! Form::text('name', $category->name, ['class' => 'form-control']) !!}
							
						</div>

						<label for="module" class="mtop16">Modulo:</label>
						<div class="input-group">
							<span class="input-group-text" id="basic-addon1"><i class="fa fa-keyboard-o" aria-hidden="true"></i></span>
							{!! Form::select('module', getModulesArray(), $category->module,['class' => 'form-select']) !!}
							
						</div>

						<label for="icon" class="mtop16">Icono:</label>
						<div class="input-group">
							<span class="input-group-text" id="basic-addon1"><i class="fa fa-keyboard-o" aria-hidden="true"></i></span>
							{!! Form::text('icon', $category->icono, ['class' => 'form-control']) !!}
							
						</div>
						{!! Form::submit('Guardar', ['class' => 'btn btn-success mtop16']) !!}
					{!! Form::close() !!}
				</div>
			</div>
		</div>		
	</div>
</div>

@endsection