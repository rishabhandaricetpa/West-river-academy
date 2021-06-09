@extends('admin.app')

@section('content')
    <section class="content container-fluid  my-3">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <!-- first card parent details -->
        <div class="card family-details px-3 my-3">
            <ul class="nav overflow-auto" id="to-the-top">
                <li class="nav-item">
                    <a class="nav-link" href="#parent-details" aria-controls="parent-details"
                        aria-selected="true">Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#student-details" aria-controls="student-details"
                        aria-selected="true">Students</a>
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
                    {{-- -------------- first tab --}}
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

                        {{-- parent detil-1 --}}
                        <div class="col-md-12">
                            <form class="is-readonly row" id="sampleForm">

                                <div class="col-md-6">
                                    <h3 class="mt-3">parent-details-1</h3>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">First Name :</label>
                                        <input type="text" class="form-control is-disabled" id="exampleInputPassword1"
                                            placeholder="Name" value="Benjamin" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Middle Name :</label>
                                        <input type="text" class="form-control is-disabled" id="exampleInputPassword1"
                                            placeholder="Name" value="David" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Last Name :</label>
                                        <input type="text" class="form-control is-disabled" id="exampleInputPassword1"
                                            placeholder="Name" value="Livingston" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email :</label>
                                        <input type="email" class="form-control is-disabled" id="exampleInputEmail1"
                                            placeholder="" value="benjamin.livingston@ithands.com" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Phone :</label>
                                        <input type="email" class="form-control is-disabled" id="exampleInputEmail1"
                                            placeholder="" value="+91.955.09.0328" disabled>
                                    </div>
                                    <h3 class="mt-3">Address</h3>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Street :</label>
                                        <input type="email" class="form-control is-disabled" id="exampleInputEmail1"
                                            placeholder="" value="" disabled>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">City :</label>
                                                <input type="email" class="form-control is-disabled" id="exampleInputEmail1"
                                                    placeholder="" value="" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">State :</label>
                                                <input type="email" class="form-control is-disabled" id="exampleInputEmail1"
                                                    placeholder="" value="" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">City :</label>
                                                <input type="email" class="form-control is-disabled" id="exampleInputEmail1"
                                                    placeholder="" value="" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">State :</label>
                                                <input type="email" class="form-control is-disabled" id="exampleInputEmail1"
                                                    placeholder="" value="" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- parents details 2 --}}

                                <div class="col-md-6">
                                    <h3 class="mt-3">parent-details-2</h3>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">First Name :</label>
                                        <input type="text" class="form-control is-disabled" id="exampleInputPassword1"
                                            placeholder="Name" value="Benjamin" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Middle Name :</label>
                                        <input type="text" class="form-control is-disabled" id="exampleInputPassword1"
                                            placeholder="Name" value="David" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Last Name :</label>
                                        <input type="text" class="form-control is-disabled" id="exampleInputPassword1"
                                            placeholder="Name" value="Livingston" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email :</label>
                                        <input type="email" class="form-control is-disabled" id="exampleInputEmail1"
                                            placeholder="" value="benjamin.livingston@ithands.com" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Phone :</label>
                                        <input type="email" class="form-control is-disabled" id="exampleInputEmail1"
                                            placeholder="" value="+91.955.09.0328" disabled>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h3 class="mt-3 mb-2">Address </h3>
                                        <div class="text-right d-flex align-items-center">
                                            <input class="mt-3 mb-3" type="checkbox" id="vehicle2" name="vehicle2"
                                                value="Car">
                                            <label class=" ml-2 mt-3 mb-2" for="vehicle2">Same Address as Parent 1</label>
                                        </div>


                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Street :</label>
                                        <input type="email" class="form-control is-disabled" id="exampleInputEmail1"
                                            placeholder="" value="" disabled>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">City :</label>
                                                <input type="email" class="form-control is-disabled" id="exampleInputEmail1"
                                                    placeholder="" value="" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">State :</label>
                                                <input type="email" class="form-control is-disabled" id="exampleInputEmail1"
                                                    placeholder="" value="" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">City :</label>
                                                <input type="email" class="form-control is-disabled" id="exampleInputEmail1"
                                                    placeholder="" value="" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">State :</label>
                                                <input type="email" class="form-control is-disabled" id="exampleInputEmail1"
                                                    placeholder="" value="" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 pt-3 d-md-flex">
                                    <button type="button"
                                        class="btn btn-default btn-primary form-enable btn-edit js-edit mr-2">Edit</button>
                                    <button type="button"
                                        class="btn btn-default btn-primary form-enable  btn-save js-save mr-2">Save</button>
                                    <button type="button"
                                        class="btn btn-default btn-primary  btn-save js-cancel">Cancel</button>
                                </div>

                            </form>
                        </div>



                    </div>
                </div>
            </section>
            {{-- row 2 --}}
            <div class="row  py-5 my-3">
                <div class="col-md-6">
                    <form>
                        <div class="form-group">
                            <h3>Reps/Group</h3>
                            <input type="text" class="form-control is-disabled" id="exampleInputPassword1"
                                placeholder="Name" value="Benjamin" disabled>
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
                                                    data-whatever="@getbootstrap"><img src="/images/add.png" alt=""><img
                                                        src="/images.add.png" alt=""></button>
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
            <div class="modal fade" id="studentDetailsModal" tabindex="-1" role="dialog"
                aria-labelledby="studentDetailsModalLabel" aria-hidden="true">
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
            {{-- notes --}}
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
                                                    data-whatever="@getbootstrap"><img src="/images/add.png" alt=""><img
                                                        src="/images.add.png" alt=""></button>
                                            </span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>MM/DD/YYYY</td>
                                        <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos nemo magnam
                                            quaerat nihil
                                            amet
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>MM/DD/YYYY</td>
                                        <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos nemo magnam
                                            quaerat nihil
                                            amet
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>MM/DD/YYYY</td>
                                        <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos nemo magnam
                                            quaerat nihil
                                            amet
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>MM/DD/YYYY</td>
                                        <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos nemo magnam
                                            quaerat nihil
                                            amet
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
            <div class="modal fade" id="notesModal" tabindex="-1" role="dialog" aria-labelledby="#notesModalLabel"
                aria-hidden="true">
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
                                                    data-whatever="@getbootstrap"><img src="/images/add.png" alt=""><img
                                                        src="/images.add.png" alt=""></button>

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
            <div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel"
                aria-hidden="true">
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

            {{-- Enrollments --}}
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
                                                    data-whatever="@getbootstrap"><img src="/images/add.png" alt=""><img
                                                        src="/images.add.png" alt=""></button>

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
            <div class="modal fade" id="enrollmentsModal" tabindex="-1" role="dialog"
                aria-labelledby="enrollmentsModalLabel" aria-hidden="true">
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

            {{-- Records --}}
            <section class="records  py-5 my-3" id="records">
                <div class="row">
                    <div class="col-12">
                        <h2 class="pr-3">Records</h2>
                        <div class="overflow-auto max-table">
                            <table class="table table-striped table-styling w-100 table-vertical_scroll">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Student Name</th>
                                        <th scope="col">School Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone Number</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                        <th scope="col" class="d-flex align-items-end justify-content-between">

                                            <span>
                                                <button type="button" class="btn btn-primary btn-modal ml-3"
                                                    data-toggle="modal" data-target="#recordsModal"
                                                    data-whatever="@getbootstrap"><img src="/images/add.png" alt=""><img
                                                        src="/images.add.png" alt=""></button>

                                            </span>
                                        </th>
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
                </div>
            </section>
            <div class="modal fade" id="recordsModal" tabindex="-1" role="dialog" aria-labelledby="recordsModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="recordsModalLabel">Create New Record</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="add-record-request">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">For student</label>
                                    <select id="student-name">

                                        @foreach ($allstudent as $student)

                                            <option value="{{ $student->id }}">{{ $student->first_name }}</option>

                                        @endforeach
                                    </select>
                                    <input type="hidden" value="{{ $parent->id }}" id='parent_id' name="parent_id">

                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">School Name:</label>
                                    <input type="text" class="form-control" id="school_name" id="recipient-name">
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Email Address:</label>
                                    <input type="email" id="email">
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Fax Number:</label>
                                    <input type="text" id="fax_number">
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Phone Number:</label>
                                    <input type="text" id="phone_number">
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Street Address</label>
                                    <input type="text" id="street_address">
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">City</label>
                                    <input type="text" id="city">
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">State/Province/Region</label>
                                    <input type="text" id="state">
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Zip/Postal Code</label>
                                    <input type="text" id="zipcode">
                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Country</label>
                                    <input type="text" id="country">
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>


            {{-- Documents --}}
            <section class="documents  py-5 my-3" id="documents">
                <div class="row">
                    <div class="col-12">
                        <h2 class="pr-3">Documents</h2>
                        <div class="overflow-auto max-table">
                            <table class="table table-striped table-styling w-100 table-vertical_scroll">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">File Name</th>
                                        <th scope="col">Document Type</th>
                                        <th scope="col">View Documents</th>
                                        <th scope="col">Upload Documents</th>
                                        <th scope="col" class="d-flex align-items-end justify-content-between">

                                            <span>
                                                <button type="button" class="btn btn-primary btn-modal ml-3"
                                                    data-toggle="modal" data-target="#documentsModal"
                                                    data-whatever="@getbootstrap"><img src="/images/add.png" alt=""><img
                                                        src="/images.add.png" alt=""></button>

                                            </span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($documents as $document)
                                        <tr>
                                            <td>{{ $document->created_at->format('M j,Y') }}</td>
                                            <td>{{ $document->original_filename }}</td>
                                            <td>{{ $document->document_type }}</td>
                                            <td><a href=" {{ route('admin.edit.uploadedDocument', $document->id) }}">View
                                                    Documents</a></br></td>
                                            <td><a
                                                    href=" {{ route('admin.edit.upload', $document->student_profile_id) }}">Upload
                                                    Documents</a></br></td>
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>

            <div class="modal fade" id="documentsModal" tabindex="-1" role="dialog" aria-labelledby="documentsModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="documentsModalLabel">New message</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="add-documents" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">For student</label>
                                    <select id="student-name">

                                        @foreach ($allstudent as $student)

                                            <option value="{{ $student->id }}">{{ $student->first_name }}</option>

                                        @endforeach
                                    </select>
                                    <input type="hidden" value="{{ $parent->id }}" id='parent_id' name="parent_id">

                                </div>
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Upload Document</label>
                                    <input type="file" id="file" class="form-control choose-btn" required>
                                </div>

                            </div>

                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Upload</button>

                        </form>
                    </div>
                </div>
            </div>

            <div class="text-right pb-4">
                <a href="#to-the-top" class="btn btn-primary">Back to Top</a>
            </div>



        </div>
    </section>





    </section>


@endsection
