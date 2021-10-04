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
                        <h2 class="pr-3"><a href=""></a>
                        </h2>

                    </div>
                    <div class="col-12"></div>
                    {{-- parent detil-1 --}}

                    <div class="col-md-12">
                        <h3 class="mt-3">Name: <span>{{ $rep_group->name }}</span></h3>

                        <form class="is-readonly row" id="repForm">
                            @csrf
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Type :</label>
                                    <input type="text" class="form-control is-disabled" name="edit_rep_type"
                                        id="edit_rep_type" value="{{ $rep_group->type }}" disabled required>
                                </div>
                                <input type="hidden" value="{{ $rep_group->id }}" id="edit_rep_id">
                                <div class="form-group">
                                    <input type='hidden' id="edit_parent_id" name="parent_id" value="">
                                    <label>Country :</label>
                                    <input type="text" class="form-control is-disabled" name="edit_rep_country"
                                        id="edit_rep_country" value="{{ $rep_group->country }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>City / Area :</label>
                                    <input type="text" class="form-control is-disabled" name="edit_rep_city"
                                        id="edit_rep_city" value="{{ $rep_group->city }}" disabled required>
                                </div>
                                <div class="form-group">
                                    <label>Name :</label>
                                    <input type="text" class="form-control is-disabled" name="edit_rep_name"
                                        id="edit_rep_name" value="{{ $rep_group->name }}" disabled required>
                                </div>

                                <div class="form-group">
                                    <label> Email :</label>
                                    <input type="email" class="form-control is-disabled" name="edit_rep_email"
                                        id="edit_rep_email" value="{{ $rep_group->email }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label> Phone :</label>
                                    <input type="number" class="form-control is-disabled" name="edit_rep_phone"
                                        id="edit_rep_phone" value="{{ $rep_group->rep_phone }}" disabled>
                                </div>

                                <div class="form-group">
                                    <label>Terms of Agreement :</label>
                                    <textarea class="form-control is-disabled" name="terms_of_org" id="terms_of_org"
                                        disabled>{{ $rep_group->terms_of_agreement }}</textarea>
                                </div>
                                <div class="pt-3 d-md-flex">
                                    <button type="button"
                                        class="btn btn-default btn-primary form-enable btn-edit js-edit mr-2">Edit</button>
                                    <button type="button"
                                        class="btn btn-default btn-primary form-enable btn-edit js-edit mr-2"
                                        onclick="goBack()">Back</button>
                                    <button type="submit"
                                        class="btn btn-default btn-primary form-enable  btn-save js-save mr-2">Save</button>
                                    <button type="button"
                                        class="btn btn-default btn-primary  btn-save js-cancel">Cancel</button>
                                </div>
                            </div>

                            {{-- parents details 2 --}}
                            <div class="col-md-6">
                                <div class="bg-light p-3">
                                    <button type="button" class="btn btn-primary ml-2 mb-2" data-target="#testing1"
                                        data-toggle="modal" data-whatever="@getbootstrap">Add</button>
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
                                                        @if ($repGroupAmountDetail->amount > 0)
                                                            <td>${{ $repGroupAmountDetail->amount }}</td>
                                                        @else
                                                            <td>{{ '-$' . abs($repGroupAmountDetail->amount) }}</td>
                                                        @endif
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

                        </form>
                    </div>

                </div>
            </div>
            <div class="mt-4 bg-light p-3">
                <form method="post" action="{{ route('admin.generaterep.report') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            Report From <input type="date" id="report_from" name="report_from" class="form-control">
                        </div>
                        <div class="col-md-6">
                            Report To <input type="date" id="report_to" name="report_to" class="form-control">
                        </div>
                        <input type="hidden" value="{{ $rep_id }}" name="rep_id">
                    </div>
                    <div class="text-secondary py-3"> Note : If dates are not selected then report will
                        have all families mentioned below.</div>
                    <button type="submit" class="btn btn-primary"> Rep Report </button>
                </form>
            </div>
            {{-- add payment for rep --}}
            <div class="modal fade bd-example-modal-lg pt-5 " id="testing1" tabindex="-1" role="dialog"
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
                                    <input class="form-control" type="number" value="" id="rep_amount" required>
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


            <nav class="student-detail_documents pt-5">
                <div class="nav nav-tabs justify-content-start" id="nav-tab" role="tablist">
                    <a class="nav-link active" id="repdetail-family-tab" data-toggle="tab" href="#repdetail-family"
                        role="tab" aria-controls="repdetail-family" aria-selected="true">Family</a>
                    <a class="nav-link" id="repdetail-notes-tab" data-toggle="tab" href="#repdetail-notes" role="tab"
                        aria-controls="repdetail-notes" aria-selected="false">Notes</a>
                    <a class="nav-link" id="repdetail-doc-tab" data-toggle="tab" href="#repdetail-doc" role="tab"
                        aria-controls="repdetail-doc" aria-selected="false">Documents</a>
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
                                                @foreach ($family_groups as $rep_family)
                                                    <td>{{ formatDate($rep_family->created_at) }}</td>
                                                    <td><a
                                                            href="{{ route('admin.parent.edit', $rep_family->id) }}">{{ $rep_family->p1_first_name }}</a>
                                                    </td>
                                                    <td>${{ $rep_family->amount }}</td>
                                                    <td></td>
                                            </tr>
                                            @endforeach

                                        </tbody>

                                    </table>
                                </div>
                                <table>
                                    <tfoot class="tfoot-light">
                                        <tr>
                                            <td colspan="5" class="text-center">Currently
                                                Due:
                                                @if ($calculatedAmount > 0)
                                                    <span>${{ $calculatedAmount }}</span>
                                                @elseif($calculatedAmount == 0)
                                                    <span>${{ $calculatedAmount }}</span>
                                                @else
                                                    <span>{{ '-$' . abs($calculatedAmount) }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </section>
                    {{-- rerepdetail-family_addModal --}}
                    <div class="modal fade bd-example-modal-lg pt-5 " id="rerepdetail-family_addModal" tabindex="-1"
                        role="dialog" aria-labelledby="#rerepdetail-family_addModalLabel" aria-hidden="true">
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
                                            @foreach ($getNotes as $getNote)
                                                <tr>
                                                    <td>{{ $getNote->created_at->format('M j, Y') }}</td>
                                                    <td>{{ $getNote->notes }}</td>
                                                    <td></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </section>
                    <div class="modal fade bd-example-modal-lg pt-5 " id="repdetail-notes_addModal" tabindex="-1"
                        role="dialog" aria-labelledby="repdetail-notes_addModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content mt-5">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="notesModalLabel">Add Notes</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="add-rep-notes">
                                        <div class="form-group">
                                            <input class="form-control" type="hidden" value="{{ $rep_id }}"
                                                id='rep_group_id'>
                                        </div>
                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">Notes:</label>
                                            <textarea class="form-control" id="rep_message_val" required
                                                onKeyPress="if(this.value.length==2000) return false;"
                                                maxlength="2000"></textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
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
                                                            target="_blank">Click here
                                                            to download and
                                                            preview</a></td>
                                                    <td></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                </div>
        </section>
        <div class="modal fade bd-example-modal-lg pt-5 " id="repdetail-docModal" tabindex="-1" role="dialog"
            aria-labelledby="repdetail-docModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content mt-5">
                    <div class="modal-header">
                        <h5 class="modal-title" id="repdetail-docModalLabel">Add New Student</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form id="add-rep-doc">
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="message-text" class="col-form-label">
                                        Notes</label>
                                    <textarea id="rep_doc_note" class="form-control choose-btn"
                                        onKeyPress="if(this.value.length==2000) return false;" maxlength="2000"></textarea>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="message-text" class="col-form-label">Upload Document</label>
                                    <input type="file" id="file" class="form-control choose-btn" required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="hidden" value="{{ $rep_id }}" id='rep_id' name="rep_id">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
        </div>
        </div>
    </section>
    </section>
@endsection
