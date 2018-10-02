<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all()->toArray();

        rsort($users);

        return response()->json($users);
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
        	$user = new User([
        		'name' => $request->input('name'), 
        		'lastname' => $request->input('lastname'), 
        		'email' => $request->input('email'), 
        		'password' => bcrypt($request->input('email')), 
        		'status' => $request->input('status'), 
        	]);
        	$user->save();
        	return response()->json('Usuario Creado', 500);
        }catch (\Exception $e){
        	return response("Algo salio mal", 501);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        try{
        	if (!$user) {
        		return response()->json(["El usuario no existe"], 503);
        	}

        	return response()->json($user, 200);

        }catch (\Exception $e){
        	return response("Algo salio mal", 501);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {  	
    	$error = true;
       try{ 	
       		$reglas=[
            	'email'=>'email|unique:users,email,'.$user->id,
			];	

			$error = $this->validate($request,$reglas);

    		$user->update($request->all());
    		return response()->json("Usuario {$user->name} Modificado", 200);
    	} catch (\Exception $e){  

    		if (!$error) {
    			return response("Algo salio mal", 501);
    		}
    		return response("El correo ya tiene un usuario asignado por favor ingresa otro", 501);
    		
    	}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
        	$user = User::find($id);

        	if (!$user) {
        		return response()->json("El usuario no existe", 503);
        	}

        	$user->delete();
        	return response()->json("Usuario {$user->name} ELiminado", 200);

        }catch (\Exception $e){
        	return response("Algo salio mal", 501);
        }
    }
}
