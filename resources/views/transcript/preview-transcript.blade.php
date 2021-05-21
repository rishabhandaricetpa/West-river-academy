@extends('layouts.app')
@section('pageTitle', 'Preview Transcript')
@section('content')

<main class="position-relative container form-content mt-4">
  <h1 class="text-center text-white text-uppercase">dashboard</h1>

  <div class="form-wrap border bg-light py-2r px-25 text-center dashboard-info">
    <p>I'm finished with this transcript. I want to see what it looks like</p>
    <a href="{{ url('/transcript-pdf') }}" class="btn btn-primary mt-4 font-weight-bold" data-toggle="modal"
      data-target="#previewTranscriptModal">View Transcript</a>
    <a href="{{ route('submit.transcript',[$student->id,$transcript_id]) }}"
      class="btn btn-primary mt-4 font-weight-bold">Submit</a>
  </div>
</main>

<div class="modal fade" id="previewTranscriptModal" tabindex="-1" role="dialog"
  aria-labelledby="previewTranscriptModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <table style="margin-bottom:20px;">
        
            <thead>
              <th colspan="6">
                <table style="margin-bottom:20px;">
                  <tbody>
                    <tr width="100%">
                      <td style="width:100%;color:#EC1D1D;font-weight:400;font-size:19px;margin:0 auto;">After this
                        transcript is approved by you, any further changes will incure a $25 fee.</td>
                    </tr>
                  </tbody>
                </table>
                <table style="margin-bottom:20px;" width="100%">
                  <tbody>
                    <tr style="width:100%;">
                      <td width="50%" valign="middle" style="text-transform:uppercase;font-weight: 700;font-size:25px;">
                        official transcript</td>
                      <td width="50%" valign="middle" style="text-align:center;">
                        <img src="/images/letterhead.png" alt="logo"
                          style="filter: brightness(0.5);max-width: 300px;margin: 0 auto;object-fit:contain;display:block;">
                      </td>
                    </tr>
                  </tbody>
                </table>
              </th>
            </thead>
           <tbody>
            <tr>
              <td style="width:50%;">
                <table>
                  <tbody>
                    <tr>
                      <td style="text-transform:uppercase;width:10%;font-size:11px;line-height:1;">student</td>
                      <td
                        style="font-weight:700;text-transform:uppercase;text-align:left;font-size:11px;line-height:1;">
                        {{$student->fullname}}</td>
                    </tr>
                    <tr>
                      <td style="text-transform:uppercase;font-size:11px;width:10%;line-height:1;padding:2px;"
                        valign="top">address</td>
                      <td valign="top"
                        style="font-weight:700;text-transform:uppercase;text-align:left;font-size:11px;line-height:1; padding:2px;">
                        {{$address->street_address}}</br> {{$address->city}}, {{$address->zip_code}},
                        {{$address->country}}
                      </td>
                    </tr>
                    <tr>
                      <td valign="top" style="text-transform:uppercase;font-size:14px;width:10%; padding:2px;"></td>
                      <td valign="top"
                        style="font-weight:700;text-transform:uppercase;text-align:left;font-size:14px;padding:2px;">
                      </td>
                    </tr>
                  </tbody>
                </table>
              </td>
              <td style="width:50%;">
                <table>
                  <tbody>
                    <tr>
                      <td style="text-transform:uppercase;width:35%;font-size:11px;line-height:1;">date of birth</td>
                      <td
                        style="font-weight:700;text-transform:uppercase;text-align:left;font-size:11px;line-height:1;">
                        {{$student->d_o_b->format(' M y d')}}</td>
                    </tr>
                    <tr>
                      <td valign="top"
                        style="text-transform:uppercase;font-size:11px;width:35%;line-height:1;padding:2px;">years(s)
                      </td>
                      <td valign="top"
                        style="font-weight:700;text-transform:uppercase;text-align:left;font-size:11px;line-height:1;padding:2px;">
                        {{$minYear}}-{{$maxYear}}</td>
                    </tr>
                    <tr>
                      <td valign="top"
                        style="text-transform:uppercase;font-size:11px;width:35%;line-height:1;padding:2px;">grade
                        level(s)</td>
                      <td valign="top"
                        style="font-weight:700;text-transform:uppercase;text-align:left;font-size:11px;line-height:1;padding:2px;">
                        {{ getPromotedGrades($grades) }}</td>
                    </tr>
                  </tbody>
                </table>
              </td>
            </tr>
          </tbody>
         
        </table>


        <table width="100%">
          <tbody>
            <tr style="width:100%;">
              <td width="70%">
                <table style="width:100%;border:2px solid #000;border-collapse:collapse;text-transform:uppercase;">
                  <thead>
                    <tr>
                      <th colspan="3"
                        style="border-bottom:1px solid #000;font-size: 11px;font-weight:700;width:70%;padding:3px;">
                        course name</th>
                      @foreach($grades as $grade)
                      <th
                        style="border-bottom:1px solid #000;border-left:1px solid #000;font-size: 11px;font-weight:700;width:15%;padding:3px;">
                        Grade {{$grade->grade}}</th>
                      @endforeach
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($groupCourses as $course)
                    <tr>
                      <td colspan="3" style="border-bottom:1px solid #000;width:70%;padding:3px;font-size:11px;">
                        {{$course->subject->subject_name}}</td>
                      @foreach($transcriptData as $niddle => $data)
                      <td
                        style="border-bottom:1px solid #000;border-left:1px solid #000;width:15%;padding:3px;font-size:11px;text-align:center;">
                        {{ getMetrixValues($course, $data, $transcriptData) }}</td>
                      @endforeach
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </td>
              <td width="30%" style="text-align:right;">
                <table width="100%">
                  <tbody>
                    <tr style="width:100%;">
                      <td style="white-space: pre;font-weight:600;text-transform:uppercase;padding-left:22px;"><span
                          style="border-bottom:1px solid #000;display:inline-block;font-size:11px;text-align:left;">GRADING SYSTEM</span></td>
                    </tr>
                    <tr style="width:100%;">
                      <td style="white-space: pre;padding-left:22px;font-size:11px;">A = 90-100%</td>
                    </tr>
                    <tr style="width:100%;">
                      <td style="white-space: pre;padding-left:22px;font-size:11px;">B = 80-89%</td>
                    </tr>
                    <tr style="width:100%;">
                      <td style="white-space: pre;padding-left:22px;font-size:11px;">C = 70-79%</td>
                    </tr>
                    <tr style="width:100%;">
                      <td style="white-space: pre;padding-left:22px;font-size:11px;">D = 60-69%</td>
                    </tr>
                    <tr style="width:100%;">
                      <td style="white-space: pre;padding-left:22px;font-size:11px;">F = 0-59%</td>
                    </tr>
                    <tr style="width:100%;">
                      <td style="white-space: pre;padding-left:22px;font-size:11px;">P = P</td>
                    </tr>
                  </tbody>
                </table>
              </td>
            </tr>
          </tbody>
        </table>
        <table style="margin:10px 0 20px;">
          <tbody>
            <tr width="100%">
              <td style="padding-top:20px;width:100%;font-size:12px;">This Student has met West River Academy's
                requirements for Grades <span style="font-weight:700;">{{ getPromotedGrades($grades) }}</span> and is
                promoted to grade <span style="font-weight:700;">{{ getPromtedGrade($grades) }}</span>.</td>
            </tr>
          </tbody>
        </table>
        <table>
          <tbody>
            <tr>
              <td valign="bottom" style="text-align:center;width:40%;padding:10px 20px;">
                <img src="/images/signature.png" style="width:150px;height:auto;object-fit:contain;" alt="signatures">
                <span
                  style="border-top: 1px solid #000;display:block;text-transform:uppercase;padding-top:10px;font-size:11px;">official
                  signature</span></td>
              <td valign="bottom" style="text-align:center;width:30%;padding:10px 20px;">
              <span> 05/12/2021</span>
              <span
                  style="border-top: 1px solid #000;display:block;text-transform:uppercase;padding-top:10px;font-size:11px;text-align:center;">date</span>
              </td>
              <td valign="middle" style="width:30%;padding:10px 20px;"><img src="/images/Stamp.png"
                  style="width:85px;height:80px;object-fit:contain;" alt="Stamp"></td>
            </tr>
          </tbody>
        </table>
        <table>
          <tbody>
            <tr>
              <td>
                <p style="font-size:11px;">West River Academy is accredited by the National Association for the Legal
                  Support of Alternative Schools (NALSAS) and registered in the California School Directory: CDS Code 30
                  66464 6134720. Country : Orange, Address: 33721 BlueWater Ln., Dana Point, CA 92629-2173</p>
              </td>
            </tr>
          </tbody>
        </table>
        <table class="my-5">
          <tbody>
            <tr>
              <td width="50%" style="text-align:center;position: relative;"> <a
                  href="{{route('another.grade',[$student->id,$transcript_id])}}"
                  style="background-color: #FC0;line-height:1;color: #000;border: 0;border-radius: 5px;padding: 10px 16px;font-size: 14px;display:inline-block; position: absolute; left:45%;top:10px;">Edit</button>
              </td>
              <td width="50%" style="text-align:center;position: relative;"> <a type="submit"
                  href="{{ route('submit.transcript',[$student->id,$transcript_id]) }}"
                  style="line-height:1;background-color: #FC0;color: #000;border: 0;border-radius: 5px;padding: 10px 16px;font-size: 14px;display:inline-block; position: absolute; left:42%;top:10px;">Submit</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

@endsection
