<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthenticationController extends Controller
{
    

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:users',
            'asrama' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
               'message'=>'Validation Error',
               'errors' => $validator->errors()
                ],422);

        }

        $user = User::create([
            'name'=>$request->name,
            'asrama'=>$request->asrama,
            'password'=>Hash::make($request->password),            
        ]);

        return response()->json([
            'message'=>'Registrasi Sukses',
            'data' => $user
             ],200);

        
    }


    function getallsantri(){
        $userall = User::all();
        return response()->json( ['data' => $userall]);
    }

    function deleteuser ($id){
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['data' => "Akun Berhasil dihapus"]);
    }


}
