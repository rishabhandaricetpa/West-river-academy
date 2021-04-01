@extends('layouts.app')
@section('pageTitle', 'Preview Transcript')
@section('content')

<main class="position-relative container form-content mt-4">
    <h1 class="text-center text-white text-uppercase">dashboard</h1>

    <div class="form-wrap border bg-light py-2r px-25 text-center dashboard-info">
        <p>I'm finished with this transcript. I want to see what it looks like</p>
        <a href="{{ url('/transcript-pdf') }}" class="btn btn-primary mt-4 font-weight-bold" data-toggle="modal" data-target="#previewTranscriptModal">View Transcript</a>
        <a href="{{ route('submit.transcript',[$student->id,$transcript_id]) }}" class="btn btn-primary mt-4 font-weight-bold">Submit</a>
    </div>
</main>

<div class="modal fade" id="previewTranscriptModal" tabindex="-1" role="dialog" aria-labelledby="previewTranscriptModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <table>
                    <tbody>
                        <tr width="100%">
                            <td style="width:100%;color:#EC1D1D;font-weight:400;font-size:19px;margin:0 auto;">After this transcript is approved by you, any further changes will incure a $25 fee.</td>
                        </tr>
                    </tbody>
                </table>
                <table style="margin-bottom:20px;" width="100%">
                    <tbody>
                        <tr style="width:100%;">
                            <td width="50%" style="text-transform:uppercase;font-weight: 700;font-size:25px;">official transcript</td>
                            <td width="50%" style="text-align:center;">
                                <img src="https://www.westriveracademy.com/cwp/img/wra_logo.svg" alt="logo" style="filter: brightness(0.5);max-width: 300px;margin: 0 auto;object-fit:contain;display:block;">
                                <p style="margin:0;font-size:14px;">Califorinia Colorado USA</p>
                                <p style="margin:0;font-size:14px;">949.492.5240 info@westriveracademy.com</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table width="100%">
                    <tbody>
                        <tr style="width:100%;">
                            <td style="text-transform:uppercase;width:10%;font-size:11px;line-height:1;">student</td>
                            <td style="font-weight:700;text-transform:uppercase;text-align:left;font-size:11px;width:50%;line-height:1;">{{$student->fullname}}</td>
                            <td style="text-transform:uppercase;width:20%;font-size:11px;line-height:1;">date of birth</td>
                            <td style="font-weight:700;text-transform:uppercase;text-align:left;width:20%;font-size:11px;line-height:1;">{{$student->d_o_b->format(' M d Y')}}</td>
                        </tr>
                    </tbody>
                </table>
                <table width="100%">
                    <tbody>
                        <tr style="width:100%;">
                            <td style="text-transform:uppercase;font-size:11px;width:10%;line-height:1;">address</td>
                            <td style="font-weight:700;text-transform:uppercase;text-align:left;font-size:11px;width:50%;line-height:1;">{{$address->street_address}} {{$address->city}}, {{$address->zip_code}}, {{$address->country}}</td>
                            <td style="text-transform:uppercase;font-size:11px;width:20%;line-height:1;">academic years</td>
                            <td style="font-weight:700;text-transform:uppercase;text-align:left;font-size:11px;width:20%;line-height:1;">2021</td>
                        </tr>
                    </tbody>
                </table>
                <table style="margin-bottom:40px;" width="100%">
                    <tbody>
                        <tr style="width:100%;">
                            <td style="text-transform:uppercase;font-size:14px;width:10%;"></td>
                            <td style="font-weight:700;text-transform:uppercase;text-align:left;font-size:14px;width:50%;"></td>
                            <td style="text-transform:uppercase;font-size:11px;width:20%;line-height:1;">grade level</td>
                            <td style="font-weight:700;text-transform:uppercase;text-align:left;font-size:11px;width:20%;line-height:1;">{{ getPromotedGrades($grades) }}</td>
                        </tr>
                    </tbody>
                </table>
                <table width="100%">
                    <tbody>
                        <tr style="width:100%;">
                            <table style="width:100%;" border="1">
                                <tr>
                                    <td style="width:50%;">
                                        <table border="1" style="width:100%;border:0;">
                                            <thead style="background-color:#cccccc70">
                                                <tr>
                                                    <th style="text-transform:uppercase;font-size:14px;padding:7px;line-height: 1;">course name</th>
                                                    <th style="text-transform:uppercase;font-size:14px;padding:7px;line-height: 1;">yr</th>
                                                    <th style="text-transform:uppercase;font-size:14px;padding:7px;line-height: 1;">cr</th>
                                                    <th style="text-transform:uppercase;font-size:14px;padding:7px;line-height: 1;"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="font-weight:700;text-align:center;font-size:14px;">Acadmic Year 2014 - 2015</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:7px;line-height:1;font-size:14px;">Mathematics 9</td>
                                                    <td style="padding:7px;line-height:1;font-size:14px;">9</td>
                                                    <td style="padding:7px;line-height:1;font-size:14px;">1.00</td>
                                                    <td style="padding:7px;line-height:1;font-size:14px;">B</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:7px;line-height:1;font-size:14px;">Mathematics 9</td>
                                                    <td style="padding:7px;line-height:1;font-size:14px;">9</td>
                                                    <td style="padding:7px;line-height:1;font-size:14px;">1.00</td>
                                                    <td style="padding:7px;line-height:1;font-size:14px;">B</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:7px;line-height:1;font-size:14px;">Mathematics 9</td>
                                                    <td style="padding:7px;line-height:1;font-size:14px;">9</td>
                                                    <td style="padding:7px;line-height:1;font-size:14px;">1.00</td>
                                                    <td style="padding:7px;line-height:1;font-size:14px;">B</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:7px;line-height:1;font-size:14px;">Mathematics 9</td>
                                                    <td style="padding:7px;line-height:1;font-size:14px;">9</td>
                                                    <td style="padding:7px;line-height:1;font-size:14px;">1.00</td>
                                                    <td style="padding:7px;line-height:1;font-size:14px;">B</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td style="width:50%;">
                                        <table border="1" style="width:100%;border:0;">
                                            <thead style="background-color:#cccccc70">
                                                <tr>
                                                    <th style="text-transform:uppercase;font-size:14px;padding:7px;line-height: 1;">course name</th>
                                                    <th style="text-transform:uppercase;font-size:14px;padding:7px;line-height: 1;">yr</th>
                                                    <th style="text-transform:uppercase;font-size:14px;padding:7px;line-height: 1;">cr</th>
                                                    <th style="text-transform:uppercase;font-size:14px;padding:7px;line-height: 1;">gr</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="font-weight:700;text-align:center;font-size:14px;">Acadmic Year 2014 - 2015</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:7px;line-height:1;font-size:14px;">Mathematics 9</td>
                                                    <td style="padding:7px;line-height:1;font-size:14px;">9</td>
                                                    <td style="padding:7px;line-height:1;font-size:14px;">1.00</td>
                                                    <td style="padding:7px;line-height:1;font-size:14px;">B</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:7px;line-height:1;font-size:14px;">Mathematics 9</td>
                                                    <td style="padding:7px;line-height:1;font-size:14px;">9</td>
                                                    <td style="padding:7px;line-height:1;font-size:14px;">1.00</td>
                                                    <td style="padding:7px;line-height:1;font-size:14px;">B</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:7px;line-height:1;font-size:14px;">Mathematics 9</td>
                                                    <td style="padding:7px;line-height:1;font-size:14px;">9</td>
                                                    <td style="padding:7px;line-height:1;font-size:14px;">1.00</td>
                                                    <td style="padding:7px;line-height:1;font-size:14px;">B</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:7px;line-height:1;font-size:14px;">Mathematics 9</td>
                                                    <td style="padding:7px;line-height:1;font-size:14px;">9</td>
                                                    <td style="padding:7px;line-height:1;font-size:14px;">1.00</td>
                                                    <td style="padding:7px;line-height:1;font-size:14px;">B</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:50%;">
                                        <table border="1" style="width:100%;border:0;">
                                            <tbody>
                                                <tr>
                                                    <td style="font-weight:700;text-align:center;font-size:14px;">Acadmic Year 2014 - 2015</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:7px;line-height:1;font-size:14px;">Mathematics 9</td>
                                                    <td style="padding:7px;line-height:1;font-size:14px;min-width:35px;">9</td>
                                                    <td style="padding:7px;line-height:1;font-size:14px;">1.00</td>
                                                    <td style="padding:7px;line-height:1;font-size:14px;min-width:35px;">B</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:7px;line-height:1;font-size:14px;">Mathematics 9</td>
                                                    <td style="padding:7px;line-height:1;font-size:14px;min-width:35px;">9</td>
                                                    <td style="padding:7px;line-height:1;font-size:14px;">1.00</td>
                                                    <td style="padding:7px;line-height:1;font-size:14px;min-width:35px;">B</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:7px;line-height:1;font-size:14px;">Mathematics 9</td>
                                                    <td style="padding:7px;line-height:1;font-size:14px;min-width:35px;">9</td>
                                                    <td style="padding:7px;line-height:1;font-size:14px;">1.00</td>
                                                    <td style="padding:7px;line-height:1;font-size:14px;min-width:35px;">B</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:7px;line-height:1;font-size:14px;">Mathematics 9</td>
                                                    <td style="padding:7px;line-height:1;font-size:14px;min-width:35px;">9</td>
                                                    <td style="padding:7px;line-height:1;font-size:14px;">1.00</td>
                                                    <td style="padding:7px;line-height:1;font-size:14px;min-width:35px;">B</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td style="width:50%;">
                                        <table border="1" style="width:100%;border:0;">
                                            <tbody>
                                                <tr>
                                                    <td style="font-weight:700;text-align:center;font-size:14px;">Acadmic Year 2014 - 2015</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:7px;line-height:1;font-size:14px;">Mathematics 9</td>
                                                    <td style="padding:7px;line-height:1;font-size:14px;min-width:35px;">9</td>
                                                    <td style="padding:7px;line-height:1;font-size:14px;">1.00</td>
                                                    <td style="padding:7px;line-height:1;font-size:14px;min-width:35px;">B</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:7px;line-height:1;font-size:14px;">Mathematics 9</td>
                                                    <td style="padding:7px;line-height:1;font-size:14px;min-width:35px;">9</td>
                                                    <td style="padding:7px;line-height:1;font-size:14px;">1.00</td>
                                                    <td style="padding:7px;line-height:1;font-size:14px;min-width:35px;">B</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:7px;line-height:1;font-size:14px;">Mathematics 9</td>
                                                    <td style="padding:7px;line-height:1;font-size:14px;min-width:35px;">9</td>
                                                    <td style="padding:7px;line-height:1;font-size:14px;">1.00</td>
                                                    <td style="padding:7px;line-height:1;font-size:14px;min-width:35px;">B</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:7px;line-height:1;font-size:14px;">Mathematics 9</td>
                                                    <td style="padding:7px;line-height:1;font-size:14px;min-width:35px;">9</td>
                                                    <td style="padding:7px;line-height:1;font-size:14px;">1.00</td>
                                                    <td style="padding:7px;line-height:1;font-size:14px;min-width:35px;">B</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                        </tr>
                    </tbody>
                </table>
                <table style="margin:10px 0 20px;">
                    <tbody>
                        <tr width="100%">
                            <td style="padding-top:20px;width:100%;font-size:12px;">The Student has met West River Academy's requirments for Grades <span style="font-weight:700;">{{ getPromotedGrades($grades) }}</span>, and is promoted to grade <span style="font-weight:700;">{{ getPromtedGrade($grades) }}</span>.</td>
                        </tr>
                    </tbody>
                </table>
                <table>
                    <tbody>
                        <tr>
                            <td width="60%" style="text-align:center;"><span style="border-top: 1px solid #000;display:block;text-transform:uppercase;padding-top:10px;font-size:11px;">official signature</span></td>
                            <td width="20%"><span style="border-top: 1px solid #000;display:block;text-transform:uppercase;padding-top:10px;font-size:11px;text-align:center;">date</span></td>
                            <td><img src="../public/images/Stamp.png" style="width:150px;height:150px;object-fit:contain;" alt="Stamp"></td>
                        </tr>
                    </tbody>
                </table>
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <p style="font-size:11px;">West River Academy is accredited by the National Association for the Legal Auppotr of Alternative Schools (NALSAS) and registered in the California School Directory.CDS Code 30 66464 6134720. Country:Orange Address:33721 BlueWater Ln.Dana Point ,CA 92629-2173</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table width="100%">
                    <tbody>
                        <tr>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection