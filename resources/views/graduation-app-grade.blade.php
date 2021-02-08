@extends('layouts.app')

@section('content')
<!-- * =============== Main =============== * -->
<main class="position-relative container form-content mt-4">
  <h1 class="text-center text-white text-uppercase">Graduation application</h1>
  <div class="form-wrap border bg-light py-5 px-25">
      <p>To graduate from West River Academy, please fill out our application. Once your application has been approved, we will invite you continue to pay the fee of $395 and receive instructions on how to complete your Graduation Project and final transcript.</p>
   <div class="col-sm-6 pt-4">
       <form>
       <div class="form-group d-sm-flex mb-1">
        <label for="">Student Name</label>
        <div>Brown Rice</div>
      </div>
      <div class="form-group d-sm-flex mb-1">
        <label for="">Student Email</label>
        <div>
        <input type="text" name="" id="" value="" class="w-100">
        </div>
      </div>
      <p class="mt-2r mb-4">Please tell us how you completed grades 9,10 and 11.</p>
      <div class="mt-4">
         <p>Grade 9</p>
            <div class="form-group d-sm-flex mb-1">
                <input type="radio" name="" id="" value="">
                <label for="" class="w-auto pl-2 pr-0">I was enrolled in West River Academy.</label>
            </div>
            <div class="form-group d-sm-flex mb-1">
                <input type="radio" name="" id="" value="">
                <label for="" class="w-auto pl-2 pr-0">I homeschooled independently. (There are no transcripts that a school can send.)</label>
            </div>
            <div class="form-group d-sm-flex mb-1">
                <input type="radio" name="" id="" value="">
                <label for="" class="w-auto pl-2 pr-0">I was enrolled in another school that can send or has already sent transcripts.</label>
            </div>
            <div class="form-group d-sm-flex mb-1">
                <input type="radio" name="" id="" value="">
                <label for="" class="w-auto pl-2 pr-0">Other</label>
                <input type="text" name="" id="" value="" class="w-100 ml-3" placeholder="Reason">
            </div>
      </div>

      <div class="mt-4">
         <p>Grade 10</p>
            <div class="form-group d-sm-flex mb-1">
                <input type="radio" name="" id="" value="">
                <label for="" class="w-auto pl-2 pr-0">I was enrolled in West River Academy.</label>
            </div>
            <div class="form-group d-sm-flex mb-1">
                <input type="radio" name="" id="" value="">
                <label for="" class="w-auto pl-2 pr-0">I homeschooled independently. (There are no transcripts that a school can send.)</label>
            </div>
            <div class="form-group d-sm-flex mb-1">
                <input type="radio" name="" id="" value="">
                <label for="" class="w-auto pl-2 pr-0">I was enrolled in another school that can send or has already sent transcripts.</label>
            </div>
            <div class="form-group d-sm-flex mb-1">
                <input type="radio" name="" id="" value="">
                <label for="" class="w-auto pl-2 pr-0">Other</label>
                <input type="text" name="" id="" value="" class="w-100 ml-3" placeholder="Reason">
            </div>
      </div>
      <div class="mt-4">
         <p>Grade 11</p>
            <div class="form-group d-sm-flex mb-1">
                <input type="radio" name="" id="" value="">
                <label for="" class="w-auto pl-2 pr-0">I was enrolled in West River Academy.</label>
            </div>
            <div class="form-group d-sm-flex mb-1">
                <input type="radio" name="" id="" value="">
                <label for="" class="w-auto pl-2 pr-0">I homeschooled independently. (There are no transcripts that a school can send.)</label>
            </div>
            <div class="form-group d-sm-flex mb-1">
                <input type="radio" name="" id="" value="">
                <label for="" class="w-auto pl-2 pr-0">I was enrolled in another school that can send or has already sent transcripts.</label>
            </div>
            <div class="form-group d-sm-flex mb-1">
                <input type="radio" name="" id="" value="">
                <label for="" class="w-auto pl-2 pr-0">Other</label>
                <input type="text" name="" id="" value="" class="w-100 ml-3" placeholder="Reason">
            </div>
      </div>
     <button type="button" class="btn btn-primary mt-4" data-toggle="modal" data-target="#grade">Submit</button>
       </form>
   </div>
    </div>
</main>
<!-- Modal -->
<div class="modal fade text-center" id="grade" tabindex="-1" role="dialog" aria-labelledby="gradeTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <p>Thank you for your application.</p>
        <p>We will review it and notify you of the next steps.</p>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Okay</button>
      </div>
    </div>
  </div>
</div>
<!-- * =============== /Main =============== * -->
@endsection
