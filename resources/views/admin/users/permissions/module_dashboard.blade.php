<div class="col-md-4 d-flex">
	<div class="panel shadow">
		<div class="header">
			<h2 class="title"><i class="fa fa-home"></i>Modulo Dashboard</h2>
		</div>

		<div class="inside">
			<div class="form-check">
				<input type="checkbox" value="true" name="dashboard" @if(kvfj($user->permissions, 'dashboard')) checked @endif> <label for="dashboard">púede ver el dashboard</label>
			</div>

			<div class="form-check">
				<input type="checkbox" value="true" name="dashboard_small_stats" @if(kvfj($user->permissions, 'dashboard_small_stats')) checked @endif> <label for="dashboard_small_stats">Estadisticas en el dashboard</label>
			</div>

			<div class="form-check">
				<input type="checkbox" value="true" name="dashboard_sell_today" @if(kvfj($user->permissions, 'dashboard_sell_today')) checked @endif> <label for="dashboard_sell_today">Ventas del dia</label>
			</div>
		</div>
	</div>
</div>