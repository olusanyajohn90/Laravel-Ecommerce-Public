<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Rave;

use Auth;
use DB;
use Cart;
use Session;

class RaveController extends Controller
{


    /**
   * Initialize Rave payment process
   * @return void
   */public function initialize(Request $request){
    //This initializes payment and redirects to the payment gateway//The initialize method takes the parameter of the redirect URL




    Rave::initialize(route('callback'));
  }
/**
   * Obtain Rave callback information
   * @return void
   */public function callback(Request $request){

    $email = Auth::user()->email;
    $total = $request->total;



    $charge = $request->resp;
    $body = json_decode($charge, true);
    $txRef = $body['data']['data']['txRef'];
    $data = Rave::verifyTransaction($txRef);

    //dd($data);  // view the data response







if ($data->status == 'success') {
    $data = array();
    $data['user_id'] = Auth::id();
    $data['payment_id'] = $request->txid;
    $data['paying_amount'] = $request->amount;
    $data['blnc_transaction'] = $request->txref;
    $data['stripe_order_id'] = $request->flwref;
    $data['shipping'] = $request->shipping;
    $data['vat'] = $request->vat;
    $data['total'] = $request->amount;
    $data['payment_type'] = $request->payment_type;
    $data['status_code'] = mt_rand(100000,999999);

    if (Session::has('coupon')) {
    	$data['subtotal'] = Session::get('coupon')['balance'];
    }else{
    	$data['subtotal'] = Cart::Subtotal();
    }
    $data['status'] = 0;
    $data['date'] = date('d-m-y');
    $data['month'] = date('F');
    $data['year'] = date('Y');
    $order_id = DB::table('orders')->insertGetId($data);

   // Mail send to user for Invoice
 // Mail::to($email)->send(new invoiceMail($data));


    /// Insert Shipping Table

    $shipping = array();
    $shipping['order_id'] = $order_id;
    $shipping['ship_name'] = $request->ship_name;
    $shipping['ship_phone'] = $request->ship_phone;
    $shipping['ship_email'] = $request->ship_email;
    $shipping['ship_address'] = $request->ship_address;
    $shipping['ship_city'] = $request->ship_city;
    DB::table('shipping')->insert($shipping);

    // Insert Order Details Table

    $content = Cart::content();
    $details = array();
    foreach ($content as $row) {
    $details['order_id'] = $order_id;
    $details['product_id'] = $row->id;
    $details['product_name'] = $row->name;
    $details['color'] = $row->options->color;
    $details['size'] = $row->options->size;
    $details['quantity'] = $row->qty;
    $details['singleprice'] = $row->price;
    $details['totalprice'] = $row->qty*$row->price;
    DB::table('orders_details')->insert($details);

    }

    Cart::destroy();
    if (Session::has('coupon')) {
    	Session::forget('coupon');
    }
    $notification=array(
                        'message'=>'Order Process Successfully Done',
                        'alert-type'=>'success'
                         );
                       return Redirect()->to('/')->with($notification);


//do something to your database
}
else {
    $notification=array(
        'message'=>'Order Process Went Wrong',
        'alert-type'=>'success'
         );
       return Redirect()->to('/')->with($notification);
}
}









public function webhook()
  {
    //This receives the webhook
    $data = Rave::receiveWebhook();
    Log::info(json_encode($data, true));
  }


}
