<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Image, Auth, Config, Str, Hash;
use App\User;
class UserController extends Controller
{
    public function __Construct()
    {
    	$this->middleware('auth');
    }

    public function getAccountEdit()
    {
    	$birthday = (is_null(Auth::user()->birthday)) ? [null,null,null] : explode('-', Auth::user()->birthday);
    	$data = [
    		'birthday' => $birthday
    	];
    	return view('users.account_edit', $data);
    }
    public function postAccountAvatar(Request $request)
    {
    	$rules = [
            'avatar' => 'required',
        ];
        $messages = [
            'avatar.required' => 'Se requiere una imagen de la galeria',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error.!')->with('typealert', 'danger')->withInput();
        else:
            if($request->hasFile('avatar')):
                //ruta a guardar las imagenes
                $path = '/'.Auth::id();
                //validar extesion de la imagen o extraer extension
                $fileExt = trim($request->file('avatar')->getClientOriginalExtension());
                //ruta absoluta donde guardar archivo
                $upload_path = Config::get('filesystems.disks.uploads_users.root');
                //$name = Str::slug(str_replace(search, replace, subject))
                $name = Str::slug(str_replace($fileExt, '', $request->file('avatar')->getClientOriginalName()));
                //nombre final para guardar la img
                $filename = rand(1,999).'_'.$name.'.'.$fileExt;
                //archivos miniaturas con intervention
                $final_file = $upload_path.'/'.$path.'/'.$filename;


                $user = User::find(Auth::id());
                $avatar_actual = $user->avatar;
                $user->avatar = $filename; 

                if($user->save()):
                    if($request->hasFile('avatar')){
                        $fl = $request->avatar->storeAs($path, $filename, 'uploads_users');
                        $img = Image::make($final_file);
                        $img->fit(256, 256, function($constraint){
                            $constraint->upsize();
                        });
                        $img->save($upload_path.'/'.$path.'/av_'.$filename);

                    }
                    //elimino el avatar anterior
                    unlink($upload_path.'/'.$path.'/'.$avatar_actual);
                    //elimino el avatar miniatura anterior
                    unlink($upload_path.'/'.$path.'/av_'.$avatar_actual);
                    return back()->with('message', 'Avatar actualizado con exito.!')->with('typealert', 'success');
                endif;
            endif;
        endif;
    }

    public function postAccountPassword(Request $request)
    {
    	$rules = [
            'actual_password' => 'required|min:8',
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:password',
        ];
        $messages = [
            'actual_password.required' => 'Escribe tu contraseña actual',
            'actual_password.min' => 'La contraseña actual Debe tener al menos 8 caracteres.',
            'password.required' => 'Escribe tu nueva contraseña',
            'password.min' => 'La nueva contraseña Debe tener al menos 8 caracteres.',
            'confirm_password.required' => 'Confirma tu nueva contraseña',
            'confirm_password.min' => 'La confirmacion de la nueva contraseña debe tener al menos 8 caracteres.',
            'confirm_password.same' => 'Las contraseñas no coinciden.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error.!')->with('typealert', 'danger')->withInput();
        else:
        	$user = User::find(Auth::id());
        	if(Hash::check($request->actual_password, $user->password)):
        		$user->password = Hash::make($request->actual_password);
        		if($user->save()):
        			return back()->with('message', 'La contraseña se actualizo con exito.!')->with('typealert', 'success');
        		endif;
        	else:
        		return back()->with('message', 'Su contraseña actual es erronea.!')->with('typealert', 'danger');
        	endif;
        endif;
    }

    public function postAccountInfo(Request $request)
    {
    	//dd($request->all());
    	$rules = [
            'name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'year' => 'required',
            'day' => 'required',
        ];
        $messages = [
            'name.required' => 'Su nombre es requerido.',
            'last_name.required' => 'Su apellido es requerido.',
            'phone.required' => 'Su numero telefonico es requerido.',
            'phone.min' => 'El numero telefonico debe tener al menos 8 digitos.',
            'year.required' => 'Su año de nacimiento es requerido',
            'day.required' => 'Su dia de nacimiento es requerido',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error.!')->with('typealert', 'danger')->withInput();
        else:
        	$date = $request->year.'-'.$request->month.'-'.$request->day;
        	$user = User::find(Auth::id());
        	$user->name = e($request->name);
        	$user->last_name = e($request->last_name);
        	$user->phone = e($request->phone);
        	$user->gender = e($request->gender);
        	$user->birthday = date('Y-m-d', strtotime($date));
        	if($user->save()):
    			return back()->with('message', 'Su informacion se actualizo con exito.!')->with('typealert', 'success');
    		endif;
        endif;
    }
}
