<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class UserController extends Controller
{
    // Construtor para aplicar middleware nas funções
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->only(['listAllUsers', 'deleteUser']); // Somente administradores podem acessar essas rotas
    }

    public function listAllUsers() {
        // Verificar se o usuário logado é um administrador
        if (!Auth::user()->isAdmin()) {
            return redirect()->route('listAllPosts')
                             ->with('error', 'Você não tem permissão para ver a lista de usuários.');
        }
        
        $users = User::all();
        return view('users.listAllUsers', ['users' => $users]);
    }

    public function listUserById(Request $request, $uid) {
        // Verifica se o usuário logado pode ver o perfil (próprio ou admin)
        $user = User::where('id', $uid)->first();

        // Somente admin ou o próprio usuário pode ver o perfil
        if ($user && (Auth::user()->isAdmin() || Auth::user()->id == $user->id)) {
            return view('users.profile', ['user' => $user]);
        }

        return redirect()->route('listAllPosts')
                         ->with('error', 'Você não tem permissão para acessar este perfil.');
    }

    public function updateUser(Request $request, $uid) {
        $user = User::where('id', $uid)->first();
    
        // Verifica se o usuário logado pode editar o perfil
        if (Auth::user()->id != $user->id && !Auth::user()->isAdmin()) {
            return redirect()->route('listAllPosts')
                             ->with('error', 'Você não tem permissão para editar este usuário.');
        }
    
        // Atualiza o nome e o email
        $user->name = $request->name;
        $user->email = $request->email;
    
        // Atualiza a senha se fornecida
        if ($request->password != '') {
            $user->password = Hash::make($request->password);
        }
    
        // Verifica se o usuário enviou uma nova imagem de perfil
        if ($request->has('profile_image')) {
            // Valida a imagem enviada
            $request->validate([
                'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
    
            // Remove a imagem antiga, se existir
            if ($user->photo) {
                Storage::delete('public/' . $user->photo);
            }
    
            // Armazena a nova imagem
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
            $user->photo = $imagePath;
        }
    
        // Salva as alterações no banco
        $user->save();
    
        // Redireciona o usuário com uma mensagem de sucesso
        return redirect()->route('listUserById', [$user->id])
                         ->with('message', 'Usuário atualizado com sucesso!');
    }
    

    public function deleteUser(Request $request, $uid) {
        $user = User::where('id', $uid)->first();

        // Impedir que um administrador exclua o próprio usuário
        if (Auth::user()->id == $user->id) {
            return redirect()->route('listAllUsers')
                             ->with('error', 'Você não pode excluir sua própria conta.');
        }

        $user->delete();
        return redirect()->route('listAllUsers')
                         ->with('message', 'Usuário excluído com sucesso!');
    }

    public function suspendUser($id) {
        $user = User::findOrFail($id);
        
        // Somente admins podem suspender usuários
        if (!Auth::user()->isAdmin()) {
            return redirect()->route('listAllUsers')
                             ->with('error', 'Você não tem permissão para suspender usuários.');
        }

        $user->suspended = true;
        $user->save();

        return redirect()->route('listAllUsers')->with('status', 'Usuário suspenso com sucesso.');
    }

    public function registerUser(Request $request) {
        if ($request->method() === 'GET') {
            return view('users.create');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('listAllPosts')
                         ->with('success', 'Cadastro realizado com sucesso.');
    }
}
