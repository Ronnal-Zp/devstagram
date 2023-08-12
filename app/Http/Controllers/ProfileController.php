<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function edit(User $user) 
    {
        if(auth()->user()->id == $user->id) {
            return view('profile.edit', ['user' => $user]);
        } else {
            return redirect()->route('posts.index', [
                'user' => auth()->user() 
            ]);
        }
    }


    public function store(Request $request, User $user)
    {

        // Modificar el request para que entre en la validacion de username.unique
        $request->request->add(['username' => Str::slug( $request->username )]);

        $this->validate($request,
            [
                'username' => ['required', 'unique:users,username,'.auth()->user()->id, 'min:3', 'max:15', 'not_in:edit,store'],
                'password' => ['min:8', 'nullable'],
                'new_password' => ['required_with:password', 'nullable', 'min:8', 'confirmed'],
            ],
            [
                'required' => 'Este campo es requerido',
                'username.unique' => 'Ya existe este username',
                'min' => 'Minimo de :min caracteres',
                'max' => 'Maximo de :max caracteres',
                'not_in' => 'Valor invalido',
                'confirmed' => 'Las contraseñas no coinciden',
                'required_with' => 'Debe ingresar la nueva contraseña'
            ]
        );


        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        

        // Validar si cambia la contraseña
        if($request->password != '') {
            $isauth = auth()->attempt([
                'email' => auth()->user()->email,
                'password' => $request->password
            ]);

            if($isauth) {
                $usuario->password = Hash::make( $request->new_password );
            } else {
                throw ValidationException::withMessages(['password' => 'Contraseña incorrecta']);
            }

        }


        // Validar si cambia la imagen
        if($request->imagen) {

            $image = $request->file('imagen');

            // Eliminar anterior imagen
            if(($imageName = $usuario->imagen) != '') {
                $imagePath = public_path('profiles') . "/" . $imageName;
                if(File::exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $imageName = Str::uuid(). "." .$image->extension();

            // Instanciar imagen
            $imageUpload = Image::make($image);
            $imageUpload->fit(1000, 1000);

            // Generar path de imagen a subir y guardar
            $imagePath = public_path('profiles') . "/" . $imageName;
            $imageUpload->save($imagePath);

            $usuario->imagen = $imageName;
        } else {

            // Eliminar anterior imagen
            if(($imageName = $usuario->imagen) != '') {
                $imagePath = public_path('profiles') . "/" . $imageName;
                if(File::exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $usuario->imagen = "";
        }

        
        $usuario->save();
        return redirect()->route('posts.index', $usuario);
    }
}
