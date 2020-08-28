<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Models\Category;
use App\Http\Models\Product;
use App\Http\Models\PGallery;
use Validator, Str, Config, Image;
class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('userstatus');
        $this->middleware('permissions');
        $this->middleware('isadmin');
    }
    public function getProducts($status)
    {
        //para optimizar las consultas usamos el metodo with(['y aqui adentro llamamos cada relacion que contenga el registro'])
        switch ($status) {
            case '0':
                # code...
                $products = Product::with(['cat'])->where('status', 0)->orderBy('id', 'Desc')->paginate(25);
                break;
            case '1':
                # code...
                $products = Product::with(['cat'])->where('status', 1)->orderBy('id', 'Desc')->paginate(25);
                break;
            case 'all':
                # code...
                $products = Product::with(['cat'])->orderBy('id', 'Desc')->paginate(25);
                break;
            case 'trash':
                # code...
                $products = Product::with(['cat'])->onlyTrashed()->orderBy('id', 'Desc')->paginate(25);
                break;
            
        }
        //$products = Product::with(['cat'])->orderBy('id', 'Desc')->paginate(25);
        $data = ['products' => $products];
        return view('admin.products.index', $data);
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
        $categories = Category::where('module', '0')->pluck('name', 'id');
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required',
            'image' => 'required|image',
            'price' => 'required',
            'content' => 'required',
        ];
        $messages = [
            'title.required' => 'Se requiere del nombre del Producto',
            'image.required' => 'Seleccione una imagen destacada',
            'image.image' => 'El archivo no es una imagen seleccionada',
            'price.required' => 'Se requiere del precio del Producto',
            'content.required' => 'Se requiere una descripción del Producto',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error.!')->with('typealert', 'danger')->withInput();
        else:
            //ruta a guardar las imagenes
            $path = '/'.date('Y-m-d');
            //validar extesion de la imagen o extraer extension
            $fileExt = trim($request->file('image')->getClientOriginalExtension());
            //ruta absoluta donde guardar archivo
            $upload_path = Config::get('filesystems.disks.uploads.root');
            //$name = Str::slug(str_replace(search, replace, subject))
            $name = Str::slug(str_replace($fileExt, '', $request->file('image')->getClientOriginalName()));
            //nombre final para guardar la img
            $filename = rand(1,999).'-'.$name.'.'.$fileExt;
            //archivos miniaturas con intervention
            $final_file = $upload_path.'/'.$path.'/'.$filename;

            //return $final_file;
            $product = new Product;
            $product->title = e($request->title);
            $product->status = '0';
            $product->code = e($request->code);
            $product->slug = Str::slug($request->title);
            $product->category_id = $request->category;
            $product->file_path = date('Y-m-d');
            $product->image = $filename;
            $product->inventory = e($request->inventory);
            $product->price = $request->price;
            $product->in_discount = $request->in_discount;
            $product->discount = $request->discount;
            $product->content = e($request->content);
            if($product->save()):
                if($request->hasFile('image')){
                    $fl = $request->image->storeAs($path, $filename, 'uploads');
                    $img = Image::make($final_file);
                    $img->fit(256, 256, function($constraint){
                        $constraint->upsize();
                    });
                    $img->save($upload_path.'/'.$path.'/t_'.$filename);

                }
                return redirect('/admin/products/1')->with('message', 'Producto registrado con exito.!')->with('typealert', 'success');
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
        $categories = Category::where('module', '0')->pluck('name', 'id');
        $product = Product::find($id);
        return view('admin.products.edit', compact('product', 'categories'));
        
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
            'title' => 'required',
            //'image' => 'required|image',
            'price' => 'required',
            'content' => 'required',
        ];
        $messages = [
            'title.required' => 'Se requiere del nombre del Producto',
            //'image.required' => 'Seleccione una imagen destacada',
            //'image.image' => 'El archivo no es una imagen seleccionada',
            'price.required' => 'Se requiere del precio del Producto',
            'content.required' => 'Se requiere una descripción del Producto',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error.!')->with('typealert', 'danger')->withInput();
        else:
            
            //return $final_file;
            $product = Product::findOrFail($id);
            $image_prev_path = $product->file_path;
            $image_prev = $product->image;
            $product->title = e($request->title);
            $product->status = $request->status;
            $product->code = e($request->code);
            //$product->slug = Str::slug($request->title);
            $product->category_id = $request->category;
            if($request->hasFile('image')):
                //ruta a guardar las imagenes
                $path = '/'.date('Y-m-d');
                //validar extesion de la imagen o extraer extension
                $fileExt = trim($request->file('image')->getClientOriginalExtension());
                //ruta absoluta donde guardar archivo
                $upload_path = Config::get('filesystems.disks.uploads.root');
                //$name = Str::slug(str_replace(search, replace, subject))
                $name = Str::slug(str_replace($fileExt, '', $request->file('image')->getClientOriginalName()));
                //nombre final para guardar la img
                $filename = rand(1,999).'-'.$name.'.'.$fileExt;
                //archivos miniaturas con intervention
                $final_file = $upload_path.'/'.$path.'/'.$filename;



                $product->file_path = date('Y-m-d');
                $product->image = $filename;
            endif;
            $product->price = $request->price;
            $product->inventory = e($request->inventory);
            $product->in_discount = $request->in_discount;
            $product->discount = $request->discount;
            $product->content = e($request->content);
            if($product->save()):
                if($request->hasFile('image')){
                    $fl = $request->image->storeAs($path, $filename, 'uploads');
                    $img = Image::make($final_file);
                    $img->fit(256, 256, function($constraint){
                        $constraint->upsize();
                    });
                    $img->save($upload_path.'/'.$path.'/t_'.$filename);

                    //eliminar las antiguas img del sistema de archivos
                    unlink($upload_path.'/'.$image_prev_path.'/'.$image_prev);
                    unlink($upload_path.'/'.$image_prev_path.'/t_'.$image_prev);

                }
                return back()->with('message', 'Producto actualizado con exito.!')->with('typealert', 'success');
            endif;
        endif;
    }


    public function productGallery(Request $request, $id)
    {
        $rules = [
            'file_image' => 'required',
        ];
        $messages = [
            'file_image.required' => 'Se requiere una imagen de la galeria',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Se ha producido un error.!')->with('typealert', 'danger')->withInput();
        else:
            if($request->hasFile('file_image')):
                //ruta a guardar las imagenes
                $path = '/'.date('Y-m-d');
                //validar extesion de la imagen o extraer extension
                $fileExt = trim($request->file('file_image')->getClientOriginalExtension());
                //ruta absoluta donde guardar archivo
                $upload_path = Config::get('filesystems.disks.uploads.root');
                //$name = Str::slug(str_replace(search, replace, subject))
                $name = Str::slug(str_replace($fileExt, '', $request->file('file_image')->getClientOriginalName()));
                //nombre final para guardar la img
                $filename = rand(1,999).'-'.$name.'.'.$fileExt;
                //archivos miniaturas con intervention
                $final_file = $upload_path.'/'.$path.'/'.$filename;



                
                $g = new PGallery;
                $g->product_id = $id;
                $g->file_path = date('Y-m-d');
                $g->file_name = $filename;
                if($g->save()):
                    if($request->hasFile('file_image')){
                        $fl = $request->file_image->storeAs($path, $filename, 'uploads');
                        $img = Image::make($final_file);
                        $img->fit(256, 256, function($constraint){
                            $constraint->upsize();
                        });
                        $img->save($upload_path.'/'.$path.'/t_'.$filename);

                    }
                    return back()->with('message', 'Imagen Subida con exito.!')->with('typealert', 'success');
                endif;
            endif;
        endif;
        
    }

    //eliminar imagen de la galeria
    public function productGalleryDelete($id, $gid)
    {
        $g = PGallery::findOrFail($gid);
        $path = $g->file_path;
        $file = $g->file_name;
        $upload_path = Config::get('filesystems.disks.uploads.root');

        if($g->product_id != $id){

            return back()->with('message', 'La Imagen no se puede eliminar.')->with('typealert', 'danger');
        }else{
            if($g->delete()):
                //unlink($upload_path.'/'.$path.'/'.$file);//ojo esto elimina de raiz y tenemos uso de softDeletes
                //unlink($upload_path.'/'.$path.'/t_'.$file);//ojo esto elimina de raiz y tenemos uso de softDeletes
                return back()->with('message', 'La Imagen eliminada con exito.!')->with('typealert', 'success');
            endif;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if($product->delete()):
            return back()->with('message', 'Producto enviado a la papelera.!')->with('typealert', 'success');
        endif;
    }

    public function restore($id)
    {
        $product = Product::onlyTrashed()->where('id', $id)->first();
        if($product->restore()):
            return redirect('/admin/product/'.$product->id.'/edit')->with('message', 'Producto restaurado con exito.!')->with('typealert', 'success');
        endif;
    }

    public function postProductSearch(Request $request)
    {
        //return "hola";
        $rules = [
            'search' => 'required',
        ];
        $messages = [
            'search.required' => 'El campo de busqueda es requerido.!'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return redirect('/admin/products/1')->withErrors($validator)->with('message', 'Se ha producido un error.!')->with('typealert', 'danger')->withInput();
        else:
            switch ($request->filter) {
                case '0':
                    # code...
                    $products = Product::with(['cat'])->where('title', 'LIKE', '%'.$request->search.'%')->where('status', $request->search)->orderBy('id', 'Desc')->get();
                    break;
                case '1':
                    # code...
                    $products = Product::with(['cat'])->where('code', $request->search)->orderBy('id', 'Desc')->get();
                    break;
            }
            return view('admin.products.search', compact('products'));

        endif;
    }
}
