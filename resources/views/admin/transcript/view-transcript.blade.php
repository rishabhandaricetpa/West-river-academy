@extends('admin.app')

@section('content')

<main class="position-relative container form-content mt-4">
    <h1 class="text-center text-white text-uppercase">Transcript Wizard</h1>
    <div class="form-wrap border bg-light py-5 px-25 mb-4">
        <h2 class="mb-3">{{$student->first_name}}</h2>
        <form method="POST" action="" class="mb-0">

            <div class="form-group d-sm-flex mb-2">
                <label for="">Name</label>
                <div>
                    {{$student->fullname}}
                </div>
            </div>
            <div class="form-group d-sm-flex mb-2">
                <label for="">Date of Birth</label>
                <div>
                    {{$student->d_o_b->format('d M Y ')}}
                </div>
            </div>
        </form>
    </div>
        @foreach($transcriptData as $school)
        <div class="form-wrap border bg-light py-5 px-25 mb-4">
        <a type="button" href="{{ url('admin/view-pdf',1)}}" class="btn btn-primary">Generate Unsigned Transcript</a>
        <a type="button" href="{{ url('admin/file-upload')}}" class="btn btn-primary">Upload Signed Transcript</a>
            <legend>{{$school->school_name}}</legend>
            <p>
                Academic School Year(s):{{$school->enrollment_year}}<br>
                Grade: {{$school->grade}}<br>
            </p>
            <table id="addressData" class="table table-bordered table-striped data-table"">
                <thead>
                    <tr>
                        <th>Courses</th>
                        <th>Subjects</th>
                        <th>Grade</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($school->TranscriptCourse as $course)
                    @foreach ($course->subjects as $subject)
                    <tr>

                        <td>
                            @php
                            $firstCourse = \Arr::first($course->course, function ($value, $key) use ($subject) {
                            return $value['id'] == $subject['courses_id'];
                            });
                            @endphp
                            {{$firstCourse->course_name}}
                        </td>
                        <td>{{$subject->subject_name}}</td>
                        <td>{{$course->score}}</td>
                        <td><button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#editGrades">Edit</button>
</td>
                    </tr>
                    @endforeach
                    @endforeach
                </tbody>
            </table>
                </form>
            </div>
        @endforeach
    </div>
</main>

<div class="modal fade" id="editGrades" tabindex="-1" role="dialog" aria-labelledby="editGradesLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3  id="moneygramModalLabel">Add New Address for Money Gram</h3>
      </div>
      <form method="post" action="{{route('admin.create.moneygram')}}">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Subjects<sup>*</sup></label>
                    <input  class="form-control" id="subject_name" value="" name="subject_name">
                  </div>
                  <div class="form-group">
                    <label>Grades</label>
                    <input  class="form-control" id="grades" name="grades" value="">
                  </div>
                <!-- /.card-body -->
      <div class="modal-footer py-3 px-0">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
