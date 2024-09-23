<?php
namespace App\Http\Middleware;

use App\Models\Permission;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     * @param Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verifica se o usuário está autenticado
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'É necessário efetuar seu login!');
        }

        // Obtém o nome da rota solicitada e prefixo baseado na função do usuário
        // $requestedRouteName = $request->route()->getName();

        // $prefix = ($user->role === "admin") ? "admin." : "";

        // Verifica se o usuário não é admin e tenta acessar uma rota admin
        // if ($user->role !== "admin" && str_starts_with($requestedRouteName, 'admin.')) {

        //     return redirect()->route('home')->with('error', 'Você não tem permissão para acessar esta área.');
        // }

        // Obtém a permissão do usuário pelo seu papel
        // $permission = Permission::where('tag', $user->role)->first();

        // Verifica se a permissão existe e se o módulo é definido
        // if (!$permission || empty($permission->module)) {
        //     return redirect()->route($prefix . 'home')->with('error', 'Permissão não encontrada.');
        // }

        // Converte o módulo de permissões para array se necessário
        // $modules = is_array($permission->module) ? $permission->module : json_decode($permission->module, true);

        // Cria o array de resultado com o nome dos módulos e seu status
        // $moduleStatus = [];

        // foreach ($modules as $moduleName => $module) {
        //     if (is_array($module) && !empty($module)) {
        //         $allPermissionsFalse = true;

        //         foreach ($module as $key => $value) {
        //             if ($value !== false) {
        //                 $allPermissionsFalse = false;
        //                 break;
        //             }
        //         }

                // Define o status do módulo baseado nas permissões
        //         $moduleStatus[$moduleName] = !$allPermissionsFalse;
        //     }
        // }

        // Verifica o status das permissões dos módulos
        // foreach ($moduleStatus as $moduleName => $status) {
        //     if (!$status && str_starts_with($requestedRouteName, $prefix . $moduleName)) {
        //         return redirect()->route($prefix . 'home')->with('error', 'Você não tem permissão suficiente.');
        //     }
        // }

        return $next($request);
    }
}
