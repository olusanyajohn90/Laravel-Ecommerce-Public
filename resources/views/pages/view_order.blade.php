@extends('layouts.app')
@section('content')




<div class="contact_form">
  <div class="container">
    <div class="row">
      <div class="col-9 card">
        <table class="table">

            <tr>
                <th>Payment Details </th>

                    </tr>

            <tr>
        <th> Name: </th>
        <th> {{ $order->name }} </th>
            </tr>

            <tr>
        <th> Phone: </th>
        <th> {{ $order->phone }} </th>
            </tr>



            <tr>
        <th> Payment Type: </th>
        <th>{{ $order->payment_type }} </th>
            </tr>



            <tr>
        <th> Payment Id: </th>
        <th> {{ $order->payment_id }} </th>
            </tr>


            <tr>
        <th> Total : </th>
        <th># {{ $order->total }}  </th>
            </tr>

            <tr>
        <th> Month: </th>
        <th> {{ $order->month }} </th>
            </tr>

                <tr>
        <th> Date: </th>
        <th> {{ $order->date }} </th>
            </tr>

        </table>



        <table class="table">

            <tr>
                <th> Shipping Details: </th>

                    </tr>

            <tr>
        <th> Name: </th>
        <th> {{ $shipping->ship_name }} </th>
            </tr>

            <tr>
        <th> Phone: </th>
        <th> {{ $shipping->ship_phone }} </th>
            </tr>



            <tr>
        <th> Email: </th>
        <th>{{ $shipping->ship_email }} </th>
            </tr>



            <tr>
        <th> Address: </th>
        <th> {{ $shipping->ship_address }} </th>
            </tr>


            <tr>
        <th> City : </th>
        <th> {{ $shipping->ship_city }} </th>
            </tr>

            <tr>
        <th> Status: </th>
        <th>
        @if($order->status == 0)
        <span class="badge badge-warning">Pending</span>
        @elseif($order->status == 1)
        <span class="badge badge-info">Payment Accepted</span>
       @elseif($order->status == 2)
       <span class="badge badge-warning">Progress</span>
       @elseif($order->status == 3)
       <span class="badge badge-success">Delevered</span>
       @else
       <span class="badge badge-danger">Cancled</span>

        @endif

         </th>

            </tr>


        </table>





        <table class="table display responsive nowrap">
            <thead>

                <tr>
                    <th> Order Details: </th>

                        </tr>
              <tr>
                <th class="wd-15p">Product ID</th>
                <th class="wd-15p">Product Name</th>
                <th class="wd-15p">Image</th>
                <th class="wd-15p">Color</th>
                <th class="wd-15p">Size</th>
                <th class="wd-15p">Quantity</th>
                <th class="wd-15p">Unit Price</th>
                <th class="wd-20p">Total</th>

              </tr>
            </thead>
            <tbody>
              @foreach($details as $row)
              <tr>
                <td>{{ $row->product_code }}</td>
                <td>{{ $row->product_name }}</td>

           <td> <img src="{{ URL::to($row->image_one) }}" height="50px;" width="50px;"> </td>
               <td>{{ $row->color }}</td>
               <td>{{ $row->size }}</td>
               <td>{{ $row->quantity }}</td>
               <td># {{ $row->singleprice }}</td>
               <td># {{ $row->totalprice }}</td>

              </tr>
              @endforeach

            </tbody>
          </table>
      </div>

      <div class="col-3">
        <div class="card">
          <img src="{{ asset('public/frontend/images/avatar.jpg') }}" class="card-img-top" style="height: 90px; width: 90px; margin-left: 34%;">
          <div class="card-body">
            <h5 class="card-title text-center">{{ Auth::user()->name }}</h5>

          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item"> <a href="{{ route('password.change') }}">Change Password</a>  </li>
             <li class="list-group-item">Edit Profile</li>
              <li class="list-group-item"><a href="{{ route('success.orderlist') }}"> Return Order</a> </li>
          </ul>

          <div class="card-body">
            <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">Logout</a>

          </div>

        </div>

      </div>

    </div>

  </div>


</div>





@endsection
