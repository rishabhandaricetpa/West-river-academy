<div class="d-flex">
  <!-- * =============== Sidebar =============== * -->
  <sidebar class="main-sidebar bg-secondary pt-5 fixed-top overflow-auto">
    <ul class="list-unstyled">
      <li>
        <a href="#">Dashboard</a>
        <ul class="list-unstyled">
          <li><a href="#">Add student</a></li>
          <li><a href="#">add enrollment</a></li>
        </ul>
      </li>
      <li><a href="#">Cart</a></li>
      <li><a href="#">Fee structure</a></li>
      <li><a href="#">Tutorials</a></li>
      <li><a href="#">My Account</a></li>
      <li><a href="#">Logout</a></li>
    </ul>
  </sidebar>
  <!-- * =============== /Sidebar =============== * -->

  <div class="main-content position-relative ml-auto">
    <title> @yield('pageTitle', 'Enroll Students') | {{config('app.name')}}</title>
    <!-- <sup>*</sup> =============== Header =============== <sup>*</sup> -->
    @include('layouts.partials.header')
    <!-- <sup>*</sup> =============== /Header =============== <sup>*</sup> -->

    <!-- * =============== Main =============== * -->

    <main class="position-relative container form-content mt-4">
      <h1 class="text-center text-white text-uppercase">student enrollment</h1>
      <div class="form-wrap border bg-light py-5 px-25">
        <h2 class="h3">Review Student 1 Enrollment</h2>
        <form method="POST" action="" class="seperator pb-2">
          <div class="form-group d-sm-flex mb-2">
            <label for="">Student Name</label>
            <div>
              <p>{{$studentData ->first_name}}</p>
            </div>
          </div>
          <div class="form-group d-sm-flex mb-2">
            <label for="">Date of Birth</label>
            <div>
              <p>{{$studentData ->d_o_b}}</p>
            </div>
          </div>
          <div class="form-group d-sm-flex mb-2">
            <label for="">Email Address</label>
            <div>
              <p>{{$studentData ->email}}</p>
            </div>
          </div>
          <div class="form-group d-sm-flex mb-2">
            <label for="">Phone</label>
            <div>
              <p>{{$studentData ->cell_phone}}</p>
            </div>
          </div>
          <div class="form-group d-sm-flex mb-2">
            <label for="">Student ID</label>
            <div>
              <p>{{$studentData ->student_Id}}</p>
            </div>
          </div>
          @foreach($enrollPeriods as $enrollPeriod)
          <div class="form-group d-sm-flex mb-2">
            <label for="">Enrollment Period(s)</label>
            <div>
              <p>{{$enrollPeriod->start_date_of_enrollment}} ,{{$enrollPeriod->end_date_of_enrollment}}</p>

            </div>
          </div>


          <div class="form-group d-sm-flex mb-2">
            <label for="">Grade Level(s)</label>
            <div>
              <p>{{$enrollPeriod->grade_level}}</p>
            </div>
          </div>
          @endforeach
        </form>
        <div class="col-md-4">
          <h3 class="py-3">Fees</h3>
          <table class="px-0 w-100">
            <tbody>
              <tr>
                <td>Annual * 2</td>
                <td class="text-right">$750</td>
              </tr>
              <tr>
                <td>Second Semester Only * 1</td>
                <td class="text-right">$200</td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <td>Annual * 2</td>
                <td class="text-right">$750</td>
              </tr>
            </tfoot>
          </table>
          <div class="text-right mt-4">
            <a href="#" class="btn btn-primary">Edit</a>
            <a href="#" class="btn btn-primary ml-3">Add to Cart</a>
          </div>
        </div>
    </main>

    <!-- * =============== /Main =============== * -->
    @include('layouts.partials.footer')
  </div>

</div>
