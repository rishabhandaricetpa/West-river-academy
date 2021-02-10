@extends('admin.app')

@section('content')


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- /.card-header -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> Subject</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped data-table"">
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
                                <a href=""><i class=" fas fa-edit"
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
@endsection