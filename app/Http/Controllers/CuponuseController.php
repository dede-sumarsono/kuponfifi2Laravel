<?php

namespace App\Http\Controllers;

use App\Http\Resources\CuponuseResource;
use App\Models\Cuponuse;
use Illuminate\Http\Request;

class CuponuseController extends Controller
{
    
    function index(){
        $cuponuse = Cuponuse::all();
        ///return response()->json(['data' => $cuponuse]);

        return  CuponuseResource::collection($cuponuse);
        
    }

    function show($id){
        $cuponuse = Cuponuse::findOrFail($id);
        //return response()->json(['data' => $cuponuse]);
        return new CuponuseResource($cuponuse);
        
    }

    function store(Request $request) {
        
        $validate = $request->validate([
            'user_id' => 'required',
            'name' => 'required',
            'asrama' => 'required',
            'qr_code' => 'required',
            'sesi' => 'required',
        ]);

        $cuponuse = Cuponuse::create($request->all());

        //return response()->json('Oke berhasil');
        return new CuponuseResource($cuponuse);
        
    }
}
