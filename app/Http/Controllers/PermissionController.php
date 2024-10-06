<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class PermissionController extends Controller
{
    //
    public static function fetchAllCategoryPermissions() {
        
        $categoryPermission = Permission::all()->groupBy('category');
        return response()->json([$categoryPermission]);
    }

    public static function getPermissionsByCategory() {
        
        $user = Auth::user();

        $categoryPermission = $user->getAllPermissions();

        return response()->json($categoryPermission);
    }

    public static function getPermissionsByCategoryForUser($userId) {

        $user = User::findOrFail($userId);

        $categoryPermission = $user->getAllPermissions();
    
        return response()->json($categoryPermission);
    }

    public function update(Request $request) {

        dd($request);
    }
}
