@extends('admin.app')

@section('content')
    <div class="container-fluid position-relative">
        <h1> Graduation Information</h1>
        <div class="form-wrap border py-5 px-25 position-relative">
            <form action="{{ route('admin.update.graduation', $graduation->id) }}" class="row" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="form-group col-sm-6">
                    Student Name: <a href="{{ route('admin.edit-student', $graduation->student_profile_id) }}">
                        {{ $graduation->student->fullname }}
                    </a>
                </div>

                <div class="form-group col-sm-6">
                    Student Email: <a class="transform-none" href="mailto:{{ $graduation->student->email }}">
                        {{ $graduation->student->email }}</a>
                </div>

                <div class="form-group col-sm-6">
                    Birthdate: {{ Carbon\Carbon::parse($graduation->student->birthdate)->format('M j, Y') }}
                </div>

                <div class="form-group col-sm-6">
                    Parent Email: <a class="transform-none"
                        href="mailto:{{ $graduation->parent->p1_email }}">{{ $graduation->parent->p1_email }}</a>
                </div>

                <div class="form-group col-sm-6">
                    Grade Details :
                    <ul>
                        <li>Grade 9: {{ $graduation->grade_9_info }}</li>
                        <li>Grade 10: {{ $graduation->grade_10_info }}</li>
                        <li>Grade 11: {{ $graduation->grade_11_info }}</li>
                    </ul>
                </div>

                <div class="form-group col-sm-6">
                    Country: {{ $graduation->parent->country }}
                </div>

                <div class="form-group col-sm-6">
                    <label for="project">Project:</label>
                    <input type="text" class="form-control" id="project" value="{{ $graduation->details->project }}"
                        name="project">
                </div>
                <div class="form-group col-sm-6">
                    <label for="diploma">Diploma:</label>
                    <input type="text" class="form-control" id="diploma" value="{{ $graduation->details->diploma }}"
                        name="diploma">
                </div>

                <div class="form-group col-sm-6">
                    <label for="transcript">Transcript:</label>
                    <input type="text" class="form-control" id="transcript"
                        value="{{ $graduation->details->transcript }}" name="transcript">
                </div>

                <div class="form-group col-sm-6">
                    <label for="records">Records Received:</label>
                    <input type="text" class="form-control" id="records"
                        value="{{ $graduation->details->record_received }}" name="record_received">
                </div>

                <div class="form-group col-sm-6">
                    <label for="grad_date">Expected Grad Date:</label>
                    <input type="datepicker" class=" datepicker form-control" id="grad_date"
                        value="{{ Carbon\Carbon::parse($graduation->details->grad_date)->format('M j, Y') }}"
                        name="grad_date">
                </div>

                <div class="form-group col-sm-6">
                    <label for="apostille_package">Apostille Package:</label>
                    <input type="text" class="form-control" id="apostille_package"
                        value="{{ $graduation->details->apostille_package }}" name="apostille_package">
                </div>

                <div class="form-group col-sm-6">
                    <label for="notes">Notes:</label>
                    <input type="text" class="form-control" id="notes" value="{{ $graduation->details->notes }}"
                        name="notes">
                </div>



                <div class="form-group col-sm-6">
                    <label for="status">Status:</label>
                    <select class="form-control" name="status" id="status">
                        <option @if ($graduation->status === 'pending') selected @endif value="pending">Pending Approval</option>
                        <option @if ($graduation->status === 'approved') selected @endif value="approved">Approved</option>
                        <option @if ($graduation->status === 'paid') selected @endif value="paid">Paid</option>
                        <option @if ($graduation->status === 'completed') selected @endif value="completed">Completed</option>
                    </select>
                </div>
                <div class="form-group col-sm-6">
                    <label for="situation">Situation/Updates:</label>
                    <textarea name="situation" class="w-100" id="situation" cols="80" rows="4" maxlength="2000"
                        onKeyPress="if(this.value.length==2000) return false;">{{ $graduation->details->situation }}</textarea>
                </div>
                <div class=" form-group col-sm-6">
                    <label>Upload Single/Multiple Documents<sup>*</sup></label>
                    <input multiple="multiple" type="file" name="file[]" class="form-control choose-btn" multiple>
                </div>


                <div class="col-sm-12 mt-md-4 mt-3">
                    <input type="submit" class="btn btn-primary" value="Update">
                    <a onclick="goBack()" class="btn btn-primary">Back</a>
                </div>
            </form>
        </div>
    </div>
    </section>
    <!-- /.content -->
@endsection
