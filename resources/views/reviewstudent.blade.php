@extends('layouts.app')

@section('content')
<main class="position-relative container form-content mt-4">
      <h1 class="text-center text-white text-uppercase">student enrollment</h1>
      <div class="form-wrap border bg-light py-5 px-25">
        <h2 class="h3">Review Student 1 Enrollment</h2>
        <form method="POST" action="" class="seperator pb-2">
          <div class="form-group d-sm-flex mb-2">
            <label for="">Student Name</label>
            <div>
              <p>{{$studentData ->first_name}}</p>
            </div>
          </div>
          <div class="form-group d-sm-flex mb-2">
            <label for="">Date of Birth</label>
            <div>
              <p>{{$studentData ->d_o_b->format('d M yy')}}</p>
            </div>
          </div>
          <div class="form-group d-sm-flex mb-2">
            <label for="">Email Address</label>
            <div>
              <p>{{$studentData ->email}}</p>
            </div>
          </div>
          <div class="form-group d-sm-flex mb-2">
            <label for="">Phone</label>
            <div>
              <p>{{$studentData ->cell_phone}}</p>
            </div>
          </div>
          <div class="form-group d-sm-flex mb-2">
            <label for="">Student ID</label>
            <div>
              <p>{{$studentData ->student_Id}}</p>
            </div>
          </div>
          @foreach($enrollPeriods as $enrollPeriod)
          <div class="form-group d-sm-flex mb-2">
            <label for="">Enrollment Period(s)</label>
            <div>
              <p>{{ Carbon\Carbon::parse($enrollPeriod->start_date_of_enrollment)->format('d M yy') }},{{ Carbon\Carbon::parse($enrollPeriod->end_date_of_enrollment)->format('d M yy') }}</p>

            </div>
          </div>
          <div class="form-group d-sm-flex mb-2">
            <label for="">Grade Level(s)</label>
            <div>
              <p>{{$enrollPeriod->grade_level}}</p>
            </div>
          </div>
          @endforeach
        </form>
        <div class="col-md-4">
          <h3 class="py-3">Fees</h3>
          <table class="px-0 w-100">
            <tbody>
              @foreach($periodInfo as $period)
              <tr>
                <td>{{$period->fee_structure_id == '1'?'Annual':'Semester'}} * {{$period->total}}</td>
                <td class="text-right">{{$period->fee_structure_id == 1?'$350':'$100'}}</td>
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <td>Total</td>
                <td class="text-right">{{$period->fee_structure_id==1?'$350':'$100'}}</td>
              </tr>
            </tfoot>
          </table>
          <div class="text-right mt-4">
            <a href="{{route('edit.student',$studentData->id)}}" class="btn btn-primary">Edit</a>
            <a href="#" class="btn btn-primary ml-3">Add to Cart</a>
          </div>
        </div>
    </main>
    @endsection
