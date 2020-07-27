<?php 
//archivo de rutas admin
Route::prefix('/admin')->group(function(){
	Route::get('/', 'Admin\DashboardController@getDashboard')->name('dashboard');

	//USUARIOS
	Route::get('/users/{status}', 'Admin\UserController@getUsers')->name('users_list');
	Route::get('/user/{id}/edit', 'Admin\UserController@edit')->name('user_edit');
	Route::post('/user/{id}/edit', 'Admin\UserController@update')->name('user_edit');
	Route::get('/user/{id}/banned', 'Admin\UserController@banned')->name('user_banned');
	Route::get('/user/{id}/permissions', 'Admin\UserController@getUserPermissions')->name('user_permissions');
	Route::post('/user/{id}/permissions', 'Admin\UserController@postUserPermissions')->name('user_permissions');
	
	//CATEGORIES
	Route::get('/categories/{module}', 'Admin\CategoryController@index')->name('categories_list');
	Route::post('/category/add', 'Admin\CategoryController@store')->name('category_store');
	Route::get('/category/{id}/edit', 'Admin\CategoryController@edit')->name('category_edit');
	Route::post('/category/{id}/edit', 'Admin\CategoryController@update')->name('category_edit');
	Route::get('/category/{id}/delete', 'Admin\CategoryController@destroy')->name('category_delete');

	//PRODUCTS
	Route::get('/products/{status}', 'Admin\ProductController@getProducts')->name('products_list');
	Route::get('/product/add', 'Admin\ProductController@create')->name('product_new');
	Route::post('/product/add', 'Admin\ProductController@store')->name('product_new');
	Route::post('/product/search', 'Admin\ProductController@postProductSearch')->name('product_search');
	Route::get('/product/{id}/edit', 'Admin\ProductController@edit')->name('product_edit');
	Route::get('/product/{id}/delete', 'Admin\ProductController@destroy')->name('product_delete');
	Route::get('/product/{id}/restore', 'Admin\ProductController@restore')->name('product_delete');
	Route::post('/product/{id}/edit', 'Admin\ProductController@update')->name('product_edit');
	Route::get('/product/{id}/delete', 'Admin\ProductController@destroy')->name('product_delete');
	Route::post('/product/{id}/gallery/add', 'Admin\ProductController@productGallery')->name('add_image_gallery');
	Route::get('/product/{id}/gallery/{gid}/delete', 'Admin\ProductController@productGalleryDelete')->name('delete_image_gallery');

});