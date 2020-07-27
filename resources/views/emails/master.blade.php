<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body style="margin: 0px; padding: 0px; background-color: #f0f0f0;">
	<div style="display:block; margin: 0px auto; max-width: 728px; width: 60%;" >
		<img src="{{ url('/static/images/montaña.jpg')}}" style="width: 100%; display: block; height: 30%;">

		<div style="background-color: #fff; padding: 24px;">
			@yield('content')

			<hr>
			<p>Nuestras redes sociales</p>
		</div>
	</div>
</body>
</html>