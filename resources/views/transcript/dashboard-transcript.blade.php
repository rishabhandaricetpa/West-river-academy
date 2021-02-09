<div class="d-flex">
  <!-- * =============== Sidebar =============== * -->
  @include('layouts.partials.sidebar')
  <!-- * =============== /Sidebar =============== * -->

  <div class="main-content position-relative ml-auto">
    <title> @yield('pageTitle', 'Enroll Students') | {{config('app.name')}}</title>
    <!-- <sup>*</sup> =============== Header =============== <sup>*</sup> -->
    @include('layouts.partials.header')
    <!-- <sup>*</sup> =============== /Header =============== <sup>*</sup> -->

    <!-- * =============== Main =============== * -->

    <main class="position-relative container form-content mt-4">
      <h1 class="text-center text-white text-uppercase">dashboard</h1>

      <div class="form-wrap border bg-light py-2r px-25 text-center dashboard-info">
        <p>You are ready to select the courses and grades to put on the transcript for <a href="#">{{$student->first_name}}</a></p>
        <p>If the trancscript is to be presented to another school, we recommend that you choose course names that match the courses of the school that the student is transferring into.</p>
        <a href="{{route('display.studentProfile',$student->id)}}" class="btn btn-primary mt-4 font-weight-bold">Start to create transcript</a>
      </div>
    </main>

    <!-- * =============== /Main =============== * -->
    @include('layouts.partials.footer')
  </div>

</div>