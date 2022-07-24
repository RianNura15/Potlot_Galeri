<?php

namespace App\Http\Controllers\blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Response;
class lukisanController extends Controller
{
    public function lukisan_json(){
      $template = '';
      $get = db::table('tb_gambar')
      ->limit(20)
      ->get();
      foreach ($get as $key => $value) {
        $template .= '
        <div class="col-md-4 col-lg-4 grid-margin stretch-card">
        <div class="card card-rounded">
          <div class="card-body">
              <div class="portfolio-wrap">
                <img src="'.asset('public/images').'/'.$value->gambar.'" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <hr>
                  <p class="h4">'.$value->nama.'</p>
                  <p>'.$value->kategori.'</p>
                </div>
              </div>

            <div class="list align-items-center pt-3">
              <div class="wrapper w-100">
                <p class="mb-0">
                  <a href="'.route('blog.lukisan.detail',['id'=>$value->id]).'" class="fw-bold text-primary">Lihat <i class="mdi mdi-arrow-right ms-2"></i></a>
                </p>
              </div>
            </div>
          </div>
        </div>
        </div>';
      }
      return response()->json($template,200);
    }
    public function detail(Request $request){
      $id = $request->id;
      $get = db::table('tb_gambar')
      ->where('id',$id)
      ->first();
      return view('blog.detail',compact('get'));
    }
}
