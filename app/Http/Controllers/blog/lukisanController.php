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
                <a href="'.asset('public/images').'/'.$value->gambar.'" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Web 3"><i class="bx bx-plus"></i></a>
                <a href="#" title="More Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
          </div>
        </div>
        ';
      }
      return response()->json($template,200);
    }
}
