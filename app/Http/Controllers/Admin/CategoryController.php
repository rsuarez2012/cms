<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Validator, Str;

use App\Http\Controllers\Controller;
use App\User;
use App\Http\Models\Category;
class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'userstatus', 'permissions','isadmin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($module)
    {
        //$categories = Category::orderBy('id', 'Desc')->get();
        $categories = Category::where('module', $module)->orderBy('id', 'Asc')->get();
        return view('admin.categories.index', compact('categories'));
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
        //dd($request->all());
        //guardar categoria
        $rules = [
            'name' => 'required',
            'icon' => 'required'
        ];
        $messages = [
            'name.required' => 'Se requiere de un nombre de Categoria',
            'icon.required' => 'Se requiere de un icono para la Categoria'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error.!')->with('typealert', 'danger');
        else:
            $category = new Category;
            $category->module = $request->module;
            $category->name = e($request->name);
            $category->slug = Str::slug($request->name);
            $category->icono = e($request->icon);
            if($category->save()):
                return back()->with('message', 'La categoria fue registrada con exito.!')->with('typealert', 'success');
            endif;
        endif;
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
        $category = Category::find($id);
        return view('admin.categories.edit', compact('category'));
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
        $rules = [
            'name' => 'required',
            'icon' => 'required'
        ];
        $messages = [
            'name.required' => 'Se requiere de un nombre de Categoria',
            'icon.required' => 'Se requiere de un icono para la Categoria'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error.!')->with('typealert', 'danger');
        else:
            $category = Category::find($id);
            $category->module = $request->module;
            $category->name = e($request->name);
            //$category->slug = Str::slug($request->name);
            $category->icono = e($request->icon);
            if($category->save()):
                return back()->with('message', 'Categoria actualizada con exito.!')->with('typealert', 'success');
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
        $category = Category::find($id);
        if($category->delete()):
                return back()->with('message', 'Categoria Borrada con exito.!')->with('typealert', 'success');
            endif;
    }
}
