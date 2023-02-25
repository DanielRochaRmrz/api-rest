<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Enviamos una respuesta de todos los menus registrados, en formato JSON
        return response()->json([
            "status" => true,
            "menus" => Menu::all()
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

    public function show($menu)
    {
        //Validamos el formato del id del menu
        $validateid = Validator::make(['id' => $menu], [
            'id' => 'required|numeric|integer|exists:menus,id'
        ]);


        //Si hubo algún error de validación enviamos un respuesta, en formato JSON
        if ($validateid->fails()) {
            return response()->json([
                "errors" => $validateid->errors()
            ]);
        }

        //Buscamos el menu mediante el id y generamos una colección
        $menu = Menu::find($menu)->first();

        //Si se obtuvo la información del menu, enviamos una respuesta, en formato JSON
        return response()->json([
            "status" => true,
            "message" => "Datos encontrados con exito",
            "menu" => $menu
        ], 201);
    }

    public function showMenuByBranch($id_sucursal) {
        //Validamos el formato del id del la sucursal
        $validateid = Validator::make(['id_sucursal' => $id_sucursal], [
            'id_sucursal' => 'required|string|exists:menus,id_sucursal'
        ]);


        //Si hubo algún error de validación enviamos un respuesta, en formato JSON
        if ($validateid->fails()) {
            return response()->json([
                "errors" => $validateid->errors()
            ]);
        }

        //Buscamos el menu mediante el id_subcursal y generamos una colección
        $menu = Menu::where('id_sucursal', $id_sucursal)->get();

        //Si se obtuvo la información del menu, enviamos una respuesta, en formato JSON
        return response()->json([
            "status" => true,
            "message" => "Datos encontrados con exito",
            "menu" => $menu
        ], 201);
    }

    public function edit(Menu $menu)
    {
        //
    }

    public function update(Request $request, Menu $menu)
    {
        //
    }

    public function destroy(Menu $menu)
    {
        //
    }
}
