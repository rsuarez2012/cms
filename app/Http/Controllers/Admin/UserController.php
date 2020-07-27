<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('userstatus');
        $this->middleware('permissions');
        $this->middleware('isadmin');
    }
    public function getUsers($status)
    {
        if ($status == 'all') {
            # code...
            $users = User::orderBy('id', 'Desc')->paginate(25);

        }else{
            $users = User::where('status', $status)->orderBy('id', 'Desc')->paginate(25);

        }
        $data = ['users' => $users];
        return view('admin.users.index', $data);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->role = $request->user_type;
        if($request->user_type == '1'):
            if(is_null($user->permissions)):
                $permissions = [
                    'dashboard' => true
                ];
                $permissions = json_encode($permissions);
                //return $permissions;
                $user->permissions = $permissions;
            endif;
        else:
            $user->permissions = null;
        endif;
        if($user->save()):
            if($request->user_type == '1'):
                return redirect('/admin/user/'.$user->id.'/permissions')->with('message', 'Usuario editado con exito.!')->with('typealert', 'success');
            else:
                return back()->with('message', 'Usuario editado con exito.!')->with('typealert', 'success');
            endif;
        endif;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function banned($id)
    {
        $user = User::findOrFail($id);
        if($user->status == "100"):
            $user->status = "0";
            $msg = "Usuario activado.!";
        else:
            $user->status = "100";
            $msg = "Usuario suspendido.!";

        endif;
        if($user->save()):
            return back()->with('message', $msg)->with('typealert', 'success');
        endif;
    }

    public function getUserPermissions($id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.permissions', compact('user'));
    }

    public function postUserPermissions(Request $request, $id)
    {
        //dd(json_encode($request->except(['_token'])));
        //se comenta la variable permissions por la optimizacion de codigo pero lo dejo como ejemplo para futuras cosas
        /*$permissions = [
            'dashboard' => $request->dashboard,
            //permisos a productos
            'products_list' => $request->products_list,
            'product_new' => $request->product_new,
            'product_edit' => $request->product_edit,
            'product_delete' => $request->product_delete,
            'add_image_gallery' => $request->add_image_gallery,
            'delete_image_gallery' => $request->delete_image_gallery,
            'product_search' => $request->product_search,

            //permisos a categorias
            'categories_list' => $request->categories_list,
            'category_store' => $request->category_store,
            'category_edit' => $request->category_edit,
            'category_delete' => $request->category_delete,

            //permisos a usuarios
            'users_list' => $request->users_list,
            'user_edit' => $request->user_edit,
            'user_banned' => $request->user_banned,
            'user_permissions' => $request->user_permissions,
            'dashboard_small_stats' => $request->dashboard_small_stats,
            'dashboard_sell_today' => $request->dashboard_sell_today
        ];
        //convertir el arreglo en un json
        $permissions = json_encode($permissions);
        //return $permissions;
        $user->permissions = $permissions;*/
        $user = User::findOrFail($id);
        
        //$user->permissions = $request->except(['_token']);
        $user->permissions = json_encode($request->except(['_token']));
        if($user->save()):
            return back()->with('message', 'Permisos aactualizado con exito.!')->with('typealert', 'success');
        endif;
    }
}
