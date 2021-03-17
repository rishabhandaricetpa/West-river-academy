@extends('layouts.app')
@section('pageTitle', 'MyAccount')
@section('content')
<!-- * =============== Main =============== * -->

<main class="position-relative container form-content mt-4">
   <div class="form-wrap border bg-light py-5 px-25">
      <h2 class="mb-3">User Information</h2>
      <form>
         <div class="form-group d-sm-flex mb-2">
            <label for="">First Name</label>
            <div>{{$parent->p1_first_name}}</div>
         </div>
         <div class="form-group d-sm-flex mb-2">
            <label for="">Last Name</label>
            <div>{{$parent->p1_last_name}}</div>
         </div>
         <div class="form-group d-sm-flex mb-2">
            <label for="">Email</label>
            <div>{{$parent->p1_email}}</div>
         </div>
         <div class="form-group d-sm-flex mb-2">
            <label for="">Phone</label>
            <div>{{$parent->p1_cell_phone}}</div>
         </div>
         <a href="{{url('/editaccount', $user_id)}}" class="btn btn-primary">Edit Your Login</a>
   </div>
   <div class="form-wrap border bg-light py-5 px-25 mt-2r">
      <h2 class="mb-3">Password</h2>
      <form>
         <div class="form-group d-sm-flex mb-2">
            <label for="">Password</label>
            <div>********</div>
         </div>
         <a href="{{ route('reset.password',$user_id  ) }}" class="btn btn-primary">Change Your Password?</a>

   </div>

   </form>
</main>

<!-- * =============== /Main =============== * -->
@endsection