@extends('layouts.app')
@section('pageTitle', 'MyAccount')
@section('content')
    <!-- * =============== Main =============== * -->

    <main class="position-relative container form-content mt-4">
        <div class="form-wrap border bg-light py-5 px-25">

            <form class="row">
                <div class="col-md-6">
                    <h2 class="mb-3">User Information</h2>
                    <div class="form-group d-sm-flex mb-2">
                        <label for="">First Name</label>
                        <div>{{ $parent->p1_first_name }}</div>
                    </div>
                    <div class="form-group d-sm-flex mb-2">
                        <label for="">Last Name</label>
                        <div>{{ $parent->p1_last_name }}</div>
                    </div>
                    <div class="form-group d-sm-flex mb-2">
                        <label for="">Email</label>
                        <div>{{ $parent->p1_email }}</div>
                    </div>
                    <div class="form-group d-sm-flex mb-2">
                        <label for="">Phone</label>
                        <div>{{ $parent->p1_cell_phone }}</div>
                    </div>
                    <a href="{{ url('/editaccount', $user_id) }}" class="btn btn-primary">Edit Your Login</a>
                </div>

                <div class="col-md-6">
                    <h2 class="mb-3">Password</h2>
                    <form>
                        <div class="form-group ">
                            <label for="">Password</label>
                            <div>********</div>
                        </div>
                        <a href="{{ route('reset.password', $user_id) }}" class="btn btn-primary">Change Your
                            Password?</a>

                </div>
        </div>

        <div class="form-wrap row border bg-light py-5 px-25 mt-2r ">
            <div class="col-md-6">
                <h2 class="mb-3">Mailing Address</h2>
                <form>
                    <div class="form-group d-sm-flex mb-2">
                        <label for="">Street Address</label>
                        <div>{{ $parent->street_address }}</div>
                    </div>
                    <div class="form-group d-sm-flex mb-2">
                        <label for="">City</label>
                        <div>{{ $parent->city }}</div>
                    </div>
                    <div class="form-group d-sm-flex mb-2">
                        <label for="">State</label>
                        <div>{{ $parent->state }}</div>
                    </div>
                    <div class="form-group d-sm-flex mb-2">
                        <label for="">Zip code</label>
                        <div>{{ $parent->zip_code }}</div>
                    </div>
                    <div class="form-group d-sm-flex mb-2">
                        <label for="">Country</label>
                        <div>{{ $parent->country }}</div>
                    </div>
                    <a href="{{ route('editMailingAddress', $user_id) }}" class="btn btn-primary">Edit Your Mailing
                        Address</a>
                </form>
            </div>

            <div class="col-md-6">
                <h2 class="mb-3">Parent 2 Information</h2>
                <form>
                    <div class="form-group d-sm-flex mb-2">
                        <label for=""> Name</label>
                        <div>{{ $parent->p2_first_name }}</div>
                    </div>
                    <div class="form-group d-sm-flex mb-2">
                        <label for="">Last Name</label>
                        <div>{{ $parent->p2_last_name }}</div>
                    </div>
                    <div class="form-group d-sm-flex mb-2">
                        <label for="">Email</label>
                        <div>{{ $parent->p2_email }}</div>
                    </div>
                    <div class="form-group d-sm-flex mb-2">
                        <label for="">Cell Phone</label>
                        <div>{{ $parent->p2_cell_phone }}</div>
                    </div>
                    <div class="form-group d-sm-flex mb-2">
                        <label for="">Phone Number</label>
                        <div>{{ $parent->p2_home_phone }}</div>
                    </div>
                    <a href="{{ url('/editaccount', $user_id) }}" class="btn btn-primary">Edit Your Login</a>
            </div>
        </div>


        <!-- Transcript Payment History Start-->
        @if (count($transcript_payments) > 0)
            <div class="form-wrap border bg-light py-5 px-25 mt-2r">
                <h2 class="mb-3">Paid For: Transcripts</h2>
                <div class="overflow-auto max-table">
                    <table class="table-styling w-100 table-vertical_scroll">
                        <thead>
                            <tr>
                                <th scope="col">Student Name</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Payment Method</th>
                                <th scope="col">Transcation Id</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transcript_payments as $transcript_payment)
                                <tr>

                                    <td>{{ $transcript_payment['student']['first_name'] }}</td>
                                    <td>${{ $transcript_payment['transcriptPayment']['amount'] }}</td>
                                    <td>{{ $transcript_payment['transcriptPayment']['payment_mode'] }}</td>
                                    <td>{{ $transcript_payment['transcriptPayment']['transcation_id'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Custom Payment History Start-->
        @if (count($customPayments) > 0)
            <div class="form-wrap border bg-light py-5 px-25 mt-2r">
                <h2 class="mb-3">Paid For: Custom Payments</h2>
                <div class="overflow-auto max-table">
                    <table class="table-styling w-100 table-vertical_scroll">
                        <thead>
                            <tr>
                                <th scope="col">Parent Name</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Payment Method</th>
                                <th scope="col">Transcation Id</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customPayments as $customPayment)
                                <tr>

                                    <td>{{ $customPayment['ParentProfile']['p1_first_name'] }}</td>
                                    <td>${{ $customPayment['amount'] }}</td>
                                    <td>{{ $customPayment['payment_mode'] }}</td>
                                    <td>{{ $customPayment['transcation_id'] }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                    </div>

                </div>
            </div>
        @endif

        <!-- Enrollment Payment History Start-->
        @if (count($enrollmentPayments) > 0)
            <div class="form-wrap border bg-light py-5 px-25 mt-2r">
                <h2 class="mb-3">Paid For: Enrollment Payments</h2>
                <div class="overflow-auto max-table">
                    <table class="table-styling w-100 table-vertical_scroll">
                        <thead>
                            <tr>
                                <th scope="col">Student Name</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Payment Method</th>
                                <th scope="col">Transcation Id</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($enrollmentPayments as $enrollmentPayment)
                                <tr>
                                    <td>{{ $enrollmentPayment->first_name }}</td>
                                    <td>${{ $enrollmentPayment->amount }}</td>
                                    <td>{{ $enrollmentPayment->payment_mode }}</td>
                                    <td>{{ $enrollmentPayment->transcation_id }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        <!-- Graduation Payment History Start-->

        @if (count($graduationPayments) > 0)
            <div class="form-wrap border bg-light py-5 px-25 mt-2r">
                <h2 class="mb-3">Paid For: Graduations </h2>
                <div class="overflow-auto max-table">
                    <table class="table-styling w-100 table-vertical_scroll">
                        <thead>
                            <tr>
                                <th scope="col">Student Name</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Payment Method</th>
                                <th scope="col">Transcation Id</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($graduationPayments as $graduationPayment)
                                <tr>
                                    <td>{{ $graduationPayment->first_name }}</td>
                                    <td>${{ $graduationPayment->amount }}</td>
                                    <td>{{ $graduationPayment->payment_mode }}</td>
                                    <td>{{ $graduationPayment->transcation_id }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Notirization Payment History Start-->

        @if (count($graduationPayments) > 0)
            <div class="form-wrap border bg-light py-5 px-25 mt-2r">
                <h2 class="mb-3">Paid For: Notarizations </h2>
                <div class="overflow-auto max-table">
                    <table class="table-styling w-100 table-vertical_scroll">
                        <thead>
                            <tr>
                                <th scope="col">Student Name</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Payment Method</th>
                                <th scope="col">Transcation Id</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notirizationPayments as $notirizationPayment)
                                <tr>

                                    <td>{{ $notirizationPayment['ParentProfile']['p1_first_name'] }}</td>
                                    <td>${{ $notirizationPayment->amount }}</td>
                                    <td>{{ $notirizationPayment->payment_mode }}</td>
                                    <td>{{ $notirizationPayment->transcation_id }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                    </div>
                </div>

            </div>

        @endif
        <!-- Order Personal Consulation Payment History Start-->
        @if (count($orderConsulationPayments) > 0)
            <div class="form-wrap border bg-light py-5 px-25 mt-2r">
                <h2 class="mb-3">Paid For: Order Consulation Payments</h2>
                <div class="overflow-auto max-table">
                    <table class="table-styling w-100 table-vertical_scroll">
                        <thead>
                            <tr>
                                <th scope="col">Parent Name</th>
                                <th scope="col">Preferred Language</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Payment Method</th>
                                <th scope="col">Transcation Id</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderConsulationPayments as $orderConsulationPayment)
                                <tr>
                                    <td>{{ $orderConsulationPayment['parent']['p1_first_name'] }}</td>
                                    <td>{{ $orderConsulationPayment->preferred_language }}</td>
                                    <td>${{ $orderConsulationPayment->amount }}</td>
                                    <td>{{ $orderConsulationPayment->payment_mode }}</td>
                                    <td>{{ $orderConsulationPayment->transcation_id }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div>
                </div>
            </div>
        @endif
    </main>

    <!-- * =============== /Main =============== * -->
@endsection
