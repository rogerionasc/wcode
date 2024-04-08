<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Login/Index');
    }

    public function auth(Request $request)
    {
        try {
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]);

            if (auth()->attempt([
                'password' => $request->password,
                'email' => $request->email,
            ])) {
                if (auth()->user()->account->status === 'active') {
                    $request->session()->regenerate();
                    return Redirect::route('admin.dashboard')->with('success', 'Login realizado com sucesso!');
                } else {
                    auth()->logout(); // Desconectar usuário se a conta estiver inativa
                    session()->invalidate();
                    session()->regenerateToken();
                    return Redirect::route('login')->with('warning', 'Sua conta está inativa. Entre em contato com o suporte.');
                }
            } else {
                return Redirect::route('login')->with('error', 'Verifique sua senha e email.');
            }

        } catch (\Exception $exception) {
            return Redirect::route('login')->with('error', 'Error interno contate o administrador do sistema.');
        }
    }

    public function logout()
    {
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('login');
    }
}
