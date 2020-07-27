@extends('admin.master')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
	@if(kvfj(Auth::user()->permissions, 'dashboard_small_stats'))
	<div class="panel shadow">
		<div class="header">
			<h2 class="title"><i class="fa fa-bar-chart"></i> Estadisticas Rapidas</h2>
		</div>
	</div>

		<div class="row mtop16">
			<div class="col-md-3">
				<div class="panel shadow">
					<div class="header">
						<h2 class="title"><i class="fa fa-users"></i> Usuarios Registrados</h2>
					</div>
					<div class="inside">
						<div class="big_count">{{ $users }}</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="panel shadow">
					<div class="header">
						<h2 class="title"><i class="fa fa-cubes"></i> Productos en la DB</h2>
					</div>
					<div class="inside">
						<div class="big_count">{{ $products }}</div>
					</div>
				</div>
			</div>
			@if(kvfj(Auth::user()->permissions, 'dashboard_sell_today'))
			<div class="col-md-3">
				<div class="panel shadow">
					<div class="header">
						<h2 class="title"><i class="fa fa-shopping-basket"></i> Ordenes Hoy</h2>
					</div>
					<div class="inside">
						<div class="big_count">0</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="panel shadow">
					<div class="header">
						<h2 class="title"><i class="fa fa-credit-card"></i> Facturados Hoy.</h2>
					</div>
					<div class="inside">
						<div class="big_count">0</div>
					</div>
				</div>
			</div>
			@endif
		</div>
		<!--<div class="inside">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
		</div>-->
	@endif
</div>

@endsection

