<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{
    //
    public function register(Request $request){
        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'password2' => 'required|same:password',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }
   
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        
        $user = User::create($input);
        $success['name'] =  $user->name;
   
        return response()->json($success);
    }

    public function login(Request $request){
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken(env('APP_NAME'))->plainTextToken; 
            $success['name'] =  $user->name;
   
            return response()->json($success);
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised']);
        }
    }

    public function logout(){
        $user = Auth::user();

        if(isset($user)){
            $user->tokens()->delete();
            return response()->json(['message' => 'User successfully logged out.']);
        }
        else{
            return response()->json(['message' => 'Session already invalidated.']);
        }

    }
}
