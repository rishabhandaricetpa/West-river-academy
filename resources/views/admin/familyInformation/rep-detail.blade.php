@extends('admin.app')

@section('content')
<section class="content container-fluid  my-3">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <!-- first card parent details -->

  <div class="card my-3 family-details">
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
          <a class="nav-link" href="{{ route('admin.parent.delete', $parent->id) }}"
            onclick="return confirm('Are you sure you want to delete this family?');" aria-controls="documents"
            aria-selected="true">Delete</a>
        </li>
        <li class="nav-item"><a href="#" class="add-menu-item nav-link" data-toggle="modal"
            data-target="#parentDetailsModal" data-whatever="@getbootstrap">
            <img src="/images/add-1.png" alt="">
          </a></li>
        <li><a class="back-button" onclick="goBack()"> <img src="/images/back-button.png" alt=""></a></li>
      </ul>
      <div class="row parents-details_name px-3">
        <div class="col-12 d-flex align-items-center">
          <h2 class="pr-3 mb-0">{{ $parent->p1_first_name }} {{ $parent->p1_middle_name }}
            {{ $parent->p1_last_name }} & {{ $parent->p2_first_name }} {{ $parent->p2_middle_name }}
            {{ $parent->p2_last_name }}</h2>
          <div class="form-group mb-0">
            <select required class="dropdown-icon" id="parent_status">
              <option @if ($parent->status === 0) selected @endif value="0">Active</option>
              <option @if ($parent->status === 1) selected @endif value="1">Inactive</option>
            </select>
            <input type="hidden" value="{{ $parent->id }}" id='parent_id' name="parent_id">
          </div>
        </div>
        <div class="col-12">Date Created: {{ $parent->created_at->format('M j, Y') }} </div>
      </div>
    </div>
    <div class="modal fade bd-example-modal-lg pt-4" id="parentDetailsModal" tabindex="-1" role="dialog"
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
                <label for="message-text" class="col-form-label">
                  <h2>Enter Parent 1 Information:</h2>
                </label>
                <div class="col-lg-4 col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">First Name:</label>
                    <input class="form-control" type="text" id='parent1_first_name' required>
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
                    <input class="form-control" type="email" id='parent1_email' required>
                  </div>
                </div>
                <div class="col-lg-4 col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Cell Phone:</label>
                    <input type="text" id="parent1_cell_phone" class="form-control" required>
                  </div>
                </div>

                <div class="col-lg-4 col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Work/Home Phone:</label>
                    <input type="text" id="parent1_home_phone" class="form-control">
                  </div>
                </div>
                <label for="message-text" class="col-form-label">
                  <h2>Enter Parent 2 Information:</h2>
                </label>
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
                    <input type="text" id="parent2_home_phone" class="form-control">
                  </div>
                </div>
                <label for="message-text" class="col-form-label">
                  <h2>Mailing Address:</h2>
                </label>

                <div class="col-lg-4 col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Street Address:</label>
                    <input type="text" id="parent1_street_address" class="form-control">
                  </div>
                </div>

                <div class="col-lg-4 col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">City:</label>
                    <input type="text" id="parent1_city" required class="form-control">
                  </div>
                </div>
                <div class="col-lg-4 col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">State:</label>
                    <input type="text" id="parent1_state" class="form-control">
                  </div>
                </div>

                <div class="col-lg-4 col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Zip Code:</label>
                    <input type="text" id="parent2_zip_code" required class="form-control">
                  </div>
                </div>
                <div class="col-lg-4 col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Country:</label>
                    <input type="text" id="parent2_country" required class="form-control">
                  </div>
                </div>
                <div class="col-lg-4 col-12">
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
</section>
@endsection
