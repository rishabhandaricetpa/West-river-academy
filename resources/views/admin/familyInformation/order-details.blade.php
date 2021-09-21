<section class="orders-detail  pt-10r" id="orders">
    <div class="row">
        <div class="col-12">
            <h2 class="pr-3">Current Orders</h2>
            <div class="overflow-auto max-table">
                <table class="table table-striped table-styling w-100 table-vertical_scroll">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Order</th>
                            <th scope="col">Status</th>
                            <th scope="col">Amount</th>
                            <th scope="col" class="text-right"> <button type="button" class="btn btn-modal ml-3"
                                    data-toggle="modal" data-target="#orderModal" data-whatever="@getbootstrap"><img
                                        src="/images/add.png" alt=""><img src="/images.add.png" alt=""></button></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transcations as $transcation)
                            <tr>
                                <td>{{ $transcation->created_at->format('M j,Y') }}</td>
                                <td>{{ $transcation->item_type }}</td>
                                <td>Pending</td>
                                <td>{{ getOrderAmount($transcation->item_type, $transcation->item_id) }}</td>
                                <?php $values = getOrders($transcation->transcation_id); ?>
                                <td>{{ $values }}</td>
                                {{-- <td><a href=" {{ route('admin.orders.details', $transcation->parent_profile_id) }}"><i
                                             class=" fas fa-edit" onclick="return myFunction();"></i></a></br>
                                </td> --}}
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
                            <option value="">Select Order</option>
                            <option value="order-detail_transcript">Transcript</option>
                            <option value="order-detail_enrollment">Enrollment</option>
                            <option value="order-detail_Graduation">Graduation</option>
                            <option value="order-detail_CustomPayment">Custom Payments</option>
                            <option value="order-detail_OrderPostage">Postage</option>
                            <option value="order-detail_Notarization">Notarization</option>
                            <option value="order-detail_ApostilePackage">Apostille</option>
                            <option value="order-detail_CustomLetter">Custom Letter</option>
                            <option value="order-detail_OrderConsultaion">Personal Consultaion</option>
                        </select>
                    </div>
                    <div class="order-detail_transcript row" id="order-detail_transcript">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Student Name<span
                                        class="required">*</span></label>
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
                                <label for="message-text" class="col-form-label">Parent Name<span
                                        class="required">*</span>
                                </label>
                                <input type="text" id="parent_name" class="form-control"
                                    value="{{ $parent->p1_first_name }}" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Period</label>
                                <select id="transcript_period" class="form-control" onchange="getTranscriptval();">
                                    <option value="">Select...</option>
                                    <option value="K-8">K-8</option>
                                    <option value="9-12">9-12</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Amount<span
                                        class="required">*</span></label>
                                <select type="" id="amount" class="form-control" onchange="getTotalTranscript();">
                                    <option value="">Select...</option>
                                    <option value="25">25</option>
                                    <option value="80">80</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Quantity<span
                                        class="required">*</span></label>
                                <input type="text" id="quantity" class="form-control" onchange="getTotalTranscript();">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Status</label>
                                <select type="" id="status" class="form-control paymentDisplay">
                                    <option value="">Select</option>
                                    <option value="pending">Pending</option>
                                    <option value="paid">Paid</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-group transction-div">
                                <label for="message-text" class="col-form-label">Transaction ID</label>
                                <input type="text" id="transcript_transaction_id"
                                    class="form-control custom_letter_transction">
                            </div>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="form-group payment-div">
                                <label for="message-text" class="col-form-label">Payment Mode</label>
                                <select type="" id="transcript_pay_mode"
                                    class="form-control custom_letter_payment_mode">
                                    <option value="">Select One </option>
                                    <option value="Credit Card">Credit Card</option>
                                    <option value="Paypal">Paypal</option>
                                    <option value="Bank Transfer">Bank Transfer</option>
                                    <option value="MoneyGram">MoneyGram</option>
                                    <option value="Check Or Money Order"> Check Or Money Order</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Note
                                </label>
                                <textarea style="height:120px;" id="notes" class="form-control"
                                    onKeyPress="if(this.value.length==2000) return false;" maxlength="2000"></textarea>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group d-flex align-items-center justify-content-end">
                                <label for="message-text"
                                    class="col-form-label col-2 font-size-large  pt-2">Total:</label>
                                <input type="text" id="total_val" class="form-control col-6">
                            </div>
                        </div>
                    </div>
                    <div class="order-detail_enrollment display-none" id="order-detail_enrollment">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Start Date</label>
                                    <input type="date" id="start_date_of_enrollment" class="form-control">
                                </div>
                            </div>
                            <input class="form-control" type="hidden" value="{{ $parent->id }}" id='parent_id'
                                name="parent_id">
                            <div class="col-lg-6 col-12">
                                <label for="recipient-name" class="col-form-label">For Student</label>
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
                                    <input type="date" id="end_date_of_enrollment" class="form-control"
                                        onchange="calculateType()">
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Grade</label>
                                    <select id="order-grade" class="form-control">
                                        <option value="Ungraded">Ungraded</option>
                                        <option value="Preschool Age 3">Preschool Age 3 </option>
                                        <option value="Preschool Age 4">Preschool Age 4</option>
                                        <option value="Kindergarten">Kindergarten</option>
                                        <?php for ($i = 1; $i <= 12; $i++) { echo '<option value="' . $i
                                            . '">' . $i . '</option>' ; } ?> </select>
                                </div>
                            </div>

                            <div class="col-lg-6 col-12">
                                <label for="message-text" class="col-form-label">Type</label>
                                <select type="" id="order-type" class="form-control paymentDisplay">
                                    <option value="half">Second Semester</option>
                                    <option value="annual">Annual</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-12">
                                <label for="message-text" class="col-form-label">Amount</label>
                                <select type="" id="order-amount" class="form-control paymentDisplay">
                                    <option value="200">$200</option>
                                    <option value="50">$50</option>
                                    <option value="375">$375</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Status</label>
                                    <select type="" id="custom_letter_status" class="form-control paymentDisplay">
                                        <option value="">Select One</option>
                                        <option value="pending">Pending</option>
                                        <option value="paid">Paid</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group transction-div">
                                    <label for="message-text" class="col-form-label">Transaction ID</label>
                                    <input type="text" id="enrollment_transction_id"
                                        class="form-control custom_letter_transction">
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group payment-div">
                                    <label for="message-text" class="col-form-label">Payment Mode</label>
                                    <select type="" id="enrollment_pay_mode"
                                        class="form-control custom_letter_payment_mode">
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
                    <div class="order-detail_Graduation display-none" id="order-detail_Graduation">
                        <div class="row">
                            <div class="form-group col-12">
                                <input type="hidden" value="{{ $parent->id }}" id='parent_id' name="parent_id">
                                <div class="row">
                                    <div class="col-md-6 pb-2">
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">For student</label>
                                            <select id="student_ids" class="form-control grad-student">
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
                                            <label for="recipient-name" class="col-form-label">Include the Apostille
                                                package</label>
                                            <input type="checkbox" id="apostille_package" name="apostille_package"
                                                checked class="apostille_package">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12" id="apostille_country_pac">
                                        <div class="form-group">
                                            <label for="message-text"
                                                class="col-form-label apostille_country_pac">Apostille
                                                Country</label>
                                            <select class="form-control apostille_country_gard"
                                                id="apostille_country_gard">
                                                <option value="">Select country</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->country }}">
                                                        {{ $country->country }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 pb-2">
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Grade 9</label>
                                            <select id="grade_9" required class="form-control grade_9">
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
                                            <select id="grade_10" required class="form-control grade_10">
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
                                            <select id="grade_11" required class="form-control grade_11">
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
                                        <label for="recipient-name" class="col-form-label">Status</label>
                                        <select id="status-graduation" class="form-control paymentDisplay">
                                            <option value=''>Select</option>
                                            <option value='paid'>Paid</option>
                                            <option value='pending'>Pending</option>
                                            <option value='approved'>Approved</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 pb-2">
                                        <div class="form-group" id="grad-div-transction">
                                            <label for="message-text" class="col-form-label">Transaction
                                                ID</label>
                                            <input type="text" id="grad_transction_id" class="form-control ">
                                        </div>
                                    </div>
                                    <div class="col-md-6 pb-2">
                                        <div class="form-group" id="payment-div-grad">
                                            <label for="message-text" class="col-form-label">Payment
                                                Mode</label>
                                            <select type="" id="custom_payment_mode" class="form-control ">
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
                                    <textarea type="text" id="custom_paying_for" class="form-control"
                                        onKeyPress="if(this.value.length==2000) return false;"
                                        maxlength="2000"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Status</label>
                                    <select type="" id="custom1" class="form-control paymentDisplay">
                                        <option value="">Select...</option>
                                        <option value="paid">Paid</option>
                                        <option value="pending">Pending</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group transction-div" id="transction-div-custom">
                                    <label for="message-text" class="col-form-label">Transaction Id</label>
                                    <input type="text" id="custom_transcation1"
                                        class="form-control custom_letter_transction">
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group payment-div" id="payment-div-custom">
                                    <label for="message-text" class="col-form-label">Payment Mode</label>
                                    <select type="" id="custom_payment_mode1"
                                        class="form-control custom_letter_payment_mode">
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
                    <div class="order-detail_OrderPostage display-none" id="order-detail_OrderPostage">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Parent Name</label>
                                    <input type="text" id="p1_parent_name" class="form-control"
                                        value="{{ $parent->p1_first_name }}" disabled>
                                    <input type="hidden" value="{{ $parent->id }}" id='parent_value'>
                                </div>
                            </div>

                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Paying for</label>
                                    <textarea type="text" id="paying_for" class="form-control"
                                        onKeyPress="if(this.value.length==2000) return false;"
                                        maxlength="2000"></textarea>
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
                                    <label for="message-text" class="col-form-label">Quantity</label>
                                    <input type="text" id="postage_quantity" class="form-control"
                                        onchange="getTotal();">
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Status</label>
                                    <select type="" id="OrderPostage-paymentDetails"
                                        class="form-control  paymentDisplay">
                                        <option value="">Select</option>
                                        <option value="pending">Pending</option>
                                        <option value="paid">Paid</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group transction-div" id="transction-div-custom">
                                    <label for="message-text" class="col-form-label">Transaction Id</label>
                                    <input type="text" id="custom_transcation" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group payment-div" id="payment-div-custom">
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
                            <div class="col-12">
                                <div class="form-group d-flex align-items-center justify-content-end">
                                    <label for="message-text"
                                        class="col-form-label col-2 font-size-large  pt-2">Total:</label>
                                    <input type="text" id="postage_total" class="form-control col-6">
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
                                        onchange="getNoatrizationAmount(); getTotal();">
                                        <option value="">Select</option>
                                        <?php for ($i = 1; $i <= 10; $i++) { echo '<option value="' . $i
                                            . '">' . $i . '</option>' ; } ?> </select>
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
                                        onchange="getCountryValnotar();">
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
                                    <select type="" id="noatrization_status" class="form-control paymentDisplay">
                                        <option value="">Select...</option>
                                        <option value="paid">Paid</option>
                                        <option value="pending">Pending</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group transction-div" id="transction-div-custom">
                                    <label for="message-text" class="col-form-label">Transaction Id</label>
                                    <input type="text" id="notar_transaction_id" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group payment-div" id="payment-div-custom">
                                    <label for="message-text" class="col-form-label">Payment Mode</label>
                                    <select type="" id="notar_payment_mode" class="form-control">
                                        <option value="">Select One </option>
                                        <option value="Credit Card">Credit Card</option>
                                        <option value="Paypal">Paypal</option>
                                        <option value="Bank Transfer">Bank Transfer</option>
                                        <option value="MoneyGram">MoneyGram</option>
                                        <option value="Check Or Money Order"> Check Or Money Order</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Note
                                    </label>
                                    <textarea style="height:120px;" id="notar_notes" class="form-control"
                                        onKeyPress="if(this.value.length==2000) return false;"
                                        maxlength="2000"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="order-detail_ApostilePackage display-none" id="order-detail_ApostilePackage">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Quantity</label>
                                    <select type="" id="apostille_quantity" class="form-control"
                                        onchange="getApostilleAmount(); getTotal();">
                                        <option value="">Select</option>
                                        <?php for ($i = 1; $i <= 10; $i++) { echo '<option value="' . $i
                                            . '">' . $i . '</option>' ; } ?> </select>
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
                                    <label for="message-text" class="col-form-label">Shipping Country</label>
                                    <select class="form-control" id="shipp_country"
                                        onchange="getCountryValappostille(); getTotal();">
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
                                    <select type="" id="apostille_status" class="form-control paymentDisplay">
                                        <option value="">Select...</option>
                                        <option value="paid">Paid</option>
                                        <option value="pending">Pending</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6 col-12 ">
                                <div class="form-group  payment-div">
                                    <label for="message-text" class="col-form-label">Payment Mode</label>
                                    <select type="" id="apostille_payment_mode" class="form-control">
                                        <option value="">Select...</option>
                                        <option value="Credit Card">Credit Card</option>
                                        <option value="Pay Pal">Pay Pal</option>
                                        <option value="Bank Transfer">Bank Transfer</option>
                                        <option value="Money Gram">Money Gram</option>
                                        <option value="Check or Money Order">Check or Money Order</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group transction-div">
                                    <label for="message-text" class="col-form-label">Transaction ID</label>
                                    <input type="text" id="apostille_transaction_id" class="form-control">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Note
                                    </label>
                                    <textarea style="height:120px;" id="apostille_notes"
                                        onKeyPress="if(this.value.length==2000) return false;" maxlength="2000"
                                        class="form-control"></textarea>
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
                                    <input type="text" id="custom_letter_amount" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Paying For</label>
                                    <textarea type="text" id="custom_letter_paying" class="form-control"
                                        onKeyPress="if(this.value.length==2000) return false;"
                                        maxlength="2000"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Status</label>
                                    <select type="" id="custom_l_status" class="form-control paymentDisplay">
                                        <option value="">Select...</option>
                                        <option value="paid">Paid</option>
                                        <option value="pending">Pending</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group transction-div" id="transction-div">
                                    <label for="message-text" class="col-form-label">Transaction ID</label>
                                    <input type="text" id="custom_letter_transction"
                                        class="form-control custom_letter_transction">
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group payment-div" id="payment-div">
                                    <label for="message-text" class="col-form-label">Payment Mode</label>
                                    <select type="" id="custom_letter_payment_mode"
                                        class="form-control custom_letter_payment_mode">
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
                                    <select type="" id="consul_quantity" class="form-control"
                                        onchange="getConsulatationAmount();">
                                        <option value="">Select</option>
                                        <?php for ($i = 1; $i <= 10; $i++) { echo '<option value="' . $i
                                            . '">' . $i . '</option>' ; } ?> </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Amount</label>
                                    <input type="text" id="consul_amount" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Paying for</label>
                                    <textarea type="text" id="consul_paying_for" class="form-control"
                                        onKeyPress="if(this.value.length==2000) return false;"
                                        maxlength="2000"></textarea>
                                </div>
                            </div>


                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Status</label>
                                    <select type="" id="OrderConsultaion-paymentDetails"
                                        class="form-control paymentDisplay">
                                        <option value="">Select...</option>
                                        <option value="pending">Pending</option>
                                        <option value="paid">Paid</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 order-detail_OrderConsultaion-paid"
                                id="order-detail_OrderConsultaion-paid">
                                <div class="row">
                                    <div class="col-lg-6 col-12 ">
                                        <div class="form-group payment-div">
                                            <label for="message-text" class="col-form-label">Payment
                                                Mode</label>
                                            <select type="" id="consul_payment_mode" class="form-control">
                                                <option value="">Select...</option>
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
                                        <div class="form-group transction-div">
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
