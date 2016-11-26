<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use DB;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest', ['except' => ['getLogout', 'getRegister', 'postRegister']]);
        $this->middleware($this->guestMiddleware(), ['except' => ['logout', 'getRegister', 'postRegister', 'getAll', 'ativar', 'desativar']]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'role' => 'required',
            'password' => 'required|confirmed',
            'codigo_seguranca' => 'required|unique:users',
        ], [
            'name.required' => 'Informe um Nome',
            'name.max' => 'O campo nome deve conter no máximo 255 caracteres',
            'email.required' => 'Informe um Email',
            'email.email' => 'Informe um Email válido',
            'email.max' => 'O campo email deve conter no máximo 255 caracteres',
            'email.unique' => 'Email já existe!!! Informe outro email',
            'password.confirmed' => 'É preciso Confirmar sua Senha',
            'password.required' => 'É preciso informar a senha',
            'codigo_seguranca.required' => 'É preciso informar o código de segurança',
            'codigo_seguranca.unique' => 'Já existe usuário com esso código de segurança'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $data['role'],
            'codigo_seguranca' => $data['codigo_seguranca'],
            'ultimo_pagamento' => \Carbon\Carbon::now(),
        ]);
    }

    public function ativar($id)
    {
        $user = User::find($id);
        $user->ativo = true;
        $user->save();
        return redirect()->route('user.editar');
    }

    public function desativar($id)
    {
        $user = User::find($id);
        $user->ativo = false;
        $user->save();
        return redirect()->route('user.editar');
    }

    public function getAll()
    {
        //$user =  DB::select("SELECT * FROM users where role = 'apostador'");
        $user = User::where('role', 'apostador')->get();
        return view('auth.editarUser', ['user' => $user]);
    }
}