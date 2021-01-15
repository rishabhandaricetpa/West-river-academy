@extends('layouts.app')

@section('content')
<!-- * =============== Main =============== * -->

<main class="position-relative container form-content mt-4">
   <div class="form-wrap border bg-light py-5 px-25">
      <h2 class="mb-3">User Information</h2>
      <form >
         <div class="form-group d-sm-flex mb-2">
            <label for="">User ID</label>
            <div></div>
         </div>
         <div class="form-group d-sm-flex mb-2">
            <label for="">First Name</label>
            <div></div>
         </div>
         <div class="form-group d-sm-flex mb-2">
            <label for="">Last Name</label>
            <div></div>
         </div>
         <div class="form-group d-sm-flex mb-2">
            <label for="">Email</label>
            <div></div>
         </div>
         <div class="form-group d-sm-flex mb-2">
            <label for="">Phone</label>
            <div></div>
         </div>
         <button type="submit" class="btn btn-primary">Edit Your Login</button>
</div>
   <div class="form-wrap border bg-light py-5 px-25 mt-2r">
   <h2 class="mb-3">Password</h2>
      <form >
         <div class="form-group d-sm-flex mb-2">
            <label for="">Password</label>
            <div>********</div>
         </div>
         <button href="{{route('password.request')}}" class="btn btn-primary">Change Your Password</button>

</div>

   </form>
</main>

    <!-- * =============== /Main =============== * -->
@endsection