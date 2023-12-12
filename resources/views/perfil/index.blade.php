@extends('layout.app')

@section('titulo')
    Editar perfil
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            <form action="{{ route('perfil.store') }}" method="POST" enctype="multipart/form-data" class="mt-10 md:mt-0" novalidate>
                @csrf
                <div class="mb-5">
                    <label for="username" class=" mb-2 uppercase text-blue-600 font-bold">
                        Usuario:
                    </label>
                    <input type="text" name="username" id="username" class="border p-3 w-full rounded-lg @error('username') border-red-600 @enderror " value="{{ auth()->user()->username}}">
                    @error('username')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{$message}}
                    </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="imagen" class=" mb-2 uppercase text-blue-600 font-bold">
                        Imagen Perfil
                    </label>
                    <input type="file" name="imagen" id="imagen" class="border p-3 w-full rounded-lg" value="" accept=".jpg, jpeg, .png">
                </div>

                <input type="submit" value="Guardar" class="bg-sky-600 text-white hover:bg-sky-800 transition-colors cursor-pointer uppercase font-bold p-3 w-full rounded-lg">
            </form>    
        </div>
    </div>
@endsection