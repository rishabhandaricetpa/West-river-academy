@extends('admin.app')

@section('content')
<div class="container-fluid position-relative">
  <h1>Edit Graduation Information</h1>
  <div class="form-wrap border py-5 px-25 position-relative">
    <form action="{{ route('admin.update.graduation',$graduation->id) }}" class="row" method="post">
      @csrf
      @method('put')
      <div class="form-group col-sm-6">
        Student Name: {{ $graduation->student->fullname }}
      </div>
     
      <div class="form-group col-sm-6">
        Student Email: {{ $graduation->student->email }}
      </div>
   
      <div class="form-group col-sm-6">
        Birthdate: {{ $graduation->student->birthdate }}
      </div>

      <div class="form-group col-sm-6">
        Parent Email : {{ $graduation->parent->p1_email }}
      </div>

      <div class="form-group col-sm-6">
        Grade Details :
        <ul>
          <li>Grade 9 : {{ $graduation->grade_9_info }}</li>
          <li>Grade 10 : {{ $graduation->grade_10_info }}</li>
          <li>Grade 11 : {{ $graduation->grade_11_info }}</li>
        </ul>
      </div>

      <div class="form-group col-sm-6">
        Country : {{ $graduation->parent->country }}
      </div>

      <div class="form-group col-sm-6">
        <label for="project">Project:</label>
        <input type="text" class="form-control" id="project" value="{{ $graduation->details->project }}" name="project">
      </div>
      <div class="form-group col-sm-6">
        <label for="diploma">Diploma:</label>
        <input type="text" class="form-control" id="diploma" value="{{ $graduation->details->diploma }}" name="diploma">
      </div>

      <div class="form-group col-sm-6">
        <label for="transcript">Transcript:</label>
        <input type="text" class="form-control" id="transcript" value="{{ $graduation->details->transcript }}"
          name="transcript">
      </div>

      <div class="form-group col-sm-6">
        <label for="records">Records Received:</label>
        <input type="text" class="form-control" id="records" value="{{ $graduation->details->record_received }}"
          name="record_received">
      </div>

      <div class="form-group col-sm-6">
        <label for="grad_date">Expected Grad Date:</label>
        <input type="date" class="form-control" id="grad_date" value="{{ $graduation->details->grad_date }}"
          name="grad_date">
      </div>

      <div class="form-group col-sm-6">
        <label for="apostille_package">Apostille Package:</label>
        <input type="text" class="form-control" id="apostille_package" value="{{ $graduation->details->apostille_package }}"
          name="apostille_package">
      </div>

      <div class="form-group col-sm-8">
        <label for="notes">Notes:</label>
        <input type="text" class="form-control" id="notes" value="{{ $graduation->details->notes }}" name="notes">
      </div>

      <div class="form-group col-sm-8">
        <label for="situation">Situation/Updates:</label>
        <textarea name="situation" class="w-100" id="situation" cols="80"
          rows="4">{{ $graduation->details->situation }}</textarea>
      </div>

      <div class="form-group col-sm-4">
        <label for="status">status:</label>
        <select class="form-control" name="status" id="status">
          <option @if($graduation->status === 'pending')  selected @endif value="pending">Pending Approval</option>
          <option @if($graduation->status === 'approved')  selected @endif value="approved">Approved</option>
          <option @if($graduation->status === 'paid')  selected @endif value="paid">Paid</option>
          <option @if($graduation->status === 'completed')  selected @endif value="completed">Completed</option>
        </select>
      </div>

      <div class="col-sm-12">
        <input type="submit" class="btn btn-primary" value="Update">
      </div>
    </form>
  </div>
</div>
</section>
<!-- /.content -->
@endsection