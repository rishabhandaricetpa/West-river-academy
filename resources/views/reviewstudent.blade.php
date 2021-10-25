@extends('layouts.app')
@section('pageTitle', 'Review Students')
@section('content')
    <main class="position-relative container form-content mt-4">
        <h1 class="text-center text-white text-uppercase">Student Enrollment</h1>
        <div class="form-wrap border bg-light py-5 px-25">
            <h2>Review Student Enrollment Information</h2>
            <form method="POST" action="" class="pb-2">
                @foreach ($students as $key => $student)
                    <div class="d-flex align-items-center pt-4">
                        <h3> Student {{ ++$key }} Profile </h3>
                        <a href="{{ route('edit.student', $student->id) }}" class="btn btn-primary ml-auto">Edit Student
                            {{ $key }} </a>
                    </div>
                    <div class="seperator">
                        <div class="form-group d-sm-flex mb-2">
                            <label for="">Student Name</label>
                            <div>
                                <p>{{ $student->first_name }} {{ $student->last_name }}</p>
                            </div>
                        </div>
                        <div class="form-group d-sm-flex mb-2">
                            <label for="">Date of Birth</label>
                            <div>
                                <p>{{ formatDate($student->d_o_b) }}</p>
                            </div>
                        </div>
                        <div class="form-group d-sm-flex mb-2">
                            <label for="">Email Address</label>
                            <div>
                                <p>{{ $student->email }}</p>
                            </div>
                        </div>
                        <div class="form-group d-sm-flex mb-2">
                            <label for="">Phone</label>
                            <div>
                                <p>{{ $student->cell_phone }}</p>
                            </div>
                        </div>
                        <div class="form-group d-sm-flex mb-2">
                            <label for="">National ID</label>
                            <div>
                                <p>{{ $student->student_Id }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </form>
            <div>
                <h3 class="py-3">Fees</h3>
                <form method="POST" id="review-form" action="{{ route('add.cart') }}">
                    @csrf
                    <input type="hidden" name="type" value="enrollment_period">
                    <div class="overflow-auto">
                        <table class="px-0 w-100 table-styling">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Enrollment Period</th>
                                    <th>Amount</th>
                                    <th>Select or De-select</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total_amount = 0;
                                @endphp
                                @foreach ($fees as $fee)
                                    <tr>
                                        <td>{{ $fee->first_name }} {{ $fee->last_name }}</td>
                                        <td class="ml-2">
                                        @if ($fee->type == 'annual') Annual @else
                                                Second Semester Only @endif
                                            <span class="small"> ({{ formatDate($fee->start_date_of_enrollment) }} -
                                                {{ formatDate($fee->end_date_of_enrollment) }} ) </span>
                                        </td>
                                        <td>${{ $fee->amount }}</td>
                                        <td style="min-width: 2rem;"> <input
                                                v-on:click="changeAmount($event, '{{ $fee->amount }}')" type="checkbox"
                                                name="eps[]" checked value="{{ $fee->id }}"> </td>
                                        @php
                                            $total_amount += $fee->amount;
                                        @endphp
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td class="text-center transform-none">Total to Pay </td>
                                    <td class="text-center"> $@{{ totalAmount }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="text-right mt-4">
                        <a href="/enroll-student" class="btn btn-primary mb-4 mb-sm-0">Add Another Student</a>
                        <button type="submit" class="btn btn-primary ml-3 transform-none"> Add selected items to Cart
                        </button>
                    </div>
                </form>
            </div>
    </main>
@endsection
@section('manualscript')
    <script>
        const reviewForm = new Vue({
            el: '#review-form',
            data() {
                return {
                    totalAmount: '{{ $total_amount }}'
                }
            },
            methods: {
                changeAmount(event, amount) {
                    if (event.srcElement.checked) {
                        this.addAmount(amount)
                    } else {
                        this.deductAmount(amount)
                    }
                },
                deductAmount(amount) {
                    this.totalAmount -= amount * 1;
                },
                addAmount(amount) {
                    this.totalAmount += amount * 1;
                }
            }
        });

    </script>
@endsection
