<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SignupRequest;
use App\Http\Requests\UsereditRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Collection;

class LoginController extends Controller
{
    /**
     * Muestra el formulario de registro si el usuario no está autenticado.
     *
     * @return \Illuminate\View\View
     */
    public function signupForm()
    {
        if (Auth::check()) {
            $collections = Collection::orderBy('created_at')->get();
            return view('users.account', compact('collections'));
        } else {
            return view('auth.signup');
        }
    }

    /**
     * Procesa el registro de un nuevo usuario.
     *
     * @param \App\Http\Requests\SignupRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function signup(SignupRequest $request)
    {
        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->birthday = $request->get('birthday');
        $user->password = Hash::make($request->get('password'));
        $user->image_user = '/storage/img/user_images/logo.png';
        $user->save();

        Auth::login($user);

        return redirect()->route('account');
    }

    /**
     * Muestra el formulario de inicio de sesión si el usuario no está autenticado.
     *
     * @return \Illuminate\View\View
     */
    public function loginForm()
    {
        if (Auth::check()) {
            $collections = Collection::orderBy('created_at')->get();
            return view('users.account', compact('collections'));
        } else {
            return view('auth.login');
        }
    }

    /**
     * Procesa el inicio de sesión del usuario.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function login(Request $request)
    {
        $credentials = $request->only('name', 'password');
        $rememberLogin = $request->get('remember') ? true : false;

        if (Auth::guard('web')->attempt($credentials, $rememberLogin)) {
            $request->session()->regenerate();

            return redirect()->route('account'); // Aquí es donde se corrige la redirección
        } else {
            $error = __('requests.passworderror.js');
            return view('auth.login', compact('error'));
        }
    }

    /**
     * Cierra la sesión del usuario y lo redirige a la página de inicio de sesión.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return view('auth.login');
    }

    /**
     * Muestra el formulario de edición del perfil del usuario si está autenticado.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit(User $user)
    {
        if (!request()->ajax()) {
            return redirect()->route('account')->withErrors(['error' => 'Acceso no permitido']);
        }

        return view('users.edit', compact('user')); // Asegúrate de que esta vista sea una vista parcial sin el layout completo
    }

    /**
     * Procesa la actualización del perfil del usuario.
     *
     * @param \App\Http\Requests\UsereditRequest $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UsereditRequest $request, User $user)
    {
        $credentials = [
            'name' => Auth::user()->name,
            'password' => $request->get('password'),
        ];

        if (Auth::guard('web')->attempt($credentials)) {
            $user->birthday = $request->get('birthday');

            if ($request->filled('newpassword')) {
                $user->password = Hash::make($request->get('newpassword'));
            }

            if ($request->hasFile('image_user')) {
                $image = $request->file('image_user');
                $extension = $image->getClientOriginalExtension();
                $filename = $user->id . '.' . $extension;

                $path = $image->storeAs('public/img/user_images', $filename);

                $user->image_user = '/storage/img/user_images/' . $filename;
            }

            $user->save();

            Session::flash('success_message', __('requests.accountedit.js'));
            return redirect()->route('account')->with('success', __('alert.all_good'));
        } else {
            Session::flash('success_message', __('requests.passwordnovalid.js'));
            return redirect()->route('account')->with('error', 'Error');
        }
        
    }

    /**
     * Elimina el usuario.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(User $user)
    {
        if (Auth::id() == $user->id) {
            if ($user->image_user !== '/storage/img/user_images/logo.png') {
                $imagePath = str_replace('/storage', 'public', $user->image_user);
                Storage::delete($imagePath);
            }
            Auth::logout();
            $user->delete();
            return redirect('/')->with('success_message', __('requests.delete.js'));
        } else {
            return redirect()->back()->with('error_message', __('requests.authorized.js'));
        }
    }
}


