@extends('layouts.app')

@section('content')

    <main class="position-relative container form-content mt-4">
      <h1 class="text-center text-white text-uppercase">dashboard</h1>

      <div class="form-wrap border bg-light py-2r px-25 text-center dashboard-info">
        <p>I'm finished with this transcript. I want to see what it looks like</p>
        <!-- <a href="{{ route('genrate.transcript',1) }}" class="btn btn-primary mt-4 font-weight-bold">View Transcript</a> -->
        <a href="{{ url('/transcript-pdf') }}" class="btn btn-primary mt-4 font-weight-bold"  data-toggle="modal" data-target="#previewTranscriptModal">View Transcript</a>

        <!-- <a href="{{ url('/transcript-pdf') }}" class="btn btn-primary mt-4 font-weight-bold"  data-toggle="modal" data-target="#previewTranscriptModal">View Transcript</a> -->
      </div>
    </main>

    <div class="modal fade" id="previewTranscriptModal" tabindex="-1" role="dialog" aria-labelledby="previewTranscriptModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-body">
<div style="max-width:1000px;margin:0 auto;padding:0 15px;">
    <div style="display:flex;flex-wrap:wrap;align-items: center;">
    <h1 style="width:50%;text-transform:uppercase;font-family:'Judson',serif;font-weight: 300;margin:0;">official transcript</h1>
    <div style="width:50%;display:flex;">
    <div style="margin-left:auto;text-align:center;">
       <img src="https://www.westriveracademy.com/cwp/img/wra_logo.svg" alt="logo" style="filter: brightness(0.5);max-width: 300px;margin: 0 auto;object-fit:contain;">
       <p style="margin:0;">Califorinia Colorado USA</p>
       <p style="margin:0;">949.492.5240 info@westriveracademy.com</p>
       </div>
    </div>
    <div style="width:50%;">
       <ul style="list-style-type:none;padding-left:0;">
            <li style="display:flex;">Student <span> : {{$student->fullname}}</span></li>
            <li style="display:flex;">address <span> :Dehradun</span></li>
       </ul>
    </div>

    <div style="width:50%;display:flex;">
       <ul style="list-style-type:none;padding-left:0;margin-left:auto;">
            <li style="display:flex;">Date of birth: <span> {{$student->d_o_b->format(' M y d')}}</span></li>
            <li style="display:flex;">acadmic years <span>2019-2020</span></li>
            <li style="display:flex;">Grade levels <span>4 and 5</span></li>
       </ul>
    </div>        
    <table style="width:60%;border:2px solid #000;border-collapse:collapse;text-transform:uppercase;">
        <thead>
          <tr>
             <th colspan="2" style="border-bottom:1px solid #000;font-size: 14px;font-weight:400;">course name</th>
             @foreach($grades as $grade)
             <th style="border-bottom:1px solid #000;border-left:1px solid #000;font-size: 14px;font-weight:400;">Grade {{$grade->grade}}</th>
             @endforeach
          </tr>
        </thead>
        <tbody>

        @foreach($groupCourses as $course)
        
          <tr>
            <td colspan="2" style="border-bottom:1px solid #000;font-size: 14px;">{{$course->subject->subject_name}}</td>
            @foreach($transcriptData as $niddle => $data)
              <td style="border-bottom:1px solid #000;border-left:1px solid #000;font-size: 14px;">{{ getMetrixValues($course, $data, $transcriptData) }}</td>
            @endforeach
          </tr>
          @endforeach

        </tbody>
        </table>
        <div style="width:40%;padding-left: 15px;box-sizing:border-box;display:flex;">
        <div style="margin-left:auto;">
         <h3 style="font-weight:600;text-transform:uppercase;">
         <span style="border-bottom:1px solid #000;">grading system</span>
         </h3>
        <ul style="list-style-type:none;padding-left:0;">
          <li>A = 90-100%</li>
          <li>B = 80-89%</li>
          <li>C = 70-79%</li>
          <li>D = 60-69%</li>
          <li>F = 0-59%</li>
          <li>P = PASS</li>
        </ul>
        </div>
        </div>
        <p>The Student has met West River Academy's requirments for Grades 4 and 5, and is promoted to grade 6.</p>
        <div style="width:100%;display:flex;flex-wrap:wrap;align-items:center;">
         <div style="width:60%;display:flex;flex-wrap:wrap;">
         <div style="width:60%;text-transform:uppercase;text-align:center;padding:15px;box-sizing:border-box;"><span style="border-top: 1px solid #000;display:block;">official signature</span></div>
         <div style="width:40%;text-transform:uppercase;text-align:center;padding:15px;box-sizing:border-box;"><span style="border-top: 1px solid #000;display:block;">date</span></div>
         </div>
         <div style="width:40%;">
         <!-- <img src="https://picsum.photos/200" style="width:100%;height:100%;object-fit:contain;" alt="logo"> -->
         </div>
        </div>
        <p style="text-align:center;width:100%;">West River Academy is accredited by the National Association for the Legal Auppotr of Alternative Schools (NALSAS) and registered in the California School Directory.CDS Code  30 66464 6134720. Country:Orange Address:33721 BlueWater Ln.Dana Point ,CA 92629-2173</p>
        <div style="display: flex;justify-content: space-around;width: 100%;">
        <button type="submit" style="background-color: #FC0;color: #000;border: 0;border-radius: 5px;padding: 10px 16px;font-size: 14px;">Edit</button>
        <a type="button"  href="{{ url('/download-transcript') }}"  style="background-color: #FC0;color: #000;border: 0;border-radius: 5px;padding: 10px 16px;font-size: 14px;">Submit</a>
        </div>
    </div>
    <div>

    </div>
        
        </div>
        </div>
</div>
</div>
 @endsection