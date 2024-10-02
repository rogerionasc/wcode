<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with(['permissions' => function ($query) {
            $query->orderBy('category'); // Ordenar permissões por 'category'
        }])->get();

        return response()->json($roles);
    }

}
