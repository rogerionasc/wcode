<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Address;
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
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Log;


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
        $defaultBirthDate = '2010-01-01';

        // Verifica se a data de nascimento foi fornecida; se não, usa a data padrão
        $birthDate = $request->birth_date 
            ? Carbon::createFromFormat('d/m/Y', $request->birth_date)->format('Y-m-d') 
            : $defaultBirthDate;

        try {
            DB::beginTransaction();         

            $validator = Validator::make($request->all(), [
                'first_name' => 'required|alpha|max:255',
                'last_name'  => 'required|string|max:255',
                'document'   => ['required', 'min:11', 'max:14', new ValidatorDocument, 'unique:users'],
                'email'      => ['required', 'max:255', new ValidatorEmail, 'unique:users'],
                'password'   => 'required|string|min:6',
                'confirmPassword' => 'required|same:password',
                'birth_date' => 'required|date_format:d/m/Y',
                'status'     => 'required|alpha'
            ], $this->customMessages(), $this->fieldAliases());

            if ($validator->fails()) {
                return Redirect::back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error', 'Não foi possível cadastrar o usuário. Verifique os campos e tente novamente.');
            }
            

            // Criação de um novo usuário
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'document'   =>  $request->document,
                'birth_date' => $birthDate,
                'email'      => $request->email,
                'password'   => Hash::make($request->password),
            ]);

            if (!$user) {
                throw new \Exception('Erro ao criar usuário.');
            }

            $address = Address::create(['user_id' => $user->id]);

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
            return Redirect::route('admin.user')->with('error', 'Não foi possível cadastrar o usuário!');
        } catch (\Exception $e) {
            DB::rollBack();
            return Redirect::route('admin.user')->with('error', 'Erro ao criar o usuário.');
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
            unset($user->password);
            unset($user->remember_token);
            $address = DB::table('addresses')->where('user_id', $user->id)->first();
            $user->address = $address ? (array) $address : [];
            $user->title_role = $role ? $role->title : 'N/A'; // Define o atributo title_role diretamente
        }

        // dd($users);

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
        
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'document' => 'required|string|max:14',
            'birth_date' => 'required|date_format:Y-m-d',
            'status' => 'required|string',
            'title_role' => 'required|string',
        ], $this->customMessages(), $this->fieldAliases());

        // Se houver erros de validação
        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->with('error', 'Impossível atualizar. Verifique os campos e tente novamente.');
        }
        try {
            
            $user = User::find($id);
            if (!$user) {
                return Redirect::back()->with('error','Usuário não existe.');
            }

            $user->update([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'document' => $request->input('document'),
                'birth_date' => $request->input('birth_date'),
                'status' => $request->input('status'),
                'title_role' => $request->input('title_role'),
            ]);

            return Redirect::back()->with('success', 'Cadastro de usuário atualizado.');

        } catch (\Exception $e) {
            
            return Redirect::route('admin.user')
                ->with('error', 'Ocorreu um erro ao atualizar o usuário. Tente novamente.');
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
    protected function customMessages()
    {
        return [
            'required' => 'O campo é obrigatório.',
            'string'    => 'O campo deve ser palavras!',
            'max'      => 'O campo não pode ter mais de :max caracteres.',
            'unique'   => 'Este :attribute já está em uso.',
            'min'      => 'O campo deve ter :min caracteres.',
            'date_format' => 'O formato da data deve ser :format.',
            'same' => 'As senhas informadas devem coincidir.',
        ];
    }

    // Método para retornar aliases (nomes amigáveis) dos campos
    protected function fieldAliases()
    {
        return [
            'first_name' => 'nome',
            'last_name'  => 'sobrenome',
            'email'      => 'e-mail',
            'password'   => 'senha',
            'document'   => 'documento',
            'confirmPassword' => 'confirmação de senha',
        ];
    }
}
