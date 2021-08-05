@extends('layouts.app')
@section('pageTitle', 'Dashboard')
@section('content')

    <main class="position-relative container form-content mt-4">
        <h1 class="text-center text-white text-uppercase">dashboard</h1>
        <div class="form-wrap border bg-light py-5 px-25 mb-4">
            <h2 class="mb-5">What would you like to do?</h2>
            <div class="row dashboard-options">
                <div class="col-md-3 col-sm-6 text-center">
                    <a href="{{ route('order.consultation') }}" class="d-inline-block mb-5 decoration-none">
                        <i class="fas fa-comments rounded-circle circled-grid fa-2x text-secondary"></i>
                        <h3 class="mt-3 text-black font-weight-normal">Order a Personal Consultation</h3>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 text-center">
                    <a href="/orderpostage" class="d-inline-block mb-5 decoration-none">
                        <i class="fas fa-stamp rounded-circle circled-grid fa-2x text-secondary"></i>
                        <h3 class="mt-3 text-black font-weight-normal">Order Postage</h3>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 text-center">
                    <a href="https://www.idcreator.com/custom-id-designs/westriveracademy-id-card.html" target="_blank"
                        class="d-inline-block mb-5 decoration-none">
                        <i class="fas fa-id-card-alt rounded-circle circled-grid fa-2x text-secondary"></i>
                        <h3 class="mt-3 text-black font-weight-normal">Order a Student ID Card</h3>
                    </a>
                </div>

                @if ($parentData->country === 'United States')
                    <div class="col-md-3 col-sm-6 text-center">
                        <a href="{{ route('notarization') }}" class="d-inline-block mb-5 decoration-none">
                            <i class="fas fa-file-alt rounded-circle circled-grid fa-2x text-secondary"></i>
                            <h3 class="mt-3 text-black font-weight-normal">Order an Apostille or Notarization</h3>
                        </a>
                    </div>
                @endif


                @if ($parentData->country !== 'United States')
                    <div class="col-md-3 col-sm-6 text-center">
                        <a href="{{ route('choose_notarization') }}" class="d-inline-block mb-5 decoration-none">
                            <i class="fas fa-file-alt rounded-circle circled-grid fa-2x text-secondary"></i>
                            <h3 class="mt-3 text-black font-weight-normal">Order an Apostille or Notarization</h3>
                        </a>
                    </div>
                @endif

                <div class="col-md-3 col-sm-6 text-center">
                    <a href="{{ route('custom.payment') }}" class="d-inline-block mb-5 decoration-none">
                        <i class="fas fa-credit-card rounded-circle circled-grid fa-2x text-secondary"></i>
                        <h3 class="mt-3 text-black font-weight-normal">Make a Custom Payment</h3>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 text-center">
                    <a href="{{ route('order-transcript', Auth::user()->id) }}"
                        class="d-inline-block mb-5 decoration-none">
                        <i class="fas fa-folder-open rounded-circle circled-grid fa-2x text-secondary"></i>
                        <h3 class="mt-3 text-black font-weight-normal">Purchase a Transcript </h3>
                    </a>
                </div>
                {{-- <div class="col-md-3 col-sm-6 text-center">
                <a href="{{ route('enrolled.students') }}" class="d-inline-block mb-5 decoration-none">
            <i class="fas fa-gamepad rounded-circle circled-grid fa-2x text-secondary"></i>
            <h3 class="mt-3 text-black font-weight-normal">Transcript Wizard</h3>
            </a>
        </div> --}}

                <div class="col-md-3 col-sm-6 text-center">
                    <a href="{{ route('graduation.apply') }}" class="d-inline-block mb-5 decoration-none">
                        <i class="fas fa-graduation-cap rounded-circle circled-grid fa-2x text-secondary"></i>

                        <h3 class="mt-3 text-black font-weight-normal">Apply for Graduation</h3>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 text-center">
                    <a href="{{ route('custom.letter') }}" class="d-inline-block mb-5 decoration-none">
                        <i class="fas fa-clipboard rounded-circle circled-grid fa-2x text-secondary"></i>
                        <h3 class="mt-3 text-black font-weight-normal">Order a Custom Letter</h3>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 text-center">
                    <a href="{{ route('reviewstudent') }}" class="d-inline-block mb-5 decoration-none">
                        <i class="fas fa-user-friends rounded-circle circled-grid fa-2x text-secondary"></i>
                        <h3 class="mt-3 text-black font-weight-normal">Renew my Family’s Enrollment</h3>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 text-center">
                    <a href="{{ url('/enroll-student') }}" class="d-inline-block mb-5 decoration-none">
                        <i class="fas fa-user rounded-circle circled-grid fa-2x text-secondary"></i>
                        <h3 class="mt-3 text-black font-weight-normal">Enroll a new Student in my Family</h3>
                    </a>
                </div>
                <div class="col-sm-12">
                    <p>Need help? Check out our <a href="{{ route('video.tutorials') }}" class="btn btn-primary">Dashboard
                            Tutorial </a> or <a href="#" role="button" class="btn btn-primary"> Help me Decide</a></p>
                </div>
            </div>
        </div>
        <!-- -->
        @if ($amount > 0)
            <div class="form-wrap border bg-light py-5 px-25 mb-4">
                <h2 class="mb-3">Pay Now : <i class="fas fa-dollar-sign "></i> {{ $amount }}</h2>
                <a href="{{ route('add.cart') }}" class="btn btn-primary">Go To Cart</a>
            </div>
        @endif
        @if (count($transcript) > 0)
            <div class="form-wrap border bg-light py-5 px-25 mb-4">
                <h2 class="mb-3">Transcripts</h2>
                <p>Use the Edit Transcript link to edit your transcript. When a transcript is completed there will be a link
                    to
                    download it.</p>

                <div class="overflow-auto max-table mb-2">
                    <table class="table-styling w-100 table-vertical_scroll">
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Status</th>
                                <th>Transcript Period</th>
                                <th>Edit Transcript</th>
                                <th>Download</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transcript as $transcriptData)
                                @if ($transcriptData->period === 'K-8')
                                    <tr>
                                        <td>{{ $transcriptData['student']['fullname'] }}</td>
                                        @if ($transcriptData->status === 'paid')
                                            <td>Paid</td>
                                        @elseif($transcriptData->status === 'canEdit')
                                            <td>Edit</td>
                                        @elseif($transcriptData->status === 'approved')
                                            <td>Approved</td>
                                        @elseif($transcriptData->status === 'completed')
                                            <td>Submitted</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        <td>{{ $transcriptData->period }}</td>
                                        @if ($transcriptData->status === 'paid')
                                            <td>-</td>
                                        @elseif($transcriptData->status === 'canEdit' && $transcriptData->period='K-8')
                                            <td><a
                                                    href="{{ route('another.grade', [$transcriptData->student_profile_id, $transcriptData->id]) }}">Edit
                                                    Transcript</a></td>
                                        @elseif($transcriptData->status === 'approved')
                                            <td><a
                                                    href="{{ route('edit.transcript', [$transcriptData->id, $transcriptData->student_profile_id]) }}">Click
                                                    here to Change in Transcript</a></td>
                                        @elseif($transcriptData->status === 'completed' &&
                                            $transcriptData->period='K-8')
                                            <td><a
                                                    href="{{ route('preview.transcript', [$transcriptData->student_profile_id, $transcriptData->id]) }}">Preview
                                                    Transcript</a></td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        @if ($transcriptData->status === 'approved')
                                            <td><a
                                                    href="{{ route('download.transcript', [$transcriptData->id, $transcriptData->student_profile_id]) }}"><i
                                                        class="fas fa-file-pdf mr-2"></i>Download Transcript</a></td>
                                        @elseif($transcriptData->status === 'completed')
                                            <td>Waiting For Approval</td>
                                        @elseif($transcriptData->status === 'canEdit')
                                            <td>-</td>
                                        @elseif($transcriptData->status === 'paid')
                                            <td><a href="{{ route('transcript.create', [$transcriptData->id, $transcriptData->student_profile_id]) }}"
                                                    class="btn btn-primary">Create a Transcript</a></td>
                                        @endif
                                    </tr>
                                @else
                                    <tr>
                                        <td>{{ $transcriptData['student']['fullname'] }}</td>
                                        @if ($transcriptData->status === 'paid')
                                            <td>Paid</td>
                                        @elseif($transcriptData->status === 'canEdit')
                                            <td>Edit</td>
                                        @elseif($transcriptData->status === 'approved')
                                            <td>Approved</td>
                                        @elseif($transcriptData->status === 'completed')
                                            <td>Submitted</td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        <td>{{ $transcriptData->period }}</td>
                                        @if ($transcriptData->status === 'paid')
                                            <td>-</td>
                                        @elseif($transcriptData->status === 'canEdit')
                                            <td><a
                                                    href="{{ route('display.grades', [$transcriptData->student_profile_id, $transcriptData->id]) }}">Edit
                                                Transcript</a></td> @elseif($transcriptData->status === 'approved')
                                            <td><a
                                                    href="{{ route('edit.transcript', [$transcriptData->id, $transcriptData->student_profile_id]) }}">Click
                                                    here to Change in Transcript</a></td>
                                        @elseif($transcriptData->status === 'completed')
                                            <td><a
                                                    href="{{ route('preview.transcript9_12', [$transcriptData->student_profile_id, $transcriptData->id]) }}">Preview
                                                    Transcript</a></td>
                                        @else
                                            <td>-</td>
                                        @endif
                                        @if ($transcriptData->status === 'approved')
                                            <td><a
                                                    href="{{ route('download.transcript', [$transcriptData->id, $transcriptData->student_profile_id]) }}"><i
                                                        class="fas fa-file-pdf mr-2"></i>Download Transcript</a></td>
                                        @elseif($transcriptData->status === 'completed')
                                            <td>Waiting For Approval</td>
                                        @elseif($transcriptData->status === 'canEdit')
                                            <td>-</td>
                                        @elseif($transcriptData->status === 'paid')
                                            <td><a href="{{ route('transcript.create', [$transcriptData->id, $transcriptData->student_profile_id]) }}"
                                                    class="btn btn-primary">Create a Transcript</a></td>
                                        @endif
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <a href="{{ route('order-transcript', Auth::user()->id) }}" class="btn btn-primary mt-4">Purchase
                    Transcripts</a>
            </div>
        @endif
        @if (count($confirmLetter) > 0)
            <div class="form-wrap border bg-light py-5 px-25 mb-4">
                <h2 class="mb-3">Download Your Confirmation Letter</h2>
                <div class="mb-2 text-center text-sm-left">
                </div>
                <div class="overflow-auto max-table">
                    <table class="table-styling w-100 table-vertical_scroll">
                        <thead>
                            <tr>
                                <th>Student First Name</th>
                                <th>National Id</th>
                                <th>Grade</th>
                                <th>Status</th>
                                <th>Download</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($confirmLetter as $student)
                                <tr>
                                    <td>{{ $student->fullname }}</td>
                                    <td>{{ $student->student_Id }}</td>
                                    <td>{{ $student->grade_level }}</td>
                                    @if (getPaymentstatus($student->enrollment_payment_id) === 'paid')
                                        <td>Paid</td>
                                    @else
                                        <td>Pending</td>
                                    @endif
                                    @if (getPaymentstatus($student->enrollment_payment_id) === 'paid')
                                        <td><a href="{{ route('view.confirm', [$student->enrollment_payment_id, $student->grade_level]) }}"
                                                class="d-flex align-items-center"><i
                                                    class="fas fa-file-pdf mr-2"></i>Download</a></td>
                                    @else
                                        <td>-</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-2 text-md-right">
                    <p>Download your Enrollment Confirmation Letters from the download links above.</p>
                </div>
                <a href="{{ route('reviewstudent') }}" class="btn btn-primary" value="Renew Enrollment">Renew
                    Enrollment</a>
            </div>
        @endif
        @if (count($record_transfer))
            <div class="form-wrap border bg-light py-5 px-25 mb-4">
                <h2 class="mb-3">Record Transfer</h2>
                <div class="mb-2 text-center text-sm-left">
                </div>
                <div class="overflow-auto max-table">
                    <table class="table-styling w-100 table-vertical_scroll">
                        <thead>
                            <tr>
                                <th>Student First Name</th>
                                <th>School Name</th>
                                <th>Email</th>
                                <th>Phone number</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($record_transfer as $record)
                                <tr>
                                    <td>{{ $record['student']['fullname'] }}</td>
                                    <td>{{ $record->school_name }}</td>
                                    <td class="transform-none"> {{ $record->email }}</td>
                                    <td>{{ $record->phone_number }}</td>
                                    @if ($record->request_status === 'Pending' || empty($record->request_status))
                                        <td>Pending</td>
                                    @elseif($record->request_status === 'Record Received')
                                        <td>Record Received</td>
                                    @endif
                                    <td><a class="btn btn-primary"
                                            href="{{ route('edit.record', $record->id) }}">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-2 text-right">
                    <p></p>
                </div>
                <a class="btn btn-primary" href="{{ route('record.transfer', $parentId) }}">Request Record Transfer</a>
            </div>
        @endif
        @if (count($personal_consultation) > 0)
            <div class="form-wrap border bg-light py-5 px-25 mb-4">
                <h2 class="mb-3">Personal Consultation</h2>
                <div class="mb-2 text-center text-sm-left">
                </div>
                <div class="overflow-auto max-table">
                    <table class="table-styling w-100 table-vertical_scroll">
                        <thead>
                            <tr>
                                <th>Parent Name</th>
                                <th>Preferred language</th>
                                <th>Call Type</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($personal_consultation as $consultations)
                                <tr>
                                    <td>{{ $consultations['parent']['p1_first_name'] }}
                                        {{ $consultations['parent']['p1_last_name'] }}</td>
                                    <td>{{ $consultations->preferred_language }}</td>
                                    @if ($consultations->preferred_language === 'English')
                                        <td>{{ $consultations->en_call_type }}</td>
                                    @else
                                        <td>{{ $consultations->sp_call_type }}</td>
                                    @endif
                                    @if ($consultations->status === 'paid')
                                        <td>Paid</td>
                                    @else
                                        <td>{{ $consultations->status }}</td>
                                    @endif
                                    @if ($consultations->preferred_language === 'English')
                                        <td><a class="btn btn-primary"
                                                href="https://calendly.com/westriveracademy-peggywebb/consult"
                                                target="_blank">Schedule Consultation</a></td>
                                    @else
                                        <td><a class="btn btn-primary" href=" https://calendly.com/apoyowra/consulta"
                                                target="_blank">Schedule Consultation</a></td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
        @if (count($uploadedDocuments) > 0)

            <div class="form-wrap border bg-light py-5 px-25 mb-4">

                <h2 class="mb-3">Uploaded Documents From West River Academy</h2>
                <div class="mb-2 text-center text-sm-left">
                </div>
                <div class="overflow-auto max-table">
                    <table class="table-styling w-100 table-vertical_scroll">
                        <thead>
                            <tr>
                                <th>Document Type</th>
                                <th>Preview Documents</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($uploadedDocuments as $uploadedDocument)
                                <tr>
                                    @if (!empty($uploadedDocument->document_type))
                                        <td>{{ $uploadedDocument->document_type }}</td>
                                    @else
                                        <td>Uploaded By West River Academy</td>
                                    @endif
                                    <td>
                                        <div class="col-sm-12 mb-3">
                                            <a href="{{ $uploadedDocument->document_url }}" download
                                                target="_blank">Click here
                                                to
                                                preview</a>
                                        </div>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </main>
@endsection
