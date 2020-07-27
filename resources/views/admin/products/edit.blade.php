@extends('admin.master')

@section('title', 'Productos')

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{{ url('/admin/products') }}"><i class="fa fa-product-hunt" aria-hidden="true"></i>Productos</a>
</li>
<li class="breadcrumb-item">
	<a href="{{ url('/admin/products') }}"><i class="fa fa-edit" aria-hidden="true"></i>Editar Producto</a>
</li>
@endsection
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-9">	
			<div class="panel shadow">
				<div class="header">
					<h2 class="title"><i class="fa fa-edit" aria-hidden="true"></i>Editar Producto</h2>
				</div>

				<div class="inside">
					{!! Form::open(['url' => '/admin/product/'.$product->id.'/edit', 'files' => true]) !!}		
					<div class="row">
						<div class="col-md-6">
							<label for="title">Nombre del Producto:</label>
							<div class="input-group">
								<span class="input-group-text" id="basic-addon1"><i class="fa fa-keyboard-o" aria-hidden="true"></i></span>
								{!! Form::text('title', $product->title,['class' => 'form-control']) !!}
							</div>
						</div>

						<div class="col-md-3">
							<label for="category">Categoría:</label>
							<div class="input-group">
								<span class="input-group-text" id="basic-addon1"><i class="fa fa-keyboard-o" aria-hidden="true"></i></span>							
								{!! Form::select('category', $categories, $product->category_id,['class' => 'form-control custom-select']) !!}
								
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
								{!! Form::number('price', $product->price,['class' => 'form-control', 'min' => '0.00', 'step' => 'any']) !!}
								
							</div>
						</div>

						<div class="col-md-3">
							<label for="in_discount">¿En Descuento?</label>
							<div class="input-group">
								<span class="input-group-text" id="basic-addon1"><i class="fa fa-money" aria-hidden="true"></i></span>
								{!! Form::select('in_discount', ['0' => 'No', '1' => 'Sí'], $product->in_discount,['class' => 'form-select']) !!}
								
							</div>
						</div>

						<div class="col-md-3">
							<label for="discount">Descuento en %:</label>
							<div class="input-group">
								<span class="input-group-text" id="basic-addon1"><i class="fa fa-money" aria-hidden="true"></i></span>
								{!! Form::number('discount', $product->discount, ['class' => 'form-control']) !!}
								
							</div>
						</div>

						<div class="col-md-3">
							<label for="status">Estado:</label>
							<div class="input-group">
								<span class="input-group-text" id="basic-addon1"><i class="fa fa-money" aria-hidden="true"></i></span>
								{!! Form::select('status', ['0' => 'Borrador', '1' => 'Publicado'], $product->status,['class' => 'form-select']) !!}
								
							</div>
						</div>
					</div>

					<div class="row mtop16">
						<div class="col-md-3">
							<label for="inventory">Inventario:</label>
							<div class="input-group">
								<span class="input-group-text" id="basic-addon1"><i class="fa fa-money" aria-hidden="true"></i></span>
								{!! Form::number('inventory', $product->inventory, ['class' => 'form-control', 'min' => '0.00']) !!}
								
							</div>
						</div>

						<div class="col-md-3">
							<label for="code">Codigo de sistema:</label>
							<div class="input-group">
								<span class="input-group-text" id="basic-addon1"><i class="fa fa-money" aria-hidden="true"></i></span>
								{!! Form::text('code', $product->code, ['class' => 'form-control']) !!}
								
							</div>
						</div>
					</div>

					<div class="row mtop16">
						<div class="col-md-12">
							<label for="content">Descripción:</label>
							{!! Form::textarea('content', $product->content, ['class' => 'form-control', 'id' => 'editor']) !!}
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
		<!--Image -->
		<div class="col-md-3">
			<div class="panel shadow">
				<div class="header">
					<h2 class="title"><i class="fa fa-image" aria-hidden="true"></i>Imagen Destacada:</h2>
				</div>
				<div class="inside">
					<img src="{{ url('/uploads/'.$product->file_path.'/'.$product->image) }}" class="img-fluid">
				</div>
			</div>

			<div class="panel shadow mtop16">
				<div class="header">
					<h2 class="title"><i class="fa fa-image" aria-hidden="true"></i>Galeria:</h2>
				</div>
				<div class="inside product_gallery">
					@if(kvfj(Auth::user()->permissions, 'add_image_gallery'))
					{!! Form::open(['url' => '/admin/product/'.$product->id.'/gallery/add', 'files' => true, 'id' => 'form_product_gallery']) !!}
					{!! Form::file('file_image', ['id' => 'product_file_image', 'accept' => 'image/*', 'style' => 'display:none', 'required']) !!}
					{!! Form::close() !!}
					<div class="btn-submit">
						<a href="#" id="btn_product_file_image"><i class="fa fa-plus"></i> </a>
					</div>
					@endif

					<div class="tumbs">
						@foreach($product->getGallery as $img)
						<div class="tumb">
							@if(kvfj(Auth::user()->permissions, 'product_gallery_delete'))
							<a href="{{ url('/admin/product/'.$product->id.'/gallery/'.$img->id.'/delete') }}" data-toggle="tooltip" data-placement="top" title="Eliminar">
								<i class="fa fa-trash"></i>
							</a>
							@endif
							<img src="{{ url('/uploads/'.$img->file_path.'/t_'.$img->file_name) }}">
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>


	</div>
</div>

@endsection