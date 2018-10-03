<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all()->toArray();

        rsort($posts);

        return response()->json($posts);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        header('Access-Control-Allow-Origin: *');

         try{
                $post = Post::create([
                    'user_id' => $request->input('user_id'),
                    'tittle' => $request->input('tittle'), 
                    'description' => $request->input('description'), 
                    'ubication' => $request->input('ubication'), 
                ]);
 
                return response()->json($post);
                
        }catch (\Exception $e){
            return response("Algo salio mal", 501);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        try{
            if (!$post) {
                return response()->json(["La publicacion no existe"], 503);
            }

            return response()->json($post, 200);

        }catch (\Exception $e){
            return response("Algo salio mal", 501);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        try{   

            $post->update($request->all());
            return response()->json("Publicacion {$post->tittle} Modificado", 200);

        } catch (\Exception $e){  
            return response("Algo salio mal", 501);
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $post = Post::find($id);

            if (!$post) {
                return response()->json("La Publicacion no existe", 503);
            }

            $post->delete();
            return response()->json("Publicacion {$post->tittle} ELiminado", 200);

        }catch (\Exception $e){
            return response("Algo salio mal", 501);
        }
    }
}
