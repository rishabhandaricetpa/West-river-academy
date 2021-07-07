@extends('admin.app')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <div class="card my-3 pb-5 family-details">
        <div class="sticky mb-2 pb-1">
            {{-- @include('admin.familyInformation.parent_header') --}}

            <ul class="nav overflow-auto align-items-center">
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

                <li class="nav-item">
                    <a class="nav-link" href="" onclick="return confirm('Are you sure you want to delete this family?');"
                        aria-controls="documents" aria-selected="true">Delete</a>
                </li>
                <li><a class="back-button" onclick="goBack()"> <img src="/images/back-button.png" alt=""></a></li>
            </ul>
            <div class="row parents-details_name px-3">
                <div class="col-12 d-flex align-items-center">
                    <h2 class="pr-3 mb-0">Family: Kate Green</h2>
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
                            <form class="is-readonly row" id="orderForm1">
                                @csrf
                                <div class="col-md-6">
                                    <h3 class="mt-3">Billing Iinformation</h3>
                                    <div class="form-group">
                                        <label for="p1_first_name">First Name :</label>
                                        <input type="text" class="form-control is-disabled" name="p1_first_name"
                                            id="p1_first_name" placeholder="" value="{{ $parent->p1_first_name }}"
                                            disabled required>
                                    </div>
                                    <input type="hidden" value="{{ $parent->id }}" id="parent_address_id">
                                    <input type="hidden" value="{{ $address->id }}" id="address_id">
                                    <div class="form-group">
                                        <label for="p1_last_name">Last Name :</label>
                                        <input type="text" class="form-control is-disabled" name="p1_last_name"
                                            id="p1_last_name" placeholder="" value="{{ $parent->p1_last_name }}" disabled
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="street_address">Street :</label>
                                        <input type="text" class="form-control is-disabled" id="billing_street_address"
                                            placeholder="" name="street_address" value="{{ $parent->street_address }}"
                                            disabled required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">City :</label>
                                        <input type="text" class="form-control is-disabled" id="billing_city" placeholder=""
                                            name="city" value="{{ $parent->city }}" disabled required>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">State :</label>
                                                <input type="text" class="form-control is-disabled" id="billing_state"
                                                    placeholder="" name="state" value="{{ $parent->state }}" disabled
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Zip Code :</label>
                                                <input type="text" class="form-control is-disabled" id="billing_zip_code"
                                                    placeholder="" name="state" value="{{ $parent->zip_code }}" disabled
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Country :</label>
                                        <input type="text" class="form-control is-disabled" id="billing_country"
                                            placeholder="" name="country" value="{{ $parent->country }}" disabled
                                            required>
                                    </div>
                               
                                </div>

                                {{-- shipping details 2 --}}
                                <div class="col-md-6">
                                    <h3 class="mt-3">Shipping Iinformation</h3>
                                    <div class="form-group">
                                        <label for="street_address">Street :</label>
                                        <input type="text" class="form-control is-disabled" id="shipping_street_address2"
                                            placeholder="" name="street_address"
                                            value="{{ $address->shipping_street_address }}" disabled required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">City :</label>
                                        <input type="text" class="form-control is-disabled" id="shipping_city2"
                                            placeholder="" name="city" value="{{ $address->shipping_city }}" disabled
                                            required>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">State :</label>
                                                <input type="text" class="form-control is-disabled" id="shipping_state2"
                                                    placeholder="" name="state" value="{{ $address->shipping_state }}"
                                                    disabled required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Zip Code :</label>
                                                <input type="text" class="form-control is-disabled" id="shipping_zip_code2"
                                                    placeholder="" name="state" value="{{ $address->shipping_zip_code }}"
                                                    disabled required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Country :</label>
                                        <input type="text" class="form-control is-disabled" id="shipping_country2"
                                            placeholder="" name="country" value="{{ $address->shipping_country }}"
                                            disabled required>
                                    </div>
                                    <div class="form-group">
                                        <label for="p1_email">Email :</label>
                                        <input type="email" class="form-control is-disabled" name="shipping_email"
                                            id="p1_email" placeholder="" value="{{ $address->email }}" disabled required>
                                    </div>

                                </div>

                                <div class="col-12 pt-3 d-md-flex">
                                    <button type="button"
                                        class="btn btn-default btn-primary form-enable btn-edit js-edit mr-2">Edit</button>
                                    <button type="submit"
                                        class="btn btn-default btn-primary form-enable  btn-save js-save mr-2">Save</button>
                                    <button type="button"
                                        class="btn btn-default btn-primary  btn-save js-cancel">Cancel</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </section>
            </form>
            {{-- student-details --}}
            <section class="parents-detail  pt-5" id="student-details">
                @include('admin.familyInformation.order-details')
            </section>


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




@endsection
