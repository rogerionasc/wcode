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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->auth($request);
//        dd($request);
//        $request->authenticate();
//        $request->session()->regenerate();
//        return redirect()->intended(RouteServiceProvider::HOME);

    }

    /**
     * Display the specified resource.
     */
    public function show(Login $login)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Login $login)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Login $login)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Login $login)
    {
        //
    }

    public function auth(Request $request) {
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if(auth()->attempt([
            'password' => $request->password,
            'email' => $request->email,
        ])) {
            $request->session()->regenerate();
//            return redirect()->route('admin/dashboard');
            return redirect()->route('admin.dashboard');
        }else {
            return Inertia::render('Welcome', [
                'failed' => "Essas credenciais não correspondem a nenhum dos nossos registros!"
            ]);
        }
    }

//    public function auth(Request $request)
//    {
//        dd($auth);
//        $this->validate($request, [
//            'email' => 'required|email',
//            'password' => 'required|min:5',
//        ]);
//
//        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
//            $request->session()->regenerate();
//            return Inertia::render('Admin/Login/Dashboard');
//        } else {
//            return Inertia::render('Welcome', [
//                'failed' => "Essas credenciais não correspondem a nenhum dos nossos registros!"
//            ]);
//        }
//    }

//    public function logout(Request $request) {
//        auth()->logout();
//        $request->session()->invalidate();
//        $request->session()->regenerateToken();
//        return redirect()->route('login');
//    }
}
