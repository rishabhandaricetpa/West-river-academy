@extends('layouts.app')
@section('pageTitle', 'Record Transfer Previous School')
@section('content')

<main class="position-relative container form-content mt-4">
  <h1 class="text-center text-white text-uppercase">previous school</h1>
  <div class="form-wrap border bg-light py-5 px-25 dashboard-info">
    <form class="mb-0" method="post" action="{{route('record.store',[$student_id,$parent_id])}}">
      @csrf
      <h2>Previous School</h2>
      <div class="form-group d-sm-flex mb-2">
        <label for="">School Name</label>
        <div>
          <input type="text" class="form-control" id="" name="school_name" placeholder="Name of School" required aria-describedby="" />
        </div>
      </div>
      <div class="form-group d-sm-flex mb-2">
        <label for="">Email Address</label>
        <div>
          <input type="text" class="form-control" id="" name="email" placeholder="Email Address of School" required aria-describedby="" />
        </div>
      </div>
      <div class="form-group d-sm-flex mb-2">
        <label for="">Fax Number</label>
        <div>
          <input type="text" class="form-control" id="" name="fax_number" placeholder="Fax Number of School" required aria-describedby="" />
        </div>
      </div>
      <div class="form-group d-sm-flex mb-2">
        <label for="">Phone Number</label>
        <div>
          <input type="text" class="form-control" id="" name="phone_number" placeholder="Phone Number of School" required aria-describedby="" />
        </div>
      </div>
      <div class="form-group d-sm-flex mb-2">
        <label for="">Street Address</label>
        <div>
          <input type="text" class="form-control" id="" name="street_address" placeholder="Street Address of School" required aria-describedby="" />
        </div>
      </div>
      <div class="form-group d-sm-flex mb-2">
        <label for="">City</label>
        <div>
          <input type="text" class="form-control" id="" name="city" placeholder="City" required aria-describedby="" />
        </div>
      </div>
      <div class="form-group d-sm-flex mb-2">
        <label for="">State/Province/Region</label>
        <div>
          <input type="text" class="form-control" id="" name="state" placeholder="State/Province/Region" required aria-describedby="" />
        </div>
      </div>
      <div class="form-group d-sm-flex mb-2">
        <label for="">Zip/Postal Code</label>
        <div>
          <input type="text" class="form-control" id="" name="zip_code" placeholder="Zip/Postal Code" required aria-describedby="" />
        </div>
      </div>
      <div class="form-group d-sm-flex mb-2">
        <label for="">Country</label>
        <div>
          <input type="text" class="form-control" id="" name="country" placeholder="Country" required aria-describedby="" />
        </div>
      </div>
      <div class="mt-4">
        <a href="{{route('dashboard')}}" role="button" class="btn btn-primary mr-2">Back</a>
        <button class="btn btn-primary" type="submit" value="Submit">Submit</button>
      </div>
    </form>
  </div>
</main>
@endsection