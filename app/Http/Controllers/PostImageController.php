<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\getClientOriginalName;

class PostImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post)
    {
        $image = $post->images;

        if (!$image) {
            return response()->json('Este post notiene imagenes',403);
        }
        else
        {
            rsort($image);
        }

        return response()->json($image);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post)
    {
        $campos = array();

        $file = $request->file('tittle');

        dd($file);

        $nombre = $file->getClientOriginalName();

        $url = public_path('img').'\\'.$nombre;

        Storage::disk('images')->put($nombre, \File::get($file));

        $campos = [
            'tittle' => $nombre,
            'url' => $url,
        ];

        $image = $post->images()->create($campos);

        return response()->json($image);
    }

}
