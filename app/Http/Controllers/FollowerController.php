<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    // funcion para seguir
    public function store(User $user){
        $user->followers()->attach( auth()->user()->id );

        return back();
    }

    //funcion para dejar de seguir
    public function destroy(User $user){
        $user->followers()->detach( auth()->user()->id);

        return back();
    }
}
