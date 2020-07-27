@extends('admin.master')

@section('title', 'Productos')

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{{ url('/admin/products') }}"><i class="fa fa-product-hunt" aria-hidden="true"></i>Productos</a>
</li>
<li class="breadcrumb-item">
	<a href="{{ url('/admin/products') }}"><i class="fa fa-product-hunt" aria-hidden="true"></i>Nuevo Producto</a>
</li>
@endsection
@section('content')
<div class="container-fluid">
	<div class="panel shadow">
		<div class="header">
			<h2 class="title"><i class="fa fa-product-hunt" aria-hidden="true"></i>Nuevo Producto</h2>
		</div>

		<div class="inside">
			{!! Form::open(['url' => '/admin/product/add']) !!}		
			<div class="row">
				<div class="col-md-6">
					<label for="title">Nombre del Producto:</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1"><i class="fa fa-keyboard-o" aria-hidden="true"></i></span>
						</div>
						{!! Form::text('title', null,['class' => 'form-control']) !!}
					</div>
				</div>

				<div class="col-md-3">
					<label for="title">Categoría:</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1"><i class="fa fa-keyboard-o" aria-hidden="true"></i></span>
						</div>
						{!! Form::text('title', null,['class' => 'form-control']) !!}
					</div>
				</div>

				<div class="col-md-3">
					<label for="title">Imagen Destacada:</label>
						<div class="custom-file">
							{!! Form::file('img', ['class' => 'custom-file-input', 'id' => 'customFile']) !!}
							<label class="custom-file-label" for="customFile">Choose File</label>
						</div>
				</div>
			</div>
			
			<div class="row mtop16">
				<div class="col-md-3">
					<label for="price">Precio:</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1"><i class="fa fa-money" aria-hidden="true"></i></span>
						</div>
						{!! Form::number('price', null,['class' => 'form-control', 'min' => '0.00', 'step' => 'any']) !!}
						
					</div>
				</div>

				<div class="col-md-3">
					<label for="in_discount">¿En Descuento?</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1"><i class="fa fa-money" aria-hidden="true"></i></span>
						</div>
						{!! Form::select('in_discount', ['0' => 'No', '1' => 'Sí'], 0,['class' => 'form-control custom-select']) !!}
						
					</div>
				</div>

				<div class="col-md-3">
					<label for="discount">Descuento en %:</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text" id="basic-addon1"><i class="fa fa-money" aria-hidden="true"></i></span>
						</div>
						{!! Form::number('discount', 0.00, ['class' => 'form-control']) !!}
						
					</div>
				</div>
			</div>

			<div class="row mtop16">
				<div class="col-md-12">
					<label for="content">Descripción:</label>
					{!! Form::textarea('content', null, ['class' => 'form-control', 'id' => 'editor']) !!}
				</div>
			</div>

			<div class="row mtop16">
				<div class="col-md-12">
					{!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
				</div>
			</div>
			{!! Form::close() !!}
			
		</div>
	</div>
</div>

@endsection