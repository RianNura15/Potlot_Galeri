<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Response;
class promoController extends Controller
{
    public function index(){
      return view('admin.promo.index');
    }
}
