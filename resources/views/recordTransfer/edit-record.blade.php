@extends('layouts.app')
@section('pageTitle', 'Edit Record Transfer')
@section('content')

    <!-- * =============== Main =============== * -->

    <main class="position-relative container form-content mt-4">
        <h1 class="text-center text-white text-uppercase">previous school</h1>
        <div class="form-wrap border bg-light py-5 px-25 dashboard-info">
            <form class="mb-0" method="post" action="{{ route('edit.record.store', $school_record->id) }}">
                @csrf
                <h2>Edit Previous School Record</h2>
                <input type="hidden" value="{{ $school_record->student_profile_id }}" name="student_id">
                <input type="hidden" value="{{ $school_record->parent_profile_id }}" name="parent_id">
                <div class="form-group d-sm-flex mb-2">

                    <label for="">School Name</label>
                    <div>
                        <input type="text" class="form-control" value="{{ $school_record->school_name }}"
                            name="school_name" placeholder="Name of School" required aria-describedby="" />
                    </div>
                </div>
                <div class="form-group d-sm-flex mb-2">
                    <label for="">Email Address</label>
                    <div>
                        <input type="email" class="form-control" value="{{ $school_record->email }}" name="email"
                            placeholder="Email Address of School" required aria-describedby="" />
                    </div>
                </div>
                <div class="form-group d-sm-flex mb-2">
                    <label for="">Fax Number</label>
                    <div>
                        <input type="text" class="form-control" value="{{ $school_record->fax_number }}" name="fax_number"
                            placeholder="Fax Number of School" required aria-describedby="" />
                    </div>
                </div>
                <div class="form-group d-sm-flex mb-2">
                    <label for="">Phone Number</label>
                    <div>
                        <input type="text" class="form-control" value="{{ $school_record->phone_number }}"
                            name="phone_number" placeholder="Phone Number of School" required aria-describedby="" />
                    </div>
                </div>
                <div class="form-group d-sm-flex mb-2">
                    <label for="">Street Address</label>
                    <div>
                        <input type="text" class="form-control" value="{{ $school_record->street_address }}"
                            name="street_address" placeholder="Street Address of School" required aria-describedby="" />
                    </div>
                </div>
                <div class="form-group d-sm-flex mb-2">
                    <label for="">City</label>
                    <div>
                        <input type="text" class="form-control" value="{{ $school_record->city }}" id="" name="city"
                            placeholder="City" required aria-describedby="" />
                    </div>
                </div>
                <div class="form-group d-sm-flex mb-2">
                    <label for="">State/Province/Region</label>
                    <div>
                        <input type="text" class="form-control" value="{{ $school_record->state }}" id="" name="state"
                            placeholder="State/Province/Region" required aria-describedby="" />
                    </div>
                </div>
                <div class="form-group d-sm-flex mb-2">
                    <label for="">Zip/Postal Code</label>
                    <div>
                        <input type="text" class="form-control" value="{{ $school_record->zip_code }}" id=""
                            name="zip_code" placeholder="Zip/Postal Code" required aria-describedby="" />
                    </div>
                </div>
                <div class="form-group d-sm-flex mb-2">
                    <label for="">Country</label>
                    <div>
                        <input type="text" class="form-control" value="{{ $school_record->country }}" id=""
                            name="country" placeholder="Country" required aria-describedby="" />
                    </div>
                </div>
                <div class="mt-4">
                    <a onclick="goBack()" role="button" class="btn btn-primary mr-2">Back</a>
                    <button class="btn btn-primary" type="submit" value="Submit">Submit</button>
                </div>
            </form>
        </div>
    </main>
@endsection
