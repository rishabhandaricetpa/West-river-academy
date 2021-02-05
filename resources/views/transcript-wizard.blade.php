@extends('layouts.app')

@section('content')
<!-- * =============== Main =============== * -->
<main class="position-relative container form-content mt-4">
  <h1 class="text-center text-white text-uppercase">Dashboard</h1>
  <div class="form-wrap border bg-light py-5 px-25">
      <div class="col-sm-6 mx-auto">
          <div class="text-center">
            <h2 class="mb-3">Welcome to the Transcript Wizard!</h2>
            <h3>You will be guided through the process of creating a transcript for:</h3>
         </div>
    <form method="POST" action="" class="mb-0 mt-5 label-large">

      <div class="form-group d-sm-flex mb-2">
        <label for="">First name</label>
        <div>
          <input type="text" class="form-control" >
        </div>
      </div>
      <div class="form-group d-sm-flex mb-2">
        <label for="">Middle name</label>
        <div>
          <input type="text" class="form-control" >
        </div>
      </div>
      <div class="form-group d-sm-flex mb-2">
        <label for="">Last name</label>
        <div>
          <input type="text" class="form-control" >
        </div>
      </div>
      <div class="mt-2r">
          <h3>Is the transcript for grades Kindergarten-8 or for high school (grade 9-12)?</h3>
          <div class="d-sm-flex py-4 col-sm-6 mx-auto">
                <div class="form-check mb-1">
                       <input class="form-check-input" type="radio" name="" value="option1">
                       <label class="form-check-label" for="">k-8</label>
                </div>
                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="" value="option2">
                        <label class="form-check-label" for="">6-12</label>
                    </div>
             </div>
                 <div class="text-center">
                    <a href="#" class="btn btn-primary">continue</a>
                    </div>
    </div>
      </div>
    </form>  
</main>

<!-- * =============== /Main =============== * -->
@endsection
