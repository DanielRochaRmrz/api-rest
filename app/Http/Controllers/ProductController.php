<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function index()
    {
       //Enviamos una respuesta de todos los productos registrados, en formato JSON
       return response()->json([
        "status" => true,
        "products" => Product::all()
    ], 201);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($product)
    {
        //Validamos el formato del id del producto
        $validateid = Validator::make(['id' => $product], [
            'id' => 'required|numeric|integer|exists:products,id'
        ]);


        //Si hubo algún error de validación enviamos un respuesta, en formato JSON
        if ($validateid->fails()) {
            return response()->json([
                "errors" => $validateid->errors()
            ]);
        }

        //Buscamos el producto mediante el id y generamos una colección
        $product = Product::find($product);

        //Si se obtuvo la información del producto, enviamos una respuesta, en formato JSON
        return response()->json([
            "status" => true,
            "message" => "Datos encontrados con exito",
            "product" => $product
        ], 201);
    }

    public function showProductBySubmenu($submenu_id) {
        //Validamos el formato del id del submenu
        $validateid = Validator::make(['submenu_id' => $submenu_id], [
            'submenu_id' => 'required|integer|exists:products,submenu_id'
        ]);


        //Si hubo algún error de validación enviamos un respuesta, en formato JSON
        if ($validateid->fails()) {
            return response()->json([
                "errors" => $validateid->errors()
            ]);
        }

        //Buscamos el submenu mediante el submenu_id y generamos una colección
        $product = Product::where('submenu_id', $submenu_id)->get();

        //Si se obtuvo la información del submenu, enviamos una respuesta, en formato JSON
        return response()->json([
            "status" => true,
            "message" => "Datos encontrados con exito",
            "product" => $product
        ], 201);
    }

    public function edit(Product $product)
    {
        //
    }

    public function update(Request $request, Product $product)
    {
        //
    }

    public function destroy(Product $product)
    {
        //
    }
}
