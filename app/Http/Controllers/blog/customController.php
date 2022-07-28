<?php

namespace App\Http\Controllers\blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Response;
class customController extends Controller
{
    public function index(){
      return view('blog.custom.index');
    }
    public function create(Request $request){
      try {
        $imageName = time().'.'.$request->gambar->extension();
        $request->gambar->move(public_path('images'), $imageName);
        db::table('tb_custom')
        ->insert([
          'users_id' => $request->id_users,
          'custom' => $request->keterangan,
          'gambar' => $imageName
        ]);
        return response()->json('berhasil');
      } catch (\Exception $e) {
        return response()->json($e->getMessage());
      }
    }
    public function data_list(){
      $get = db::table('tb_custom')
      ->where('users_id',auth()->user()->id)
      ->get();
      return view('blog.custom.data_list',compact('get'));
    }
    public function batal(Request $request){
      try {
        db::table('tb_custom')
        ->where('id',$request->id)
        ->delete();
        return response()->json('berhasil');
      } catch (\Exception $e) {
        return response()->json($e->getMessage());
      }

    }
}
