<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        //dd($request->get('name'));

        //Modificar el Request
        $request->request->add(['username' => Str::slug($request->username)]);

        //VALIDACION
        $this->validate($request, [
            'name' => 'required|max:15',
            'username' => 'required|unique:users|min:3',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        //Autenticar al usuario en laravel 10 no es necesario
            // auth()->attempt([
            //     'email' => $request->email,
            //     'password' => $request->password
            // ]);
        //Otra forma
        auth()->attempt($request->only('email','password'));

        //Redireccionar al usuario
        return redirect()->route('posts.index',auth()->user()->username);
    }
}
