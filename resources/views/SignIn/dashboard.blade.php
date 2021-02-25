@extends('layouts.app')

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
               <a href="#" class="d-inline-block mb-5 decoration-none">
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
              <a href="#" class="d-inline-block mb-5 decoration-none">
              <i class="fas fa-file-alt rounded-circle circled-grid fa-2x text-secondary"></i>
               <h3 class="mt-3 text-black font-weight-normal">Order an Apostille or Notarization</h3>
              </a>
              </div>
              <div class="col-md-3 col-sm-6 text-center">
              <a href="#" class="d-inline-block mb-5 decoration-none">
              <i class="fas fa-credit-card rounded-circle circled-grid fa-2x text-secondary"></i>
               <h3 class="mt-3 text-black font-weight-normal">Make a Payment</h3>
              </a>
              </div>
              <div class="col-md-3 col-sm-6 text-center">
              <a href="{{route('order-transcript',Auth::user()->id)}}" class="d-inline-block mb-5 decoration-none">
              <i class="fas fa-graduation-cap rounded-circle circled-grid fa-2x text-secondary"></i>
               <h3 class="mt-3 text-black font-weight-normal">Order & PurchaseTranscript </h3>
              </a>
              </div>
              <div class="col-md-3 col-sm-6 text-center">
              <a href="{{ route('graduation.apply') }}" class="d-inline-block mb-5 decoration-none">
              <i class="fas fa-graduation-cap rounded-circle circled-grid fa-2x text-secondary"></i>
               <h3 class="mt-3 text-black font-weight-normal">Apply for Graduation</h3>
              </a>
              </div>
              <div class="col-md-3 col-sm-6 text-center">
              <a href="#" class="d-inline-block mb-5 decoration-none">
              <i class="fas fa-clipboard rounded-circle circled-grid fa-2x text-secondary"></i>
               <h3 class="mt-3 text-black font-weight-normal">Order a Custom Letter</h3>
              </a>
              </div>
              <div class="col-md-3 col-sm-6 text-center">
              <a href="#" class="d-inline-block mb-5 decoration-none">
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
              <th>Edit Tramscript</th>
              <th>Download</th>
             </tr>
           </thead>
           <tbody>
           @foreach($transcript as $transcriptData)
           <tr> 
             <td>{{$transcriptData['student']['fullname']}}</td>
             <td>{{($transcriptData->status)}}</td>
             <td><a href="#">Edit Transcript</a></td>
             @if ($transcriptData->status === 'paid')
             <td><a href="{{route('download.transcript',[$transcriptData->id,$transcriptData->student_profile_id])}}">Download Transcript</a></td>
               @elseif($transcriptData->status === 'pending')
            <td>Payment Pending</td>
            @endif
           </tr>
           @endforeach       
           </tbody>
           </table>
           </div>
           <a href="#" class="btn btn-primary mt-4">Purchase Transcripts</a>
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
                        <th>Last Name</th>
                        <th>Student Id</th>
                        <th>Status</th>
                        <th></th>
                     </tr>
                  </thead>
                  <tbody>
                  @foreach($student as $item)
						   <tr>
                     <td>{{$item->first_name}}</td>
                     <td>{{$item->last_name}}</td>
                     <td>{{$item->student_Id}}</td>
                     <td>Active</td>
							<td><a href="{{ route('view.confirm',$item->id) }}" class="d-flex align-items-center"><i class="fas fa-file-pdf mr-2"></i>Download</a></td>
							</tr>
					 @endforeach
                  </tbody>
                 </table>
</div>
                 <div class="mt-2 text-right"> <p>Download your Enrollment Confirmation Letters from the download links above.</p></div>
					<input type="submit" name="submit" id="submit" class="btn btn-primary" value="Renew Enrollment">
				</form>
              
         </div>     
				</form>
       
  </main>
@endsection