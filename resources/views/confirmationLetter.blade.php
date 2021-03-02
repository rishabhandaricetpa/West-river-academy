<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Confirmation Letter</title>
</head>

<body>
  <div style="max-width: 1000px; margin: 0 auto;">
    <div style="text-align:center;">
      <p style="margin-bottom: 0;font-size: 18px;font-family: 'Catamaran', sans-serif;letter-spacing: 1px;">California . Colorado USA</p>
      <p style="margin-bottom: 0;margin-top:0;font-size: 18px;font-family: 'Catamaran', sans-serif;letter-spacing: 1px;">949.492.5240 . info@westriveracademy.com</p>
      <h1>Confirmation of Enrollment</h1>
    </div>

    <p style="font-size: 17px;">Date: {{ $date }}</p>
    <p style="margin-top:25px;font-size: 17px;">This confirms the enrollment of the following student in West River Academy.</p>
    <div class="info-detail" style="margin-top:25px;">
      <p style="margin-top:0;margin-bottom:5px;font-size: 17px;">Name: {{$student->first_name}} {{$student->last_name}}</p>
      <p style="margin-top:0;margin-bottom:5px;font-size: 17px;">Date of Birth: {{Carbon\Carbon::parse($student->d_o_b)->format('M d Y')}}</p>
      @foreach($enrollment as $enrollmentperiod)
      <p style="margin-top:0;margin-bottom:5px;font-size: 17px;">Grade: {{$enrollmentperiod->grade_level}}</p>
      <p style="margin-top:25px;font-size: 17px;">Enrollment Period: {{Carbon\Carbon::parse($enrollmentperiod->start_date_of_enrollment)->format('M d Y')}} - {{Carbon\Carbon::parse($enrollmentperiod->end_date_of_enrollment)->format('M d Y')}}</p>
      @endforeach
    </div>
  </div>
</body>

</html>