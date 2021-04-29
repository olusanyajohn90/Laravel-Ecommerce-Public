@extends('admin.admin_layouts')

@section('admin_content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">


  <div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>Blog Category Table</h5>

    </div><!-- sl-page-title -->

    <div class="card pd-20 pd-sm-40">
      <h6 class="card-body-title">Blog Category List
        <a href="#" class="btn btn-sm btn-warning" style="float: right;" data-toggle="modal" data-target="#modaldemo3">Add New Category</a>
        </h6>

      <div class="table-wrapper">
        <table id="datatable1" class="table display responsive nowrap">
          <thead>
            <tr>
              <th class="wd-15p"> ID </th>
              <th class="wd-15p">Category Name English</th>
              <th class="wd-15p">Category Name French</th>
              <th class="wd-20p">Action</th>

            </tr>
          </thead>
          <tbody>
              @foreach ($blogcat as $key=>$row)


            <tr>
              <td>{{ $key +1 }}</td>
              <td>{{ $row->category_name_en }}</td>
              <td>{{ $row->category_name_fr }}</td>
              <td>
                <a href="{{ URL::to('edit/blogcategory/'.$row->id) }} " class="btn btn-sm btn-info">Edit</a>
                    <a href="{{ URL::to('delete/blogcategory/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete">Delete</a>


              </td>

            </tr>
            @endforeach

          </tbody>
        </table>
      </div><!-- table-wrapper -->
    </div><!-- card -->



</div><!-- sl-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->


<!-- LARGE MODAL -->
<div id="modaldemo3" class="modal fade">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content tx-size-sm">
      <div class="modal-header pd-x-20">
        <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Add Category</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
      <form method="post" action="{{ route('store.blog.category') }}">
          @csrf
      <div class="modal-body pd-20">

            <div class="form-group">
              <label for="exampleInputEmail1">Category Name In English</label>
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Category Name In English" name="category_name_en">

            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Category Name In French</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Category Name In French" name="category_name_fr">
  
              </div>



      </div><!-- modal-body -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-info pd-x-20">Submit </button>
        <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal">Close</button>
      </div>
        </form>
    </div>
  </div><!-- modal-dialog -->
</div><!-- modal -->

@endsection
