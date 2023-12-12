<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{

    public function __construct() 
    {
        $this->middleware('auth');
    }


    //
    public function index(){
//        dd('Aqui se muestra el formulario');
        return view('perfil.index');
    }

    public function store(Request $request){
//        dd('Guardando cambios...');

    $request->request->add(['username' => Str::slug($request->username)]);

$this->validate($request,[
//    'username' => 'required|unique:users|min:3|max:20',
// se hacen  mini especies de columnas para poder corroborar que el nuevo usuario no choque con el que ya existe
'username' => [
    'required',
//El auth es para  indicar que un usuario esta haciendo la editacion 
    'unique:users,username,'.auth()->user()->id,
    'min:3',
    'max:20',
//crea una lista negra para usuaios no permitidos
    'not_in:editar-perfil'
            ]
        ]);

//Validacion de imagen
    if($request->imagen){
/*Solo fue prueba        
        dd('Hay imagen');

    }
    else{
        dd('No hay imagen');
    } 
*/ 
 
    $imagen = $request->file('imagen');

    $nombreImagen = Str::uuid().'.'.$imagen->extension();

    $imagenServidor = Image::make($imagen);
    $imagenServidor->fit(1000,1000);

    $imagenPath = public_path('perfiles').'/'.$nombreImagen;

    $imagenServidor->save($imagenPath);

        }

//Guardar cambios
    $usuario = User::find(auth()->user()->id);

    $usuario->username = $request->username;
    
//Evitar que el nombre la imagen se pierda    
    $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;

    $usuario->save();

//Redirecciar al usuario
    return redirect()->route('posts.index', $usuario->username);    
    }
}