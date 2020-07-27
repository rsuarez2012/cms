@extends('emails.master')

@section('content')
<p>Hola: <strong>{{ $name }}</strong></p>
<p>Esta es la nueva contraseña para tu cuenta en nuestra plataforma e es un correo electronico que le ayudara a restablecer la contraseña en nuestra plataforma.</p>

<p><h2>{{ $password }}</h2></p>

<p>Para iniciar sesion haga click en el siguiente botón</p>

<p><a href="{{ url('/login') }}" style="display: inline-block; background-color: #2caaff; color: #fff; padding: 8px; border-radius: 4px; text-decoration: none;">Iniciar Sesión</a></p>

<p>Si el boton anterior no le funcione, copie y pegue la siguiente url en su navegador:</p>
<p>{{ url('/login') }}</p>
@endsection