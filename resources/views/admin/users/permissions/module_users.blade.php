<div class="col-md-4 d-flex">
	<div class="panel shadow">
		<div class="header">
			<h2 class="title"><i class="fa fa-users"></i>Modulo Usuarios</h2>
		</div>

		<div class="inside">
			<div class="form-check">
				<input type="checkbox" value="true" name="users_list" @if(kvfj($user->permissions, 'users_list')) checked @endif> <label for="users_list">púede ver la lista de usuarios</label>
			</div>
			<div class="form-check">
				<input type="checkbox" value="true" name="user_banned" @if(kvfj($user->permissions, 'user_banned')) checked @endif> <label for="user_banned">púede suspender usuarios</label>
			</div>
			<div class="form-check">
				<input type="checkbox" value="true" name="user_edit" @if(kvfj($user->permissions, 'user_edit')) checked @endif> <label for="user_edit">púede editar usuarios</label>
			</div>
			<div class="form-check">
				<input type="checkbox" value="true" name="user_permissions" @if(kvfj($user->permissions, 'user_permissions')) checked @endif> <label for="user_permissions">púede administrar permisos de usuarios</label>
			</div>
		</div>
	</div>
</div>