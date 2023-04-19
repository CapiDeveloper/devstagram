<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    
    public function index() {
        return view('auth.register');
    }
    public function store(Request $request){
        // Reescribiendo el username, con Str::slug estamos haciendo que username este en minusculas, sin caracteres especiales
        // y que a cada espacio que encuentre le agrega un '-', para que quede como una url, importante para url de cada perfil de usuario en este caso,
        // incluso para codigo QR 
        $request->request->add(['username'=>Str::slug($request->username)]);
        $this->validate($request,[
            'name'=>'required|max:20',
            'username'=>'required|unique:users|max:20',
            'email'=>'required|unique:users|email|max:60',
            'password'=>'required|confirmed|min:6',
        ]);
        $user = User::create([
            'name'=>$request->name,
            'username'=>Str::slug($request->username),
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);
        // El método attempt()
        // busca en la tabla de usuarios de la base de datos en busca de una fila
        // que coincida con las credenciales proporcionadas. Si encuentra una 
        // coincidencia, autentica al usuario y devuelve true. De lo contrario, 
        // devuelve false.
        auth()->attempt([
            'email'=>$request->email,
            'password'=>$request->password
        ]);
        return redirect()->route('posts.index',['user'=>$user->username]);
    }
}