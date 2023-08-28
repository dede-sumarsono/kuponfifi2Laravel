<?php

namespace App\Http\Controllers;

use App\Models\Cuponuse;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PostController extends Controller
{
    function index() {

        $post = Post::all();
        return response()->json(['data' => $post]);
        
    }

    function showhariini(){
        //$poli = Auth::user()->poli;
        //$data = Post::whereDate("created_at",'=',Carbon::today())
        //->get();
        //->where("diagnosa","=",null)
        //->where("poli","=",$poli)
        $data = Post::all();

        return response()->json(['data' => $data]);
        
    }

    function deleteallqr() {  //delete all post table
        $data = Post::all('id');
        
        $dataAll = count($data);

        for ($i=0; $i < $dataAll; $i++) {
            $postDelete = Post::where('id', $data[$i]['id'])->first();
            $postDelete->delete();
            //print($postDelete);
        }

    
        return response()->json(['data' => 'Data Sudah Terhapus']);
        
    }


    // Scan code dan hapus
    function destroy($qr, Request $request) {
        //$post = Post::findOrFail($qr);
        $post = Post::where('qr_code', $qr)->first();
        
        //return response()->json( ['data' => 'QR Diterima Dan Berhasil dihanguskan']);
        
        $request['user_id'] = $post['user_id'];
        $request['name'] = $post['name'];
        $request['asrama'] = $post['asrama'];
        $request['qr_code'] = $post['qr_code'];
        $request['sesi']=$post['sesi'];
        
        $cuponuse = Cuponuse::create($request->all());
        $post->delete();



        return response()->json(['data' => $post]);


    }


////////buat qr code
    function getalluser(Request $request){


        $data = Post::all('id');
        
        $dataAll = count($data);

        for ($i=0; $i < $dataAll; $i++) {
            $postDelete = Post::where('id', $data[$i]['id'])->first();
            $postDelete->delete();
            //print($postDelete);
        }


        $userall = User::all('id');
        $usercount = count($userall);


        for ($i=0; $i < $usercount; $i++) { 
            
            
            //print($userall[$i]['id'].$random.' ');
            $user = User::where('id', $userall[$i]['id'])->first();
            

            for ($o=0; $o < 2; $o++) {

                $random = $this->generateRandomString();
                $request['user_id'] = $userall[$i]['id'];        
                $request['name'] = $user->name;       
                $request['asrama'] = $user->asrama;
                $request['qr_code'] = $random;
                $request['sesi'] = 'siang';


                if ($o == 0) {
                    $request['sesi'] = 'pagi';
                }else{
                    $request['sesi'] = 'siang';
                }

            
                $post = Post::create($request->all());
            
            }


            

        }

        //return response()->json( ['data' => $usercount]);
        return response()->json( ['data' => 'Kupon Berhasil dibuat']);


    }


    



     ////////////////////////Generate random string for upload file
     function generateRandomString($length = 15) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    /////////////////////////End Generate random string



}
