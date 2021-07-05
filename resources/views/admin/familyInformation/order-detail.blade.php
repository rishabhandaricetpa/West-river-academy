@extends('admin.app')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@section('content')
<div class="card my-3 pb-5 family-details">
  <div class="sticky mb-2 pb-1">
    {{-- @include('admin.familyInformation.parent_header') --}}

    <ul class="nav overflow-auto align-items-center">
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

      <li class="nav-item">
        <a class="nav-link" href="" onclick="return confirm('Are you sure you want to delete this family?');"
          aria-controls="documents" aria-selected="true">Delete</a>
      </li>
      <li><a class="back-button" onclick="goBack()"> <img src="/images/back-button.png" alt=""></a></li>
    </ul>
    <div class="row parents-details_name px-3">
      <div class="col-12 d-flex align-items-center">
        <h2 class="pr-3 mb-0">
          Family: Kate Green
        </h2>

      </div>
      <div class="col-12">Date Created: </div>
    </div>
  </div>
  <div class="px-3" id="to-the-top">
    {{-- parents-details --}}
    {{-- parents-details --}}
    <section class="order-details pb-3" id="order-details">
      <div class="tab-content">
        {{-- -------------- first tab --}}
        <div class="row">
          {{-- billing detil-1 --}}
          <div class="col-md-12">
            <form class="is-readonly row" id="sampleForm">
              @csrf
              <div class="col-md-6">
                <h3 class="mt-3">Billing Iinformation</h3>
                <div class="form-group">
                  <label for="p1_first_name">First Name :</label>
                  <input type="text" class="form-control is-disabled" name="p1_first_name" id="p1_first_name"
                    placeholder="" value="" disabled required>
                </div>
                <div class="form-group">
                  <label for="p1_last_name">Last Name :</label>
                  <input type="text" class="form-control is-disabled" name="p1_last_name" id="p1_last_name"
                    placeholder="" value="" disabled required>
                </div>

                <div class="form-group">
                  <label for="street_address">Street :</label>
                  <input type="text" class="form-control is-disabled" id="street_address" placeholder=""
                    name="street_address" value="" disabled required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">City :</label>
                  <input type="text" class="form-control is-disabled" id="city" placeholder="" name="city" value=""
                    disabled required>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">State/Zip :</label>
                      <input type="text" class="form-control is-disabled" id="state" placeholder="" name="state"
                        value="" disabled required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">FL :</label>
                      <input type="text" class="form-control is-disabled" id="zip_code" placeholder="" name="state"
                        value="33707" disabled required>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Country :</label>
                  <input type="text" class="form-control is-disabled" id="country" placeholder="" name="country"
                    value="" disabled required>
                </div>
                <div class="form-group">
                  <label for="p1_email">Email :</label>
                  <input type="email" class="form-control is-disabled" name="p1_email" id="p1_email" placeholder=""
                    value="" disabled required>
                </div>

              </div>

              {{-- shipping details 2 --}}
              <div class="col-md-6">
                <h3 class="mt-3">Shipping Iinformation</h3>
                <div class="form-group">
                  <label for="p1_first_name">First Name :</label>
                  <input type="text" class="form-control is-disabled" name="p1_first_name" id="p2_first_name"
                    placeholder="" value="" disabled required>
                </div>
                <div class="form-group">
                  <label for="p1_last_name">Last Name :</label>
                  <input type="text" class="form-control is-disabled" name="p1_last_name" id="p2_last_name"
                    placeholder="" value="" disabled required>
                </div>

                <div class="form-group">
                  <label for="street_address">Street :</label>
                  <input type="text" class="form-control is-disabled" id="street_address2" placeholder=""
                    name="street_address" value="" disabled required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">City :</label>
                  <input type="text" class="form-control is-disabled" id="city2" placeholder="" name="city" value=""
                    disabled required>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">State/Zip :</label>
                      <input type="text" class="form-control is-disabled" id="state2" placeholder="" name="state"
                        value="" disabled required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">FL :</label>
                      <input type="text" class="form-control is-disabled" id="zip_code2" placeholder="" name="state"
                        value="33707" disabled required>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Country :</label>
                  <input type="text" class="form-control is-disabled" id="country2" placeholder="" name="country"
                    value="" disabled required>
                </div>
                <div class="form-group">
                  <label for="p1_email">Email :</label>
                  <input type="email" class="form-control is-disabled" name="p1_email2" id="p1_email" placeholder=""
                    value="" disabled required>
                </div>

              </div>
              <div class="col-12 pt-3 d-md-flex">
                <button type="button"
                  class="btn btn-default btn-primary form-enable btn-edit js-edit mr-2">Edit</button>
                <button type="submit"
                  class="btn btn-default btn-primary form-enable  btn-save js-save mr-2">Save</button>
                <button type="button" class="btn btn-default btn-primary  btn-save js-cancel">Cancel</button>
              </div>
          </div>
          </form>
        </div>
      </div>
    </section>
    </form>

    {{-- student-details --}}
    <section class="parents-detail  pt-5" id="student-details">
      <div class="row">
        <div class="col-12">
          <h2 class="pr-3"></h2>
          <div class="overflow-auto max-table">
            <table class="table table-striped table-styling w-100 table-vertical_scroll">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Code</th>
                  <th scope="col">Description</th>
                  <th scope="col" class="text-right"><button type="button" class="btn btn-modal ml-auto"
                      data-toggle="modal" data-target="#orderDetailsModal" data-whatever="@getbootstrap"><img
                        src="/images/add.png" alt=""><img src="/images.add.png" alt=""></button></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>MM/DD/YY</td>
                  <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. In fuga architecto incidunt culpa
                    repellat nihil, ea inventore ad natus amet soluta libero voluptates praesentium error laborum eum
                    corrupti vitae optio.</td>
                  <td></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
    <div class="modal fade bd-example-modal-lg" id="orderDetailsModal" tabindex="-1" role="dialog"
      aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="orderDetailsModalLabel">Add New Order</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="add-new-order">
              <div class="form-group">
                <label for="message-text" class="col-form-label">Order*</label>
                <select required class=" form-control " id="order-detail_add">
                  <option value="order-detail_transcript">Transcript</option>
                  <option value="order-detail_enrollment">Enrollment</option>
                  <option value="order-detail_Graduation">Graduation</option>
                  <option value="order-detail_CustomPayment">Custom Payments</option>
                  <option value="order-detail_OrderPostage">Order Postage</option>
                  <option value="order-detail_Notarization">Notarization</option>
                  <option value="order-detail_ApostilePackage">Apostile Package</option>
                  <option value="order-detail_CustomLetter">Custom Letter</option>
                  <option value="order-detail_OrderConsultaion">Order Personal Consultaion</option>
                </select>
              </div>


              <div class="order-detail_transcript row" id="order-detail_transcript">
                <div class="col-md-6 col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Student Name*</label>
                    <input type="text" id="d_o_b" class="form-control datepicker" required>
                  </div>
                </div>
                <div class="col-lg-6 col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Parent Name*
                    </label>
                    <input type="email" id="email" class="form-control">
                  </div>
                </div>
                <div class="col-lg-6 col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Status*</label>
                    <input type="text" id="phone" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Quantity*</label>
                    <input type="text" id="phone" class="form-control">
                  </div>
                </div>
                <div class="col-lg-6 col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Note
                    </label>
                    <textarea style="height:120px;" id="" class="form-control"></textarea>
                  </div>
                </div>
                <div class="col-lg-6 col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Amount*
                    </label>
                    <input type="text" id="" class="form-control">
                  </div>
                </div>
                <div class="col-lg-6 col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Total </label>
                    <input type="text" id="" class="form-control">
                  </div>
                </div>
                <div class="col-lg-6 col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Period</label>
                    <select type="" id="" class="form-control">
                      <option>K-8</option>
                      <option>9-12</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="order-detail_enrollment display-none" id="order-detail_enrollment">
                <div class="row">
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Start Date</label>
                      <input type="text" id="" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">End Date</label>
                      <input type="text" id="" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Grade</label>
                      <input type="text" id="" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Type</label>
                      <input type="text" id="" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Amount</label>
                      <input type="text" id="" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Period</label>
                      <select type="" id="" class="form-control">
                        <option>K-8</option>
                        <option>9-12</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="order-detail_Graduation display-none" id="order-detail_Graduation">
                <div class="row">
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Start Date</label>
                      <input type="text" id="" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Grade</label>
                      <input type="text" id="" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Type</label>
                      <input type="text" id="" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Amount</label>
                      <input type="text" id="" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Period</label>
                      <select type="" id="" class="form-control">
                        <option>K-8</option>
                        <option>9-12</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="order-detail_CustomPayment display-none" id="order-detail_CustomPayment">
                <div class="row">
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Start Date</label>
                      <input type="text" id="" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">End Date</label>
                      <input type="text" id="" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Grade</label>
                      <input type="text" id="" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Type</label>
                      <input type="text" id="" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Amount</label>
                      <input type="text" id="" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Period</label>
                      <select type="" id="" class="form-control">
                        <option>K-8</option>
                        <option>9-12</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="order-detail_OrderPostage display-none" id="order-detail_OrderPostage">
                <div class="row">
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Parent Name</label>
                      <input type="text" id="" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Amount</label>
                      <input type="text" id="" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Paying for</label>
                      <input type="text" id="" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Quanity</label>
                      <input type="text" id="" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Note
                      </label>
                      <textarea style="height:120px;" id="" class="form-control"></textarea>
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Total</label>
                      <input type="text" id="" class="form-control">
                    </div>
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Period</label>
                      <select type="" id="OrderPostage-paymentDetails" class="form-control">
                        <option>Pending</option>
                        <option value="order-detail_OrderPostage-paid">Paid</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-12 order-detail_OrderPostage-paid display-none" id="order-detail_OrderPostage-paid">
                    <div class="row">
                      <div class="col-lg-6 col-12 ">
                        <div class="form-group">
                          <label for="message-text" class="col-form-label">Payment Mode</label>
                          <input type="text" id="" class="form-control">
                        </div>
                      </div>
                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="message-text" class="col-form-label">Transaction ID</label>
                          <input type="text" id="" class="form-control">
                        </div>
                      </div>
                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="message-text" class="col-form-label">Type of Payment</label>
                          <input type="text" id="" class="form-control">
                        </div>
                      </div>
                    </div>
                  </div>



                </div>
              </div>
              <div class="order-detail_Notarization display-none" id="order-detail_Notarization">
                <div class="row">
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Start Date</label>
                      <input type="text" id="" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">End Date</label>
                      <input type="text" id="" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Grade</label>
                      <input type="text" id="" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Type</label>
                      <input type="text" id="" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Amount</label>
                      <input type="text" id="" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Period</label>
                      <select type="" id="" class="form-control">
                        <option>K-8</option>
                        <option>9-12</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="order-detail_ApostilePackage display-none" id="order-detail_ApostilePackage">
                <div class="row">
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Start Date</label>
                      <input type="text" id="" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">End Date</label>
                      <input type="text" id="" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Grade</label>
                      <input type="text" id="" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Type</label>
                      <input type="text" id="" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Amount</label>
                      <input type="text" id="" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Period</label>
                      <select type="" id="" class="form-control">
                        <option>K-8</option>
                        <option>9-12</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="order-detail_CustomLetter display-none" id="order-detail_CustomLetter">
                <div class="row">
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Start Date</label>
                      <input type="text" id="" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">End Date</label>
                      <input type="text" id="" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Grade</label>
                      <input type="text" id="" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Type</label>
                      <input type="text" id="" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Amount</label>
                      <input type="text" id="" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Period</label>
                      <select type="" id="" class="form-control">
                        <option>K-8</option>
                        <option>9-12</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="order-detail_OrderConsultaion display-none" id="order-detail_OrderConsultaion">
                <div class="row">
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Parent Name</label>
                      <input type="text" id="" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Preferred Language</label>
                      <select type="" class="form-control">
                        <option>English</option>
                        <option value="">Spanish</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Amount</label>
                      <input type="text" id="" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Paying for</label>
                      <input type="text" id="" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Quanity</label>
                      <input type="text" id="" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Total</label>
                      <input type="text" id="" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Period</label>
                      <select type="" id="OrderConsultaion-paymentDetails" class="form-control">
                        <option>Pending</option>
                        <option value="order-detail_OrderConsultaion-paid">Paid</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-12 order-detail_OrderConsultaion-paid display-none"
                    id="order-detail_OrderConsultaion-paid">
                    <div class="row">
                      <div class="col-lg-6 col-12 ">
                        <div class="form-group">
                          <label for="message-text" class="col-form-label">Payment Mode</label>
                          <input type="text" id="" class="form-control">
                        </div>
                      </div>
                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="message-text" class="col-form-label">Transaction ID</label>
                          <input type="text" id="" class="form-control">
                        </div>
                      </div>
                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="message-text" class="col-form-label">Type of Payment</label>
                          <input type="text" id="" class="form-control">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
<div class="row justify-content-end pt-2">
  <div class="col-md-4 col-12">
    <div class="d-flex align-items-center form-group">
      <label for="message-text" class="col-form-label col-form-label_highlights">Coupon</label>
      <select required class=" form-control " id="student_status">
        <option selected>Active</option>
        <option>Inactive</option>
      </select>
      <input type="text" id="" class="form-control">
      <input type="text" id="" class="form-control">
    </div>
    <div class="d-flex align-items-center form-group">
      <label for="message-text" class="col-form-label col-form-label_highlights">Total</label>
      <input type="text" id="" class="form-control">

    </div>
  </div>
</div>

</div>
</div>

@endsection
