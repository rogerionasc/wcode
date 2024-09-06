<?php

namespace App\Http\Controllers;
use App\Models\Role;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        // Obtém todos os papéis
        $roles = Role::all();
        return response()->json($roles);
    }
}
