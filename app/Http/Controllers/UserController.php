<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Address;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
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
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $permissions = Permission::all()->groupBy('category');
        // $subperm = $permissions['users']->first()->category;
        // dd($subperm);
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
        try {
            $user = Auth::user();

            // Certifique-se de que o usuário possui a permissão antes de atribuí-la
            if ($user->hasAnyRole(['Administrador', 'Gerente']) || $user->hasDirectPermission('create user')) {

                if ($request->has('birth_date') && !empty($request->birth_date)) {
                    $birthDate = Carbon::parse($request->birth_date)->format('Y-m-d');
                    $request->merge(['birth_date' => $birthDate]);
                }

                $validator = Validator::make($request->all(), [
                    'first_name' => 'required|alpha|max:255',
                    'last_name' => 'required|string|max:255',
                    'document' => ['required', 'min:11', 'max:14', new ValidatorDocument, 'unique:users'],
                    'email' => ['required', 'max:255', new ValidatorEmail, 'unique:users'],
                    'password' => 'required|string|min:6',
                    'confirmPassword' => 'required|same:password',
                    'birth_date' => 'required|date_format:Y-m-d',
                    'status' => 'required|alpha'
                ], $this->customMessages(), $this->fieldAliases());

                if ($validator->fails()) {
                    session()->forget('update');
                    return Redirect::back()
                        ->withErrors($validator, 'created')
                        ->withInput();
                }

                $user = User::create([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'document' => $request->document,
                    'birth_date' => $birthDate,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);

                $role = Role::findByName('Membro');
                $role->givePermissionTo('update user');
                $user->assignRole('Membro');

                // $user->syncRoles('Membro');

                $role = $user->getRoleNames()->first();
                $user->role = $role;
                
                $user->save();

                if (!$user) {
                    throw new \Exception('Erro ao criar usuário.');
                }

                $address = Address::create(['user_id' => $user->id]);

                $account = Account::create([
                    'user_id' => $user->id,
                    'status' => $request->status,
                ]);

                if (!$account) {
                    throw new \Exception('Erro ao criar conta.');
                }

                return Redirect::route('admin.user')->with('success', 'Usuário criado com sucesso!');
            }

            return Redirect::route('home')->with('error', 'Você não tem permissão para criar um usuário.');

        } catch (ValidationException $e) {
            return Redirect::route('admin.user')->with('error', 'Não foi possível cadastrar o usuário!');
        } catch (\Exception $e) {
            return Redirect::route('admin.user')->with('error', 'Erro ao criar o usuário.' . $e->getMessage());
        }
    }

    public function getRole(Request $request)
    {
        $user = Auth::user();
        
        return response()->json($user->getAllPermissions()->pluck('name'));
        // return $user->title_role;
    }

    public function getAllUsers()
    {
        $users = DB::table('users')
            ->join('accounts', 'users.id', '=', 'accounts.user_id')
            ->select('users.*', 'accounts.status')
            ->orderBy('users.created_at', 'asc')
            ->get();

        foreach ($users as $user) {
            unset($user->password);
            unset($user->remember_token);
            if (!empty($request->birth_date)) {
                $birthDate = Carbon::createFromFormat('Y-m-d', $user->birth_date)->format('d/m/Y');
                $user->merge(['birth_date' => $birthDate]);
            }
            $address = DB::table('addresses')->where('user_id', $user->id)->first();
            $user->address = $address ? (array) $address : [];
            $user->permissions = PermissionController::getPermissionsByCategoryForUser($user->id);
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
    public function update(Request $request, string $id): RedirectResponse
    {
        try {
            $userAuth = Auth::user();

            // dd($user->getPermissionsViaRoles()->first());

            if ($userAuth->hasAnyRole(['Administrador', 'Gerente']) || $userAuth->hasPermissionTo('update user')) {
                
                if ($request->has('birth_date') && !empty($request->birth_date)) {
                    $birthDate = Carbon::parse($request->birth_date)->format('Y-m-d');
                    $request->merge(['birth_date' => $birthDate]);
                }

                $user = User::find($id);
                if (!$user) {
                    return Redirect::back()->with('error', 'Usuário não existe.');
                }

                $validator = Validator::make($request->all(), [
                    'first_name' => 'required|alpha|max:255',
                    'last_name' => 'required|string|max:255',
                    'document' => ['required', 'min:11', 'max:14', new ValidatorDocument, 'unique:users,document,' . strval($user->id)],
                    'email' => ['required', 'max:255', new ValidatorEmail, 'unique:users,email,' . strval($user->id)],
                    // 'password' => 'string|min:6',
                    'birth_date' => 'required|date_format:Y-m-d',
                    'status' => 'required|alpha'
                ], $this->customMessages(), $this->fieldAliases());

                $password = $request->input('password');

                $updateData = [
                    'first_name' => $request->input('first_name'),
                    'last_name' => $request->input('last_name'),
                    'email' => $request->input('email'),
                    'document' => $request->input('document'),
                    'birth_date' => $birthDate,
                    'role' => $request->input('role'),
                ];

                $user->syncRoles($request->input('role'));

                if (!$userAuth->hasAnyRole(['Administrador', 'Gerente'])) {
                    // dd($userAuth->hasAnyRole(['Administrador',]));
                    unset($updateData['document'], $updateData['email'], $updateData['role']);
                }
                
                if (!is_null($password) || !empty($password)) {
 
                    $validator = Validator::make($request->all(), [
                        'password' => 'string|min:6',
                    ], $this->customMessages(), $this->fieldAliases());

                    $updateData['password'] = Hash::make($password);
                }
                
                if ($validator->fails()) {

                    return Redirect::back()
                        ->withErrors($validator, 'update')
                        ->withInput()
                        ->with('userUpdate_id', $user->id);
                }

                $user->update($updateData);

                $account = Account::find($id);
                if ($account) {
                    $account->update([
                        'status' => $request->status,
                    ]);
                }

                return Redirect::back()->with('success', 'Cadastro de usuário atualizado.');
        }
        return Redirect::route('home')->with('error', 'Você não tem permissão para atualizar usuário.');
        } catch (\Exception $e) {
            if (!$userAuth->hasAnyRole(['Administrador', 'Gerente'])) {
                return Redirect::route('home')->with('error', 'Ocorreu um erro ao atualizar o usuário. Tente novamente.' . $e->getMessage());
            }
            return Redirect::route('admin.user')->with('error', 'Ocorreu um erro ao atualizar o usuário. Tente novamente.' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        try {
            $authenticatedUserId = auth()->id();

            // Verifica se o ID do usuário autenticado é o mesmo que o ID a ser excluído
            if ($authenticatedUserId == $id) {
                return redirect()->back()->with('error', 'Você não pode excluir a si mesmo.');
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

    protected function customMessages()
    {
        return [
            'alpha' => 'É permitido apenas letras',
            'required' => 'O campo é obrigatório.',
            'unique' => 'Este campo já está em uso.',
            'min' => 'O campo deve ter pelo menos :min caracteres.',
            'max' => 'O campo deve ter no máximo :max caracteres.',
            'same' => 'Os campos devem ser iguais.',
            'date_format' => 'Formato de data inválido. O formato esperado é Y-m-d.',
            'email' => 'O campo deve ser um endereço de e-mail válido.',
        ];
    }

    protected function fieldAliases()
    {
        return [
            'first_name' => 'Nome',
            'last_name' => 'Sobrenome',
            'document' => 'Documento',
            'email' => 'E-mail',
            'birth_date' => 'Data de nascimento',
            'password' => 'Senha',
            'confirmPassword' => 'Confirmação de senha',
            'status' => 'Status',
        ];
    }
}
