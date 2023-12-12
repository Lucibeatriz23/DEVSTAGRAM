<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function index(){
        return view('auth.login');
    }

    public function store(Request $request){
     

      //Validar el formulario
      $this->validate($request, [
        'email' => 'required|email',
        'password' => 'required'
      ]);
        //Validar al usuario en la BD
        if(!auth()->attempt($request->only('email', 'password'), $request->remember)){
            return back()->with('mensaje', 'Los datos son incorrectos');
    }

    
    return redirect()->route('posts.index', auth()->user()->username);
    }
}

