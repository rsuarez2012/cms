<?php
//key value from json
function kvfj($json, $key){
	if($json == null):
		return null;
	else:
		$json = $json;
		//json_decode transforma un json en un arreglo
		
		$json = json_decode($json, true);
		if(array_key_exists($key, $json)):
			return $json[$key];
		else:
			return null;
		endif; 
	endif;
}

function getModulesArray(){
	$a = [
		'0' => 'Productos',
		'1' => 'Blog',
		/*'' => 'Productos',
		'0' => 'Productos',
		'0' => 'Productos',
		'0' => 'Productos',*/
	];
	return $a;
}
function getRoleArray($mode, $id){
	$roles = [
		'0' => 'Usuario normal',
		'1' => 'Administrador',
		/*'' => 'Productos',
		'0' => 'Productos',
		'0' => 'Productos',
		'0' => 'Productos',*/
	];
	if(!is_null($mode)):
		return $roles;
	else:
		return $roles[$id];
	endif;

}

function getUserStatusArray($mode, $id){
	$status = [
		'0' => 'Registrado',
		'1' => 'Verificado',
		'100' => 'Baneado',
		/*'0' => 'Productos',
		'0' => 'Productos',
		'0' => 'Productos',*/
	];
	if(!is_null($mode)):
		return $status;
	else:
		return $status[$id];
	endif;
}

function user_permissions(){
	$p = [
		'dashboard' => [
			'icon' => '<i class="fa fa-home"></i>',
			'title' => 'Modulo Dashboard',
			'keys' => [
				'dashboard' => 'Puede ver el dashboard.',
				'dashboard_small_stats' => 'Estadisticas en el dashboard.',
				'dashboard_sell_today' => 'Ventas del día.',
			]
		],
		//productos
		'products' => [
			'icon' => '<i class="fa fa-cubes"></i>',
			'title' => 'Modulo Productos',
			'keys' => [
				'products_list' => 'Púede ver la lista de productos',
				'product_new' => 'Púede agregar productos',
				'product_edit' => 'Púede editar productos',
				'product_delete' => 'Púede eliminar productos',
				'add_image_gallery' => 'Púede agregar imagenes a galeria.',
				'delete_image_gallery' => 'Púede eliminar imagenes de la galeria.',
				'product_search' => 'Púede hacer busqueda de producto.',
			]
		],
		'categories' => [
			'icon' => '<i class="fa fa-folder-open"></i>',
			'title' => 'Modulo Categorias',
			'keys' => [
				'categories_list' => 'Púede ver las categorias.',
				'category_store' => 'Púede agregar categorias.',
				'category_edit' => 'Púede editar las categorias.',
				'category_delete' => 'Púede eliminar categorias.',
			]
		],
		'users' => [
			'icon' => '<i class="fa fa-users"></i>',
			'title' => 'Modulo Usuarios',
			'keys' => [
				'users_list' => 'Púede ver la lista de usuarios',
				'user_banned' => 'Púede suspender usuarios.',
				'user_edit' => 'Púede editar usuarios.',
				'user_permissions' => 'Púede administrar permisos de usuarios.',
			]
		],
	];

	return $p;
}