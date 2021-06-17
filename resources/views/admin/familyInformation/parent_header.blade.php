<meta name="csrf-token" content="{{ csrf_token() }}" />

<div class="d-flex justify-content-between main-nav_header align-items-center">
    <ul class="d-flex overflow-scroll">
      <li class="menu-item"><a href="{{ route('admin.dashboard.notification') }}">Dashboard</a></li>
      <li class="menu-item"><a class="active" href="{{ url('admin/view') }}">Family</a></li>
      <li class="menu-item"><a href="{{ url('admin/view-student') }}">Student</a></li>
      <li class="menu-item"><a href="#">Representative</a></li>
      <li class="menu-item"><a href="#">Groups</a></li>
      <li class="menu-item"><a href="#" data-toggle="modal"
        data-target="#parentDetailsModal" data-whatever="@getbootstrap"><img src="/images/add.png" alt=""></a></li>
    </ul>
    <ul class="d-flex">
      <li><img src="/images/search.png" alt="login"></li>
      <li><img src="/images/bell.png" alt="login"></li>
      <li><a onclick="goBack()"> <img src="/images/login.png" alt="login"></a>
      </li>
    </ul>
  </div>

   {{-- add new parent --}}
   <div class="modal fade bd-example-modal-lg" id="parentDetailsModal" tabindex="-1" role="dialog"
   aria-labelledby="parentDetailsModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
     <form id="add-new-parent">
       <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="studentDetailsModalLabel">Add New Parent</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
           <div class="row">
             <label for="message-text" class="col-form-label">Enter Parent 1 Information:</label>
             <div class="col-lg-4 col-12">
               <div class="form-group">
                 <label for="message-text" class="col-form-label">First Name:</label>
                 <input class="form-control" type="text" id='parent1_first_name'>
               </div>
             </div>

             <div class="col-lg-4 col-12">
               <div class="form-group">
                 <label for="message-text" class="col-form-label">Preferred Nickname:</label>
                 <input type="text" id="parent1_middle_name" class="form-control">
               </div>
             </div>

             <div class="col-lg-4 col-12">
               <div class="form-group">
                 <label for="message-text" class="col-form-label">Last Name:</label>
                 <input type="text" id="parent1_last_name" required class="form-control">
               </div>
             </div>

             <div class="col-lg-4 col-12">
               <div class="form-group">
                 <label for="message-text" class="col-form-label">Email Address:</label>
                 <input class="form-control" type="email" id='parent1_email'>
               </div>
             </div>
             <div class="col-lg-4 col-12">
               <div class="form-group">
                 <label for="message-text" class="col-form-label">Cell Phone:</label>
                 <input type="text" id="parent1_cell_phone" class="form-control">
               </div>
             </div>

             <div class="col-lg-4 col-12">
               <div class="form-group">
                 <label for="message-text" class="col-form-label">Work/Home Phone:</label>
                 <input type="text" id="parent1_home_phone" required class="form-control">
               </div>
             </div>
             <label for="message-text" class="col-form-label">Enter Parent 2 Information:</label>
             <div class="col-lg-4 col-12">
               <div class="form-group">
                 <label for="message-text" class="col-form-label">First Name:</label>
                 <input class="form-control" type="text" id='parent2_first_name'>
               </div>
             </div>
             <div class="col-lg-4 col-12">
               <div class="form-group">
                 <label for="message-text" class="col-form-label">Preferred Nickname:</label>
                 <input type="text" id="parent2_middle_name" class="form-control">
               </div>
             </div>

             <div class="col-lg-4 col-12">
               <div class="form-group">
                 <label for="message-text" class="col-form-label">Last Name:</label>
                 <input type="text" id="parent2_last_name" required class="form-control">
               </div>
             </div>

             <div class="col-lg-4 col-12">
               <div class="form-group">
                 <label for="message-text" class="col-form-label">Email Address:</label>
                 <input class="form-control" type="email" id='parent2_email'>
               </div>
             </div>
             <div class="col-lg-4 col-12">
               <div class="form-group">
                 <label for="message-text" class="col-form-label">Cell Phone:</label>
                 <input type="text" id="parent2_cell_phone" class="form-control">
               </div>
             </div>

             <div class="col-lg-4 col-12">
               <div class="form-group">
                 <label for="message-text" class="col-form-label">Work/Home Phone:</label>
                 <input type="text" id="parent2_home_phone" required class="form-control">
               </div>
             </div>
             <label for="message-text" class="col-form-label">Enter Parent 2 Information:</label>

             <div class="col-lg-6 col-12">
               <div class="form-group">
                 <label for="message-text" class="col-form-label">Street Address:</label>
                 <input type="text" id="parent1_street_address" class="form-control">
               </div>
             </div>

             <div class="col-lg-6 col-12">
               <div class="form-group">
                 <label for="message-text" class="col-form-label">City:</label>
                 <input type="text" id="parent1_city" required class="form-control">
               </div>
             </div> <div class="col-lg-4 col-12">
               <div class="form-group">
                 <label for="message-text" class="col-form-label">State:</label>
                 <input type="text" id="parent1_state" class="form-control">
               </div>
             </div>

             <div class="col-lg-6 col-12">
               <div class="form-group">
                 <label for="message-text" class="col-form-label">Zip Code:</label>
                 <input type="text" id="parent2_zip_code" required class="form-control">
               </div>
             </div>
             <div class="col-lg-6 col-12">
               <div class="form-group">
                 <label for="message-text" class="col-form-label">Country:</label>
                 <input type="text" id="parent2_country" required class="form-control">
               </div>
             </div>
             <div class="col-lg-6 col-12">
               <div class="form-group">
                 <label for="message-text" class="col-form-label">Who referred you to WRA?
                 </label>
                 <input type="text" id="reference" class="form-control">
               </div>
             </div>
           </div>
           <div class="modal-footer">
             <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
             <button type="submit" class="btn btn-primary">Save</button>
           </div>
         </form>
       </div>
     </div>


   </div>
 </div>

  