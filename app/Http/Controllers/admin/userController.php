<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Response;
use Illuminate\Support\Facades\Hash;
class userController extends Controller
{
    public function anggota_index(){
      return view('admin.user.anggota');
    }
    public function customer_index(){
      return view('admin.user.');
    }
    public function add_anggota(Request $request){
      $insert = db::table('users')
      ->insert([
        'name' => $request->nama,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'anggota'
      ]);
      if ($insert == true) {
        return response()->json('berhasil',200);
      }else {
        return response()->json('gagal',500);
      }
    }
    public function get_anggota(Request $request){
      $limit = is_null($request["length"]) ? 10 : $request["length"];
      $offset = is_null($request["start"]) ? 0 : $request["start"];
      $draw = $request["draw"];
      $search = $request->search['value'];
      $data = [];
      $result = DB::table('users')
      ->where('role','anggota');
      if (!empty($search)) {
        $result = $result->where('name','LIKE','%'.$search.'%')
        ->orwhere('nik','LIKE','%'.$search.'%');
      }
      $get_count = $result->get()->count();
      $result = $result
      ->limit($limit)
      ->offset($offset)
      ->orderBy('created_at','DESC')
      ->get();
      foreach ($result as $key => $value) {
        $data[] = array(
          'id' => $value->id,
          'name' => $value->name,
          'ttl' => $value->ttl,
          'nik' => $value->nik,
        );
      }
      $recordsTotal = is_null($get_count) ? 0 : $get_count;
      $recordsFiltered = is_null($get_count) ? 0 : $get_count;
      return response()->json(compact("data", "draw", "recordsTotal", "recordsFiltered"));
    }
    public function delete_anggota(Request $request){
      $delete = db::table('users')
      ->where('id',$request->id)
      ->delete();
      if($delete == true){
        return response()->json('berhasil',200);
      }else {
        return response()->json('gagal',500);
      }
    }
}
