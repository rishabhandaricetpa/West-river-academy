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

    <main class="position-relative container form-content mt-4 label-styling label-md">
      <h1 class="text-center text-white text-uppercase">enroll students</h1>
      <div class="form-wrap border bg-light py-5 px-25 dashboard-info">
        <h3 class="mb-3">Do you want to add another grade level?</h3>
        <form method="post" class="mb-0" action="{{route('another.grade.requirement')}}">
          @csrf
          <div class="form-group mb-0 lato-italic info-detail">
            <div class="row ">
              <div class="col-sm-3">
                <div class="form-check mb-2">
                  <input type="hidden" name="student_id" value="{{$id}}">
                  <input class="form-check-input" type="radio" name="another_grade" value="Yes">
                  <label class="form-check-label" for="">
                    Yes
                  </label>
                </div>
                <div class="form-check mb-2">
                  <input class="form-check-input" type="radio" name="another_grade" value="No">
                  <label class="form-check-label" for="">
                    No
                  </label>
                </div>
                <button type="submit" class="btn btn-primary mt-4">Submit</button>
              </div>
            </div>
          </div>
        </form>
    </main>
    <!-- * =============== /Main =============== * -->
    @include('layouts.partials.footer')
  </div>

</div>