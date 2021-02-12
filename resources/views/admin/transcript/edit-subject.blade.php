@extends('admin.app')

@section('content')
<section class="content">
      <div class="container-fluid position-relative">
      <h1>Edit Subject Name</h1>
            <div class="form-wrap border py-5 px-25 position-relative">
              <form method="post" class="row" action="{{url('admin/update/subject',$name->id)}}">
                @csrf           
                <form method="" action="">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Subject Name<sup>*</sup></label>
                    <input class="form-control" id="subject_name" value="{{$name->subject_name}}" name="subject_name">
                  </div>
                  <div class="form-group">
                    <label>Grade</label>
                    <input class="form-control" id="grade" value="{{$name->transcript_period}}" name="grade">
                  </div>
  
                <div class="col-sm-12">
                  <button type="submit" class="btn btn-primary">Update</button>
                  <a href="/admin/manage-courses" class="btn btn-primary">Back</a>
                </div>
              </form>
            </div>
            <!-- /.card -->

              <!-- /.card-body -->
            </div>
            <!-- /.card -->
      </div><!-- /.container-fluid -->
</section>

@endsection


