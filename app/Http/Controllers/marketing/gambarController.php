<?php

namespace App\Http\Controllers\marketing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Response;
class gambarController extends Controller
{
  public function index(){
    return view('marketing.gambar.index');
  }
  public function get_data(Request $request){
    $limit = is_null($request["length"]) ? 10 : $request["length"];
    $offset = is_null($request["start"]) ? 0 : $request["start"];
    $draw = $request["draw"];
    $search = $request->search['value'];
    $data = [];
    $result = DB::table('tb_gambar AS a')
    ->leftjoin('tb_pemasar AS b','a.id','b.id_gambar')
    ->where('b.id_anggota',$request->id_user);
    if (!empty($search)) {
      $result = $result->where('name','LIKE','%'.$search.'%')
      ->orwhere('nik','LIKE','%'.$search.'%');
    }
    $get_count = $result->get()->count();
    $result = $result
    ->limit($limit)
    ->offset($offset)
    ->get();
    foreach ($result as $key => $value) {
      $data[] = array(
        'id' => $value->id,
        'gambar' => $value->gambar,
        'nama' => $value->nama,
        'keterangan' => $value->keterangan,
        'harga' => $value->harga,
        'kategori' => $value->kategori,
        'created_at' => $value->created_at,
        'status' => $value->status,
      );
    }
    $recordsTotal = is_null($get_count) ? 0 : $get_count;
    $recordsFiltered = is_null($get_count) ? 0 : $get_count;
    return response()->json(compact("data", "draw", "recordsTotal", "recordsFiltered"));
  }
}
