<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Role;
use App\Models\User;
use App\Rules\ValidatorDocument;
use Composer\Json\JsonValidationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use App\Rules\ValidatorEmail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Admin/User/Index');
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

        $customMessages = [
            'required' => 'O campo é obrigatório.',
            'string'    => 'O campo deve ser palavras!',
            'max'      => 'O campo não pode ter mais de :max caracteres.',
            'unique'   => 'O valor do campo :attribute já está em uso.',
            'min'      => 'O campo deve ter :min caracteres.',
        ];

        $aliases = [
            'first_name' => 'nome',
            'last_name'  => 'sobrenome',
            'email'      => 'e-mail',
            'password'   => 'senha',
        ];

        try {
            DB::beginTransaction();
            // Validação dos dados do formulário
            $request->validate([
                'first_name' => 'required|alpha|max:255',
                'last_name'  => 'required|string|max:255',
                'document'   => ['string','min:11','max:14', new ValidatorDocument()],
                'email'      => ['required', 'max:255', new ValidatorEmail, 'unique:users'],
                'password'   => 'required|string|min:6',
                'status'     => 'required|alpha'
            ], $customMessages, $aliases);

            // Criação de um novo usuário
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'document'   =>  str_replace(['.', '-'], '', $request->document),
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
        }

    }

    public function getRole(Request $request) {
        $user = $request->user();
        $role = Role::where('tag_permission', $user->role)->first();
        $user->setAttribute('title_role', $role ? $role->title : 'N/A');

        return $user->title_role;
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
    public function destroy(string $id)
    {
        //
    }
}
