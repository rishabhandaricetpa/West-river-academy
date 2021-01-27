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
          <div class="form-wrap border bg-light py-5 px-25 mb-4">
             <h2 class="mb-5">What would you like to do?</h2>
                  <div class="row dashboard-options">
                     <div class="col-md-3 col-sm-6 text-center">
                        <a href="#" class="d-inline-block mb-5 decoration-none">
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
              <a href="#" class="d-inline-block mb-5 decoration-none">
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
              <a href="#" class="d-inline-block mb-5 decoration-none">
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
              <a href="#" class="d-inline-block mb-5 decoration-none">
              <i class="fas fa-user-graduate rounded-circle circled-grid fa-2x text-secondary"></i>
               <h3 class="mt-3 text-black font-weight-normal">Enroll a new Student in my Family</h3>
              </a>
            </div>
              <div class="col-sm-12">
                  <p>Needs Help? Check out our <a href="#">Dashboard Tuorial </a> <span class="px-4">or</span><a href="#" role="button" class="btn btn-primary"> Help me decide</a></p>
             </div>
         </div>
</div>
<div class="form-wrap border bg-light py-5 px-25">
             <h2 class="mb-3">Download Your Confirmation Letter</h2>
             <p>Select the information you wish to include on your confirmation letter.</p>
             <div class="mb-2 text-center text-sm-left">
				Show Enrollments From: <select name="enroll_year" id="enroll_year" class="mb-4 mb-sm-0">
                  <option value="2020">2020</option>
                  <option value="2019">2019</option>
             </select>
                        <input type="text" name="" id="" value="" class="rounded-input mb-4 mb-sm-0" placeholder="Filter by first name">
                        <input type="submit" name="" id="" value="GO" class="go btn btn-primary">
                        <input type="submit" name="" id="" value="Show All" disabled="" class="btn btn-light border">
							</div>
              <div class="overflow-auto">
                 <table class="table-styling w-100">
                  <thead>
                     <tr>
                        <th>Student</th>
                        <th>Grade</th>
                        <th>Begins</th>
                        <th>Expires</th>
                        <th>Status</th>
                        <th></th>
                     </tr>
                  </thead>
                  <tbody>
						   <tr>
                     <td>White Rice</td>
                     <td>6</td>
                     <td>8/1/2020</td>
                     <td>7/31/2021</td>
                     <td>Active</td>
							<td><a href="https://www.westriveracademy.com/cwp/pvt/enrollment/ltr/513EBC4C-74F0-7847-BF54-6D78B767F334" class="d-flex align-items-center"><i class="fas fa-file-pdf mr-2"></i>Download</a></td>
							</tr>
					     <tr>
                     <td>p1 pant</td>
                     <td>5</td>
                     <td>2/1/2020</td>
                     <td>1/31/2021</td>
                     <td>Active</td>
							<td><a href="https://www.westriveracademy.com/cwp/pvt/enrollment/ltr/6BC02E20-391C-5D43-9182-5ED10CEC0A2B" class="d-flex align-items-center"><i class="fas fa-file-pdf mr-2"></i>Download</a></td>
							</tr>
                  </tbody>
                 </table>
                 <div class="mt-2 text-right"> <p>Download your Enrollment Confirmation Letters from the download links above.</p></div>
                 <form action="" method="post" class="mb-0">
					<input type="submit" name="submit" id="submit" class="btn btn-primary" value="Renew Enrollment">
				</form>
              </div>  
         </div>
  </main>

@include('layouts.partials.footer')
</div>
</div>