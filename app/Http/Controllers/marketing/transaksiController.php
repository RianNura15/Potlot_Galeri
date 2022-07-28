<?php

namespace App\Http\Controllers\marketing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Response;
class transaksiController extends Controller
{
    public function index(){
      return view('marketing.transaksi.index');
    }
    public function get_data(Request $request){
      $limit = is_null($request["length"]) ? 10 : $request["length"];
      $offset = is_null($request["start"]) ? 0 : $request["start"];
      $draw = $request["draw"];
      $search = $request->search['value'];
      $data = [];
      $result = DB::table('tb_order AS a')
      ->leftJoin('tb_pemasar AS b','a.tb_gambar_id','b.id_gambar')
      ->leftJoin('users AS c','c.id','a.users_id')
      ->leftjoin('tb_gambar AS p','p.id','a.tb_gambar_id')
      ->leftJoin('tb_payment AS d','d.tb_order_id','a.id')
      ->where('b.id_anggota',$request->user_id);
      if (!empty($search)) {
        $result = $result->where('c.name','LIKE','%'.$search.'%')
        ->orwhere('p.nama','LIKE','%'.$search.'%');
      }
      $get_count = $result->get()->count();
      $result = $result
      ->limit($limit)
      ->offset($offset)
      ->orderBy('a.created_at','DESC')
      ->get();
      foreach ($result as $key => $value) {
        $data[] = array(
          'id' => $value->id,
          'gambar' => $value->nama,
          'pembeli' => $value->name,
          'pembayaran' => $value->payment_type,
          'harga' => rupiah($value->harga),
          'status' => $value->status_message,
          'tanggal' => date('d-m-Y',strtotime($value->transaction_time)),
        );
      }
      $recordsTotal = is_null($get_count) ? 0 : $get_count;
      $recordsFiltered = is_null($get_count) ? 0 : $get_count;
      return response()->json(compact("data", "draw", "recordsTotal", "recordsFiltered"));
    }
}
