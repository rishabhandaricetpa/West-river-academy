@extends('layouts.app')

@section('content')
<main class="position-relative container form-content mt-4">
  <h1 class="text-center text-white text-uppercase">student enrollment</h1>
  <div class="form-wrap border bg-light py-5 px-25">
    <h2 class="h3">Review Student Enrollment</h2>
    <form method="POST" action="" class="seperator pb-2">
      @foreach($students as $key=>$student)
      <h3> Student Profile {{++$key}}</h3>
      <div class="form-group d-sm-flex mb-2">
        <label for="">Student Name</label>
        <div>
          <p>{{$student ->first_name}}</p>
        </div>
      </div>
      <div class="form-group d-sm-flex mb-2">
        <label for="">Date of Birth</label>
        <div>
          <p>{{$student ->d_o_b->format('M j, Y' )}}</p>
        </div>
      </div>
      <div class="form-group d-sm-flex mb-2">
        <label for="">Email Address</label>
        <div>
          <p>{{$student ->email}}</p>
        </div>
      </div>
      <div class="form-group d-sm-flex mb-2">
        <label for="">Phone</label>
        <div>
          <p>{{$student ->cell_phone}}</p>
        </div>
      </div>
      <div class="form-group d-sm-flex mb-2">
        <label for="">Student ID</label>
        <div>
          <p>{{$student ->student_Id}}</p>
        </div>
      </div>
      <a href="{{route('edit.student',$student->id)}}" class="btn btn-primary">Edit Student {{$key}} </a>
      @endforeach
    </form>
    <div class="col-md-6">
      <h3 class="py-3">Fees</h3>
      <form method="POST" action="{{route('add.cart')}}">
        @csrf
        <input type="hidden" name="type" value="enrollment_period">
        <table class="px-0 w-100">
          <thead>
            <tr>
              <th></th>
              <th>Name</th>
              <th>Enrollment Period</th>
              <th>Amount</th>
            </tr>
          </thead>
          <tbody>
            @php
                $total_amount = 0;
            @endphp
            @foreach ($fees as $fee)
              <tr>
                <td style="min-width: 2rem; text-align:center"> <input type="checkbox" name="eps[]" checked value="{{ $fee->id }}"> </td>
                <td>{{ $fee->first_name }}</td>
                <td class="ml-2">  
                  @if ($fee->type == 'annual') Annual  @else Second Semester Only @endif
                  <span class="small"> ({{ Carbon\Carbon::parse($fee->start_date_of_enrollment)->format('d M Y') }} - {{ Carbon\Carbon::parse($fee->end_date_of_enrollment)->format('d M Y') }} ) </span>
                </td>
                <td class="text-center">${{ $fee->amount }}</td>
                @php
                    $total_amount += $fee->amount;
                @endphp
              </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <td></td>
              <td></td>
              <td class="text-center">Total to pay </td>
              <td class="text-center"> ${{ $total_amount }}</td>
            </tr>
          </tfoot>
        </table>
        <div class="text-right mt-4">
          <a href="/enroll-student" class="btn btn-primary">Add Another Student</a>
          <button type="submit" class="btn btn-primary ml-3"> Add selected items to Cart </button>
        </div>
      </form>
    </div>
</main>
@endsection
