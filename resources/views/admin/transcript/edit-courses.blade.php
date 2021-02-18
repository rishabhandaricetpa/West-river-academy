@extends('admin.app')

@section('content')
<div class="content-header">
    <div class="container-fluid position-relative">
                <h1>Subject : {{$coursename->course_name}} </h1>
            <div class="d-flex">
                <ol class="breadcrumb ml-auto">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Subjects</li>
                </ol>
            </div><!-- /.col -->
    </div><!-- /.container-fluid -->
</div> 
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- /.card-header -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> Subjects</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                    <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#addsubjectsModal">Add New Subject to {{$coursename->course_name}}</button>
                        <table id="addressData" class="table table-bordered table-striped data-table"">
                  <thead>
                  <tr>
                    <th>Subject Name</th>
                    <th>Grade Level</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($subjects as $subject)
                  <tr>
                  
                      <td>{{$subject->subject_name}}</td>
                      <td>{{$subject->transcript_period}}</td>
                            </td>
                            <td>
                                <a href="{{ url('admin/edit-subject',$subject->id)}}"><i class=" fas fa-edit"></i></a>
                                <a href="{{ url('admin/delete/subject',$subject->id)}}"><i class="fas fa-trash-alt"
                                    onclick="return myFunction();"></i></a>
                            </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
</section>

//add new Subject

<div class="modal fade" id="addsubjectsModal" tabindex="-1" role="dialog" aria-labelledby="addsubjectsModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3  id="moneygramModalLabel">Edit Subject Deatils</h3>
      </div>
      <form method="post" action="{{route('admin.create.subject',$coursename->id)}}">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Subject Name<sup>*</sup></label>
                    <input  class="form-control" id="subject_name" value="" name="subject_name">
                  </div>
                  <div class="form-group">
                    <label>Grade</label>
                    <select
                    class="form-control"
                    name="grade"
                    value=""
                    >
                    <option>Select Value</option>
                    <option>K - 8</option>
                    <option>9 - 12</option>
                    </select>
                  </div>
                <!-- /.card-body -->
        <div class="modal-footer py-3 px-0">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
</div>
@endsection
<script>
    function myFunction() {
      if(!confirm("Are You Sure to delete this"))
      event.preventDefault();
  }
</script>