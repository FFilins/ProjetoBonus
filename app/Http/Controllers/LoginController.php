<?php

namespace App\Http\Controllers;


use App\Model\User;
use App\Models\User as ModelsUser;
use Exception;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function loginShow(Request $request) {

        return view('autenticacao.loginShow');

    }
    public function cadastroShow(Request $request) {

        return view('autenticacao.cadastroShow');

    }

    public function logon(Request $request) {
        
    }

    public function autenticar(Request $request): RedirectResponse {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required',]
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();


            flash('Login realizado com sucesso')->success();
            return redirect()->intended('/');
        }
        
        flash('credenciais erradas')->error();
        return back()->withErrors([
            'email' => 'credenciais não cadastradas.',
        ])->onlyInput('email');
    }
    
    public function cadastro(Request $request) {

        try {

            $usuario = new AuthUser();

            $usuario->name = $request->name;
            $usuario->email = $request->email;
            $usuario->password = Hash::make($request->password);

            $usuario->save();

            flash('Cadastro concluído com suceso')->success();
            return redirect()->route('produtos.show');            

        }catch(Exception $e) {
            flash('Erro no cadastro')->error();
            return redirect()->back();
        }

    }


    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}
