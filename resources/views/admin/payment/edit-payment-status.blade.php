@extends('admin.app')

@section('content')

    <section class="content">
        <div class="container-fluid position-relative">
            <h1>Student Payment Information</h1>
            <div class="form-wrap border py-5 px-25 position-relative">
                <!-- form start -->
                <h3 class="pr-3"><a
                    href="{{ route('admin.parent.edit',  $student->parent_profile_id) }}">View Parent</a>
                </h3>
                <h3>Payment Status of: {{ $student ? $student->fullname : '' }}</h3>
                <form method="post" class="row" action="{{ route('admin.update-payment', $enroll_payment->id) }}">
                    @csrf
                    <input type="hidden" name="parent_id" value="{{ $student->parent_profile_id }}">
                    <input type="hidden" name="student_name" value="{{ $student->fullname }}">
                    <div class="form-group col-sm-6">
                        <label>Grade Level <sup>*</sup></label>
                        <select name="grade_level" class="form-control" required>
                            <option value="Ungraded" @if ($enrollment_periods->grade_level == 'Ungraded') selected="selected" @endif>Ungraded</option>
                            <option value="Preschool Age 3" @if ($enrollment_periods->grade_level ==
        'Preschool
                                                                                    Age 3') selected="selected" @endif>
                                Preschool
                                Age 3
                            </option>

                            <option value="Preschool Age 4" @if ($enrollment_periods->grade_level ==
        'Preschool
                                                                                    Age 4') selected="selected" @endif>
                                Preschool
                                Age 4
                            </option>

                            <option value="Kindergarten" @if ($enrollment_periods->grade_level == 'Kindergarten') selected="selected" @endif>Kindergarten</option>

                            <option class="form-control" value="1" @if ($enrollment_periods->grade_level == '1') selected="selected" @endif>1</option>

                            <option class="form-control" value="2" @if ($enrollment_periods->grade_level == '2') selected="selected" @endif>2</option>

                            <option class="form-control" value="3" @if ($enrollment_periods->grade_level == '3') selected="selected" @endif>3</option>

                            <option class="form-control" value="4" @if ($enrollment_periods->grade_level == '4') selected="selected" @endif>4</option>

                            <option class="form-control" value="5" @if ($enrollment_periods->grade_level == '5') selected="selected" @endif>5</option>

                            <option class="form-control" value="6" @if ($enrollment_periods->grade_level == '6') selected="selected" @endif>6</option>

                            <option class="form-control" value="7" @if ($enrollment_periods->grade_level == '7') selected="selected" @endif>7</option>

                            <option class="form-control" value="8" @if ($enrollment_periods->grade_level == '8') selected="selected" @endif>8</option>

                            <option class="form-control" value="9" @if ($enrollment_periods->grade_level == '9') selected="selected" @endif>9</option>

                            <option class="form-control" value="10" @if ($enrollment_periods->grade_level == '10') selected="selected" @endif>10</option>

                            <option class="form-control" value="11" @if ($enrollment_periods->grade_level == '11') selected="selected" @endif>11</option>

                            <option class="form-control" value="12" @if ($enrollment_periods->grade_level == '12') selected="selected" @endif>12</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Start Date of Enrollment <sup>*</sup></label>
                        <input name="start_date_of_enrollment" id="start_date_of_enrollment" class="form-control datepicker"
                            value="{{ Carbon\Carbon::parse($enrollment_periods->start_date_of_enrollment)->format('M j, Y') }}"
                            required>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>End Date of Enrollment <sup>*</sup></label>
                        <input name="end_date_of_enrollment" id="end_date_of_enrollment" class="form-control datepicker"
                            value="{{ Carbon\Carbon::parse($enrollment_periods->end_date_of_enrollment)->format('M j, Y') }}"
                            required>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Amount <sup>*</sup></label>
                        <input class="form-control" type="number" id="amount" min="0"
                            value="{{ $enroll_payment->amount }}" name="amount" required>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Payment Status</label>
                        <select name="paymentStatus" class="form-control">
                            <option value="pending" @if ($enroll_payment->status == 'pending') selected="selected" @endif>Pending</option>
                            <option value="paid" @if ($enroll_payment->status == 'paid') selected="selected" @endif>Paid</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        @if (empty($enroll_payment->transcation_id))
                            <label>Transcation ID <sup>*</sup></label>
                            <input class="form-control" id="transcation_id" value="{{ $enroll_payment->transcation_id }}"
                                name="transcation_id">
                        @else
                            <label>Transcation ID <sup>*</sup></label>
                            <input class="form-control" id="transcation_id" value="{{ $enroll_payment->transcation_id }}"
                                name="transcation_id" readonly>
                        @endif

                    </div>
                    <div class="form-group col-sm-6">
                        @if (empty($enroll_payment->payment_mode))
                            <label>Payment Method <sup>*</sup></label>
                            <input class="form-control" id="payment_mode" value="{{ $enroll_payment->payment_mode }}"
                                name="payment_mode">
                        @else
                            <label>Payment Method<sup>*</sup></label>
                            <input class="form-control" id="payment_mode" value="{{ $enroll_payment->payment_mode }}"
                                name="payment_mode" readonly>
                        @endif
                    </div>
                    @if ($transactionData)
                        <div class="form-group col-sm-6">
                            <label>Coupon Applied<sup>*</sup></label>
                            <input name="coupon_code" id="coupon_code" class="form-control datepicker"
                                value="{{ $transactionData->coupon_code }}" disabled>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Coupon Amount<sup>*</sup></label>
                            <input name="coupon_amount" id="coupon_amount" class="form-control datepicker"
                                value="{{ $transactionData->coupon_amount }}" disabled>
                        </div>
                    @endif
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a onclick="goBack()" class="btn btn-primary">Back</a>
                    </div>
            </div>

            </form>
        </div>
        </div><!-- /.container-fluid -->
    </section>

@endsection
