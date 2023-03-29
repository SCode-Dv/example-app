<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    public function index(Request $request) {

        // CONSULTAS MEDIANTE ORM ELOQUENT //

        // $productos = Producto::where('existencia', '>', 10)->get(); //mayor a
        // $productos = Producto::where('existencia', '<', 10)->get(); // menor a
        // $productos = Producto::where('activo', '=', 1)->get(); // si es igual a
        // $productos = Producto::where('descripcion', 'LIKE', "%Pepsi%")->get(); // que contenga la palabra
        /* Que se encuentre entre X y Y */
        //$productos = Producto::where('existencia', '>', 10)->where('existencia', '<=', 50)->get(); 
        //$productos = Producto::whereBetween('existencia', [0, 2])->get();
        //$productos = Producto::whereIn('existencia', [2, 20, 50])->get();
        //$productos = Producto::whereDate('created_at', '2023-03-20')->get();
        //$productos = Producto::whereColumn('updated_at', '>', 'created_at')->get();
        //$productos = Producto::select(['id', 'codigo', 'descripcion', 'precio', 'existencia'])->where('activo', '1')->orderByDesc('descripcion')->get();


        //$productos = Producto::where([['existencia', '>', 10], ['existencia', '<=', 20]])->get(); // sentencia AND
        //$productos = Producto::where('existencia', '=', 10 )->orWhere('precio', '<', 15)->get(); // sentencia OR
        
        
        // selecciona todo lo que contiene la tabla productos
        //$productos = Producto::all();
        
        $productos = Categoria::find(1)->productos()->get();

        return view('productos.index', ['lista' => $productos]);
    }

    public function show($nombre) {
        return view('productos.show', ['producto' => $nombre]);
    }

    public function create() {
        return view('productos.create');
    }

    public function store(Request $request) {
        // validación de datos

        // 'codigo' => 'required' es para no acpetar valores vacíos
        // unique:tabla, es para saber si un campo ya existe en la tabla
        // max:5, restriccion de numero de caracteres
        $validacion = $request->validate([
            'codigo' => 'required|unique:productos',
            'nombre' => 'required',
            'precio' => 'required'
        ]);

        // crear una instancia del modelo Producto en Appp/Models/Producto.php
        $producto = new Producto();
        // mediante el nombre del objeto aignamos en cada campo de la tabla el valor según corresponda
        $producto->codigo = $request->input('codigo');
        // para valores de inputs en una vista, específicamos mediante el name o id del input el valor que almacenará
        $producto->descripcion = $request->input('nombre');
        $producto->precio = $request->input('precio');
        $producto->existencia = 0;
        $producto->categoria_id = 1;
        $producto->activo = 1;
        // con save() guardamos la información en la tabla
        $producto->save();

        return("Registro Guardado");
    }

    public function edit($id) {

        $producto = Producto::find($id); // WHERE id=$id

        return view('productos.edit', ['id' => $id, 'producto' => $producto]);
    }

    public function update(Request $request, $id) {

        $validacion = $request->validate([
            'codigo' => 'required|unique:productos',
            'nombre' => 'required',
            'precio' => 'required'
        ]);

        // creamos un objeto especifiando qué debe encontrar en base al ID
        $producto = Producto::find($id);
        // asiganmos los valores en los campos correspondiente
        $producto->descripcion = $request->input('nombre');
        $producto->precio = $request->input('precio');
        // guardamos
        $producto->save();

        return "Registro actualizado";
        
    }

    public function destroy($id) {
        $producto = Producto::find($id);
        $producto->delete();
        echo "Registro $id eliminado";
    }
}
