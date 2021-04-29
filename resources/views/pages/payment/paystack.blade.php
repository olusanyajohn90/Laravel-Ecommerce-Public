@extends('layouts.app')

@section('content')
@include('layouts.menubar')

@php
$setting = DB::table('settings')->first();
$charge = $setting->shipping_charge;
$vat = $setting->vat;
$cart = Cart::Content();
@endphp


<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/contact_styles.css') }} ">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/contact_responsive.css') }}">



<div class="contact_form">
        <div class="container">
            <div class="row">
                <div class="col-lg-7" style="border: 1px solid grey; padding: 20px; border-radius: 25px;">
                    <div class="contact_form_container">
                        <div class="contact_form_title text-center">Cart Products</div>


                          <div class="cart_items">
                            <ul class="cart_list">

                              @foreach($cart as $row)

        <li class="cart_item clearfix">



            <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">

                 <div class="cart_item_name cart_info_col">
                    <div class="cart_item_title"><b>Product Image</b></div>
                    <div class="cart_item_text"><img src="{{ asset($row->options->image) }} " style="width: 70px; width: 70px;" alt=""></div>
                </div>


                <div class="cart_item_name cart_info_col">
                    <div class="cart_item_title"><b>Name</b></div>
                    <div class="cart_item_text">{{ $row->name  }}</div>
                </div>

                @if($row->options->color == NULL)

                @else
                <div class="cart_item_color cart_info_col">
                    <div class="cart_item_title"><b>Color</b></div>
                    <div class="cart_item_text"> {{ $row->options->color }}</div>
                </div>
                 @endif


                @if($row->options->size == NULL)

                @else
                <div class="cart_item_color cart_info_col">
                    <div class="cart_item_title"><b>Size</b></div>
                    <div class="cart_item_text"> {{ $row->options->size }}</div>
                </div>
                @endif


                <div class="cart_item_quantity cart_info_col">
                    <div class="cart_item_title"><b>Quantity</b></div>
                 <div class="cart_item_text"> {{ $row->qty }}</div>

                </div>



                <div class="cart_item_price cart_info_col">
                    <div class="cart_item_title"><b>Price</b></div>
                    <div class="cart_item_text">#{{ $row->price }}</div>
                </div>
                <div class="cart_item_total cart_info_col">
                    <div class="cart_item_title"><b>Total</b></div>
                    <div class="cart_item_text">#{{ $row->price*$row->qty }}</div>
                </div>


            </div>
        </li>
                                @endforeach
                            </ul>
                        </div>

        <ul class="list-group col-lg-8" style="float: right;">
            @if(Session::has('coupon'))
            <li class="list-group-item">Subtotal : <span style="float: right;">
            ${{ Session::get('coupon')['balance'] }} </span> </li>
             <li class="list-group-item">Coupon : ({{ Session::get('coupon')['name'] }} )
              <a href="{{ route('coupon.remove') }}" class="btn btn-danger btn-sm">X</a>
           <span style="float: right;">#{{ Session::get('coupon')['discount'] }} </span> </li>
            @else
            <li class="list-group-item">Subtotal : <span style="float: right;">
            #{{  Cart::Subtotal() }} </span> </li>
            @endif



            <li class="list-group-item">Shiping Charge : <span style="float: right;">#{{ $charge  }} </span> </li>
            <li class="list-group-item">Vat : <span style="float: right;">#{{ $vat }} </span> </li>
            @if(Session::has('coupon'))
            <li class="list-group-item">Total : <span style="float: right;">#{{ Session::get('coupon')['balance'] + $charge + $vat }} </span> </li>
            @else
      <li class="list-group-item">Total : <span style="float: right;">#{{ Cart::Subtotal() + $charge + $vat }} </span> </li>
            @endif

          </ul>



                    </div>
                </div>





<div class="col-lg-5" style="border: 1px solid grey; padding: 20px; border-radius: 25px;">
                    <div class="contact_form_container">
                        <div class="contact_form_title text-center">Pay Now</div>





<form method="POST" action="{{ route('pay') }}" id="paymentForm">
    {{ csrf_field() }}


    <input type="hidden" name="shipping" value="{{ $charge }} ">
    <input type="hidden" name="vat" value="{{ $vat }} ">
    <input type="hidden" name="amount" value="{{ Cart::Subtotal() + $charge + $vat }} ">

<input type="hidden" name="ship_name" value="{{ $data['name'] }} ">
<input type="hidden" name="ship_phone" value="{{ $data['phone'] }} ">
<input type="hidden" name="email" value="{{ $data['email'] }} ">
<input type="hidden" name="ship_address" value="{{ $data['address'] }} ">
<input type="hidden" name="ship_city" value="{{ $data['city'] }} ">
<input type="hidden" name="payment_type" value="{{ $data['payment'] }} ">


<input type="hidden" name="payment_method" value="both" /> <!-- Can be card, account, both -->
<input type="hidden" name="country" value="NG" /> <!-- Replace the value with your transaction country -->
<input type="hidden" name="currency" value="NGN" /> <!-- Replace the value with your transaction currency -->
<input type="hidden" name="firstname" value="{{ $data['name'] }}" /> <!-- Replace the value with your customer firstname -->
<input type="hidden" name="phonenumber" value="{{ $data['phone'] }}" />
    <input type="submit" value="Buy"  />
</form>

                    </div>
                </div>







            </div>
        </div>
        <div class="panel"></div>
    </div>












@endsection