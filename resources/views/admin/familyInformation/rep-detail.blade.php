@extends('admin.app')

@section('content')
    <section class="content container-fluid bg-white">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <!-- first card parent details -->
        <section class="rep-details p-3" id="rep-details">
            <div class="tab-content">
                {{-- -------------- first tab --}}
                <div class="row">
                    <div class="col-12 d-flex align-items-center">
                        <h2 class="pr-3"><a href="">Melissa Manisha</a>
                        </h2>
                        <div class="form-group mb-0">
                            <select required class="dropdown-icon" id="student_status">
                                <option selected value="0">Active</option>
                                <option selected value="1">Inactive</option>
                            </select>
                            <input type="hidden" value="" id='id' name="id">
                        </div>
                    </div>
                    <div class="col-12"> Date Created:</div>

                    <a class="btn btn-primary" href="{{ route('admin.generaterep.report', $rep_id) }}">Rep Report</a>
                    {{-- parent detil-1 --}}
                    <div class="col-md-12">
                        <h3 class="mt-3">Name :<span>Melissa</span></h3>

                        <form class="is-readonly row" id="repForm">
                            @csrf
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="p1_first_name"> Type :</label>
                                    <input type="text" class="form-control is-disabled" name="p1__name" id="p1__name"
                                        placeholder="" value="" disabled required>
                                </div>
                                <div class="form-group">
                                    <input type='hidden' id="parent_id" name="parent_id" value="">
                                    <label for="p1_middle_name">Country :</label>
                                    <input type="text" class="form-control is-disabled" name="p1_middle_name"
                                        id="p1_middle_name" placeholder="" value="" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="p1_last_name">City / Area :</label>
                                    <input type="text" class="form-control is-disabled" name="p1_last_name"
                                        id="p1_last_name" placeholder="" value="" disabled required>
                                </div>
                                <div class="form-group">
                                    <label for="p1_email">Name of Rep :</label>
                                    <input type="email" class="form-control is-disabled" name="p1_email" id="p1_email"
                                        placeholder="" value="" disabled required>
                                </div>
                                <div class="form-group">
                                    <label for="p1_cell_phone">Rep Email :</label>
                                    <input type="text" class="form-control is-disabled" name="p1_cell_phone"
                                        id="p1_cell_phone" placeholder="" value="" disabled>
                                </div>
                            </div>

                            {{-- parents details 2 --}}
                            <div class="col-md-6">
                                <div class="bg-light p-3">
                                    <div class="d-flex justify-content-between py-2">

                                        <button type="button" class="btn btn-primary ml-2" data-target="#testing1"
                                            data-toggle="modal" data-whatever="@getbootstrap">Add</button>
                                    </div>
                                    <div class="overflow-auto max-table">
                                        <table class="table table-striped table-styling w-100 table-vertical_scroll">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Date Paid</th>
                                                    <th>Amount</th>
                                                    <th>Notes</th>
                                                    <th>Remove</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($repGroupAmountDetails as $repGroupAmountDetail)
                                                    <tr>
                                                        <td>{{ formatDate($repGroupAmountDetail->created_at) }}</td>
                                                        <td>{{ $repGroupAmountDetail->amount }}</td>
                                                        <td>{{ $repGroupAmountDetail->notes }}
                                                        </td>
                                                        <td><a onclick="return confirm('Are you sure to delete?');"
                                                                href="{{ route('admin.delete.amount', $repGroupAmountDetail->id) }}">X</a><i
                                                                class="fa fa-cancel"></i></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
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
            {{-- add payment for rep --}}
            <div class="modal fade bd-example-modal-lg" id="testing1" tabindex="-1" role="dialog"
                aria-labelledby="#testing1" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content mt-5">
                        <div class="modal-header">
                            <h5 class="modal-title" id="testing1">ADD/SUBTRACT AMOUNT</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="add-rep-amount">
                            <div class="modal-body py-2 px-md-4 px-2">

                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Amount:</label>
                                    <input class="form-control" type="text" value="" id="rep_amount">
                                </div>

                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Notes:</label>
                                    <textarea class="form-control" id="rep_message_text"></textarea>
                                </div>
                                <input type="hidden" value="{{ $rep_id }}" id="rep_id">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <nav class="student-detail_documents pt-4">
                <div class="nav nav-tabs justify-content-start" id="nav-tab" role="tablist">
                    <a class="nav-link active" id="repdetail-family-tab" data-toggle="tab" href="#repdetail-family"
                        role="tab" aria-controls="repdetail-family" aria-selected="true">Family</a>
                    <a class="nav-link" id="repdetail-notes-tab" data-toggle="tab" href="#repdetail-notes" role="tab"
                        aria-controls="repdetail-notes" aria-selected="false">Notes</a>
                    <a class="nav-link" id="repdetail-doc-tab" data-toggle="tab" href="#repdetail-doc" role="tab"
                        aria-controls="repdetail-doc" aria-selected="false">Documents</a>
                    <a class="nav-link" id="repdetail-terms-tab" data-toggle="tab" href="#repdetail-terms" role="tab"
                        aria-controls="repdetail-terms" aria-selected="false">Terms Of Agreement</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                {{-- FAMILY --}}
                <div class="tab-pane fade show active" id="repdetail-family" role="tabpanel"
                    aria-labelledby="repdetail-family-tab">
                    {{-- rerepdetail-family_add --}}
                    <section class="" id="">
                        <div class="row">
                            <div class="col-12">
                                <div class="overflow-auto max-table">
                                    <table class="table table-striped table-styling w-100 table-vertical_scroll">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">Date</th>
                                                <th scope="col">Family Name</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col" class="text-right"><button type="button"
                                                        class="btn btn-modal ml-3" data-toggle="modal"
                                                        data-target="#rerepdetail-family_addModal"
                                                        data-whatever="@getbootstrap"><img src="/images/add.png" alt=""><img
                                                            src="/images.add.png" alt=""></button></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @foreach ($rep_families as $rep_family)
                                                    <td>{{ formatDate($rep_family->created_at) }}</td>
                                                    <td>{{ $rep_family->p1_first_name }}</td>
                                                    <td>{{ $repAmount }}</td>
                                                    <td></td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                        <tfoot class="tfoot-light">
                                            <tr>
                                                <td colspan="5" class="text-center">Currently
                                                    Due:<span>${{ $calculatedAmount }}</span>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </section>



                    {{-- rerepdetail-family_addModal --}}
                    <div class="modal fade bd-example-modal-lg" id="rerepdetail-family_addModal" tabindex="-1" role="dialog"
                        aria-labelledby="#rerepdetail-family_addModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content mt-5">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="rerepdetail-family_addModalLabel">Student Activity</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body py-2 px-md-4 px-2">
                                    <form id="add-new-notes">
                                        <div class="form-group">
                                            <input type="hidden" value="" id="student_name_for_notes">
                                            <input class="form-control" type="hidden" value="" id='parent_id'>
                                        </div>
                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">Notes:</label>
                                            <textarea id="message_text" class="form-control" id="message_text"></textarea>
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
                {{-- NOTES --}}
                <div class="tab-pane fade" id="repdetail-notes" role="tabpanel" aria-labelledby="repdetail-notes-tab">
                    <section class="repdetail-notes" id="">
                        <div class="row">
                            <div class="col-12">
                                <div class="overflow-auto max-table">
                                    <table class="table table-striped table-styling w-100 table-vertical_scroll">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">Date</th>
                                                <th scope="col">Notes</th>
                                                <th scope="col" class="text-right"><button type="button"
                                                        class="btn btn-modal ml-3" data-toggle="modal"
                                                        data-target="#repdetail-notes_addModal"
                                                        data-whatever="@getbootstrap"><img src="/images/add.png" alt=""><img
                                                            src="/images.add.png" alt=""></button></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>MM/DD/YY</td>
                                                <td>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sapiente quas
                                                    praesentium incidunt amet cum, dolores sint cupiditate ipsa labore
                                                    doloribus voluptate explicabo facilis qui voluptatem quae distinctio
                                                    nisi voluptates nostrum.</td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </section>
                    <div class="modal fade bd-example-modal-lg" id="repdetail-notes_addModal" tabindex="-1" role="dialog"
                        aria-labelledby="repdetail-notes_addModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content mt-5">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="repdetail-notes_addModalLabel">Add Enrollments</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="add-new-repdetail-notes_add">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <input type="hidden" value="" id='parent_id' name="parent_id"
                                                    class="form-control">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <input type="hidden" value="" id='student_name' name="student_name"
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
                                                <input type="text" class="form-control datepicker" id="start_date" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="message-text" class="col-form-label">End Date of
                                                    Enrollment:</label>
                                                <input type="text" class="form-control datepicker" id="end_date" required>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group lato-italic info-detail">
                                                    <label for="">Grade <sup>*</sup></label>
                                                    <div class="row">
                                                        <div class="col-6">


                                                            <div class="form-check" required>
                                                                <input class="form-check-input mt-1" type="radio"
                                                                    id="grade_level[]" value="Ungraded" required>
                                                                <label class="form-check-label pl-1 pl-sm-0">
                                                                    Ungraded
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input mt-1" type="radio"
                                                                    id="grade_level[]" value="Preschool Age 3">
                                                                <label class="form-check-label pl-1 pl-sm-0">
                                                                    Preschool Age 3
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input mt-1" type="radio"
                                                                    id="grade_level[]" value="Preschool Age 4">
                                                                <label class="form-check-label pl-1 pl-sm-0">
                                                                    Preschool Age 4
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input mt-1" type="radio"
                                                                    id="grade_level[]" value="Kindergarten" required>
                                                                <label class="form-check-label pl-1 pl-sm-0">
                                                                    Kindergarten
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input mt-1" type="radio"
                                                                    id="grade_level[]" value="1" required>
                                                                <label class="form-check-label pl-1 pl-sm-0">
                                                                    1
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input mt-1" type="radio"
                                                                    id="grade_level[]" value="2" required>
                                                                <label class="form-check-label pl-1 pl-sm-0">
                                                                    2
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input mt-1" type="radio"
                                                                    id="grade_level[]" value="3" required>
                                                                <label class="form-check-label pl-1 pl-sm-0">
                                                                    2
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input mt-1" type="radio"
                                                                    id="grade_level[]" value="4" required>
                                                                <label class="form-check-label pl-1 pl-sm-0">
                                                                    4
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input mt-1" type="radio"
                                                                    id="grade_level[]" value="5" required>
                                                                <label class="form-check-label pl-1 pl-sm-0">
                                                                    5
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input mt-1" type="radio" value="6"
                                                                    id="grade_level[]">
                                                                <label class="form-check-label pl-1 pl-sm-0">
                                                                    6
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check">
                                                                <input class="form-check-input mt-1" type="radio" value="7"
                                                                    id="grade_level[]">
                                                                <label class="form-check-label pl-1 pl-sm-0">
                                                                    7
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input mt-1" type="radio" value="8"
                                                                    id="grade_level[]">
                                                                <label class="form-check-label pl-1 pl-sm-0">
                                                                    8
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input mt-1" type="radio" value="9"
                                                                    id="grade_level[]">
                                                                <label class="form-check-label pl-1 pl-sm-0">
                                                                    9
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input mt-1" type="radio" value="10"
                                                                    id="grade_level[]">
                                                                <label class="form-check-label pl-1 pl-sm-0">
                                                                    10
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input mt-1" type="radio" value="11"
                                                                    id="grade_level[]">
                                                                <label class="form-check-label pl-1 pl-sm-0">
                                                                    11
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input mt-1" type="radio" value="12"
                                                                    id="grade_level[]">
                                                                <label class="form-check-label pl-1 pl-sm-0">
                                                                    12
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
                </div>
                {{-- DOCUMENTS --}}
                <div class="tab-pane fade" id="repdetail-doc" role="tabpanel" aria-labelledby="repdetail-doc-tab">
                    <section id="">
                        <div class="row">
                            <div class="col-12">
                                <div class="overflow-auto max-table">
                                    <table class="table table-striped table-styling w-100 table-vertical_scroll">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">Filename</th>
                                                <th scope="col">Notes</th>
                                                <th scope="col">Preview Document</th>
                                                <th scope="col"><button type="button" class="btn btn-modal ml-3"
                                                        data-toggle="modal" data-target="#repdetail-docModal"
                                                        data-whatever="@getbootstrap"><img src="/images/add.png" alt=""><img
                                                            src="/images.add.png" alt=""></button></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($repGroupDocuments as $repGroupDocument)
                                                <tr>
                                                    <td>{{ $repGroupDocument->original_filename }}</td>
                                                    <td>{{ $repGroupDocument->document_type }}</td>
                                                    <td> <a href="{{ $repGroupDocument->rep_document }}" download
                                                            target="_blank">Click here to download and
                                                            preview</a></td>
                                                    <td></td>
                                                </tr>
                                            @endforeach



                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </section>
                    <div class="modal fade bd-example-modal-lg" id="repdetail-docModal" tabindex="-1" role="dialog"
                        aria-labelledby="repdetail-docModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content mt-5">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="repdetail-docModalLabel">Add New Student</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="add-rep-doc">
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <input type="hidden" value="{{ $rep_id }}" id='rep_id' name="rep_id">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="message-text" class="col-form-label">
                                                    Notes</label>
                                                <textarea id="rep_doc_note" class="form-control choose-btn"
                                                    onKeyPress="if(this.value.length==2000) return false;"
                                                    maxlength="2000"></textarea>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="message-text" class="col-form-label">Upload Document</label>
                                                <input type="file" id="file" class="form-control choose-btn" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- TERMS OF AGREEMENT --}}
                <div class="tab-pane fade" id="repdetail-terms" role="tabpanel" aria-labelledby="repdetail-terms-tab">
                    <section class="transcripts-detail" id="transcripts">
                        <div class="row justify-content-center">
                            <div class="col-10 pt-4">
                                <div class="border border-secondary py-3 px-5">
                                    <p><strong>Terms and Conditions</strong></p>
                                    <p><strong>Grade 9: </strong> I was enrolled in another school that can send or has
                                        already sent transcripts.</p>
                                    <p><strong>Grade 9: </strong> I was enrolled in another school that can send or has
                                        already sent transcripts.</p>
                                    <p><strong>Grade 9: </strong> I was enrolled in another school that can send or has
                                        already sent transcripts.</p>

                                </div>
                            </div>
                        </div>
                    </section>
                    <div class="modal fade bd-example-modal-lg" id="transcriptModal" tabindex="-1" role="dialog"
                        aria-labelledby="transcriptModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content mt-5">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="transcriptModalLabel">Generate Transcript</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="add-new-transcript">
                                        <div class="row">
                                            <div class="form-group  col-md-6">
                                                <label for="recipient-name" class="col-form-label">For
                                                    student</label>
                                                <input type="text" value="" id='parent_id' name="parent_id"
                                                    class="form-control">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="recipient-name" class="col-form-label">For
                                                    Grades</label>
                                                <select id="enrollment_for" class="form-control">

                                                    <option value=""></option>

                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="recipient-name" class="col-form-label">Order</label>
                                                <select id="transcript_name" required class="form-control">
                                                    <option value="enrollment" id="transcript_name">Enrollment
                                                    </option>
                                                    <option value="transcript" id="transcript_name">Transcript
                                                    </option>
                                                    <option value="postage" id="transcript_name">Postage</option>
                                                    <option value="apostille" id="transcript_name">Apostille
                                                    </option>
                                                    <option value="notarization" id="transcript_name">Notarization
                                                    </option>
                                                    <option value="transcript_consultation" id="transcript_name">
                                                        Personal Consultation</option>
                                                    <option value="custom_payments" id="transcript_name">Custom
                                                        Payments</option>
                                                    <option value="custom_letter" id="transcript_name">Custom Letter
                                                    </option>
                                                    <option value="graduation" id="transcript_name">Graduation
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="recipient-name" class="col-form-label">Amount:</label>
                                                <input type="text" class="form-control" id="amount" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="recipient-name" class="col-form-label">Payment
                                                    Method</label>
                                                <select id="payment_mode" required class="form-control">
                                                    <option value="credit_card" id="payment_mode">Credit Card
                                                    </option>
                                                    <option value="paypal" id="payment_mode">Paypal</option>
                                                    <option value="Money Gram" id="payment_mode">Postage</option>
                                                    <option value="bankTransfer" id="payment_mode">Bank Transfer
                                                    </option>
                                                    <option value="checkandMoney" id="payment_mode">Check and Money
                                                        Order</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="recipient-name" class="col-form-label">Enrollment
                                                    Payment Status</label>
                                                <select id="enrollment_status" class="form-control">
                                                    <option value="paid">Paid</option>
                                                    <option value="pending">Pending</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="message-text" class="col-form-label">Message:</label>
                                                <textarea class="form-control" id="message"></textarea>
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
                </div>


            </div>
        </section>
    </section>
@endsection
