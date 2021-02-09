
@extends('layouts.app')

@section('content')
<main class="position-relative container form-content mt-4">
       <h1 class="text-center text-white text-uppercase">enroll students</h1>
          <div class="form-wrap border bg-light py-5 px-25 dashboard-info">
             <h3>Select an English / Language Arts course:</h3>
             <form method="POST" action="">
   @csrf
   <div class="form-group d-sm-flex mt-2r row">
      <div class="col-sm-6">
      <select class="form-control mb-4" name="english_course" id="english_course" required>
              <option value="United States">English</option>
              @foreach($englishCourse ?? '' as $english)
              <option value="{{$english->course_name}}">
                {{$english->subject_name}}</option>
              @endForeach
            </select>
         <div class="form-group d-sm-flex" >
            <label for="" class="w-auto">Other</label>
            <input type="text" class="form-control">
         </div>
         <div class="form-group d-sm-flex mt-4">
            <div class="col-sm-3 px-0">
               <h3>Select a Grade</h3>
               <div class="form-check">
                  <input class="form-check-input" type="radio" name="student_grade" value="2">
                  <label class="form-check-label" for="">
                  A
                  </label>
               </div>
               <div class="form-check">
                  <input class="form-check-input" type="radio" name="student_grade" value="3">
                  <label class="form-check-label" for="">
                  B
                  </label>
               </div>
               <div class="form-check">
                  <input class="form-check-input" type="radio" name="student_grade" value="4">
                  <label class="form-check-label" for="">
                  C
                  </label>
               </div>
               <div class="form-check">
                  <input class="form-check-input" type="radio" name="student_grade" value="5">
                  <label class="form-check-label" for="">
                  D
                  </label>
               </div>
               <div class="form-check">
                  <input class="form-check-input" type="radio" name="student_grade" value="5">
                  <label class="form-check-label" for="">
                  PASS
                  </label>
               </div>
            </div>
            <div>
               <a href="#" class="btn btn-primary">Help me decide</a>
            </div>
         </div>
         <div class="mt-5">
            <a href="#" class="btn btn-primary float-left">Add another English/Language Arts Course</a>
            <a href="#" class="btn btn-primary float-right">Continue</a>
         </div>
      </div>
   </div>
   </div>
</form>
</main>
@endsection