<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\SignupRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function signupForm() // Función para mostrar el formulario de registro
    {
        if(Auth::check()){ // En caso de que el usuario ya este logueado redirige a su cuenta
            return view('auth.login');
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
        $user->save();

        Auth:: Login($user);

        return view('auth.login');
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

        $credentials=[
            'name' => Auth::user()->name,
            'password' => $request->get('password'),
        ];

        if(Auth::guard('web')->attempt($credentials)){

            $user->birthday = $request->get('birthday');
            if ($request->filled('newpassword')) {
                $user->password = Hash::make($request->get('newpassword'));
            }
            $user->save();
            return view('users.edited');

        } else{
            $error = 'La contraseña es incorrecta, intentalo de nuevo';
            return view('users.edit', compact('user','error'));
        }
    }
}
