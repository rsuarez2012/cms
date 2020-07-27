<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Hash, Auth, Mail, Str;
use App\User;
//controlador para el envio de emails
use App\Mail\UserSendRecover;
use App\Mail\UserSendNewPassword;
class ConnectController extends Controller
{
	public function __construct()
	{
		$this->middleware('guest')->except(['getLogout']);
	}
    public function getLogin()
    {
    	return view('connect.login');
    }
    public function postLogin(Request $request)
    {
    	$rules = [
    		'email' => 'required|email',
    		'password' => 'required|min:8',
    	];
    	$messages = [
    		'email.required' => 'Su email es requerido',
    		'email.email' => 'Su email es invalido',
    		'password.required' => 'Debe ingresar una contraseña',
    		'password.min' => 'La contraseña debe tener minimo 8 digitos',
    	];
    	$validator = Validator::make($request->all(), $rules, $messages);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('message', 'Se ha Producido un error')->with('typealert', 'danger');
    	else:
    		//instanciamos el modelo User para guardar
    		if(Auth::attempt(['email' => $request->email, 'password' => $request->password], true)):
    			if(Auth::user()->status == "100"):
	    			return redirect('/logout');
	    		else:
                    if(Auth::user()->role == '1'):
                        return redirect('/admin');
                    else:
    	    			return redirect('/');
                    endif;
	    		endif;
    		else:
    			return back()->with('message', 'Se ha Producido un error')->with('typealert', 'danger');
    		endif;
    	endif;
    }
    public function getRegister()
    {
    	return view('connect.register');
    }
    public function postRegister(Request $request)
    {
    	//reglas de validacion
    	$rules = [
    		'name' => 'required',
    		'last_name' => 'required',
    		'email' => 'required|email|unique:users,email',
    		'password' => 'required|min:8',
    		'confirm_password' => 'required|min:8|same:password',
    	];

    	$messages = [
    			'name.required' => 'Su nombre es requerido',
    			'last_name.required' => 'Su apellido es requerido',
    			'email.required' => 'Su email es requerido',
    			'email.email' => 'Su email es invalido',
    			'email.unique' => 'Email ya se encuentra registrado',
    			'password.required' => 'Debe ingresar una contraseña',
    			'password.min' => 'La contraseña debe tener minimo 8 digitos',
    			'confirm_password.required' => 'Debe confirmar la contraseña',
    			'confirm_password.min' => 'La confirmacion debe tener minimo 8 digitos',
    			'confirm_password.same' => 'Las contraseñas no coinciden',
    	];
    	$validator = Validator::make($request->all(), $rules, $messages);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('message', 'Se ha Producido un error')->with('typealert', 'danger');
    	else:
    		//instanciamos el modelo User para guardar
    		$user = new User;
    		//con e evitamos registro de codigo malintencionado
    		$user->name = e($request->input('name'));
    		$user->last_name = $request->last_name;
    		$user->email = $request->email;
    		$user->password = Hash::make($request->password);
    		if($user->save()){
    			return redirect('/login')->with('message', 'Registro exitoso.!')->with('typealert', 'success');
    		}
    	endif;
    }
    public function getLogout()
    {
    	$status = Auth::user()->status;
    	Auth::logout();
    	if($status == "100"):
    		return redirect('/login')->with('message', 'Su Usuario fue suspendido.!')->with('typealert', 'danger');
    	else:
	    	return redirect('/');
    	endif;
    }
    /*
    proceso paraenvio de email con guzzle
     */
    
    
    public function getRecover()
    {
		return view('connect.recover');
    }

    public function postRecover(Request $request)
    {
		$rules = [
    		'email' => 'required|email',
    	];

    	$messages = [
    			'email.required' => 'Su email es requerido',
    			'email.email' => 'Su email es invalido',
    	];
    	$validator = Validator::make($request->all(), $rules, $messages);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('message', 'Se ha Producido un error')->with('typealert', 'danger');
    	else:
			$user = User::where('email', $request->email)->count();
			if($user == "1"):
				$user = User::where('email', $request->email)->first();
				$code = rand(100000, 999999);
				$data = ['name' => $user->name, 'email' => $user->email, 'code' => $code];
				$u = User::find($user->id);
				$u->password_code = $code;
				if($u->save()):
				Mail::to($user->email)->send(new UserSendRecover($data));
				return redirect('/reset?email='.$user->email)->with('message', 'Ingrese el codigo que se envio por correo electronico.!')->with('typealert', 'danger');
				endif;
//				return view('emails.recover', $data);
			else:
				return back()->with('message', 'Este correo electronico no existe.!')->with('typealert', 'danger');
			endif;

    	endif;
    }

    public function getReset(Request $request)
    {
    	$data = ['email' => $request->get('email')];
    	return view('connect.reset', $data);
    }
    public function postReset(Request $request)
    {
    	$rules = [
    		'email' => 'required|email',
    		'code' => 'required',
    	];

    	$messages = [
    			'email.required' => 'Su email es requerido',
    			'email.email' => 'Su email es invalido',
    			'code.required' => 'El codigo de recuperacion es requerido',
    	];
    	$validator = Validator::make($request->all(), $rules, $messages);
    	if($validator->fails()):
    		return back()->withErrors($validator)->with('message', 'Se ha Producido un error')->with('typealert', 'danger');
    	else:
			$user = User::where('email', $request->email)->where('password_code', $request->code)->count();
			if($user = "1"):
				//dd($request->all());
				$user = User::where('email', $request->email)->where('password_code', $request->code)->first();	
				//dd($user);
				$new_password = Str::random(8);
				$user->password = Hash::make($new_password);
				//ahora limpio el campo password_code
				$user->password_code = null;
				if($user->save()):
					$data = ['name' => $user->name, 'password' => $new_password];
					Mail::to($user->email)->send(new UserSendNewPassword($data));
					return redirect('/login')->with('message', 'La contraseña fue restablecida con exito, le hemos enviado un correo electronico con su nueva contraseña para que pueda iniciar sesion.!')->with('typealert', 'success');
				endif;
			else:
				return back()->with('message', 'El correo electronico o el codigo de recuperacion son erroneos.!')->with('typealert', 'danger');
			endif;

    	endif;
    }
    
}
