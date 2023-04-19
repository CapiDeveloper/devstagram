<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request){

        return view('perfil.index');
    }
    public function store(Request $request){
    
        // Str::slug($request->username) crea una url que sea amigable con el seo
        $request->request->add(['username'=>Str::slug($request->username)]);
        
        $this->validate($request,[
            'username'=> ['required','unique:users,username,'.auth()->user()->id,'min:3','max:20'],
            'email'=>['required','unique:users,email,'.auth()->user()->id,'min:10']
        ]);
    
        if($request->imagen){
            // Almacenar imagen
            $imagen = $request->file('imagen');
            $nombreImagen = Str::uuid($imagen).'.'.$imagen->extension();
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000,1000);

            $imagenPath = public_path('uploads').'/'.$nombreImagen;
            $imagenServidor->save($imagenPath);
        }
        // Guardar cambios
        $user = User::find(auth()->user()->id);
        $user->username = $request->username;
        $user->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;
        $user->email = $request->email;
         
        // Cambio password
        if($request->password_actual){
            $passwordBD = User::where('email', $request->email)->pluck('password')->first();
            $passwordActual = $request->password_actual;
            if (Hash::check($passwordActual,$passwordBD)) {
                $user->password=Hash::make($request->password);
            }else{
                return back()->with('message','Password incorrecto');
            }
        }
        $user->save();

        // Redireccionar al usuario
        return redirect()->route('posts.index',$user);
    }
}