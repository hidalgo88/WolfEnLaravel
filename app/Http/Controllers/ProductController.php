<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Size;
use App\Brand;
use App\League;


class ProductController extends Controller
{

  public function agregar(Request $req){

    $this->validate( $req, [
          'name' => 'required|unique:products',
          'price' => 'required|numeric:products',
          'description' => 'required:products',
          'brand_id' => 'required:products',
          'league_id' => 'required:products',
          'size_id' => 'required:products',
          'imgProduct' => 'nullable|image'
      ],
      [
          'name.required' => 'El campo Nombre es Obligatorio',
          'name.unique' => 'El producto ya existe',
          'price.required' => 'El campo Precio es Obligatorio',
          'price.numeric' => 'El campo Precio debe ser Numerico',
          'description.required' => 'El campo Descripcion es Obligatorio',
          'image' => 'Imagen invalida'
       ]);

    $productoNuevo= new Product();

    $productoNuevo->name = $req->input('name');
    $productoNuevo->description = $req->input('description');
    $productoNuevo->price = $req->input('price');
    $productoNuevo->brand_id = $req->input('brand_id');
    $productoNuevo->league_id = $req->input('league_id');
    $productoNuevo->size_id = $req->input('size_id');

    if($req->file('imgProduct')){
      //al archivo que subi lo voy a guardar en el filesystem de laravel
      $rutaDelArchivo = $req->file('imgProduct')->store('public');
      //le saco solo el nombre
      $nombreArchivo = basename($rutaDelArchivo);
      //guardo el nombre del archivo en el campo poster
      $productoNuevo->imgProduct = $nombreArchivo;
    }

    $productoNuevo->save();

    return redirect('/products')->with('mensaje', 'Producto creado exitosamente!');

  }

  public function agregarProducto(){

    $products = Product::all();
    $sizes = Size::all();
    $brands = Brand::all();
    $leagues = League::all();

    return view('agregarProducto')
    ->with([
      'products' => $products,
      'sizes' =>$sizes,
      'brands' =>$brands,
      'leagues' =>$leagues
    ]);

  }

  public function index(){
    // $products = Product::all();
    // dd($products);
    $leagues = League::all();

    if(isset($_GET['name'])){
      $products = Product::where('name', 'LIKE', '%'.$_GET['name'].'%')->get();
    } else{
      $products = Product::all();
    }

    $products = $products->sortByDesc('id');
    return view('products')
    ->with([
      'products' => $products,
      'leagues' =>$leagues,
    ]);
  }

  public function filterLeague($id){
    $leagues = League::all();
    $league = League::find($id);

    return view('filterLeague')
    ->with([
      'league'=>$league,
      'leagues' =>$leagues,
    ]);
  }

  public function edit($id)
  {
    $products = Product::find($id);
    $sizes = Size::all();
    $brands = Brand::all();
    $leagues = League::all();

    return view('edit')
    ->with([
      'products' => $products,
      'sizes' =>$sizes,
      'brands' =>$brands,
      'leagues' =>$leagues
    ]);
  }

  public function update($id, Request $request)
  {
    $this->validate($request,
      [
        'name'=> 'required',
        'price'=> 'required|numeric',
        'description'=> 'required',
        'imgProduct' => 'nullable|image'
      ],
      [
        'required' => 'Campo obligatorio',
        'numeric' => 'Debe ser un numero',
        'image' => 'Imagen invalida'
      ]
    );
      //dd($request->title);
      //me traigo a la pelicula usando el find
      $productoAEditar = Product::find($id);

      //le cambio los atributos o valores al objeto que me traje arriba
      $productoAEditar->name = $request->name;
      $productoAEditar->price = $request->price;
      $productoAEditar->description = $request->description;
      // $productoAEditar->sizes()->attach($request->size_id);
      $productoAEditar->size_id = $request->input('size_id');
      $productoAEditar->brand_id = $request->input('brand_id');
      $productoAEditar->league_id = $request->input('league_id');

      if($request->file('imgProduct')){
        //al archivo que subi lo voy a guardar en el filesystem de laravel
        $rutaDelArchivo = $request->file('imgProduct')->store('public');
        //le saco solo el nombre
        $nombreArchivo = basename($rutaDelArchivo);
        //guardo el nombre del archivo en el campo poster
        $productoAEditar->imgProduct = $nombreArchivo;
      }

      //lo mando a guardar
      $productoAEditar->save();

      return redirect('/products')
      ->with(
        'mensaje', 'Producto modificado exitosamente!'
      );
  }

  public function delete(Request $request)
  {
    $id = $request['id'];

    $productoAEliminar = Product::find($id);

    $productoAEliminar -> delete();

    return redirect('/products')
    ->with(
      'mensaje', 'Producto eliminadoi exitosamente!'
    );
  }

}
