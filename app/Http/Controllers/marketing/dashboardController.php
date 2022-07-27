<?php

namespace App\Http\Controllers\marketing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Response;
class dashboardController extends Controller
{
    public function home(){
      return view('marketing.index');
    }
}
