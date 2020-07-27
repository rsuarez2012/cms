<div class="col-md-4 d-flex">
	<div class="panel shadow">
		<div class="header">
			<h2 class="title"><i class="fa fa-folder-open"></i>Modulo Categorias</h2>
		</div>

		<div class="inside">
			<div class="form-check">
				<input type="checkbox" value="true" name="categories_list" @if(kvfj($user->permissions, 'categories_list')) checked @endif> <label for="categories_list">púede ver las categorias</label>
			</div>

			<div class="form-check">
				<input type="checkbox" value="true" name="category_store" @if(kvfj($user->permissions, 'category_store')) checked @endif> <label for="category_store">púede agregar categorias</label>
			</div>
			<div class="form-check">
				<input type="checkbox" value="true" name="category_edit" @if(kvfj($user->permissions, 'category_edit')) checked @endif> <label for="category_edit">púede editar categorias</label>
			</div>
			<div class="form-check">
				<input type="checkbox" value="true" name="category_delete" @if(kvfj($user->permissions, 'category_delete')) checked @endif> <label for="category_delete">púede eliminar categorias</label>
			</div>
			
		</div>
	</div>
</div>