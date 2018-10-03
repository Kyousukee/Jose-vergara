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
         try{
            if ($request->input('image')) {

                foreach($request->image as $key => $value){
                    $image = $value;  // your base64 encoded
                    $image = str_replace('data:image/jpeg;base64,', '', $image);
                    $image = str_replace(' ', '+', $image);
                    $imageName = str_random(10).'.'.'jpeg';                
                }

                $post = new Post([
                    'user_id' => $request->input('user_id'),
                    'image' => $image,
                    'tittle' => $request->input('tittle'), 
                    'description' => $request->input('description'), 
                    'ubication' => $request->input('ubication'), 

                ]);

            }else{
                $post = new Post([
                    'user_id' => $request->input('user_id'),
                    'tittle' => $request->input('tittle'), 
                    'description' => $request->input('description'), 
                    'ubication' => $request->input('ubication'), 
                ]);
            } 
            $post->save();
            //return response()->json('Publicaicon Creada', 500);
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
