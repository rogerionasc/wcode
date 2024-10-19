<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;


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
        try {
            $role = Role::find($request->role_id);
            $permissionNames = collect($request->permissions)->pluck('name')->toArray();
            $role->syncPermissions($permissionNames);
            
            return Redirect::back()->with('success', 'Permissões atualizadas com sucesso.');
        } catch (\Exception $e) {
            // Registra o erro
            // \Log::error('Erro ao atualizar permissões: ' . $e->getMessage());
            
            // return response()->json(['error' => 'Erro ao atualizar permissões.'], 500);
            return  Redirect::back()->with('error', 'Erro ao atualizar permissões.')->withErrors(500);
        }
    }
}
