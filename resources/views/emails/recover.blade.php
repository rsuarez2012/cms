@extends('emails.master')

@section('content')
<p>Hola: <strong>{{ $name }}</strong></p>
<p>Este es un correo electronico que le ayudara a restablecer la contraseña en nuestra plataforma.</p>

<p>Para continuar haga click en el siguiente boton e ingrese el siguiente codigo: <h2>{{ $code }}</h2></p>

<p><a href="{{ url('/recover/reset?email='.$email) }}" style="display: inline-block; background-color: #2caaff; color: #fff; padding: 8px; border-radius: 4px; text-decoration: none;">Resetear mi contraseña</a></p>

<p>Si el boton anterior no le funcione, copie y pegue la siguiente url en su navegador:</p>
<p>{{ url('/recover/reset?email='.$email) }}</p>
@endsection