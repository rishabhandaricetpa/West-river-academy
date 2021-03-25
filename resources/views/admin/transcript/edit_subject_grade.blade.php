@extends('admin.app')

@section('content')
<section class="content">
      <div class="container-fluid position-relative">
      <h1>Edit Subject Name</h1>
            <div class="form-wrap border py-5 px-25 position-relative">
              <form method="post" action="{{route('admin.score.update',[$subject_id,$transcript_id])}}">
                @csrf           
                <div class="card-body p-0">
                  <div class="form-group">
                    <label>Subject Name<sup>*</sup></label>
                    <input class="form-control" id="subject_name" value="{{$subjects->subject_name}}" name="subject_name">
                  </div>
                  <div class="form-group">
                    <label>Grade</label>
                    <input class="form-control" id="grade" value="{{$subjectDeatils->score}}" name="grade">
                  </div>
                <div class="col-sm-12 pl-0">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
            </div>
</section>
@endsection