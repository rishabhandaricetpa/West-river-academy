@extends('admin.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit Graduation</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <form action="{{ route('admin.update.graduation',$graduation->id) }}" method="post">
          @csrf
          @method('put')
          <div class="row form-group">
            <div class="col-4">
              Student Name: {{ $graduation->student->fullname }}
            </div>
            <div class="col-4">
              Student Email: {{ $graduation->student->email }}
            </div>
            <div class="col-4">
              Birthdate: {{ $graduation->student->birthdate }}
            </div>
          </div>
         
          <div class="row form-group">
            <div class="col-6">
              Parent Email : {{ $graduation->parent->p1_email }}
            </div>
            <div class="col-6">
              Country : {{ $graduation->parent->country }}
            </div>
          </div>

          <div class="row form-group">
            <div class="col-12">
              Grade Details :
              <ul>
                <li>Grade 9 : {{ $graduation->grade_9_info }}</li>
                <li>Grade 10 : {{ $graduation->grade_10_info }}</li>
                <li>Grade 11 : {{ $graduation->grade_11_info }}</li>
              </ul>
            </div>
          </div>

          <div class="row form-group">
            <div class="col-4">
              <label for="project">Project:</label>
              <input type="text" class="form-control" id="project" value="{{ $graduation->details->project }}" name="project">
            </div>
            
            <div class="col-4">
              <label for="diploma">Diploma:</label>
              <input type="text" class="form-control" id="diploma" value="{{ $graduation->details->diploma }}" name="diploma">
            </div>

            <div class="col-4">
              <label for="transcript">Transcript:</label>
              <input type="text" class="form-control" id="transcript" value="{{ $graduation->details->transcript }}" name="transcript">
            </div>
          </div>

          <div class="row form-group">
            <div class="col-4">
              <label for="records">Records Received:</label>
              <input type="text" class="form-control" id="records" value="{{ $graduation->details->record_received }}" name="record_received">
            </div>
            
            <div class="col-4">
              <label for="grad_date">Expected Grad Date:</label>
              <input type="date" class="form-control" id="grad_date" value="{{ $graduation->details->grad_date }}" name="grad_date">
            </div>

            <div class="col-4">
              <label for="apostille_package">Apostille Package:</label>
              <input type="text" class="form-control" id="apostille_package" value="{{ $graduation->details->apostille_package }}" name="apostille_package">
            </div>
          </div>

          <div class="row form-group">
            <div class="col-8">
              <label for="notes">Notes:</label>
              <input type="text" class="form-control" id="notes" value="{{ $graduation->details->notes }}" name="notes">
            </div>
          </div>

          <div class="row form-group">
            <div class="col-8 ">
              <label for="situation">Situation/Updates:</label>
              <textarea name="situation" class="w-100" id="situation" cols="80" rows="4">{{ $graduation->details->situation }}</textarea>
            </div>
          </div>

          <div class="row form-group">
            <div class="col-4">
              <label for="status">status:</label>
              <select class="form-control" name="status" id="status">
                  <option @if($graduation->status === 'pending') @endif value="pending">Pending Approval</option>
                  <option @if($graduation->status === 'approved') @endif value="approved">Approved</option>
                  <option @if($graduation->status === 'paid') @endif value="paid">Paid</option>
                  <option @if($graduation->status === 'completed') @endif value="completed">Completed</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <input type="submit" class="btn btn-success" value="Update">
          </div>
        </form>

      </div>
    </section>
  <!-- /.content -->
@endsection