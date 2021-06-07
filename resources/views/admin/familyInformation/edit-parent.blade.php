@extends('admin.app')

@section('content')
<section class="content container-fluid  my-3">

  <!-- first card parent details -->
  <div class="card family-details px-3 my-3">
    <ul class="nav overflow-auto" id="to-the-top">
      <li class="nav-item">
        <a class="nav-link" href="#parent-details" aria-controls="parent-details" aria-selected="true">Details</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#student-details" aria-controls="student-details" aria-selected="true">Students</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#notes" aria-controls="notes" aria-selected="true">Notes</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#orders" aria-controls="orders" aria-selected="true">Orders</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#enrollments" aria-controls="enrollments" aria-selected="true">Enrollments</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#records" aria-controls="records" aria-selected="true">Records</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#documents" aria-controls="documents" aria-selected="true">Documents</a>
      </li>
    </ul>


    {{-- parents-details --}}
    <section class="parents-details  py-5" id="parent-details">
      <div class="tab-content">
        {{---------------- first tab --}}
        <div class="row">
          <div class="col-12 d-flex align-items-center">
            <h2 class="pr-3">Benjamin & Chong Livingston</h2>
            <div class="dropdown">
              <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Active
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Inactive</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </div>
          </div>
          <div class="col-12">Date Created:</div>

          {{-- parent detil-1  --}}
          <div class="col-md-12">
            <form class="is-readonly row" id="sampleForm">

              <div class="col-md-6">
                <h3 class="mt-3">parent-details-1</h3>
                <div class="form-group">
                  <label for="exampleInputPassword1">First Name :</label>
                  <input type="text" class="form-control is-disabled" id="exampleInputPassword1" placeholder="Name"
                    value="Benjamin" disabled>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Middle Name :</label>
                  <input type="text" class="form-control is-disabled" id="exampleInputPassword1" placeholder="Name"
                    value="David" disabled>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Last Name :</label>
                  <input type="text" class="form-control is-disabled" id="exampleInputPassword1" placeholder="Name"
                    value="Livingston" disabled>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email :</label>
                  <input type="email" class="form-control is-disabled" id="exampleInputEmail1" placeholder=""
                    value="benjamin.livingston@ithands.com" disabled>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Phone :</label>
                  <input type="email" class="form-control is-disabled" id="exampleInputEmail1" placeholder=""
                    value="+91.955.09.0328" disabled>
                </div>
                <h3 class="mt-3">Address</h3>
                <div class="form-group">
                  <label for="exampleInputEmail1">Street :</label>
                  <input type="email" class="form-control is-disabled" id="exampleInputEmail1" placeholder="" value=""
                    disabled>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">City :</label>
                      <input type="email" class="form-control is-disabled" id="exampleInputEmail1" placeholder=""
                        value="" disabled>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">State :</label>
                      <input type="email" class="form-control is-disabled" id="exampleInputEmail1" placeholder=""
                        value="" disabled>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">City :</label>
                      <input type="email" class="form-control is-disabled" id="exampleInputEmail1" placeholder=""
                        value="" disabled>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">State :</label>
                      <input type="email" class="form-control is-disabled" id="exampleInputEmail1" placeholder=""
                        value="" disabled>
                    </div>
                  </div>
                </div>
              </div>

              {{-- parents details 2 --}}

              <div class="col-md-6">
                <h3 class="mt-3">parent-details-2</h3>
                <div class="form-group">
                  <label for="exampleInputPassword1">First Name :</label>
                  <input type="text" class="form-control is-disabled" id="exampleInputPassword1" placeholder="Name"
                    value="Benjamin" disabled>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Middle Name :</label>
                  <input type="text" class="form-control is-disabled" id="exampleInputPassword1" placeholder="Name"
                    value="David" disabled>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Last Name :</label>
                  <input type="text" class="form-control is-disabled" id="exampleInputPassword1" placeholder="Name"
                    value="Livingston" disabled>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email :</label>
                  <input type="email" class="form-control is-disabled" id="exampleInputEmail1" placeholder=""
                    value="benjamin.livingston@ithands.com" disabled>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Phone :</label>
                  <input type="email" class="form-control is-disabled" id="exampleInputEmail1" placeholder=""
                    value="+91.955.09.0328" disabled>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                  <h3 class="mt-3">Address </h3>
                  <div  class="d-flex align-items-center">
                    <input type="checkbox" id="vehicle2" name="vehicle2" value="Car">
                    <label for="vehicle2 ml-2 mb-0">Same Address as Parent 1</label>
                  </div>
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Street :</label>
                  <input type="email" class="form-control is-disabled" id="exampleInputEmail1" placeholder="" value=""
                    disabled>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">City :</label>
                      <input type="email" class="form-control is-disabled" id="exampleInputEmail1" placeholder=""
                        value="" disabled>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">State :</label>
                      <input type="email" class="form-control is-disabled" id="exampleInputEmail1" placeholder=""
                        value="" disabled>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">City :</label>
                      <input type="email" class="form-control is-disabled" id="exampleInputEmail1" placeholder=""
                        value="" disabled>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">State :</label>
                      <input type="email" class="form-control is-disabled" id="exampleInputEmail1" placeholder=""
                        value="" disabled>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 pt-3 d-md-flex">
                <button type="button" class="btn btn-default btn-primary form-enable btn-edit js-edit mr-2">Edit</button>
                <button type="button" class="btn btn-default btn-primary form-enable  btn-save js-save mr-2">Save</button>
                <button type="button" class="btn btn-default btn-primary  btn-save js-cancel">Cancel</button>
              </div>

            </form>
          </div>



        </div>
      </div>
    </section>
    {{-- row 2  --}}
    <div class="row  py-5 my-3">
      <div class="col-md-6">
        <form>
          <div class="form-group">
            <h3>Reps/Group</h3>
            <input type="text" class="form-control is-disabled" id="exampleInputPassword1" placeholder="Name"
              value="Benjamin" disabled>
          </div>
        </form>
      </div>
      <div class="col-md-6 ">
        <h3>Reps/Group</h3>
        <div class="overflow-auto max-table">
          <table class="table table-striped table-styling w-100 table-vertical_scroll">
            <thead class="thead-light">
              <tr>
                <th scope="col">Student Name</th>
                <th scope="col">Name</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>MM/DD/YYYY</td>
                <td>Livingston David Benjamin</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>




    {{-- student-details --}}
    <section class="parents-details py-5 my-3" id="student-details">
      <div class="row">
        <div class="col-12">
          <h2 class="pr-3">Students</h2>
          <div class="overflow-auto max-table">
            <table class="table table-striped table-styling w-100 table-vertical_scroll">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Student Name</th>
                  <th scope="col">Gender</th>
                  <th scope="col">DOB</th>
                  <th scope="col">GRADE</th>
                  <th scope="col">Enrolled</th>
                  <th scope="col">Graduated</th>
                   <th scope="col" class="d-flex align-items-end justify-content-between">
                    <span>Email</span>
                    <span>
                      <button type="button" class="btn btn-primary btn-modal ml-3"
                      data-toggle="modal" data-target="#studentDetailsModal" 
                      data-whatever="@getbootstrap"><img src="/images/add.png" alt=""><img src="/images.add.png" alt=""></button>
                      <div class="modal fade" id="studentDetailsModal"  tabindex="-1" role="dialog" aria-labelledby="studentDetailsModalLabel" aria-hidden="true">
                       <div class="modal-dialog" role="document">
                         <div class="modal-content">
                           <div class="modal-header">
                             <h5 class="modal-title" id="studentDetailsModalLabel">New message</h5>
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                             </button>
                           </div>
                           <div class="modal-body">
                             <form>
                               <div class="form-group">
                                 <label for="recipient-name" class="col-form-label">Recipient:</label>
                                 <input type="text" class="form-control" id="recipient-name">
                               </div>
                               <div class="form-group">
                                 <label for="message-text" class="col-form-label">Message:</label>
                                 <textarea class="form-control" id="message-text"></textarea>
                               </div>
                             </form>
                           </div>
                           <div class="modal-footer">
                             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                             <button type="button" class="btn btn-primary">Send message</button>
                           </div>
                         </div>
                       </div>
                     </div>
                    </span>
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Benjamin Livingston</td>
                  <td>M</td>
                  <td>MM/DD/YYYY</td>
                  <td>10</td>
                  <td>yes</td>
                  <td>no</td>
                  <td>benjamin.livingston@ithands.com</td>
                </tr>

                <tr>
                  <td>Benjamin Livingston</td>
                  <td>M</td>
                  <td>MM/DD/YYYY</td>
                  <td>10</td>
                  <td>yes</td>
                  <td>no</td>
                  <td>benjamin.livingston@ithands.com</td>

                </tr>
                <tr>
                  <td>Benjamin Livingston</td>
                  <td>M</td>
                  <td>MM/DD/YYYY</td>
                  <td>10</td>
                  <td>yes</td>
                  <td>no</td>
                  <td>benjamin.livingston@ithands.com</td>

                </tr>
                <tr>
                  <td>Benjamin Livingston</td>
                  <td>M</td>
                  <td>MM/DD/YYYY</td>
                  <td>10</td>
                  <td>yes</td>
                  <td>no</td>
                  <td>benjamin.livingston@ithands.com</td>

                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>

    {{-- notes--}}
    <section class="notes  py-5 my-3" id="notes">
      <div class="row">
        <div class="col-12">
          <h2 class="pr-3">Notes</h2>
          <div class="overflow-auto max-table">
            <table class="table table-striped table-styling w-100 table-vertical_scroll">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Date</th>
                   <th scope="col" class="d-flex align-items-end justify-content-between">
                    <span>Notes</span>
                    <span>
                      <button type="button" class="btn btn-primary btn-modal ml-3"
                      data-toggle="modal" data-target="#notesModal" 
                      data-whatever="@getbootstrap"><img src="/images/add.png" alt=""><img src="/images.add.png" alt=""></button>
                      <div class="modal fade" id="notesModal"  tabindex="-1" role="dialog" aria-labelledby="#notesModalLabel" aria-hidden="true">
                       <div class="modal-dialog" role="document">
                         <div class="modal-content">
                           <div class="modal-header">
                             <h5 class="modal-title" id="notesModalLabel">New message</h5>
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                             </button>
                           </div>
                           <div class="modal-body">
                             <form>
                               <div class="form-group">
                                 <label for="recipient-name" class="col-form-label">Recipient:</label>
                                 <input type="text" class="form-control" id="recipient-name">
                               </div>
                               <div class="form-group">
                                 <label for="message-text" class="col-form-label">Message:</label>
                                 <textarea class="form-control" id="message-text"></textarea>
                               </div>
                             </form>
                           </div>
                           <div class="modal-footer">
                             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                             <button type="button" class="btn btn-primary">Send message</button>
                           </div>
                         </div>
                       </div>
                     </div>
                    </span>
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>MM/DD/YYYY</td>
                  <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos nemo magnam quaerat nihil
                    amet
                  </td>
                </tr>
                <tr>
                  <td>MM/DD/YYYY</td>
                  <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos nemo magnam quaerat nihil
                    amet
                  </td>
                </tr>
                <tr>
                  <td>MM/DD/YYYY</td>
                  <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos nemo magnam quaerat nihil
                    amet
                  </td>
                </tr>
                <tr>
                  <td>MM/DD/YYYY</td>
                  <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos nemo magnam quaerat nihil
                    amet
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>


    {{-- order --}}
    <section class="orders-detail  py-5 my-3" id="orders">
      <div class="row">
        <div class="col-12">
          <h2 class="pr-3">Orders</h2>
          <div class="overflow-auto max-table">
            <table class="table table-striped table-styling w-100 table-vertical_scroll">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Date</th>
                  <th scope="col">Paid By</th>
                  <th scope="col">Order Total</th>
                  <th scope="col">Payment Method</th>
                  <th scope="col">Status</th>
                   <th scope="col" class="d-flex align-items-end justify-content-between">
                    <span>Details</span>
                    <span>
                      <button type="button" class="btn btn-primary btn-modal ml-3"
                      data-toggle="modal" data-target="#orderModal" 
                      data-whatever="@getbootstrap"><img src="/images/add.png" alt=""><img src="/images.add.png" alt=""></button>
                      <div class="modal fade" id="orderModal"  tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
                       <div class="modal-dialog" role="document">
                         <div class="modal-content">
                           <div class="modal-header">
                             <h5 class="modal-title" id="orderModalLabel">New message</h5>
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                             </button>
                           </div>
                           <div class="modal-body">
                             <form>
                               <div class="form-group">
                                 <label for="recipient-name" class="col-form-label">Recipient:</label>
                                 <input type="text" class="form-control" id="recipient-name">
                               </div>
                               <div class="form-group">
                                 <label for="message-text" class="col-form-label">Message:</label>
                                 <textarea class="form-control" id="message-text"></textarea>
                               </div>
                             </form>
                           </div>
                           <div class="modal-footer">
                             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                             <button type="button" class="btn btn-primary">Send message</button>
                           </div>
                         </div>
                       </div>
                     </div>
                    </span>
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>MM/DD/YYYY</td>
                  <td>Benjamin Livingston</td>
                  <td>$10</td>
                  <td>Credit Card</td>
                  <td>Pending</td>
                  <td><a href="#">link to details</a></td>
                </tr>
                <tr>
                  <td>MM/DD/YYYY</td>
                  <td>Benjamin Livingston</td>
                  <td>$10</td>
                  <td>Credit Card</td>
                  <td>Pending</td>
                  <td><a href="#">link to details</a></td>
                </tr>
                <tr>
                  <td>MM/DD/YYYY</td>
                  <td>Benjamin Livingston</td>
                  <td>$10</td>
                  <td>Credit Card</td>
                  <td>Pending</td>
                  <td><a href="#">link to details</a></td>
                </tr>
                <tr>
                  <td>MM/DD/YYYY</td>
                  <td>Benjamin Livingston</td>
                  <td>$10</td>
                  <td>Credit Card</td>
                  <td>Pending</td>
                  <td><a href="#">link to details</a></td>
                </tr>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>


    {{--Enrollments --}}
    <section class="enrollments  py-5 my-3" id="enrollments">
      <div class="row">
        <div class="col-12">
          <h2 class="pr-3">Enrollments</h2>
          <div class="overflow-auto max-table">
            <table class="table table-striped table-styling w-100 table-vertical_scroll">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Date</th>
                  <th scope="col">Student Name</th>
                  <th scope="col">Start Date</th>
                  <th scope="col">End Date</th>
                  <th scope="col">Grade</th>
                  <th scope="col">Status</th>
                   <th scope="col" class="d-flex align-items-end justify-content-between">
                    <span>Details</span>
                    <span>
                      <button type="button" class="btn btn-primary btn-modal ml-3"
                      data-toggle="modal" data-target="#enrollmentsModal" 
                      data-whatever="@getbootstrap"><img src="/images/add.png" alt=""><img src="/images.add.png" alt=""></button>
                      <div class="modal fade" id="enrollmentsModal"  tabindex="-1" role="dialog" aria-labelledby="enrollmentsModalLabel" aria-hidden="true">
                       <div class="modal-dialog" role="document">
                         <div class="modal-content">
                           <div class="modal-header">
                             <h5 class="modal-title" id="enrollmentsModalLabel">New message</h5>
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                             </button>
                           </div>
                           <div class="modal-body">
                             <form>
                               <div class="form-group">
                                 <label for="recipient-name" class="col-form-label">Recipient:</label>
                                 <input type="text" class="form-control" id="recipient-name">
                               </div>
                               <div class="form-group">
                                 <label for="message-text" class="col-form-label">Message:</label>
                                 <textarea class="form-control" id="message-text"></textarea>
                               </div>
                             </form>
                           </div>
                           <div class="modal-footer">
                             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                             <button type="button" class="btn btn-primary">Send message</button>
                           </div>
                         </div>
                       </div>
                     </div>
                    </span>
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>MM/DD/YYYY</td>
                  <td>Benjamin Livingston</td>
                  <td>$10</td>
                  <td>Credit Card</td>
                  <td></td>
                  <td>Pending</td>
                  <td><a href="#">link to details</a></td>
                </tr>
                <tr>
                  <td>MM/DD/YYYY</td>
                  <td>Benjamin Livingston</td>
                  <td>$10</td>
                  <td>Credit Card</td>
                  <td></td>
                  <td>Pending</td>
                  <td><a href="#">link to details</a></td>
                </tr>
                <tr>
                  <td>MM/DD/YYYY</td>
                  <td>Benjamin Livingston</td>
                  <td>$10</td>
                  <td>Credit Card</td>
                  <td></td>
                  <td>Pending</td>
                  <td><a href="#">link to details</a></td>
                </tr>
                <tr>
                  <td>MM/DD/YYYY</td>
                  <td>Benjamin Livingston</td>
                  <td>$10</td>
                  <td>Credit Card</td>
                  <td></td>
                  <td>Pending</td>
                  <td><a href="#">link to details</a></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
    

    {{--Records --}}
    <section class="records  py-5 my-3" id="records">
      <div class="row">
        <div class="col-12">
          <h2 class="pr-3">Records</h2>
          <div class="overflow-auto max-table">
            <table class="table table-striped table-styling w-100 table-vertical_scroll">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Student Name</th>
                  <th scope="col">Previous Status</th>
                  <th scope="col">Recieved Status</th>
                   <th scope="col" class="d-flex align-items-end justify-content-between">
                    <span>Complete</span>
                    <span>
                      <button type="button" class="btn btn-primary btn-modal ml-3"
                      data-toggle="modal" data-target="#recordsModal" 
                      data-whatever="@getbootstrap"><img src="/images/add.png" alt=""><img src="/images.add.png" alt=""></button>
                      <div class="modal fade" id="recordsModal"  tabindex="-1" role="dialog" aria-labelledby="recordsModalLabel" aria-hidden="true">
                       <div class="modal-dialog" role="document">
                         <div class="modal-content">
                           <div class="modal-header">
                             <h5 class="modal-title" id="recordsModalLabel">New message</h5>
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                             </button>
                           </div>
                           <div class="modal-body">
                             <form>
                               <div class="form-group">
                                 <label for="recipient-name" class="col-form-label">Recipient:</label>
                                 <input type="text" class="form-control" id="recipient-name">
                               </div>
                               <div class="form-group">
                                 <label for="message-text" class="col-form-label">Message:</label>
                                 <textarea class="form-control" id="message-text"></textarea>
                               </div>
                             </form>
                           </div>
                           <div class="modal-footer">
                             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                             <button type="button" class="btn btn-primary">Send message</button>
                           </div>
                         </div>
                       </div>
                     </div>
                    </span>
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Benjamin Livingston</td>
                  <td>St.John's High School</td>
                  <td>Credit Card</td>
                  <td>YES</td>
                </tr>
                <tr>
                  <td>Benjamin Livingston</td>
                  <td>St.John's High School</td>
                  <td>Credit Card</td>
                  <td>YES</td>
                </tr>
                <tr>
                  <td>Benjamin Livingston</td>
                  <td>St.John's High School</td>
                  <td>Credit Card</td>
                  <td>YES</td>
                </tr>
                <tr>
                  <td>Benjamin Livingston</td>
                  <td>St.John's High School</td>
                  <td>Credit Card</td>
                  <td>YES</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>



    {{--Documents --}}
    <section class="documents  py-5 my-3" id="documents">
      <div class="row">
        <div class="col-12">
          <h2 class="pr-3">Documents</h2>
          <div class="overflow-auto max-table">
            <table class="table table-striped table-styling w-100 table-vertical_scroll">
              <thead class="thead-light">
                <tr>
                  <th scope="col">File Name</th>
                  <th scope="col">Date Uploaded</th>
                  <th scope="col">Uploaded By</th>
                  <th scope="col">Email</th>
                  <th scope="col">Export</th>
                  <th scope="col">View</th>
                   <th scope="col" class="d-flex align-items-end justify-content-between">
                      <span>Delete</span>
                      <span>
                        <button type="button" class="btn btn-primary btn-modal ml-3"
                        data-toggle="modal" data-target="#documentsModal" 
                        data-whatever="@getbootstrap"><img src="/images/add.png" alt=""><img src="/images.add.png" alt=""></button>
                       
                      </span>
                    </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Benjamin Livingston</td>
                  <td>MM/DD/YYYY</td>
                  <td>Benjamin Livingston</td>
                  <td>benjamin@gmail.com</td>
                  <td>export</td>
                  <td>export</td>
                  <td>export</td>
                </tr>
                <tr>
                  <td>Benjamin Livingston</td>
                  <td>MM/DD/YYYY</td>
                  <td>Benjamin Livingston</td>
                  <td>benjamin@gmail.com</td>
                  <td>export</td>
                  <td>export</td>
                  <td>export</td>
                </tr>
                <tr>
                  <td>Benjamin Livingston</td>
                  <td>MM/DD/YYYY</td>
                  <td>Benjamin Livingston</td>
                  <td>benjamin@gmail.com</td>
                  <td>export</td>
                  <td>export</td>
                  <td>export</td>
                </tr>
                <tr>
                  <td>Benjamin Livingston</td>
                  <td>MM/DD/YYYY</td>
                  <td>Benjamin Livingston</td>
                  <td>benjamin@gmail.com</td>
                  <td>export</td>
                  <td>export</td>
                  <td>export</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
    <div class="modal fade" id="documentsModal"  tabindex="-1" role="dialog" aria-labelledby="documentsModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="documentsModalLabel">New message</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Recipient:</label>
                <input type="text" class="form-control" id="recipient-name">
              </div>
              <div class="form-group">
                <label for="message-text" class="col-form-label">Message:</label>
                <textarea class="form-control" id="message-text"></textarea>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Send message</button>
          </div>
        </div>
      </div>
    </div>
<div class="text-right pb-4">
    <a href="#to-the-top" class="btn btn-primary">Back to Top</a>
</div>

  

</div>
</section>


<!-- form start -->
{{-- <form method="post" class="row" action="{{ route('admin.parent.update', $parent->id) }}">
@csrf
<div class="form-group col-sm-12">
  <label>Family Name <sup>*</sup></label>
  <input class="form-control" id="p1_first_name"
    value="{{ $parent->p1_last_name }} & {{ $parent->p2_last_name }} Family" name="p1_first_name" disabled>
</div>
<div class="form-group col-12">
  <label>User Status<sup>*</sup>
    <sup>{{ $parent->status === 0 ? 'Active' : 'Inactive' }}</sup></label>
  <select id="status" name="status" class="form-control" value="{{ $parent->status === 0 ? 'Active' : 'Inactive' }}">
    <option value="0" @if ($parent->status == 0) selected="selected" @endif>Active</option>
    <option value="1" @if ($parent->status == 1) selected="selected" @endif>Inactive</option>
  </select>
</div>
<div class="container-fluid my-3 parent-info">
  <div class="row">
    <!-- tab primary details -->
    <div class="col-lg-6">
      <div class="card ">
        <div class="card-header p-0">
          <!-- START TABS DIV -->
          <div class="tabbable-responsive">
            <div class="tabbable">
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="parent1" href="#first" aria-controls="first"
                    aria-selected="true">Parent 1</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="parent2" href="#second" aria-controls="second" aria-selected="false">Parent 2
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="login" href="#third" aria-controls="third" aria-selected="false">Log
                    In</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="tab-content">
            <div class="tab-pane fade show active" id="first" role="tabpanel" aria-labelledby="parent1">
              <div class="form-group col-12">
                <label>Parent 1 First/Given Name <sup>*</sup></label>
                <input class="form-control" id="p1_first_name" value="{{ $parent->p1_first_name }}"
                  name="p1_first_name">
              </div>
              <div class="form-group col-12">
                <label>Parent 1 Middle Name</label>
                <input class="form-control" id="p1_middle_name" name="p1_middle_name"
                  value="{{ $parent->p1_middle_name }}">
              </div>
              <div class="form-group col-12">
                <label>Parent 1 Last/Family Name <sup>*</sup></label>
                <input class="form-control" id="p1_last_name" name="p1_last_name" value="{{ $parent->p1_last_name }}">
              </div>
              <div class="form-group col-12">

                <label>Parent 1 Email<sup>*</sup> </label>
                <input class="form-control" id="p1_email" name="p1_email" value="{{ $parent->p1_email }}" disabled>
              </div>
              <div class="form-group col-12">
                <label>Parent 1 Cell Phone</label>
                <input class="form-control" name="p1_cell_phone" id="p1_cell_phone"
                  value="{{ $parent->p1_cell_phone }}">
              </div>
              <div class="form-group col-12">
                <label>Parent 1 Home Phone</label>
                <input class="form-control" id="p1_home_phone" name="p1_home_phone"
                  value="{{ $parent->p1_home_phone }}">
              </div>
            </div>
            <div class="tab-pane fade" id="second" role="tabpanel" aria-labelledby="parent2">
              <div class="form-group col-12">
                <label>Parent 2 First/Given Name</label>
                <input class="form-control" id="p2_first_name" value="{{ $parent->p2_first_name }}"
                  name="p2_first_name">
              </div>
              <div class="form-group col-12">
                <label>Parent 2 Middle Name</label>
                <input class="form-control" id="p2_middle_name" name="p2_middle_name"
                  value="{{ $parent->p2_middle_name }}">
              </div>
              <div class="form-group col-12">
                <label>Parent 2 Email</label>
                <input class="form-control" id="p2_email" name="p2_email" value="{{ $parent->p2_email }}">
              </div>
              <div class="form-group col-12">
                <label>Parent 2 Cell Phone</label>
                <input class="form-control" name="p2_cell_phone" id="p2_cell_phone"
                  value="{{ $parent->p2_cell_phone }}">
              </div>
              <div class="form-group col-12">
                <label>Parent 2 Home Phone</label>
                <input class="form-control" id="p2_home_phone" name="p2_home_phone"
                  value="{{ $parent->p2_home_phone }}">
              </div>
            </div>
            <div class="tab-pane fade" id="third" role="tabpanel" aria-labelledby="login">
              <div class="form-group col-12">
                <label>First Name</label>
                <input class="form-control" id="p2_cell_phone" value="{{ $parent->p2_cell_phone }}">
              </div>
              <div class="form-group col-12">
                <label>Last Name</label>
                <input class="form-control" id="p2_home_phone" value="{{ $parent->p2_home_phone }}">
              </div>
              <div class="form-group col-12">
                <label>Email</label>
                <input class="form-control" id="p2_home_phone" value="{{ $parent->p2_home_phone }}">
              </div>
              <div class="form-group col-12">
                <label>Password</label>
                <input class="form-control" id="p2_home_phone" value="{{ $parent->p2_home_phone }}">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- tab primary details ends -->


    <!--    secondary details -->
    <div class="col-lg-6 parent-info__secondary">
      <div class="row">
        <!-- tab secondary details -->
        <div class="col-sm-6">
          <div class="card">
            <div class="card-header p-0">
              <!-- START TABS DIV -->
              <div class="tabbable-responsive">
                <div class="tabbable">
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="primaryaddress" href="#forth" aria-controls="forth"
                        aria-selected="true">Primary
                        Address</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="secondaryaddress" href="#fifth" aria-controls="fifth"
                        aria-selected="true">Other Address</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane fade show active" id="forth" role="tabpanel" aria-labelledby="primaryaddress">
                  <div class="form-group col-12">
                    <label>Street Address<sup>*</sup></label>
                    <input class="form-control" id="street_address" name="street_address"
                      value="{{ $parent->street_address }}">
                  </div>
                  <div class="form-group col-12">
                    <label>City</label>
                    <input class="form-control" id="city" name="city" value="{{ $parent->city }}">
                  </div>
                  <div class="form-group col-12">
                    <label>State<sup>*</sup></label>
                    <input class="form-control" id="state" name="state" value="{{ $parent->state }}">
                  </div>
                  <div class="form-group col-12">
                    <label>Country<sup>*</sup></label>
                    <input class="form-control" id="country" name="country" value="{{ $parent->country }}">
                  </div>
                </div>
                <div class="tab-pane fade" id="fifth" role="tabpanel" aria-labelledby="secondaryaddress">
                  <div class="form-group col-12">
                    <label>Address<sup>*</sup></label>
                    <input class="form-control" id="street_address" value="{{ $parent->street_address }}">
                  </div>
                  <div class="form-group col-12">
                    <label>Country</label>
                    <input class="form-control" id="city" name="city" value="{{ $parent->city }}">
                  </div>
                  <div class="form-group col-12">
                    <label>Home Phone<sup>*</sup></label>
                    <input class="form-control" id="state" name="state" value="{{ $parent->state }}">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- tab secondary details ends -->

        <!-- family-info starts -->
        <div class="col-sm-6 card py-3">
          <h3> Family Info</h3>
          <div class="form-group">
            <label>Immunization Status<sup>*</sup></label>
            <input class="form-control" id="immunized" name="immunized" value="{{ $parent->immunized }}">
          </div>
          <div class="form-group">
            <label>Referred by</label>
            <input class="form-control" id="reference" name="reference" value="{{ $parent->reference }}">
          </div>
        </div>
        <!-- family-info ends-->
      </div>
    </div>
  </div>
</div>
<div class="col-sm-12">
  <button type="submit" class="btn btn-primary">Update</button>
  <a onclick="goBack()" class="btn btn-primary">Back</a>
</div>
</form> --}}

</div>

<!-- second card parent details -->
{{-- <div class="container-fluid position-relative my-3">
            <div class="form-wrap border py-5 px-25 position-relative">
                <!-- student details here -->
                <div class="form-group">
                    <label>Students<sup>*</sup></label>
                    <div class="card my-3 w-100">
                        <div class="card-header p-0">
                            <!-- START TABS DIV -->
                            <div class="tabbable-responsive">
                                <div class="tabbable">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="student-tab"  href="#sixth"
                                                 aria-controls="sixth" aria-selected="true">Students</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="sixth" role="tabpanel"
                                    aria-labelledby="student-tab">
                                    <div class="card-body overflow-auto">
                                        <!-- student table -->
                                        <table id="#example-1" class="table table-bordered table-striped data-table">
                                            <thead>
                                                <tr>
                                                    <th>Name </th>
                                                    <th>Date of Birth</th>
                                                    <th>Email</th>
                                                    <th>Enrollments</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($allstudent as $student)
                                                    <tr>
                                                        <td>{{ $student->first_name }} {{ $student->last_name }}</td>
<td>{{ $student->d_o_b->format('M j, Y') }}</td>
<td>{{ $student->email }}</td>
<td>{{ getendallenrollmentes($student->id) }}</td>
<td><a href=" {{ route('admin.edit-student', $student->id) }}">View
    Student Details</a></br></td>
</tr>
@endforeach
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="container-fluid position-relative my-3">
  <div class="form-wrap border py-5 px-25 position-relative">
    <!-- order details -->
    <div class="card">
      <div class="card-header p-0">
        <!-- START TABS DIV -->
        <div class="tabbable-responsive">
          <div class="tabbable">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="enrollments" href="#seventh" aria-controls="seventh"
                  aria-selected="true">Enrollments</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="orders" href="#eight" aria-controls="eight" aria-selected="true">Orders</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="records" href="#nineth" aria-controls="nineth" aria-selected="true">Records</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="document" href="#tenth" aria-controls="tenth" aria-selected="true">Documents</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="tab-content">
          <div class="tab-pane fade show active" id="seventh" role="tabpanel" aria-labelledby="enrollments">
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped data-table">
                <thead>
                  <tr>

                    <th class="transform-none">Start Date of Enrollment</th>
                    <th class="transform-none">End Date of Enrollment</th>
                    <th>Grade Level</th>
                    <th>Amount</th>
                    <th>Payment Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($payment_info as $payment)
                  <tr>

                    <td>{{ Carbon\Carbon::parse($payment->start_date_of_enrollment)->format('M j, Y') }}
                    </td>
                    <td>{{ Carbon\Carbon::parse($payment->end_date_of_enrollment)->format('M j, Y') }}
                    </td>
                    <td>{{ $payment->grade_level }}</td>
                    <td>{{ $payment->amount }}</td>
                    @if ($payment->status === 'paid')
                    <td>Paid</td>
                    @elseif($payment->status ==='pending')
                    <td>Pending</td>
                    @endif
                    <td>
                      <a href=" {{ route('admin.edit.payment.status', $payment->id) }}"><i class=" fas fa-edit"
                          onclick="return myFunction();"></i></a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="tab-pane fade" id="eight" role="tabpanel" aria-labelledby="orders">
            <div class="card-body">
              <table id="#example-1" class="table table-bordered table-striped data-table">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Transcation Id </th>
                    <th>Payment Mode</th>
                    <th>Amount</th>
                    <th>Orders</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($transcations as $transcation)
                  <tr>
                    <td>{{ $transcation->created_at->format('M j,Y') }}</td>
                    <td>{{ $transcation->transcation_id }}</td>
                    <td>{{ $transcation->payment_mode }}</td>
                    <td>{{ $transcation->amount }}</td>
                    <?php $values = getOrders($transcation->transcation_id);
                                                    ?>

                    <td>{{ $values }}</td>
                    <td><a
                        href=" {{ route('admin.allorders', [$transcation->transcation_id, $transcation->parent_profile_id]) }}">View
                        Orders</a></br></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="tab-pane fade" id="nineth" role="tabpanel" aria-labelledby="records">
            <div class="card-body">
              <table id="#example-1" class="table table-bordered table-striped data-table">
                <table id="#example-1" class="table table-bordered table-striped data-table">
                  <thead>
                    <tr>
                      <th>Student Name</th>
                      <th>School Name</th>
                      <th>Email</th>
                      <th>Phone Number</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($recordTransfer as $records)
                    <tr>
                      <td>{{ $records['student']['fullname'] }}</td>
                      <td>{{ $records->school_name }}</td>
                      <td><a class="transform-none" href="mailto:${{ $records->email }}">
                          {{ $records->email }}</a></td>
                      <td>{{ $records->phone_number }}</td>
                      @if (empty($records->request_status))
                      <td>In Review
                        @elseif($records->request_status=='Record Received')
                      <td>Records Received
                        @endif
                        @if ($records->resendCount)
                        Resend Requested:{{ $records->resendCount }}
                        @endif
                      </td>

                      <td>
                        <a
                          href="{{ route('admin.student.schoolRecord', [$records->student_profile_id, $records->id]) }}">
                          <i class=" fas fa-arrow-alt-circle-right"></i></a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
          </div>
          <div class="tab-pane fade" id="tenth" role="tabpanel" aria-labelledby="document">
            <div class="card-body">
              <table id="#example-1" class="table table-bordered table-striped data-table">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>File Name</th>
                    <th></th>
                    <th>Amount</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($documents as $document)
                  <tr>
                    <td>{{ $document->created_at->format('M j,Y') }}</td>
                    <td>{{ $document->original_filename }}</td>
                    <td>{{ $document->document_type }}</td>
                    <td>{{ $document->filename }}</td>
                    <td><a href=" {{ route('admin.edit.uploadedDocument', $document->id) }}">View
                        Documents</a></br></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> --}}


  </section>


  @endsection
