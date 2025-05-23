<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
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

    public function auth(Request $request): RedirectResponse
    {
        $messageEmailPwd = [];
        if (empty($request->email)) {
            $messageEmailPwd['msgemail'] = 'seu e-mail';
        }

        if (empty($request->password)) {
            $messageEmailPwd['password'] = 'sua senha';
        }

        if (empty($request->email) && empty($request->password)) {
            return Redirect::route('login')->with('error', 'Por favor informe ' . $messageEmailPwd['msgemail'] . ' e ' . $messageEmailPwd['password']);
        }

        if (empty($request->email)) {
            return Redirect::route('login')->with('error', 'Por favor informe ' . $messageEmailPwd['msgemail']);
        }

        if (empty($request->password)) {
            return Redirect::route('login')->with('error', 'Por favor informe ' . $messageEmailPwd['password']);
        }

        try {
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]);

            // Verificar se existe um token de sessão
            if ($request->hasSession()) {
                // Verificar se já existe uma sessão válida
                if (Auth::check()) {
                    return Redirect::route('admin.dashboard')->with('info', 'Você já está logado.');
                } else {
                    $this->logout();
                }
            }

            if (Auth::attempt([
                'email' => $request->email,
                'password' => $request->password,
            ])) {
                if (Auth::user()->account->status === 'active') {
                    $status = Auth::user()->account->status;

                    Session::regenerate();

                    // Atualiza o status na nova sessão
                    Session::put('status', $status);

                    // Verifica o papel do usuário
                    if (Auth::user()->role !== 'Administrador') {
                        return Redirect::route('home')->with('success', 'Login realizado com sucesso!');
                    }

                    return Redirect::route('admin.dashboard')->with('success', 'Login realizado com sucesso!');
                } else {
                    $this->logout(); // Desconectar usuário se a conta estiver inativa
                    Session::invalidate();
                    Session::regenerateToken();
                    return Redirect::route('login')->with('warning', 'Conta inativa. Contate o suporte.');
                }
            } else {
                return Redirect::route('login')->with('error', 'Verifique sua senha e email.');
            }
        } catch (\Exception $exception) {
            return Redirect::route('login')->with('error', 'Erro interno. Contate o suporte.');
        }
    }

    public function logout(): RedirectResponse
    {
        Auth::guard('web')->logout();
        Session::invalidate();
        Session::regenerateToken();

        return Redirect::route('login');
    }
}
