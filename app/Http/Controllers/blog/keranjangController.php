<?php

namespace App\Http\Controllers\blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Response;
use Auth;
class keranjangController extends Controller
{
    public function index(){
      $user = Auth::user()->id;
      $get = db::table('tb_cart AS a')
      ->join('tb_gambar AS b','a.id_karya','b.id')
      ->where('id_user',$user)
      ->get();
      return view('blog.keranjang',compact('get'));
    }
    public function tambah(Request $request){
      $id = $request->id;
      $user = $request->user;
      $check = db::table('tb_cart')
      ->where('id_user',$user)
      ->where('id_karya',$id)
      ->first();
      if (empty($check)) {
        $insert = db::table('tb_cart')
        ->insert([
          'id_user' => $user,
          'id_karya' => $id
        ]);
        if ($insert == true) {
          return response()->json('berhasil',200);
        }
      }else {
        return response()->json('Barang sudah ditambahkan',500);
      }
    }
}
