<?php

namespace App\Http\Controllers;

use App\Models\Submenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubmenuController extends Controller
{

    public function index()
    {
        //Enviamos una respuesta de todos los submenus registrados, en formato JSON
        return response()->json([
            "status" => true,
            "submenus" => Submenu::all()
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

    public function show($submenu)
    {
        //Validamos el formato del id del submenu
        $validateid = Validator::make(['id' => $submenu], [
            'id' => 'required|numeric|integer|exists:products,id'
        ]);


        //Si hubo algún error de validación enviamos un respuesta, en formato JSON
        if ($validateid->fails()) {
            return response()->json([
                "errors" => $validateid->errors()
            ]);
        }

        //Buscamos el submenu mediante el id y generamos una colección
        $submenu = Submenu::find($submenu);

        //Si se obtuvo la información del submenu, enviamos una respuesta, en formato JSON
        return response()->json([
            "status" => true,
            "message" => "Datos encontrados con exito",
            "product" => $submenu
        ], 201);
    }

    public function showSubmenuByMenu($menu_id) {
        //Validamos el formato del id del menu
        $validateid = Validator::make(['menu_id' => $menu_id], [
            'menu_id' => 'required|integer|exists:submenus,menu_id'
        ]);


        //Si hubo algún error de validación enviamos un respuesta, en formato JSON
        if ($validateid->fails()) {
            return response()->json([
                "errors" => $validateid->errors()
            ]);
        }

        //Buscamos el submenu mediante el menu_id y generamos una colección
        $submenu = Submenu::where('menu_id', $menu_id)->get();

        //Si se obtuvo la información del submenu, enviamos una respuesta, en formato JSON
        return response()->json([
            "status" => true,
            "message" => "Datos encontrados con exito",
            "submenu" => $submenu
        ], 201);
    }

    public function edit(Submenu $submenu)
    {
        //
    }

   public function update(Request $request, Submenu $submenu)
    {
        //
    }

   public function destroy(Submenu $submenu)
    {
        //
    }
}
