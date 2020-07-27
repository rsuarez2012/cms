<div class="col-md-4 d-flex">
	<div class="panel shadow">
		<div class="header">
			<h2 class="title"><i class="fa fa-cubes"></i>Modulo Productos</h2>
		</div>

		<div class="inside">
			<div class="form-check">
				<input type="checkbox" value="true" name="products_list" @if(kvfj($user->permissions, 'products_list')) checked @endif> <label for="products_list">púede ver la lista de productos</label>
			</div>
			<div class="form-check">
				<input type="checkbox" value="true" name="product_new" @if(kvfj($user->permissions, 'product_new')) checked @endif> <label for="product_new">púede agregar productos</label>
			</div>
			<div class="form-check">
				<input type="checkbox" value="true" name="product_edit" @if(kvfj($user->permissions, 'product_edit')) checked @endif> <label for="product_edit">púede editar productos</label>
			</div>
			<div class="form-check">
				<input type="checkbox" value="true" name="product_delete" @if(kvfj($user->permissions, 'product_delete')) checked @endif> <label for="product_delete">púede eliminar productos</label>
			</div>
			<div class="form-check">
				<input type="checkbox" value="true" name="add_image_gallery" @if(kvfj($user->permissions, 'add_image_gallery')) checked @endif> <label for="add_image_gallery">púede agregar imagenes a galeria.</label>
			</div>
			<div class="form-check">
				<input type="checkbox" value="true" name="delete_image_gallery" @if(kvfj($user->permissions, 'delete_image_gallery')) checked @endif> <label for="delete_image_gallery">púede eliminar imagenes de la galeria.</label>
			</div>
			<div class="form-check">
				<input type="checkbox" value="true" name="product_search" @if(kvfj($user->permissions, 'product_search')) checked @endif> <label for="product_search">púede hacer busqueda de producto.</label>
			</div>
		</div>
	</div>
</div>