<?php

namespace App\Http\Controllers;

use App\Models\Submenu;
use Illuminate\Http\Request;

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

    public function show(Submenu $submenu)
    {
        //
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
