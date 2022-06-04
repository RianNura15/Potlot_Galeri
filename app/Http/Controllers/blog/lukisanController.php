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
        <div class="col-lg-4 col-md-6 portfolio-item filter-'.$value->kategori.'">
          <div class="portfolio-wrap">
            <img src="'.asset('public/images').'/'.$value->gambar.'" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>'.$value->nama.'</h4>
              <p>'.$value->kategori.'</p>
              <div class="portfolio-links">
                <a href="'.asset('public/images').'/'.$value->gambar.'" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Web 3"><i class="fa fa-eye" aria-hidden="true"></i></a>
                <a href="'.route('blog.lukisan.detail',['id'=>$value->id]).'" title="More Details"><i class="fa fa-shopping-bag" aria-hidden="true"></i></a>
              </div>
            </div>
          </div>
        </div>
        ';
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
