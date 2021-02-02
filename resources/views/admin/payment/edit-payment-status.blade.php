@extends('admin.app')

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Student Payment Information</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{route('admin.update-payment',$enroll_payment->id)}}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Grade Level <sup>*</sup></label>
                                <select name="grade_level">
                                    <option value="Ungraded" @if($enrollment_periods->grade_level == 'Ungraded')
                                        selected="selected" @endif>Ungraded</option>
                                    <option value="Preschool Age 3" @if($enrollment_periods->grade_level== 'Preschool
                                        Age 3')
                                        selected="selected" @endif>Preschool Age 3</option>

                                    <option value="Preschool Age 4" @if($enrollment_periods->grade_level == 'Preschool
                                        Age 4')
                                        selected="selected" @endif>Preschool Age 4</option>

                                    <option value="Kindergarten" @if($enrollment_periods->grade_level == 'Kindergarten')
                                        selected="selected" @endif>Kindergarten</option>

                                    <option class="form-control" value="1" @if($enrollment_periods->grade_level == '1')
                                        selected="selected" @endif>1</option>

                                    <option class="form-control" value="2" @if($enrollment_periods->grade_level == '2')
                                        selected="selected" @endif>2</option>

                                    <option class="form-control" value="3" @if($enrollment_periods->grade_level == '3')
                                        selected="selected" @endif>3</option>

                                    <option class="form-control" value="4" @if($enrollment_periods->grade_level == '4')
                                        selected="selected" @endif>4</option>

                                    <option class="form-control" value="5" @if($enrollment_periods->grade_level == '5')
                                        selected="selected" @endif>5</option>

                                    <option class="form-control" value="6" @if($enrollment_periods->grade_level == '6')
                                        selected="selected" @endif>6</option>

                                    <option class="form-control" value="7" @if($enrollment_periods->grade_level == '7')
                                        selected="selected" @endif>7</option>

                                    <option class="form-control" value="8" @if($enrollment_periods->grade_level == '8')
                                        selected="selected" @endif>8</option>

                                    <option class="form-control" value="9" @if($enrollment_periods->grade_level == '9')
                                        selected="selected" @endif>9</option>

                                    <option class="form-control" value="10" @if($enrollment_periods->grade_level ==
                                        '10')
                                        selected="selected" @endif>10</option>

                                    <option class="form-control" value="11" @if($enrollment_periods->grade_level ==
                                        '11')
                                        selected="selected" @endif>11</option>

                                    <option class="form-control" value="12" @if($enrollment_periods->grade_level ==
                                        '12')
                                        selected="selected" @endif>12</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Start Date of Enrollment <sup>*</sup></label>
                                <input name="start_date_of_enrollment" class="form-control datepicker"
                                    value="{{$enrollment_periods->start_date_of_enrollment}}">
                            </div>
                            <div class="form-group">
                                <label>End Date of Enrollment <sup>*</sup></label>
                                <input name="end_date_of_enrollment" class="form-control datepicker"
                                    value="{{$enrollment_periods->end_date_of_enrollment}}">
                            </div>
                            <div class="form-group">
                                <label>Amount <sup>*</sup></label>
                                <input class="form-control" id="amount" value="{{$enroll_payment->amount}}"
                                    name="amount">
                            </div>
                            <div class="form-group">
                                <label>Payment Status</label>
                                <select name="paymentStatus">
                                    <option value="pending" @if($enroll_payment->status == 'pending')
                                        selected="selected" @endif>Pending</option>
                                    <option value="paid" @if($enroll_payment->status== 'paid')
                                        selected="selected" @endif>Paid</option>
                                    <option value="active" @if($enroll_payment->status == 'active')
                                        selected="selected" @endif>Active</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Transcation ID <sup>*</sup></label>
                                <input class="form-control" id="transcation_id"
                                    value="{{$enroll_payment->transcation_id}}" name="transcation_id" readonly>
                            </div>
                            <div class="form-group">
                                <label>Payment Mode <sup>*</sup></label>
                                <input class="form-control" id="payment_mode" value="{{$enroll_payment->payment_mode}}"
                                    name="payment_mode" readonly>
                            </div>
                        </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                </form>
            </div>
            <!-- /.card -->

            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!--/.col (right) -->
    </div>
    <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

@endsection