@extends('admin.app')

@section('content')
    <section class="content container-fluid  my-1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <div class="rep-list bg-white py-3 px-2 overflow-auto">
            <button type="button" class="btn btn-primary btn-modal ml-3" data-toggle="modal"
                data-target="#addrep-list-Modal" data-whatever="@getbootstrap"><span>Add Rep</span><img
                    src="/images.add.png" alt="">
            </button>
            <div class="modal fade bd-example-modal-lg mt-5" id="addrep-list-Modal" tabindex="-1" role="dialog"
                aria-labelledby="addrep-list-ModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addrep-list-Label">Add Repo List</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="add-new-enrollments">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <input type="hidden" value="" id='parent_id' name="parent_id" class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="hidden" value="" id='student_name_enroll' name="student_name"
                                            class="form-control">
                                    </div>
                                    <div class="form-group  col-md-6">
                                        <label for="recipient-name" class="col-form-label">Enrollment
                                            Period</label>
                                        <select id="enrollment_period" required class="form-control">
                                            <option value="annual">Annual</option>
                                            <option value="half">Semester</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="recipient-name" class="col-form-label">Start Date of
                                            Enrollment:</label>
                                        <input type="date" class="form-control" id="start_date" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="message-text" class="col-form-label">End Date of
                                            Enrollment:</label>
                                        <input type="date" class="form-control" id="end_date" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="recipient-name" class="col-form-label">Start Date of
                                            Enrollment:</label>
                                        <input type="date" class="form-control" id="start_date" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="message-text" class="col-form-label">End Date of
                                            Enrollment:</label>
                                        <input type="date" class="form-control" id="end_date" required>
                                    </div>
                                    <div class="form-group  col-md-6">
                                        <label for="recipient-name" class="col-form-label">Enrollment
                                            Payment Status</label>
                                        <select id="enrollment_status" required class="form-control">
                                            <option value="paid">Paid</option>
                                        </select>
                                    </div>
                                    <div class="form-group  col-md-6">
                                        <label for="recipient-name" class="col-form-label">Amount</label>
                                        <select id="amount_status" required class="form-control">
                                            <option value="375">$ 375</option>
                                            <option value="200">$ 200</option>
                                            <option value="50">$ 50</option>
                                        </select>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <table class="datatable-pagination table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Name of Rep </th>
                        <th>Country</th>
                        <th>City/Area</th>
                        <th>Rep E-mail</th>
                        <th>Rep Phone</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all_reps as $rep)
                        <tr>
                            <td><a href="{{ route('admin.rep.details', $rep->id) }}"> {{ $rep->name }} </a></td>
                            <td>{{ $rep->country }}</td>
                            <td>{{ $rep->city }}</td>
                            <td class="center">{{ $rep->email }}</td>
                            <td><a class="nav-link" href="{{ route('admin.delete.rep', $rep->id) }}"
                                    onclick="return confirm('Are you sure you want to delete this representative?');"
                                    aria-controls="documents" aria-selected="true"><i class="fas fa-trash-alt"></i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </section>
@endsection
