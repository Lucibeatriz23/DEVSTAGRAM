<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
   
    public function index(){
        return view('auth.register');
    }

    public function store(Request $request){
        //validation de los datos
        $this->validate($request, [
            'name' => 'required|min:8|max:30',
            'username' => 'required|min:3|max:20',
            'email' => 'required|email|max:60',
            'password' => 'required|confirmed|min:6'
        ]);

   
    User::create([
        'name' => $request->name,
        'username' => $request->username,
        'email' => $request->email,
        'password' => Hash::make ($request->password)
    ]);

    // dd('Usuario creado');

    //Autenticar al usuario
    auth()->attempt($request->only('email', 'password'));

    //Redireccionar al usuario
    return redirect()->route('posts.index',$request->username);
   
    }
}
