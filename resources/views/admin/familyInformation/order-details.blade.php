<section class="orders-detail  pt-10r" id="orders">
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
                <th scope="col">Details</th>
                <th scope="col" class="text-right"> <button type="button" class="btn btn-modal ml-3"
                    data-toggle="modal" data-target="#orderModal" data-whatever="@getbootstrap"><img
                      src="/images/add.png" alt=""><img src="/images.add.png" alt=""></button></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($transcations as $transcation)
              <tr>
                <td>{{ $transcation->created_at->format('M j,Y') }}</td>
                <td>{{ $transcation->payment_mode }}</td>
                <td>{{ $transcation->amount }}</td>
                <td>{{ $transcation->payment_mode }}</td>
                <?php $values = getOrders($transcation->transcation_id); ?>
                <td>{{ $values }}</td>
                <td><a href=" {{ route('admin.orders.details', $parent->id) }}"><i class=" fas fa-edit"
                    onclick="return myFunction();"></i></a></br>
        </td>
                <td></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
  <div class="modal fade bd-example-modal-lg" id="orderModal" tabindex="-1" role="dialog"
    aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="orderModalLabel">Add New Order</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="add-new-order">
            <div class="form-group">
              <label for="message-text" class="col-form-label">Order<span class="required">*</span></label>
              <select required class="form-control" id="order_detail_val">
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
                  <label for="message-text" class="col-form-label">Student Name<span class="required">*</span></label>
                  <select id="student_id_val" class="form-control" required>
                    @foreach ($allstudent as $student)
                    <option value="{{ $student->id }}" id="student_name_order">
                      {{ $student->fullname }} </option>
                    @endforeach
                  </select>
                  <input type="hidden" value="{{ $parent->id }}" id='parent_val' name="parent_val">
                </div>
              </div>
              <div class="col-lg-6 col-12">
                <div class="form-group">
                  <label for="message-text" class="col-form-label">Parent Name<span class="required">*</span>
                  </label>
                  <input type="text" id="parent_name" class="form-control" value="{{ $parent->p1_first_name }}"
                    disabled>
                </div>
              </div>
              <div class="col-lg-6 col-12">
                <div class="form-group">
                  <label for="message-text" class="col-form-label">Period</label>
                  <select type="" id="transcript_period" class="form-control" onchange="getTranscriptval();">
                    <option value="K-8">K-8</option>
                    <option value="9-12">9-12</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-6 col-12">
                <div class="form-group">
                  <label for="message-text" class="col-form-label">Amount<span class="required">*</span></label>
                  <input type="text" id="amount" class="form-control" disabled>
                </div>
              </div>
              <div class="col-lg-6 col-12">
                <div class="form-group">
                  <label for="message-text" class="col-form-label">Quantity<span class="required">*</span></label>
                  <input type="text" id="quantity" class="form-control" onchange="getTotalTranscript();">
                </div>
              </div>
              <div class="col-lg-6 col-12">
                <div class="form-group" id="transcript-paymentDetails">
                  <label for="message-text" class="col-form-label">Status<span class="required">*</span>
                  </label>
                  <select id="status" class="form-control" required>
                    <option value="order-detail_transcript-paid">Paid</option>
                    <option value="pending">Pending</option>
                  </select>
                </div>
              </div>
              <div class="col-12 order-detail_transcript-paid display-none" id="order-detail_transcript-paid">
                <div class="row">
                  <div class="col-lg-6 col-12 ">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Payment
                        Mode</label>
                      <select type="" id="postage_payment_mode" class="form-control">
                        <option value="Credit Card">Credit Card</option>
                        <option value="Pay Pal">Pay Pal</option>
                        <option value="Bank Transfer">Bank Transfer</option>
                        <option value="Money Gram">Money Gram</option>
                        <option value="Check or Money Order">Check or Money Order
                        </option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Transaction
                        ID</label>
                      <input type="text" id="postage_transaction_id" class="form-control">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-12">
                <div class="form-group">
                  <label for="message-text" class="col-form-label">Note
                  </label>
                  <textarea style="height:120px;" id="notes" class="form-control"></textarea>
                </div>
              </div>

              <div class="col-12">
                <div class="form-group">
                  <label for="message-text" class="col-form-label font-size-large">Total: </label>
                 <input type="text" id="total_val" class=" bg-light form-control" disabled>
                </div>
              </div>
            </div>
            <div class="order-detail_enrollment display-none" id="order-detail_enrollment">
              <div class="row">
                <div class="col-lg-6 col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Start Date</label>
                    <input type="date" id="order-start_date" class="form-control">
                  </div>
                </div>
                <input class="form-control" type="hidden" value="{{ $parent->id }}" id='parent_id' name="parent_id">
                <div class="col-lg-6 col-12">
                  <label for="recipient-name" class="col-form-label">For student</label>
                  <select id="order-student-name" class="form-control">
                    @foreach ($allstudent as $student)
                    <option value="{{ $student->id }}">{{ $student->first_name }}
                    </option>
                    @endforeach
                  </select>
                </div>
                <div class="col-lg-6 col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">End Date</label>
                    <input type="date" id="order-end-date" class="form-control" onchange="calculateType()">
                  </div>
                </div>
                <div class="col-lg-6 col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Grade</label>
                    <input type="text" id="order-grade" class="form-control">
                  </div>
                </div>

                <div class="col-lg-6 col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Type</label>
                    <input type="text" id="order-type" class="form-control" readonly>
                  </div>
                </div>
                <div class="col-lg-6 col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Amount</label>
                    <input type="text" id="order-amount" class="form-control" readonly>
                  </div>
                </div>
                <div class="col-lg-6 col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Status</label>
                    <select id="order-status" class="form-control">
                      <option value="pending">Pending</option>
                      <option value="paid">Paid </option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="order-detail_Graduation display-none" id="order-detail_Graduation">
              <div class="row">
                <form id="add-graduation">
                  <div class="form-group col-12">
                    <input type="hidden" value="{{ $parent->id }}" id='parent_id' name="parent_id">
                    <div class="row">
                      <div class="col-md-6 pb-2">
                        <div class="form-group">
                          <label for="recipient-name" class="col-form-label">For student</label>
                          <select id="student_ids" class="form-control">
                            @foreach ($allstudent as $student)
                            <option value="{{ $student->id }}">
                              {{ $student->first_name }}
                            </option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6 pb-2">
                        <div class="form-group">
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
                      </div>
                      <div class="col-md-6 pb-2">
                        <div class="form-group">
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
                      </div>
                      <div class="col-md-6 pb-2">
                        <div class="form-group">
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
                      </div>
                      <div class="col-md-6 pb-2">
                        <div class="form-group" id="grad-div-transction">
                          <label for="message-text" class="col-form-label">Transcation
                            ID</label>
                          <input type="text" id="grad_transction_id" class="form-control">
                        </div>
                      </div>
                      <div class="col-md-6 pb-2">
                        <div class="form-group" id="payment-div-grad">
                          <label for="message-text" class="col-form-label">Payment
                            Mode</label>
                          <select type="" id="custom_payment_mode" class="form-control">
                            <option value="">Select One </option>
                            <option value="Credit Card">Credit Card</option>
                            <option value="Paypal">Paypal</option>
                            <option value="Bank Transfer">Bank Transfer</option>
                            <option value="MoneyGram">MoneyGram</option>
                            <option value="Check Or Money Order"> Check Or Money Order
                            </option>

                          </select>
                        </div>
                      </div>
                      <div class="col-md-6 pb-2">
                        <label for="recipient-name" class="col-form-label">Status</label>
                        <select id="status-graduation" class="form-control">
                          <option value='paid'>Paid</option>
                          <option value='pending'>Pending</option>
                          <option value='approved'>Approved</option>
                          <option value='completed'>Completed</option>
                        </select>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
            <div class="order-detail_CustomPayment display-none" id="order-detail_CustomPayment">
              <div class="row">
                <div class="col-lg-6 col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Amount</label>
                    <input type="text" id="custom_amount" class="form-control">
                  </div>
                </div>
                <input type="hidden" value="{{ $parent->id }}" id='parent_id' name="parent_id">
                <div class="col-lg-6 col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Paying For</label>
                    <input type="text" id="custom_paying_for" class="form-control">
                  </div>
                </div>
                <div class="col-lg-6 col-12">
                  <div class="form-group" id="transction-div-custom">
                    <label for="message-text" class="col-form-label">Transcation Id</label>
                    <input type="text" id="custom_transcation" class="form-control">
                  </div>
                </div>
                <div class="col-lg-6 col-12">
                  <div class="form-group" id="payment-div-custom">
                    <label for="message-text" class="col-form-label">Payment Mode</label>
                    <select type="" id="custom_payment_mode" class="form-control">
                      <option value="">Select One </option>
                      <option value="Credit Card">Credit Card</option>
                      <option value="Paypal">Paypal</option>
                      <option value="Bank Transfer">Bank Transfer</option>
                      <option value="MoneyGram">MoneyGram</option>
                      <option value="Check Or Money Order"> Check Or Money Order</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-6 col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Status</label>
                    <select type="" id="custom_status" class="form-control">
                      <option value="paid">Paid</option>
                      <option value="pending">Pending</option>
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
                    <input type="text" id="p1_parent_name" class="form-control" value="{{ $parent->p1_first_name }}">
                    <input type="hidden" value="{{ $parent->id }}" id='parent_value'>
                  </div>
                </div>
                <div class="col-lg-6 col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Paying for</label>
                    <input type="text" id="paying_for" class="form-control">
                  </div>
                </div>
                <div class="col-lg-6 col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Postge Country</label>
                    <select class="form-control" id="postage_country" name="postage_country"
                      onchange="getCountryVal();">
                      <option value="">Select country</option>
                      @foreach ($countries as $country)
                      <option value="{{ $country->country }}">
                        {{ $country->country }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-lg-6 col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Amount</label>
                    <input type="text" id="postage_charge" class="form-control" disabled>
                  </div>
                </div>

                <div class="col-lg-6 col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Quanity</label>
                    <input type="text" id="postage_quantity" class="form-control" onchange="getTotal();">
                  </div>
                </div>
                <div class="col-lg-6 col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Status</label>
                    <select type="" id="OrderPostage-paymentDetails" class="form-control">
                      <option value="pending">Pending</option>
                      <option value="order-detail_OrderPostage-paid">Paid</option>
                    </select>
                  </div>
                </div>
                <div class="col-12 order-detail_OrderPostage-paid display-none" id="order-detail_OrderPostage-paid">
                  <div class="row">
                    <div class="col-lg-6 col-12 ">
                      <div class="form-group">
                        <label for="message-text" class="col-form-label">Payment
                          Mode</label>
                        <select type="" id="postage_payment_mode" class="form-control">
                          <option value="Credit Card">Credit Card</option>
                          <option value="Pay Pal">Pay Pal</option>
                          <option value="Bank Transfer">Bank Transfer</option>
                          <option value="Money Gram">Money Gram</option>
                          <option value="Check or Money Order">Check or Money Order
                          </option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <label for="message-text" class="col-form-label">Transaction
                          ID</label>
                        <input type="text" id="postage_transaction_id" class="form-control">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Note
                    </label>
                    <textarea style="height:120px;" id="notes_val" class="form-control"></textarea>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label font-size-large">Total: </label>
                 <input type="text" id="postage_total" class=" bg-light form-control" disabled>
                  </div>
                </div>

              </div>
            </div>
            <div class="order-detail_Notarization display-none" id="order-detail_Notarization">
              <div class="row">
                <div class="col-lg-6 col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Quantity</label>
                    <select type="" id="notarization_quantity" class="form-control"
                      onchange="getNoatrizationAmount();">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">2</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                      <option value="9">9</option>
                      <option value="10">10</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-6 col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Amount</label>
                    <input type="text" id="notar_amount" class="form-control" disabled>
                  </div>
                </div>
                <div class="col-lg-6 col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Shipping Country</label>
                    <select class="form-control" id="shipping_country" name="apostille_country"
                      onchange="getCountryValnotar(); getTotal();">
                      <option value="">Select country</option>
                      @foreach ($countries as $country)
                      <option value="{{ $country->country }}">
                        {{ $country->country }}</option>
                      @endforeach
                    </select>
                    <input type="hidden" value="{{ $parent->id }}" id='parent_profile_id'>

                  </div>
                </div>
                <div class="col-lg-6 col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Shipping Amount</label>
                    <input type="text" id="shipping_amount" class="form-control" disabled>
                  </div>
                </div>
                <div class="col-lg-6 col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Status</label>
                    <select type="" id="noatrization_status" class="form-control">
                      <option value="pending">Pending</option>
                      <option value="paid">Paid</option>
                    </select>
                  </div>
                </div>
                <div class="col-12" id="">
                  <div class="row">
                    <div class="col-lg-6 col-12 ">
                      <div class="form-group">
                        <label for="message-text" class="col-form-label">Payment Mode</label>
                        <select type="" id="notar_payment_mode" class="form-control">
                          <option value="Credit Card">Credit Card</option>
                          <option value="Pay Pal">Pay Pal</option>
                          <option value="Bank Transfer">Bank Transfer</option>
                          <option value="Money Gram">Money Gram</option>
                          <option value="Check or Money Order">Check or Money Order</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <label for="message-text" class="col-form-label">Transaction ID</label>
                        <input type="text" id="notar_transaction_id" class="form-control">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Note
                    </label>
                    <textarea style="height:120px;" id="notar_notes" class="form-control"></textarea>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label font-size-large">Total: </label>
                    <input type="text" id="notar_total" class=" bg-light form-control" disabled>
                  </div>

                </div>

              </div>
            </div>
            <div class="order-detail_ApostilePackage display-none" id="order-detail_ApostilePackage">
              <div class="row">
                <div class="col-lg-6 col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Quantity</label>
                    <select type="" id="apostille_quantity" class="form-control" onchange="getApostilleAmount(); ">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">2</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                      <option value="9">9</option>
                      <option value="10">10</option>
                    </select>
                    <input type="hidden" value="{{ $parent->id }}" id='parent_profile_id'>

                  </div>
                </div>
                <div class="col-lg-6 col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Amount</label>
                    <input type="text" id="apostille_amount" class="form-control" disabled>
                  </div>
                </div>
                <div class="col-lg-6 col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Shiping Country</label>
                    <select class="form-control" id="shipp_country" onchange="getCountryValappostille(); getTotal();">
                      <option value="">Select country</option>
                      @foreach ($countries as $country)
                      <option value="{{ $country->country }}">
                        {{ $country->country }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-lg-6 col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Shipping Charges</label>
                    <input type="text" id="ship_amount" class="form-control" disabled>
                  </div>
                </div>
                <div class="col-lg-6 col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Apostille Country</label>
                    <select class="form-control" id="apostille_country" name="apostille_country"
                      onchange="getCountryVal();">
                      <option value="">Select country</option>
                      @foreach ($countries as $country)
                      <option value="{{ $country->country }}">
                        {{ $country->country }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-lg-6 col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Status</label>
                    <select type="" id="apostille_status" class="form-control">
                      <option value="pending">Pending</option>
                      <option value="">Paid</option>
                    </select>
                  </div>
                </div>
                <div class="col-12" id="">
                  <div class="row">
                    <div class="col-lg-6 col-12 ">
                      <div class="form-group">
                        <label for="message-text" class="col-form-label">Payment Mode</label>
                        <select type="" id="apostille_payment_mode" class="form-control">
                          <option value="Credit Card">Credit Card</option>
                          <option value="Pay Pal">Pay Pal</option>
                          <option value="Bank Transfer">Bank Transfer</option>
                          <option value="Money Gram">Money Gram</option>
                          <option value="Check or Money Order">Check or Money Order</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6 col-12">
                      <div class="form-group">
                        <label for="message-text" class="col-form-label">Transaction ID</label>
                        <input type="text" id="apostille_transaction_id" class="form-control">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Note
                    </label>
                    <textarea style="height:120px;" id="apostille_notes" class="form-control"></textarea>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label font-size-large">Total: </label>
                    <input type="text" id="apostille_total" class=" bg-light form-control" disabled>
                  </div>
                </div>
              </div>
            </div>
              <div class="order-detail_CustomLetter display-none" id="order-detail_CustomLetter">
                <div class="row">
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Quanity Needed</label>
                      <input type="text" id="custom_letter_quantity" class="form-control"
                        onchange="calculateLetterAmount()">
                    </div>
                  </div>
                  <input type="hidden" value="{{ $parent->id }}" id='parent_id' name="parent_id">
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Amount</label>
                      <input type="text" id="custom_letter_amount" class="form-control" readonly>
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Paying For</label>
                      <input type="text" id="custom_letter_paying" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Status</label>
                      <select type="" id="custom_letter_status" class="form-control custom_letter_status">
                        <option value="paid">Paid</option>
                        <option value="pending">Pending</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group" id="transction-div">
                      <label for="message-text" class="col-form-label">Transcation ID</label>
                      <input type="text" id="custom_letter_transction" class="form-control">
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group" id="payment-div">
                      <label for="message-text" class="col-form-label">Payment Mode</label>
                      <select type="" id="custom_letter_payment_mode" class="form-control">
                        <option value="">Select One </option>
                        <option value="Credit Card">Credit Card</option>
                        <option value="Paypal">Paypal</option>
                        <option value="Bank Transfer">Bank Transfer</option>
                        <option value="MoneyGram">MoneyGram</option>
                        <option value="Check Or Money Order"> Check Or Money Order</option>

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
                      <input type="text" id="consul_parent_name" class="form-control"
                        value="{{ $parent->p1_first_name }}">
                      <input type="hidden" value="{{ $parent->id }}" id='p1_profile_id'>
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Preferred Language</label>
                      <select type="" class="form-control" id="language">
                        <option value="English">English</option>
                        <option value="Spanish">Spanish</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Hours</label>
                      <select type="" id="consul_quantity" class="form-control" onchange="getConsulatationAmount();">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">2</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Amount</label>
                      <input type="text" id="consul_amount" class="form-control" disabled>
                    </div>
                  </div>
                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Paying for</label>
                      <input type="text" id="consul_paying_for" class="form-control">
                    </div>
                  </div>


                  <div class="col-lg-6 col-12">
                    <div class="form-group">
                      <label for="message-text" class="col-form-label">Period</label>
                      <select type="" id="OrderConsultaion-paymentDetails" class="form-control">
                        <option value="pending">Pending</option>
                        <option value="order-detail_OrderConsultaion-paid">Paid</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-12 order-detail_OrderConsultaion-paid display-none"
                    id="order-detail_OrderConsultaion-paid">
                    <div class="row">
                      <div class="col-lg-6 col-12 ">
                        <div class="form-group">
                          <label for="message-text" class="col-form-label">Payment
                            Mode</label>
                          <select type="" id="consul_payment_mode" class="form-control">
                            <option value="Credit Card">Credit Card</option>
                            <option value="Pay Pal">Pay Pal</option>
                            <option value="Bank Transfer">Bank Transfer</option>
                            <option value="Money Gram">Money Gram</option>
                            <option value="Check or Money Order">Check or Money Order
                            </option>
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-6 col-12">
                        <div class="form-group">
                          <label for="message-text" class="col-form-label">Transaction
                            ID</label>
                          <input type="text" id="consul_transaction_id" class="form-control">
                        </div>
                      </div>
                    </div>
                  </div>
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