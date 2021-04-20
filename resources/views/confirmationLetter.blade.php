<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Confirmation Letter</title>
</head>

<body>

  <div style="text-align:center;width:300px;margin:0 auto;">
    <img src="../public/images/letterhead.png" style="width:100%;object-fit:contain;" alt="logo-img">
  </div>

  <div style="max-width: 1000px; margin: 0 auto;">
    <h1 style="font-size:23px;text-align:center;margin:70px 0 60px;">Confirmation of Enrollment</h1>
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
  <table style="padding-top:70%;width:100%;">
    <tbody>
      <tr>
        <td><img src="../public/images/signature.png" alt="signature">
          <p>Stacey Nishikawa</p>
          <p>Administrative Director</p>
        </td>
        <td><img src="../public/images/Stamp.png" style="width:150px;height:150px;object-fit:contain;" alt="Stamp"></td>
      </tr>
    </tbody>
  </table>
</body>

</html>