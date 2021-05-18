@extends('admin.app')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@section('content')
    <section class="content">
        <div class="container-fluid position-relative">
            <h1>Student Details</h1>
            <div class="form-wrap border py-5 px-25 position-relative">
                <form method="post" class="row" action="{{ route('admin.edit-student.update', $student->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group col-sm-6">
                        <label>First/Given Name <sup>*</sup></label>
                        <input class="form-control" id="first_name" value="{{ $student->first_name }}" name="first_name">
                    </div>
                    <input type='hidden' name="parent_id" value="{{ $student->parent_profile_id }}">
                    <div class="form-group col-sm-6">
                        <label>Middle Name</label>
                        <input class="form-control" id="middle_name" name="middle_name"
                            value="{{ $student->middle_name }}">
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Last/Family Name <sup>*</sup></label>
                        <input class="form-control" id="last_name" name="last_name" value="{{ $student->last_name }}">
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Date of Birth<sup>*</sup></label>
                        <div class="position-relative w-100"> <i class="fas fa-calendar-alt" aria-hidden="true"></i><input
                                class="form-control datepicker" id="dob" name="dob"
                                value="{{ $student->d_o_b->format('M d Y') }}" required></div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Email Address</label>
                        <input class="form-control" name="email" id="email" value="{{ $student->email }}">
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Cell Phone<sup>*</sup></label>
                        <input class="form-control" id="cell_phone" name="cell_phone" value="{{ $student->cell_phone }}">
                    </div>
                    <div class="form-group col-sm-6">
                        <label>National ID<sup>*</sup></label>
                        <input class="form-control" id="student_id" name="student_id" value="{{ $student->student_Id }}">
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Immunization Status<sup>*</sup></label>
                        <select class="form-control" name="immunized_status" value="{{ $student->immunized_status }}">
                            <option>Yes, records will come with school records.</option>
                            <option>Yes, I will provide records.</option>
                            <option>Yes, I plan to get immunizations soon.</option>
                            <option>No, for personal reasons.</option>
                            <option>No, for medical reasons.</option>
                            <option>No, for religious reasons.</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-12">
                        <label>Student Situation</label>
                        <textarea class="form-control"  name="student_situation" value="{{ $student->student_situation }}">{{ $student->student_situation }}</textarea>
                    </div>
                    <div>
                    </div>
                    <label class="px-3">Enrollment Period <sup>*</sup></label>
                    @foreach ($enrollment_periods as $enrollment_period)
                        <div class="form-group w-100 row mx-0">
                            <input type="hidden" name="id[]" value="{{ $enrollment_period->id }}">
                            <div class="col-md-4 mb-4 mb-sm-0">
                                <label class="w-auto">Start Date </label>
                                <input class="datepicker form-control" id="start_date_of_enrollment" type="text"
                                    name="start_date[]"
                                    value="{{ Carbon\Carbon::parse($enrollment_period->start_date_of_enrollment)->format('M d Y') }}">
                            </div>
                            <div class="col-md-4  mb-4 mb-sm-0">
                                <label class="w-auto">End Date </label>
                                <input class="datepicker form-control" id="end_date_of_enrollment" type="text"
                                    name="end_date[]"
                                    value="{{ Carbon\Carbon::parse($enrollment_period->end_date_of_enrollment)->format('M d Y') }}">
                            </div>

                            <div class="col-md-4 mb-4 mb-sm-0">
                                <label class="w-auto">Grade Level</label>
                                <select name="grade[]" class="form-control">
                                    <option value="Ungraded" @if ($enrollment_period->grade_level == 'Ungraded') selected="selected" @endif>Ungraded</option>
                                    <option value="Preschool Age 3" @if ($enrollment_period->grade_level ==
        'Preschool
                                                                    Age 3') selected="selected" @endif>
                                        Preschool
                                        Age 3
                                    </option>

                                    <option value="Preschool Age 4" @if ($enrollment_period->grade_level ==
        'Preschool
                                                                    Age 4') selected="selected" @endif>
                                        Preschool
                                        Age 4
                                    </option>

                                    <option value="Kindergarten" @if ($enrollment_period->grade_level == 'Kindergarten') selected="selected" @endif>Kindergarten</option>

                                    <option class="form-control" value="1" @if ($enrollment_period->grade_level == '1') selected="selected" @endif>1</option>

                                    <option class="form-control" value="2" @if ($enrollment_period->grade_level == '2') selected="selected" @endif>2</option>

                                    <option class="form-control" value="3" @if ($enrollment_period->grade_level == '3') selected="selected" @endif>3</option>

                                    <option class="form-control" value="4" @if ($enrollment_period->grade_level == '4') selected="selected" @endif>4</option>

                                    <option class="form-control" value="5" @if ($enrollment_period->grade_level == '5') selected="selected" @endif>5</option>

                                    <option class="form-control" value="6" @if ($enrollment_period->grade_level == '6') selected="selected" @endif>6</option>

                                    <option class="form-control" value="7" @if ($enrollment_period->grade_level == '7') selected="selected" @endif>7</option>

                                    <option class="form-control" value="8" @if ($enrollment_period->grade_level == '8') selected="selected" @endif>8</option>

                                    <option class="form-control" value="9" @if ($enrollment_period->grade_level == '9') selected="selected" @endif>9</option>

                                    <option class="form-control" value="10" @if ($enrollment_period->grade_level == '10') selected="selected" @endif>10</option>

                                    <option class="form-control" value="11" @if ($enrollment_period->grade_level == '11') selected="selected" @endif>11</option>

                                    <option class="form-control" value="12" @if ($enrollment_period->grade_level == '12') selected="selected" @endif>12</option>
                                </select>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-md-6">
                        <label>Upload Single/Multiple Documents<sup>*</sup></label>
                        <label class="font-weight-bold text-secondary">
                        </label>
                        <input multiple="multiple" type="file" name="file[]" class="form-control choose-btn" multiple>
                    </div>
                    <!-- /.card-body -->
                    <div class="my-sm-4 my-3 col-12">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a type="button" href="{{ route('admin.genrate.adminConfirmition', $student->id) }}"
                            class="btn btn-primary ml-3">Generate Confirmation</a>
                        <a href="{{ route('admin.view-student') }}" class="btn btn-primary">Back</a>
                    </div>

            </div>
        </div>

        </form>
        </div>
        </div>

    </section>

@endsection
