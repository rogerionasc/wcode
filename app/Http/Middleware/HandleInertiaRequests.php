<?php

namespace App\Http\Middleware;

use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Tighten\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        // dd($request->user()->document);
        $permissionController = new PermissionController();
        return array_merge(parent::share($request), [
            'auth' => function () use ($request) {
                return [
                    'user' => $request->user() ? [
//                      'logo' => Auth::user()->photo_path ? URL::route('image', ['path' => Auth::user()->photo_path]) : asset('assets/images/default_user.png'),
                        'id' => $request->user()->id,
                        'first_name' => $request->user()->first_name,
                        'last_name' => $request->user()->last_name,
                        'status' => $request->user()->account->status,
                        'email' => $request->user()->email,
                        'document' => $request->user()->document,
                        'birth_date' => $request->user()->birth_date,
                        'owner' => $request->user()->account->owner,
                        'role' => $request->user()->role,
                        // 'path' => $request->user()->role === 'Administrador' ? '/admin/' : '/',
                        'path' => in_array($request->user()->role, ['Administrador', 'Gerente']) ? '/admin/' : '/',
                        'permissions' => PermissionController::getPermissionsByCategory(),

                    ] : null,
                ];
            },
            'flash' => function () use ($request) {
                return [
                    'success' => $request->session()->get('success'),
                    'error' => $request->session()->get('error'),
                    'info' => $request->session()->get('info'),
                    'warning' => $request->session()->get('warning'),

                ];
            },
        ]);
    }
}
