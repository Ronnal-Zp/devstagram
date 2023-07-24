<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function store(Request $request)
    {

        // Obtener imagen y generar nombre
        $image = $request->file('file');
        $imageName = Str::uuid(). "." .$image->extension();

        // Instanciar imagen
        $imageUpload = Image::make($image);
        $imageUpload->fit(1000, 1000);

        // Generar path de imagen a subir y guardar
        $imagePath = public_path('uploads') . "/" . $imageName;
        $imageUpload->save($imagePath);

        return response()->json( ['imagen' => $imageName] );
    }
}
