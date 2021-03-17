@extends('layouts.app')
@section('pageTitle', 'Dashbord')
@section('content')

<main class="position-relative container form-content mt-4">
   <h1 class="text-center text-white text-uppercase">dashboard</h1>
   <div class="form-wrap border bg-light py-5 px-25 mb-4">
      <h2 class="mb-5">What would you like to do?</h2>
      <div class="row dashboard-options">
         <div class="col-md-3 col-sm-6 text-center">
            <a href="https://www.westriveracademy.com/schedule-a-call/" class="d-inline-block mb-5 decoration-none">
               <i class="fas fa-comments rounded-circle circled-grid fa-2x text-secondary"></i>
               <h3 class="mt-3 text-black font-weight-normal">Order a Personal Consultation</h3>
            </a>
         </div>
         <div class="col-md-3 col-sm-6 text-center">
            <a href="/orderpostage" class="d-inline-block mb-5 decoration-none">
               <i class="fas fa-stamp rounded-circle circled-grid fa-2x text-secondary"></i>
               <h3 class="mt-3 text-black font-weight-normal">Order Postage</h3>
            </a>
         </div>
         <div class="col-md-3 col-sm-6 text-center">
            <a href="https://www.idcreator.com/custom-id-designs/westriveracademy-id-card.html" class="d-inline-block mb-5 decoration-none">
               <i class="fas fa-id-card-alt rounded-circle circled-grid fa-2x text-secondary"></i>
               <h3 class="mt-3 text-black font-weight-normal">Order a Student ID Card</h3>
            </a>
         </div>
         <div class="col-md-3 col-sm-6 text-center">
            <a href="{{ route('notarization')}}" class="d-inline-block mb-5 decoration-none">
               <i class="fas fa-file-alt rounded-circle circled-grid fa-2x text-secondary"></i>
               <h3 class="mt-3 text-black font-weight-normal">Order an Apostille or Notarization</h3>
            </a>
         </div>
         <div class="col-md-3 col-sm-6 text-center">
            <a href="{{ route('custom.payment')}}" class="d-inline-block mb-5 decoration-none">
               <i class="fas fa-credit-card rounded-circle circled-grid fa-2x text-secondary"></i>
               <h3 class="mt-3 text-black font-weight-normal">Make a Custom Payment</h3>
            </a>
         </div>
         <div class="col-md-3 col-sm-6 text-center">
            <a href="{{route('order-transcript',Auth::user()->id)}}" class="d-inline-block mb-5 decoration-none">
               <i class="fas fa-graduation-cap rounded-circle circled-grid fa-2x text-secondary"></i>
               <h3 class="mt-3 text-black font-weight-normal">Purchase a Transcript </h3>
            </a>
         </div>
         <div class="col-md-3 col-sm-6 text-center">
            <a href="{{ route('graduation.apply') }}" class="d-inline-block mb-5 decoration-none">
               <i class="fas fa-graduation-cap rounded-circle circled-grid fa-2x text-secondary"></i>

               <h3 class="mt-3 text-black font-weight-normal">Apply for Graduation</h3>
            </a>
         </div>
         <div class="col-md-3 col-sm-6 text-center">
            <a href="{{ route('custom.letter')}}" class="d-inline-block mb-5 decoration-none">
               <i class="fas fa-clipboard rounded-circle circled-grid fa-2x text-secondary"></i>
               <h3 class="mt-3 text-black font-weight-normal">Order a Custom Letter</h3>
            </a>
         </div>
         <div class="col-md-3 col-sm-6 text-center">
            <a href="{{ route('reviewstudent') }}" class="d-inline-block mb-5 decoration-none">
               <i class="fas fa-sync rounded-circle circled-grid fa-2x text-secondary"></i>
               <h3 class="mt-3 text-black font-weight-normal">Renew my Family’s Enrollment</h3>
            </a>
         </div>
         <div class="col-md-3 col-sm-6 text-center">
            <a href="{{ url('/enroll-student')}}" class="d-inline-block mb-5 decoration-none">
               <i class="fas fa-user-graduate rounded-circle circled-grid fa-2x text-secondary"></i>
               <h3 class="mt-3 text-black font-weight-normal">Enroll a new Student in my Family</h3>
            </a>
         </div>
         <div class="col-sm-12">
            <p>Needs Help? Check out our <a href="#">Dashboard Tuorial </a> <span class="px-4">or</span><a href="#" role="button" class="btn btn-primary"> Help me decide</a></p>
         </div>
      </div>
   </div>
   <div class="form-wrap border bg-light py-5 px-25 mb-4">
      <h2 class="mb-3">Transcripts</h2>
      <p>Use the Edit Transcript link to edit your transcript. When a transcript is completed there will be a link to download it.</p>

      <div class="overflow-auto max-table mb-2">
         <table class="table-styling w-100">
            <thead>
               <tr>
                  <th>Student</th>
                  <th>Status</th>
                  <th>Edit Transcript</th>
                  <th>Download</th>
               </tr>
            </thead>
            <tbody>
               @foreach($transcript as $transcriptData)
               <tr>
                  <td>{{$transcriptData['student']['fullname']}}</td>
                  @if($transcriptData->status === 'paid')
                  <td>Paid</td>
                  @elseif($transcriptData->status === 'canEdit')
                  <td>Edit</td>
                  @elseif($transcriptData->status === 'approved')
                  <td>Approved</td>
                  @elseif($transcriptData->status === 'completed')
                  <td>Payment Received</td>
                  @else
                  <td>-</td>
                  @endif
                  @if($transcriptData->status === 'paid')
                  <td>-</td>
                  @elseif($transcriptData->status === 'canEdit')
                  <td><a href="{{route('another.grade',$transcriptData->student_profile_id)}}">Edit Transcript</a></td>
                  @elseif($transcriptData->status === 'approved')
                  <td><a href="{{route('edit.transcript',[$transcriptData->id,$transcriptData->student_profile_id])}}">Click here to Change in Transcript</a></td>
                  @elseif($transcriptData->status === 'completed')
                  <td><a href="{{ route ('preview.transcript',$transcriptData['student']['id'])}}" role="button">Preview Transcript</a></td>
                  @else
                  <td>-</td>
                  @endif
                  @if($transcriptData->status === 'approved')
                  <td><a href="{{route('download.transcript',[$transcriptData->id,$transcriptData->student_profile_id])}}"><i class="fas fa-file-pdf mr-2"></i>Download Transcript</a></td>
                  @elseif($transcriptData->status === 'completed')
                  <td>Waiting For Approval</td>
                  @elseif($transcriptData->status === 'paid')
                  <td><a href="{{route('order-transcript',Auth::user()->id)}}" class="btn btn-primary">Create a Transcript</a></td>
                  @endif
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
      <a href="{{route('order-transcript',Auth::user()->id)}}" class="btn btn-primary mt-4">Purchase Transcripts</a>
   </div>
   <div class="form-wrap border bg-light py-5 px-25 mb-4">
      <h2 class="mb-3">Download Your Confirmation Letter</h2>
      <div class="mb-2 text-center text-sm-left">
      </div>
      <div class="overflow-auto max-table">
         <table class="table-styling w-100">
            <thead>
               <tr>
                  <th>Student First Name</th>
                  <th>Student Id</th>
                  <th>Status</th>
                  <th>Download</th>
               </tr>
            </thead>
            <tbody>
               @foreach($confirmLetter as $student)
               <tr>
                  <td>{{$student->fullname}}</td>
                  <td>{{$student->student_Id}}</td>
                  <td>Active</td>
                  @if(($student->status === 'completed') || ($student->status === 'paid'))
                  <td><a href="{{ route('view.confirm',$student->student_profile_id) }}" class="d-flex align-items-center"><i class="fas fa-file-pdf mr-2"></i>Download</a></td>
                  @elseif($student->status === 'pending')
                  <td>Please pay your Enrollment Fees</td>
                  @endif
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
      <div class="mt-2 text-right">
         <p>Download your Enrollment Confirmation Letters from the download links above.</p>
      </div>
      <a href="{{ route('reviewstudent') }}" class="btn btn-primary" value="Renew Enrollment">Renew Enrollment</a>
      </form>

   </div>

   <div class="form-wrap border bg-light py-5 px-25 mb-4">
      <h2 class="mb-3">Record Transfer</h2>
      <div class="mb-2 text-center text-sm-left">
      </div>
      <div class="overflow-auto max-table">
         <table class="table-styling w-100">
            <thead>
               <tr>
                  <th>Student First Name</th>
                  <th>School Name</th>
                  <th>Email</th>
                  <th>Phone number</th>
                  <th>Status</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               @foreach($record_transfer as $record)
               <tr>
                  <td>{{$record['student']['fullname']}}</td>
                  <td>{{$record->school_name}}</td>
                  <td>{{$record->email}}</td>
                  <td>{{$record->phone_number}}</td>
                  @if($record->status === 'In Review')
                  <td>{{$record->status}}</td>
                  @elseif($record->status === 'Request Sent')
                  <td>Record Reviewed</td>
                  @endif
                  <td><a class="btn btn-primary" href="{{route('edit.record',$record->id)}}">Edit</a></td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
      <div class="mt-2 text-right">
         <p>Download your Enrollment Confirmation Letters from the download links above.</p>
      </div>
      <a class="btn btn-primary" href="{{route('record.transfer',$parentId)}}">Request Record Transfer</a>
      </form>
   </div>


</main>
@endsection