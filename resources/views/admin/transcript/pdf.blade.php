<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Transcript pdf</title>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <style>
    body {
      font-family: "Catamaran", sans-serif;
    }

    table {
      width: 100%;
    }
  </style>
</head>

<body>
  <table>
    <tbody>
      <tr width="100%">
        <td style="width:100%;color:#EC1D1D;font-weight:400;font-size:20px;margin:0 auto;">After this transcript is approved by you, any further changes will incure a $25 fee.</td>
      </tr>
    </tbody>
  </table>
  <table style="margin-bottom:20px;">
    <tbody>
      <tr style="width:100%;">
        <td valign="middle" style="text-transform:uppercase;font-weight: 300;font-size:25px;width:50%;height:100px">official transcript</td>
        <td valign="middle" style="text-align:center;width:50%;height:100px;">
          <img src="../public/images/letterhead.png" alt="logo" style="filter: brightness(0.5);max-width: 300px;height:90px;margin: 0 auto;object-fit:contain;display:block;">
          <!-- <p style="margin:0;font-size:14px;">Califorinia Colorado USA</p>
          <p style="margin:0;font-size:14px;">949.492.5240 info@westriveracademy.com</p> -->
        </td>
      </tr>
    </tbody>
  </table>
  <table>
    <tbody>
      <tr style="width:100%;">
        <td style="text-transform:uppercase;width:10%;font-size:11px;line-height:1;">student</td>
        <td style="font-weight:700;text-transform:uppercase;text-align:left;font-size:11px;width:50%;line-height:1;">{{$student->fullname}}</td>
        <td style="text-transform:uppercase;width:20%;font-size:11px;line-height:1;">date of birth</td>
        <td style="font-weight:700;text-transform:uppercase;text-align:left;width:20%;font-size:11px;line-height:1;">{{$student->d_o_b->format(' M d Y')}}</td>
      </tr>
    </tbody>
  </table>
  <table>
    <tbody>
      <tr style="width:100%;">
        <td style="text-transform:uppercase;font-size:11px;width:10%;line-height:1;">address</td>
        <td style="font-weight:700;text-transform:uppercase;text-align:left;font-size:11px;width:50%;line-height:1;">{{$address->street_address}} {{$address->city}}, {{$address->zip_code}}, {{$address->country}}</td>
        <td style="text-transform:uppercase;font-size:11px;width:20%;line-height:1;">academic years</td>
        <td style="font-weight:700;text-transform:uppercase;text-align:left;font-size:11px;width:20%;line-height:1;">2019-20</td>
      </tr>
    </tbody>
  </table>
  <table style="margin-bottom:20px;">
    <tbody>
      <tr style="width:100%;">
        <td style="text-transform:uppercase;font-size:14px;width:10%;"></td>
        <td style="font-weight:700;text-transform:uppercase;text-align:left;font-size:14px;width:50%;"></td>
        <td style="text-transform:uppercase;font-size:11px;width:20%;line-height:1;">grade level</td>
        <td style="font-weight:700;text-transform:uppercase;text-align:left;font-size:11px;width:20%;line-height:1;">4 and 5</td>
      </tr>
    </tbody>
  </table>
  <table>
    <tbody>
      <tr style="width:100%;">
        <td width="70%">
          <table style="width:100%;border:2px solid #000;border-collapse:collapse;text-transform:uppercase;">
            <thead>
              <tr>
                <th style="border-bottom:1px solid #000;font-size: 11px;font-weight:700;width:70%;padding:3px;">Course name</th>
                @foreach($grades as $grade)
                <th style="border-bottom:1px solid #000;border-left:1px solid #000;font-size: 11px;font-weight:700;width:15%;padding:3px 20px;white-spane:initial;word-break:break-all;">Grade {{$grade->grade}}</th>
                @endforeach
              </tr>
            </thead>
            <tbody>
              @foreach($groupCourses as $course)
              <tr>
                <td style="border-bottom:1px solid #000;width:70%;padding:3px;font-size:11px;">{{$course->subject->subject_name}}</td>
                @foreach($transcriptData as $niddle => $data)
                <td style="border-bottom:1px solid #000;border-left:1px solid #000;width:15%;padding:3px;font-size:11px;text-align:center;">{{ getMetrixValues($course, $data, $transcriptData) }}</td>
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
                <td style="white-space: pre;font-weight:600;text-transform:uppercase;padding-left:52px;"><span style="border-bottom:1px solid #000;display:inline-block;font-size:11px;">GRADING SYSTEM</span></td>
              </tr>
              <tr style="width:100%;">
                <td style="white-space: pre;padding-left:52px;font-size:11px;">A = 90-100%</td>
              </tr>
              <tr style="width:100%;">
                <td style="white-space: pre;padding-left:52px;font-size:11px;">B = 80-89%</td>
              </tr>
              <tr style="width:100%;">
                <td style="white-space: pre;padding-left:52px;font-size:11px;">C = 70-79%</td>
              </tr>
              <tr style="width:100%;">
                <td style="white-space: pre;padding-left:52px;font-size:11px;">D = 60-69%</td>
              </tr>
              <tr style="width:100%;">
                <td style="white-space: pre;padding-left:52px;font-size:11px;">F = 0-59%</td>
              </tr>
              <tr style="width:100%;">
                <td style="white-space: pre;padding-left:52px;font-size:11px;">P = PASS</td>
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
        <td style="padding-top:20px;width:100%;font-size:12px;">The Student has met West River Academy's requirments for Grades <span style="font-weight:700;">4</span> and <span style="font-weight:700;">5</span>, and is promoted to grade <span style="font-weight:700;">6</span>.</td>
      </tr>
    </tbody>
  </table>
  <table style="margin-top:3%">
    <tbody>
      <tr>
        <td width="50%" style="text-align:center;padding-right:30px;"><span style="border-top: 1px solid #000;display:block;text-transform:uppercase;padding-top:10px;font-size:11px;">official signature</span></td>
        <td width="15%"><span style="border-top: 1px solid #000;display:block;text-transform:uppercase;padding-top:10px;font-size:11px;text-align:center;">date</span></td>
        <td width="35%" style="text-align:right;"> <img src="../public/images/Stamp.png" style="width:150px;heigth:150px;object-fit:contain;" alt="logo"></td>
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
</body>

</html>