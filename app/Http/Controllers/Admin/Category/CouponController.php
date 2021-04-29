<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function coupon()
    {
        $coupon = DB::table('coupons')->get();
        return view('admin.coupon.coupon', compact('coupon'));

    }

    public function storecoupon(Request $request)
    {
        $data = array();
        $data['coupon'] = $request->coupon;
        $data['discount'] = $request->discount;
        DB::table('coupons')->insert($data);


        $notification=array(
            'message'=>'Coupon inserted successfully',
            'alert-type'=>'success'
            );
        return Redirect()->back()->with($notification);
    }

    public function deletecoupon($id)
    {

        DB::table('coupons')->where('id' , $id)->delete();

        $notification=array(
                                'message'=>'Coupons Deleted successfully',
                                'alert-type'=>'success'
                                );
            return Redirect()->back()->with($notification);
    }

    public function editcoupon($id)
    {
        $coupon = DB::table('coupons')->where('id', $id )->first();
        return view('admin.coupon.edit_coupon', compact('coupon'));

    }

    public function updatecoupon(Request $request, $id)
    {
        $data = array();
        $data['coupon'] = $request->coupon;
        $data['discount'] = $request->discount;
        DB::table('coupons')->where('id' , $id)->update($data);

        $notification=array(
            'message'=>'Coupon updated successfully',
            'alert-type'=>'success'
            );
        return Redirect()->route('admin.coupon')->with($notification);
    }

    public function newsletter()
    {
        $sub = DB::table('newsletters')->get();
        return view('admin.coupon.newsletter',compact('sub'));
    }

    public function deletenewsub($id)
    {
        DB::table('newsletters')->where('id', $id)->delete();
        $notification=array(
            'message'=>'Subscriber Deleted successfully',
            'alert-type'=>'success'
            );
return Redirect()->back()->with($notification);
    }







}
