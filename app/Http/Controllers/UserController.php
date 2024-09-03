<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Role;
use App\Models\User;
use App\Rules\ValidatorDocument;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use App\Rules\ValidatorEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->getAllUsers();
        return Inertia::render('Admin/User/Index', ['users' => $users]);
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
    public function store(Request $request): RedirectResponse
    {
        // dd($request->all());

        $customMessages = [
            'required' => 'O campo é obrigatório.',
            'string'    => 'O campo deve ser palavras!',
            'max'      => 'O campo não pode ter mais de :max caracteres.',
            'unique'   => 'Este :attribute já está em uso.',
            'min'      => 'O campo deve ter :min caracteres.',
            'date_format' => 'O formato da data deve ser :format.',
            'same' => 'As senhas informadas devem coincidir.',
        ];

        $aliases = [
            'first_name' => 'nome',
            'last_name'  => 'sobrenome',
            'email'      => 'e-mail',
            'password'   => 'senha',
            'document'   => 'documento',
            'confirmPassword' => 'confirmação de senha',
        ];

        try {
            DB::beginTransaction();

            // Validação dos dados do formulário
            $request->validate([
                'first_name' => 'required|alpha|max:255',
                'last_name'  => 'required|string|max:255',
                'document'   => ['required', 'min:11', 'max:14', 'unique:users', new ValidatorDocument], // 'unique' antes da regra personalizada
                'email'      => ['required', 'max:255', 'unique:users', new ValidatorEmail], // 'unique' antes da regra personalizada
                'password'   => 'required|string|min:6',
                'confirmPassword' => 'required|same:password',
                'birth_date' => 'required|date_format:d/m/Y',
                'status'     => 'required|alpha'
            ], $customMessages, $aliases);
            


            // dd([
            //     'first_name' => $request->first_name,
            //     'last_name'  => $request->last_name,
            //     'document'   => str_replace(['.', '-'], '', $request->document),
            //     'birth_date' => Carbon::createFromFormat('d/m/Y', $request->birth_date)->format('Y-m-d H:i:s'),
            //     'email'      => $request->email,
            //     'password'   => Hash::make($request->password),
            // ]);

            // Criação de um novo usuário
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                // 'document'   => str_replace(['.', '-'], '', $request->document),
                'document'   =>  $request->document,
                'birth_date' => Carbon::createFromFormat('d/m/Y', $request->birth_date)->format('Y-m-d'),
                'email'      => $request->email,
                'password'   => Hash::make($request->password),
            ]);

            if (!$user) {
                throw new \Exception('Erro ao criar usuário.');
            }

            $account = Account::create([
                'user_id' => $user->id,
                'status'  => $request->status,
            ]);

            if (!$account) {
                throw new \Exception('Erro ao criar conta.');
            }

            DB::commit();

            return Redirect::route('admin.user')->with('success', 'Usuário criado com sucesso!');
        } catch (ValidationException $e) {
            DB::rollBack();
            $errors = $e->errors();
            return Redirect::back()->withErrors($errors)->with('error', 'Não foi possível cadastrar o usuário!');
        } catch (\Exception $e) {
            DB::rollBack();
            return Redirect::back()->with('error', 'Erro ao criar o usuário.');
        }
    }

    public function getRole(Request $request) {
        $user = $request->user();
        $role = Role::where('tag_permission', $user->role)->first();
        $user->setAttribute('title_role', $role ? $role->title : 'N/A');

        return $user->title_role;
    }

    public function getAllUsers()
    {
        $users = DB::table('users')
            ->join('accounts', 'users.id', '=', 'accounts.user_id')
            ->select('users.*', 'accounts.status')
            ->orderBy('users.created_at', 'asc')
            ->get();

        foreach ($users as $user) {
            $role = Role::where('tag_permission', $user->role)->first();
            $user->title_role = $role ? $role->title : 'N/A'; // Define o atributo title_role diretamente
        }

        return $users;
    }

    public function fetchUsers()
    {
        $users = $this->getAllUsers();
        return response()->json($users);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteUser(string $id)
    {
        try {
            $authenticatedUserId = auth()->id();
        
            // Verifica se o ID do usuário autenticado é o mesmo que o ID a ser excluído
            if ($authenticatedUserId == $id) {
                return redirect()->back()->with('warning', 'Você não pode excluir a si mesmo.');
            }

            // Busca o usuário pelo ID
            $user = User::findOrFail($id);
    
            $user->delete();

            return redirect()->back()->with('success', 'Usuário excluído com sucesso.');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Usuário não encontrado.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao excluir o usuário.');
        }
    }
}
