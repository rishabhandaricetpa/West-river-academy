@extends('admin.app')

@section('content')
<!-- Content Header (Page header) -->
<!-- Content Wrapper. Contains page content -->

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid position-relative">
    <h1>Transcript List K-8</h1>
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <!-- /.card-header -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"></h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped data-table">
              <thead>
                <tr>
                  <th>Student Name</th>
                  <th>Country</th>
                  <th>grade</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
             
                @foreach ($transcript_data as $transcripts)
                <tr>

                  <td>{{     getStudentData($transcripts[0]['student_profile_id']);}}</td>
                  {{-- <td><a class="transform-none" href="mailto:${{ $student->email }}">
                      {{ $student->transcript_id }}</a></td> --}}
                  {{-- <td>{{ $transcripts->transcript_id }}</td>--}}
                  <td>{{getStudentGrade($transcripts)}}</td>
               
                  <td>{{ $transcripts[0]['country']}}</td>
                 
                  {{-- @if ($type == 'k-8') --}}
                  <td>
                    <a href=" {{ route('admin.viewfull.transcript', [$transcripts[0]['student_profile_id'],$transcripts[0]['transcript_id']]) }}">
                      <i class="fas fa-arrow-alt-circle-right"></i></a>
                  </td>
                  {{-- @else
                  <td>
                    <a href=" {{ route('admin.edit.transcript9_12', $student->id) }}">
                      <i class="fas fa-arrow-alt-circle-right"></i></a>
                  </td>
                  @endif --}}

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
</div>
<!-- /.content -->
@endsection
<script>
  function myFunction() {
    if (!confirm("Are You Sure to delete this"))
      event.preventDefault();
  }

</script>
