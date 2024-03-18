<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Admin/Login/Index');
    }

    public function auth(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (auth()->attempt([
            'password' => $request->password,
            'email' => $request->email,
        ])) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        } else {
            return Inertia::render('Welcome', [
                'failed' => "Senha ou email incorretos"
            ]);
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

