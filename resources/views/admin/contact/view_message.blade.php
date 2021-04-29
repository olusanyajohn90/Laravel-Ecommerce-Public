@extends('admin.admin_layouts')

@section('admin_content')

 <div class="sl-mainpanel">
      <div class="sl-pagebody">

      <div class="card pd-20 pd-sm-40">
          <h6 class="card-body-title">Message Details  </h6>


  <div class="row">
  	<div class="col-md-6">
            <div class="card">
                <div class="card-header"><strong>Message</strong> Details</div>
         <div class="card-body">
         	<table class="table">
         		<tr>
         	<th> Name: </th>
         	<th> {{ $messages->name }} </th>
         		</tr>

         		<tr>
         	<th> Phone: </th>
         	<th> {{ $messages->phone }} </th>
         		</tr>



         		<tr>
         	<th> Email: </th>
         	<th>{{ $messages->email }} </th>
         		</tr>



         		<tr>
         	<th> Message: </th>
         	<th> {{ $messages->message }} </th>
         		</tr>




         	</table>


         </div>



         </div>
    </div>






  </div>












     </div>
   </div>
</div>
 @endsection
