<?php

namespace App\Http\Controllers;

use Illuminate\Hashing\BcryptHasher;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Users;

class UsersController extends Controller
{

    public function test(){
       dd("Testing......");
    }

    public function getAllUsers(){
        return response()-> json(Users::all());
    }

    public function getUsersById($id){
        return response()-> json(Users::find($id));
    }


    //this function is used to register a new user
    public function create(Request $request)
    {
        //creating a validator
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users',
            'password' => 'required',
            'email' => 'required|unique:users'
        ]);
        //if validation fails 
        if ($validator->fails()) {
            return array(
                'error' => true,
                'message' => $validator->errors()->all()
            );
        }
        //creating a new user
        $users = new Users();
        //adding values to the users
        $users->username = $request->input('username');
        $users->email = $request->input('email');
        $users->password = (new BcryptHasher)->make($request->input('password'));
        //saving the user to database
        $users->save();
        //unsetting the password so that it will not be returned 
        unset($users->password);
        //returning the registered user 
        return response()->json($users);
    }

    public function updateUser($id,Request $request){
        //creating a validator
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
            'email' => 'required'
        ]);
        //if validation fails 
        if ($validator->fails()) {
            return array(
                'error' => true,
                'message' => $validator->errors()->all()
            );
        }else{
            $exitsUser= Users::findOrFail($id);
            $exitsUser->update($request->all());
            return response()->json($exitsUser);
        }
    }

    public function deleteUser($id){
        $exitsUser= Users::findOrFail($id)->delete();
        return response()->json("'Deleted Successfully'");
    }
}