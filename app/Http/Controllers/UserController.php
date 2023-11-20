<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function dataUser()
    {
        $user = User::all();
        return response()->json($user);
    }

    public function index()
    {
        // Obtener todos los usuarios
        $users = User::all();
        return response()->json($users);
    }

    public function show($id)
    {
        // Obtener un usuario por ID
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function store(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string',
            // Agrega más campos si es necesario
        ]);

        // Crear un nuevo usuario
        $user = User::create($request->all());

        return response()->json($user, 201);
    }

    public function update(Request $request, $id)
    {
        // Validar la solicitud
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'required|string',
            // Agrega más campos si es necesario
        ]);

        // Actualizar el usuario
        $user = User::findOrFail($id);
        $user->update($request->all());

        return response()->json($user, 200);
    }

    public function destroy($id)
    {
        // Eliminar el usuario
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(null, 204);
    }
}
