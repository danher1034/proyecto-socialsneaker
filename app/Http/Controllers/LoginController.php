<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SignupRequest;
use App\Http\Requests\UsereditRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function signupForm() // Función para mostrar el formulario de registro
    {
        if(Auth::check()){ // En caso de que el usuario ya este logueado redirige a su cuenta
            return view('users.account');
        }else{
            return view('auth.signup');
        }
    }

    public function signup (SignupRequest $request) // Crea el usuario en la base de datos
    {
        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->birthday=$request->get('birthday');
        $user->password = Hash:: make($request->get('password'));
        $user->image_user='';
        $user->save();

        Auth:: Login($user);

        return view('users.account');
    }

    public function loginform() // Muestra el formulario para iniciar sesión
    {
        if(Auth::check()){ // En caso de que el usuario ya este logueado redirige a su cuenta
            return view('users.account');
        }else{
            return view('auth.login');
        }
    }

    public function login(Request $request) // Comprueba que el usuario y contraseña introducidos en el formulario de login sean correctos
    {
        $credentials= $request->only('name','password');
        $remenberLogin= ($request->get('remember')) ? true: false;

        if(Auth::guard('web')->attempt($credentials, $remenberLogin)){
            $request->session()->regenerate();
            return view('users.account');
        } else{ // Si no son correctos dará error
            $error = 'La contraseña o el usuario son incorrectos o no existen, intentalo de nuevo';
            return view('auth.login', compact('error'));
        }
    }

    public function logout(Request $request) // Funcion para cerrar sesión
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return view('auth.login');
    }


    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UsereditRequest $request, User $user)
    {
        $credentials = [
            'name' => Auth::user()->name,
            'password' => $request->get('password'),
        ];

        // Verificar las credenciales del usuario antes de permitir la actualización
        if (Auth::guard('web')->attempt($credentials)) {
            // Actualizar los campos del usuario
            $user->birthday = $request->get('birthday');

            if ($request->filled('newpassword')) {
                $user->password = Hash::make($request->get('newpassword'));
            }

            // Procesar la imagen si se ha subido un archivo
            if ($request->hasFile('image_user')) {
                $image = $request->file('image_user');
                $extension = $image->getClientOriginalExtension();
                $filename = $user->id . '.' . $extension; // Nuevo nombre de archivo

                // Guardar la imagen en el sistema de archivos
                $path = $image->storeAs('public/img/user_images', $filename);

                // Actualizar la ruta de la imagen en el modelo User
                $user->image_user = '/storage/img/user_images/' . $filename;
            }

            // Guardar los cambios en el modelo User
            $user->save();

            // Redirigir a una vista de confirmación
            return view('users.edited');
        } else {
            // Mostrar un mensaje de error si las credenciales no son válidas
            $error = 'La contraseña es incorrecta, inténtalo de nuevo';
            return view('users.edit', compact('user', 'error'));
        }
    }
}
//https://www.youtube.com/watch?v=sGRC6cuSu8c
