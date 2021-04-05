@extends('layouts.app')
@section('pageTitle', 'Preview Transcript')
@section('content')
<style>
  .course-border{
    border: 1px solid black;
  }
</style>

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
                            <td style="font-weight:700;text-transform:uppercase;text-align:left;font-size:11px;width:20%;line-height:1;"> {{$minYear}} - {{$maxYear + 1}} </td>
                        </tr>
                    </tbody>
                </table>
                <table style="margin-bottom:40px;" width="100%">
                    <tbody>
                        <tr style="width:100%;">
                            <td style="text-transform:uppercase;font-size:14px;width:10%;"></td>
                            <td style="font-weight:700;text-transform:uppercase;text-align:left;font-size:14px;width:50%;"></td>
                            <td style="text-transform:uppercase;font-size:11px;width:20%;line-height:1;">grade level</td>
                            <td style="font-weight:700;text-transform:uppercase;text-align:left;font-size:11px;width:20%;line-height:1;">{{ getPromotedGrades($grades_data) }}</td>
                        </tr>
                    </tbody>
                </table>

                @php
                    $total_credit = 0;
                @endphp

                <div class="row p-2">

                  @foreach ($transcriptData as $grades)
                  <div class="col-6">
                      @foreach ($grades as $grade)
                      <div class="row course-border">
                        <table border="1" style="width:100%;border:0;">
                         @if ($loop->first)
                         <thead style="background-color:#cccccc70">
                          <tr>
                              <th style="text-transform:uppercase;font-size:14px;padding:7px;line-height: 1;">course name</th>
                              <th style="text-transform:uppercase;font-size:14px;padding:7px;line-height: 1;">yr</th>
                              <th style="text-transform:uppercase;font-size:14px;padding:7px;line-height: 1;">cr</th>
                              <th style="text-transform:uppercase;font-size:14px;padding:7px;line-height: 1;"></th>
                          </tr>
                      </thead>
                         @endif
                          <tbody>
                              <tr>
                                  <td style="font-weight:700;text-align:center;font-size:14px;">Acadmic Year {{ $grade['enrollment_year'] }} - {{ (int)$grade['enrollment_year']+1 }}</td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                              </tr>

                              @foreach ($grade['transcript_course9_12'] as $subject)
                              @php
                                  $total_credit += (int)$subject['credit']['credit'];
                              @endphp
                                <tr>
                                  <td style="padding:7px;line-height:1;font-size:14px;">{{ $subject['subject']['subject_name'] }}</td>
                                  <td style="padding:7px;line-height:1;font-size:14px;"> {{ $grade['grade'] }} </td>
                                  <td style="padding:7px;line-height:1;font-size:14px;">{{ $subject['credit']['credit'] }}</td>
                                  <td style="padding:7px;line-height:1;font-size:14px;">{{$subject['score']}}</td>
                                </tr>
                              @endforeach
                          </tbody>
                      </table>
                      </div>
                      @endforeach
                  </div>
                  @endforeach


                </div>


                <div class="row mt-3">
                  <div class="col-4">
                    <table border="1" style="width:100%;border:0;">
                      <tr>
                        <th>Total Credits Earned</th>
                        <td> {{ $total_credit }} </td>
                      </tr>
                      <tr>
                        <th>G.P.A</th>
                        <td> - </td>
                      </tr>
                      <tr>
                        <th>Date of Transcript</th>
                        <td> - </td>
                      </tr>
                    </table>

                    <div class="row">
                      Some text
                    </div>

                  </div>
                  <div class="col-4">
                    <div class="row">
                      <div class="col-12 text-center">
                        Grading System
                      </div>
                      <table border="1" style="width:100%;border:0;margin:0px;padding:0px">
                       <thead>
                         <tr>
                           <th>Grade</th>
                           <th>Percent</th>
                           <th>Points</th>
                           <th>AP Points</th>
                         </tr>
                       </thead>
                       <tbody>
                         <tr>
                           <td>A</td>
                           <td>90-100</td>
                           <td>4.00</td>
                           <td>5.00</td>
                         </tr>
                         <tr>
                           <td>B</td>
                           <td>80-89</td>
                           <td>3.00</td>
                           <td>4.00</td>
                         </tr>
                         <tr>
                           <td>C</td>
                           <td>70-79</td>
                           <td>2.00</td>
                           <td>3.00</td>
                         </tr>
                         <tr>
                           <td>D</td>
                           <td>60-69</td>
                           <td>1.00</td>
                           <td>2.00</td>
                         </tr>
                         <tr>
                           <td>F</td>
                           <td>0-59</td>
                           <td>0.00</td>
                           <td>0.00</td>
                         </tr>
                         <tr>
                           <td>P</td>
                           <td>60-100</td>
                           <td>0.00</td>
                           <td>0.00</td>
                         </tr>
                       </tbody>
                     </table>
                     </div>
                  </div>
                  <div class="col-4">
                    Some text
                  </div>
                </div>



                <table style="margin:10px 0 20px;">
                    <tbody>
                        <tr width="100%">
                            <td style="padding-top:20px;width:100%;font-size:12px;">The Student has met West River Academy's requirments for Grades <span style="font-weight:700;">{{ getPromotedGrades($grades_data) }}</span>, and is promoted to grade <span style="font-weight:700;">{{ getPromtedGrade($grades_data) }}</span>.</td>
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
