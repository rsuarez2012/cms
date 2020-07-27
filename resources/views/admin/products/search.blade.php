@extends('admin.master')

@section('title', 'Productos')

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="{{ url('/admin/products') }}"><i class="fa fa-cubes" aria-hidden="true"></i> Productos</a>
</li>
@endsection
@section('content')
<div class="container-fluid">
	<div class="panel shadow">
		<div class="header">
			<h2 class="title"><i class="fa fa-cubes" aria-hidden="true"></i> Productos</h2>
			<ul>
				@if(kvfj(Auth::user()->permissions, 'product_new'))
				<li>
					<a href="{{ url('/admin/product/add') }}"><i class="fa fa-plus"></i> Agregar Producto</a>
				</li>
				@endif
				<li>
					<a href="#">Filtrar <i class="fa fa-chevron-down"></i> </a>
					<ul class="shadow">
						<li>
							<a href="{{ url('/admin/products/1') }}"><i class="fa fa-globe"></i> Publicos</a>
						</li>
						<li>
							<a href="{{ url('/admin/products/0') }}"><i class="fa fa-eraser"></i> Borrador</a>
						</li>
						<li>
							<a href="{{ url('/admin/products/trash') }}"><i class="fa fa-trash"></i> Papelera</a>
						</li>
						<li>
							<a href="{{ url('/admin/products/all') }}"><i class="fa fa-list"></i> Todos</a>
						</li>
					</ul>
				</li>
				<li>
					<a href=#" id="btn_search"><i class="fa fa-search"></i> Buscar</a>
					
				</li>
			</ul>
		</div>

		<div class="inside">
			<div class="form_search" id="form_search">
				{!! Form::open(['url' => '/admin/product/search']) !!}
				<div class="row">
					<div class="col-md-4">
						{!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Buscar']) !!}
						
					</div>
					<div class="col-md-4">
						{!! Form::select('filter', ['0' => 'Nombre del Producto', '1' => 'Codigo del Producto'], 0, ['class' => 'form-control']) !!}
					</div>
					<div class="col-md-2">
						{!! Form::select('status', ['0' => 'Borrador', '1' => 'Publicos'], 0, ['class' => 'form-control']) !!}
					</div>
					<div class="col-md-2">
						{!! Form::submit('Buscar', ['class' => 'btn btn-primary']) !!}
					</div>
				</div>
				{!! Form::close() !!}
			</div>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>ID</th>
						<th></th>
						<th>Nombre</th>
						<th>Categoria</th>
						<th>Precio</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach($products as $product)
					<tr>
						<td width="50">{{ $product->id }}</td>
						<td width="64"> 
							<a href="{{ url('/uploads/'.$product->file_path.'/t_'.$product->image) }}" data-fancybox="gallery">
								<img src="{{ url('/uploads/'.$product->file_path.'/t_'.$product->image) }}" width="64"> 
							</a>
						</td>
						<td>{{ $product->title }}@if($product->status == 0) <i class="fa fa-eraser" data-toggle="tooltip" data-placement="top" title="Estado: Borrador"></i> @endif</td>
						<td>{{ $product->cat->name }}</td>
						<td>{{ $product->price }}</td>
						<td>
							<div class="opts">
								@if(kvfj(Auth::user()->permissions, 'product_edit'))
								<a href="{{ url('/admin/product/'.$product->id.'/edit') }}" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a>
								@endif
								@if(kvfj(Auth::user()->permissions, 'product_delete'))
								<a href="{{ url('/admin/product/'.$product->id.'/delete') }}" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa fa-trash"></i></a>
								@endif
							</div>
						</td>
					</tr>
					@endforeach
					<tr>
						<td colspan="6">
							{{--{!! $products->render() !!}--}}
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

@endsection