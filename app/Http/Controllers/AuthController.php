<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function store(Request $request)
    {
        //Validaciones
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]);

        //Si hay algún error de validación, enviar en formato JSON
        if ($validate->fails()) {
            return response()->json([
                "errors" => $validate->errors()
            ]);
        }

        //Generamos un valor hash para el campo password, desde el objeto $request
        $request->merge(['password' => Hash::make($request->password)]);


        // Si las validaciones son correctas, se da de alta el usuario
        $user = User::create($request->all());

        //Posteriormente, enviamos una respuesta, en formato JSON de la alta exitosa del usuario
        return response()->json([
            "status" => true,
            "message" => "Alta de usuario exitosa",
            "email" => $user->email
        ], 201);
    }


    public function login(Request $request)
    {
        //Validaciones
        $validate = Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required|string|min:8'
        ]);

        //Si hay algún error de validación, enviar en formato JSON
        if ($validate->fails()) {
            return response()->json([
                "errors" => $validate->errors()
            ]);
        }


        //Generamos una colección para comprobar si existe algún usuario registrado con los valores recibidos
        $user = User::where("email", "=", $request->email)->first();

        //Si se encuentra alguna coincidencia, entramos al if
        if ($user) {
            //Validamos que el password enviado, coincida con el del usuario en la base de datos
            if (Hash::check($request->password, $user->password)) {
                //Generamos el token para el usuario
                $token = $user->createToken('auth_token')->plainTextToken;

                //Devolvemos una respuesta con el token de autenticación para futuras peticiones
                return response()->json([
                    "status" => true,
                    "message" => "Usuario Logueado",
                    "auth_token" => $token
                ], 201);
                //Si el password no coincide, devolvemos una respuesta con un mensaje de error
            } else {
                return response()->json([
                    "status" => false,
                    "message" => "Password incorrecto",
                ], 404);
            }
        }
        //Si no se existe coincidencia con el nombre de usuario, devolvemos una respuesta con un mensaje de error
        else {
            return response()->json([
                "status" => false,
                "message" => "Usuario no registrado"
            ], 404);
        }

    }

    public function logout(Request $request)
    {
        //Generamos una colección para comprobar si existe algún usuario registrado con los valores recibidos
        $user = User::where("email", "=", $request->email)->first();

        //Eliminamos el token de autenticación generado para el usuario
        $user->tokens()->delete();

        //Enviamos una respuesta exitosa, en formato JSON
        return response()->json([
            "status" => true,
            "message" => "Sesión cerrada exitosamente"
        ], 201);
    }




}
