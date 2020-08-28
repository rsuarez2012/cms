<div class="sidebar shadow">
	<!--video 11-->
	<div class="section-top">
		<img src="{{ url('/static/images/logoN.v02.png') }}" class="logo img-fluid">
	
		<div class="user">
			<span class="subtitle">Hola:</span>
			<div class="name">
				{{ Auth::user()->name }} {{ Auth::user()->last_name }}
				<a href="{{ url('/logout') }}" data-toggle="tooltip" data-placement="top" title="Salir"><i class="fas fa-sign-out-alt"></i>Salir</a>
			</div>
			<div class="email">
				{{ Auth::user()->email }}
			</div>
		</div>
	</div>

	<div class="main">
		<ul>
			@if(kvfj(Auth::user()->permissions, 'dashboard'))
			<li>
				<a href="{{ url('/admin') }}" class="lk-dashboard"><i class="fa fa-table" aria-hidden="true"></i>Dashboard</a>
			</li>
			@endif
			@if(kvfj(Auth::user()->permissions, 'categories_list'))
			<li>
				<a href="{{ url('/admin/categories/0') }}" class="lk-categories_list lk-category_new lk-category_edit"><i class="fa fa-folder-open" aria-hidden="true"></i>Categorias</a>
			</li>
			@endif
			@if(kvfj(Auth::user()->permissions, 'products_list'))
			<li>
				<a href="{{ url('/admin/products/1') }}" class="lk-products_list lk-product_new lk-product_edit lk-product_search"><i class="fa fa-cubes" aria-hidden="true"></i>Productos</a>
				
			</li>
			@endif
			@if(kvfj(Auth::user()->permissions, 'users_list'))
			<li>
				<a href="{{ url('/admin/users/all') }}" class="lk-users_list lk-user_edit lk-user_permissions"><i class="fa fa-users"></i>Usuarios</a>
				
			</li>
			@endif
		</ul>
	</div>
</div>