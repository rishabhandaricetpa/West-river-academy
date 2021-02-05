@extends('layouts.app')

@section('content')
<!-- * =============== Main =============== * -->
<main class="position-relative container form-content mt-4">
  <h1 class="text-center text-white text-uppercase">Graduation application</h1>
  <div class="form-wrap border bg-light py-5 px-25">
     
            <h2 class="mb-3">Select the student who wishes to apply for graduation</h2>
           <div class="overflow-auto">
              <table class="w-100 table-styling enlarge-input">
                 <thead>
                     <tr>
                         <th>Name</th>
                         <th>Date of Birth</th>
                         <th>Grade</th>
                         <th>Enrolled</th>
                     </tr>
                 </thead>
                 <tbody>
                     <tr>
                         <td>
              <input class="form-check-input" type="radio" name="">
            Brown Rice</td>
                         <td>04/01/2005</td>
                         <td>-</td>
                         <td>No</td>
                     </tr>
                     <tr>
                         <td> <input class="form-check-input" type="radio" name="">White Rice</td>
                         <td>01/01/2004</td>
                         <td>5</td>
                         <td>Yes</td>
                     </tr>
                 </tbody>
              </table>
           </div>
           <div class="mt-5">
                <a href="#" class="btn btn-primary">cancel</a>
                <a href="#" class="btn btn-primary">continue</a>
           </div>
</main>

<!-- * =============== /Main =============== * -->
@endsection
