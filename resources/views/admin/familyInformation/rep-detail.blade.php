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
          <h2 class="pr-3"><a href="">{{$rep_detail->name}}</a>
          </h2>
          <div class="form-group mb-0">
            <select required class="dropdown-icon" id="student_status">
              <option selected value="0">Active</option>
              <option selected value="1">Inactive</option>
            </select>
            <input type="hidden" value="" id='id' name="id">
          </div>
        </div>
        <div class="col-12"> Date Created:  <span>{{getDateVal($rep_detail->created_at)}}</span> </div>
        {{-- parent detil-1 --}}
        <div class="col-md-12">
          <h3 class="mt-3">Name: <span>{{$rep_detail->name}}</span></h3>
          
          <form class="is-readonly row" id="repForm">
            @csrf
            <div class="col-md-6">
              <div class="form-group">
                <label> Type :</label>
                <input type="text" class="form-control is-disabled" name="edit_rep_type" id="edit_rep_type" 
                  value="{{$rep_detail->type}}" disabled required>
              </div>
              <input type="hidden" value={{$rep_detail->id}} id="edit_rep_id">
              <div class="form-group">
                <input type='hidden' id="edit_parent_id" name="parent_id" value="{{$parent_detail->id}}">
                <label>Country :</label>
                <input type="text" class="form-control is-disabled" name="edit_rep_country" id="edit_rep_country"
                   value="{{$rep_detail->country}}" disabled>
              </div>
              <div class="form-group">
                <label >City / Area :</label>
                <input type="text" class="form-control is-disabled" name="edit_rep_city" id="edit_rep_city" 
                  value="{{$rep_detail->city}}" disabled required>
              </div>
              <div class="form-group">
                <label >Name of Rep :</label>
                <input type="text" class="form-control is-disabled" name="edit_rep_name" id="edit_rep_name" 
                  value="{{$rep_detail->name}}" disabled required>
              </div>
              <div class="form-group">
                <label >Administrator of group :</label>
                <input type="text" class="form-control is-disabled" name="edit_rep_admin" id="edit_rep_admin" 
                  value="{{$rep_detail->name}}" disabled required>
              </div>
              <div class="form-group">
                <label >Rep Email :</label>
                <input type="email" class="form-control is-disabled" name="edit_rep_email" id="edit_rep_email"
                   value="{{$rep_detail->email}}" disabled>
              </div>
              <div class="form-group">
                <label >Rep Phone :</label>
                <input type="number" class="form-control is-disabled" name="edit_rep_phone" id="edit_rep_phone"
                   value="{{$rep_detail->rep_phone}}" disabled>
              </div>
              <div class="form-group">
                <label >Rep Skype Name :</label>
                <input type="text" class="form-control is-disabled" name="edit_rep_skype" id="edit_rep_skype"
                   value="{{$rep_detail->rep_skype}}" disabled>
              </div>
              <div class="form-group">
                <label >Terms of Agreement :</label>
                <input type="text" class="form-control is-disabled" name="terms_of_org" id="terms_of_org"
                   value="{{$rep_detail->terms_of_agreement}}" disabled>
              </div>
            </div>

            {{-- parents details 2 --}}
            <div class="col-md-6">
              <div class="bg-light p-3">
                <div class="d-flex justify-content-between py-2">
                  <input type="text" class="form-control">
                  <button class="btn btn-primary ml-2">Add</button>
                </div>
                <div class="overflow-auto max-table">
                  <table class="table table-striped table-styling w-100 table-vertical_scroll">
                    <thead class="thead-light">
                      <tr>
                        <th>Data Paid</th>
                        <th>Amount</th>
                        <th>Notes</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>22/12/2020</td>
                        <td>90</td>
                        <td>for 2020 repdetail-notes_add <i class="fa fa-cancel"></i></td>
                      </tr>
                      <tr>
                        <td>22/12/2020</td>
                        <td>90</td>
                        <td>for 2020 repdetail-notes_add <i class="fa fa-close"></i></td>
                      </tr>
                      <tr>
                        <td>22/12/2020</td>
                        <td>90</td>
                        <td>for 2020 repdetail-notes_add <i class="fa fa-cancel"></i></td>
                      </tr>
                      <tr>
                        <td>22/12/2020</td>
                        <td>90</td>
                        <td>for 2020 repdetail-notes_add <i class="fa fa-close"></i></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="col-12 pt-3 d-md-flex">
              <button type="button" class="btn btn-default btn-primary form-enable btn-edit js-edit mr-2">Edit</button>
              <button type="submit" class="btn btn-default btn-primary form-enable  btn-save js-save mr-2">Save</button>
              <button type="button" class="btn btn-default btn-primary  btn-save js-cancel">Cancel</button>
            </div>
          </form>
        </div>

      </div>
    </div>
    <nav class="student-detail_documents pt-4">
        <div class="nav nav-tabs justify-content-start" id="nav-tab" role="tablist">
          <a class="nav-link active" id="repdetail-family-tab" data-toggle="tab" href="#repdetail-family" role="tab"
            aria-controls="repdetail-family" aria-selected="true">Family</a>
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
                        <th scope="col">Paid</th>
                        <th scope="col" class="text-right"><button type="button" class="btn btn-modal ml-3"
                            data-toggle="modal" data-target="#rerepdetail-family_addModal"
                            data-whatever="@getbootstrap"><img src="/images/add.png" alt=""><img src="/images.add.png"
                              alt=""></button></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($family_groups as $family_group)
                     <tr>
                         <td>{{getDateVal($family_group->created_at)}}</td>
                         <td>{{$family_group->p1_first_name}}{{$family_group->p1_last_name}}</td>
                         <td></td>
                         <td><input type="checkbox"></td>
                         <td></td>
                     </tr>
                     @endforeach
                    </tbody>
                    <tfoot class="tfoot-light">
                      <tr>
                        <td colspan="5" class="text-center">CurrentlY Due:<span>$30</span> </td>
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
                        <th scope="col" class="text-right"><button type="button" class="btn btn-modal ml-3"
                            data-toggle="modal" data-target="#repdetail-notes_addModal" data-whatever="@getbootstrap"><img
                              src="/images/add.png" alt=""><img src="/images.add.png" alt=""></button></th>
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
          <div class="modal fade bd-example-modal-lg" id="repdetail-notes_addModal" tabindex="-1" role="dialog"
            aria-labelledby="repdetail-notes_addModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content mt-5">
                <div class="modal-header">
                 
                  <div class="modal-header">
                    <h5 class="modal-title" id="notesModalLabel">Add Notes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add-new-notes">
                        <div class="form-group">                            
                            <input class="form-control" type="hidden" value="{{ $parent_detail->id }}" id='parent_id'
                                name="parent_id">

                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Notes:</label>
                            <textarea class="form-control" id="message_text" required
                                onKeyPress="if(this.value.length==2000) return false;" maxlength="2000"></textarea>
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
        {{-- DOCUMENTS --}}
        <div class="tab-pane fade" id="repdetail-doc" role="tabpanel" aria-labelledby="repdetail-doc-tab">
          <section id="">
            <div class="row">
              <div class="col-12">
                <div class="overflow-auto max-table">
                  <table class="table table-striped table-styling w-100 table-vertical_scroll">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col">Date Applied</th>
                        <th scope="col">Grade 9</th>
                        <th scope="col"><button type="button" class="btn btn-modal ml-3" data-toggle="modal"
                            data-target="#repdetail-docModal" data-whatever="@getbootstrap"><img
                              src="/images/add.png" alt=""><img src="/images.add.png" alt=""></button></th>
                      </tr>
                    </thead>
                    <tbody>
                     <tr>
                         <td></td>
                         <td></td>
                         <td></td>
                     </tr>
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
                  <form id="add-graduation">
                    <div class="form-group row">
                      <div class="col-md-6">
                        <input type="hidden" value="" id='parent_id' name="parent_id">
                      </div>
                      <div class="col-md-6">
                        <input type="hidden" value="" id='student_id' name="student-name">
                      </div>
                      <div class="col-md-6 pb-2">
                        <label for="recipient-name" class="col-form-label">Grade 9</label>
                        <select id="grade_9" required class="form-control">
                          <option value="I was enrolled in West River Academy.">I was enrolled
                            in West River
                            Academy.
                          </option>
                          <option
                            value="I homeschooled independently. (There are no transcripts that a school can send.)">
                            I homeschooled independently. (There are no transcripts that a
                            school can send.)
                          </option>
                          <option
                            value="I was enrolled in another school that can send or has already sent transcripts.">
                            I was enrolled in another school that can send or has already
                            sent transcripts.
                          </option>
                          <option value="Others">Others</option>
                        </select>
                      </div>
                      <div class="col-md-6 pb-2">
                        <label for="recipient-name" class="col-form-label">Grade 10</label>
                        <select id="grade_10" required class="form-control">
                          <option value="I was enrolled in West River Academy.">I was enrolled
                            in West River
                            Academy.
                          </option>
                          <option
                            value="I homeschooled independently. (There are no transcripts that a school can send.)">
                            I homeschooled independently. (There are no transcripts that a
                            school can send.)
                          </option>
                          <option
                            value="I was enrolled in another school that can send or has already sent transcripts.">
                            I was enrolled in another school that can send or has already
                            sent transcripts.
                          </option>
                          <option value="Others">Others</option>
                        </select>
                      </div>
                      <div class="col-md-6 pb-2">
                        <label for="recipient-name" class="col-form-label">Grade 11</label>
                        <select id="grade_11" required class="form-control">
                          <option value="I was enrolled in West River Academy.">I was enrolled
                            in West River
                            Academy.
                          </option>
                          <option
                            value="I homeschooled independently. (There are no transcripts that a school can send.)">
                            I homeschooled independently. (There are no transcripts that a
                            school can send.)
                          </option>
                          <option
                            value="I was enrolled in another school that can send or has already sent transcripts.">
                            I was enrolled in another school that can send or has already
                            sent transcripts.
                          </option>
                          <option value="Others">Others</option>
                        </select>
                      </div>
                      <div class="col-md-6 pb-2">
                        <label for="recipient-name" class="col-form-label">Status</label>
                        <select id="status-graduation" class="form-control">
                          <option value='pending'>Pending</option>
                          <option value='approved'>Approved</option>
                          <option value='paid'>Paid</option>
                          <option value='completed'>Completed</option>
                        </select>
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
        {{-- TERMS OF AGREEMENT --}}
        <div class="tab-pane fade" id="repdetail-terms" role="tabpanel" aria-labelledby="repdetail-terms-tab">
          <section class="transcripts-detail" id="transcripts">
            <div class="row justify-content-center">
              <div class="col-10 pt-4">
               <div class="border border-secondary py-3 px-5">
<p><strong>Terms and Conditions</strong></p>
<p><strong>Grade 9: </strong> I was enrolled in another school that can send or has already sent transcripts.</p>
<p><strong>Grade 9: </strong> I was enrolled in another school that can send or has already sent transcripts.</p>
<p><strong>Grade 9: </strong> I was enrolled in another school that can send or has already sent transcripts.</p>

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
                        <input type="text" value="" id='parent_id' name="parent_id" class="form-control">
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
