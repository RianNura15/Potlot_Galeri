<?php

namespace App\Http\Controllers\blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB, Response, Auth;
use App\Services\Midtrans\CreateSnapTokenService;
use Midtrans\Config;
use Midtrans\Notification;
use Midtrans\Snap;
use Illuminate\Support\Str;

class orderController extends Controller
{
    public function bayar(Request $request){
      \Midtrans\Config::$serverKey = 'Mid-server-UZNFle0pQNFWNiVlZcgos_59';
      \Midtrans\Config::$isProduction = true;
      \Midtrans\Config::$isSanitized = true;
      \Midtrans\Config::$is3ds = true;
      $id = Str::random(40);
      $id_cart = $request->id;
      $midtrans = [
          'transaction_details' => [
              'order_id' => $id,
              'gross_amount' => $request->gross_amount
          ],
          'customer_details' => [
              'first_name' => $request->name,
              'email' => $request->email,
          ],
          'enable_payments' => [
            "credit_card", "cimb_clicks",
            "bca_klikbca", "bca_klikpay", "bri_epay", "echannel", "permata_va",
            "bca_va", "bni_va", "bri_va", "other_va", "indomaret", "alfamart",
            "danamon_online", "akulaku", "shopeepay"
          ],
          'vtweb' => []
      ];
        try {
          $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;
          $token =  Snap::createTransaction($midtrans)->token;
          $data = [
            'token' => $token,
            'id_cart' => $id_cart
          ];
          return response()->json($data);
      }
      catch (Exception $e) {
        return response()->json($e->getMessage());
      }
    }
    public function payload(Request $request){
      $token = $request->token;
      $id_cart = $request->id_cart;
      return view('blog.showpay',compact('token','id_cart'));
    }
    public function status(Request $request){
      $get = db::table('tb_cart')
      ->where('id',$id_booking)
      ->first();
      $data = json_decode($request->data);
      
    }
}
