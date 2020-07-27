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
			{!! Form::open(['url' => '/admin/product/add', 'files' => true]) !!}		
			<div class="row">
				<div class="col-md-6">
					<label for="title">Nombre del Producto:</label>
					<div class="input-group">
						<span class="input-group-text" id="basic-addon1"><i class="fa fa-keyboard-o" aria-hidden="true"></i></span>
						{!! Form::text('title', null,['class' => 'form-control']) !!}
					</div>
				</div>

				<div class="col-md-3">
					<label for="category">Categoría:</label>
					<div class="input-group">
						<span class="input-group-text" id="basic-addon1"><i class="fa fa-keyboard-o" aria-hidden="true"></i></span>
						{!! Form::select('category', $categories, 0,['class' => 'form-select']) !!}
						
					</div>
				</div>

				<div class="col-md-3">
					<label for="image">Imagen Destacada:</label>
						<div class="form-file">
							{!! Form::file('image', ['class' => 'form-file-input', 'id' => 'customFile', 'accept'=>'image/*']) !!}
							<label class="form-file-label" for="customFile">
								<span class="form-file-text">Choose File...</span> 	
								<span class="form-file-button">Buscar</span> 	

							</label>
						</div>
				</div>
			</div>
			
			<div class="row mtop16">
				<div class="col-md-3">
					<label for="price">Precio:</label>
					<div class="input-group">
						<span class="input-group-text" id="basic-addon1"><i class="fa fa-money" aria-hidden="true"></i></span>
						{!! Form::number('price', null,['class' => 'form-control', 'min' => '0.00', 'step' => 'any']) !!}
						
					</div>
				</div>

				<div class="col-md-3">
					<label for="in_discount">¿En Descuento?</label>
					<div class="input-group">
						<span class="input-group-text" id="basic-addon1"><i class="fa fa-money" aria-hidden="true"></i></span>
						{!! Form::select('in_discount', ['0' => 'No', '1' => 'Sí'], 0,['class' => 'form-control custom-select']) !!}
						
					</div>
				</div>

				<div class="col-md-3">
					<label for="discount">Descuento en %:</label>
					<div class="input-group">
						<span class="input-group-text" id="basic-addon1"><i class="fa fa-money" aria-hidden="true"></i></span>
						{!! Form::number('discount', 0.00, ['class' => 'form-control', 'min' => '0.00', 'step' => 'any']) !!}
						
					</div>
				</div>
			</div>
			<div class="row mtop16">
				<div class="col-md-3">
					<label for="inventory">Inventario:</label>
					<div class="input-group">
						<span class="input-group-text" id="basic-addon1"><i class="fa fa-money" aria-hidden="true"></i></span>
						{!! Form::number('inventory', 0, ['class' => 'form-control', 'min' => '0.00']) !!}
						
					</div>
				</div>

				<div class="col-md-3">
					<label for="code">Codigo de sistema:</label>
					<div class="input-group">
						<span class="input-group-text" id="basic-addon1"><i class="fa fa-money" aria-hidden="true"></i></span>
						{!! Form::text('code', 0, ['class' => 'form-control']) !!}
						
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