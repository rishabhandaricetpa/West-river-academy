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

  <table style="margin-bottom:20px;">
    <tbody>
      <tr style="width:100%;">
        <td width="50%" style="text-transform:uppercase;font-weight: 300;font-size:25px;">official transcript</td>
        <td width="50%" style="text-align:center;">
          <img src="https://www.westriveracademy.com/cwp/img/wra_logo.svg" alt="logo" style="filter: brightness(0.5);max-width: 300px;margin: 0 auto;object-fit:contain;display:block;">
          <p style="margin:0;font-size:13px;">Califorinia Colorado USA</p>
          <p style="margin:0;font-size:13px;">949.492.5240 info@westriveracademy.com</p>
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
        <td style="text-transform:uppercase;font-size:13px;width:10%;"></td>
        <td style="font-weight:700;text-transform:uppercase;text-align:left;font-size:13px;width:50%;"></td>
        <td style="text-transform:uppercase;font-size:11px;width:20%;line-height:1;">grade level</td>
        <td style="font-weight:700;text-transform:uppercase;text-align:left;font-size:11px;width:20%;line-height:1;">4 and 5</td>
      </tr>
    </tbody>
  </table>
  <table width="100%" style="border-collapse:collapse;" >
          <tbody>
            <tr style="width:100%;">
           <table style="width:100%;border-collapse:collapse;" border="1">
           <tr>
              <td style="width:50%;">
                <table  style="width:100%;border-collapse:collapse;">
                  <thead style="background-color:#cccccc70">
                   <tr style="line-height:1;">
                    <th style="text-transform:uppercase;font-size:13px;padding:4px 7px;line-height:1;text-align:left;">course name</th>
                    <th style="text-transform:uppercase;font-size:13px;padding:4px 7px;line-height:1;text-align:left;">yr</th>
                    <th style="text-transform:uppercase;font-size:13px;padding:4px 7px;line-height:1;text-align:left;">cr</th>
                    <th style="text-transform:uppercase;font-size:13px;padding:4px 7px;line-height:1;text-align:left;">gr</th>
                   </tr>
                  </thead>
                  <tbody>
                  <tr style="line-height:1;">
                    <td style="font-weight:700;text-align:center;font-size:13px;" colspan="4"><span style="text-decoration:underline;">Acadmic Year 2014 - 2015</span></td>

                  </tr>
                  <tr style="line-height:1;">
                    <td style="padding:3px 6px;line-height:1;font-size:13px;text-transform:uppercase;">spanish</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">9</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">1.00</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">B</td>
                  </tr>
                  <tr style="line-height:1;">
                    <td style="padding:3px 6px;line-height:1;font-size:13px;text-transform:uppercase;">english 9</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">9</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">1.00</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">B</td>
                  </tr>
                  <tr style="line-height:1;">
                    <td style="padding:3px 6px;line-height:1;font-size:13px;text-transform:uppercase;">health</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">9</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">1.00</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">B</td>
                  </tr>
                  <tr style="line-height:1;">
                    <td style="padding:3px 6px;line-height:1;font-size:13px;text-transform:uppercase;">world geography</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">9</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">1.00</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">B</td>
                  </tr>
                  <tr style="line-height:1;">
                    <td style="padding:3px 6px;line-height:1;font-size:13px;text-transform:uppercase;">world history</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">9</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">1.00</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">B</td>
                  </tr>
                  <tr style="line-height:1;">
                    <td style="padding:3px 6px;line-height:1;font-size:13px;text-transform:uppercase;">algebra 1</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">9</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">1.00</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">B</td>
                  </tr>
                  <tr style="line-height:1;">
                    <td style="padding:3px 6px;line-height:1;font-size:13px;text-transform:uppercase;">biology</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">9</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">1.00</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">B</td>
                  </tr>
                  <tr style="line-height:1;">
                    <td style="padding:3px 6px;line-height:1;font-size:13px;text-transform:uppercase;">painting</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">9</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">1.00</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">B</td>
                  </tr>
                  <tr style="line-height:1;">
                    <td style="padding:3px 6px;line-height:1;font-size:13px;text-transform:uppercase;">art</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">9</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">1.00</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">B</td>
                  </tr>
                   <tr style="line-height:1;">
                    <td style="font-weight:700;text-align:center;font-size:13px;" colspan="4"><span style="text-decoration:underline">Acadmic Year 2014 - 2015</span></td>

                  </tr>
                  <tr style="line-height:1;">
                    <td style="padding:3px 6px;line-height:1;font-size:13px;text-transform:uppercase;">spanish</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">9</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">1.00</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">B</td>
                  </tr>
                  <tr style="line-height:1;">
                    <td style="padding:3px 6px;line-height:1;font-size:13px;text-transform:uppercase;">english 9</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">9</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">1.00</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">B</td>
                  </tr>
                  <tr style="line-height:1;">
                    <td style="padding:3px 6px;line-height:1;font-size:13px;text-transform:uppercase;">health</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">9</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">1.00</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">B</td>
                  </tr>
                  <tr style="line-height:1;">
                    <td style="padding:3px 6px;line-height:1;font-size:13px;text-transform:uppercase;">world geography</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">9</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">1.00</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">B</td>
                  </tr>
                  <tr style="line-height:1;">
                    <td style="padding:3px 6px;line-height:1;font-size:13px;text-transform:uppercase;">world history</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">9</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">1.00</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">B</td>
                  </tr>
                  <tr style="line-height:1;">
                    <td style="font-weight:700;text-align:center;font-size:13px;" colspan="4"><span style="text-decoration:underline;">Acadmic Year 2014 - 2015</span></td>

                  </tr>
                  <tr style="line-height:1;">
                    <td style="padding:3px 6px;line-height:1;font-size:13px;text-transform:uppercase;">spanish</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">9</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">1.00</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">B</td>
                  </tr>
                  <tr style="line-height:1;">
                    <td style="padding:3px 6px;line-height:1;font-size:13px;text-transform:uppercase;">english 9</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">9</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">1.00</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">B</td>
                  </tr>
                  <tr style="line-height:1;">
                    <td style="padding:3px 6px;line-height:1;font-size:13px;text-transform:uppercase;">health</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">9</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">1.00</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">B</td>
                  </tr>
                  <tr style="line-height:1;">
                    <td style="padding:3px 6px;line-height:1;font-size:13px;text-transform:uppercase;">world geography</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">9</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">1.00</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">B</td>
                  </tr>
                  <tr style="line-height:1;">
                    <td style="padding:3px 6px;line-height:1;font-size:13px;text-transform:uppercase;">world history</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">9</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">1.00</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">B</td>
                  </tr>
                  </tbody>
                </table>
              </td>
              <td style="width:50%;">
                <table  style="width:100%;border-collapse:collapse;">
                  <thead style="background-color:#cccccc70">
                   <tr style="line-height:1;">
                    <th style="text-transform:uppercase;font-size:13px;padding:4px 7px;line-height:1;text-align:left;">course name</th>
                    <th style="text-transform:uppercase;font-size:13px;padding:4px 7px;line-height:1;text-align:left;">yr</th>
                    <th style="text-transform:uppercase;font-size:13px;padding:4px 7px;line-height:1;text-align:left;">cr</th>
                    <th style="text-transform:uppercase;font-size:13px;padding:4px 7px;line-height:1;text-align:left;">gr</th>
                   </tr>
                  </thead>
                  <tbody>
                  <tr style="line-height:1;">
                    <td style="font-weight:700;text-align:center;font-size:13px;" colspan="4"><span style="text-decoration:underline;">Acadmic Year 2014 - 2015</span></td>

                  </tr>
                  <tr style="line-height:1;">
                    <td style="padding:3px 6px;line-height:1;font-size:13px;text-transform:uppercase;">spanish</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">9</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">1.00</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">B</td>
                  </tr>
                  <tr style="line-height:1;">
                    <td style="padding:3px 6px;line-height:1;font-size:13px;text-transform:uppercase;">english 9</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">9</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">1.00</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">B</td>
                  </tr>
                  <tr style="line-height:1;">
                    <td style="padding:3px 6px;line-height:1;font-size:13px;text-transform:uppercase;">health</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">9</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">1.00</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">B</td>
                  </tr>
                  <tr style="line-height:1;">
                    <td style="padding:3px 6px;line-height:1;font-size:13px;text-transform:uppercase;">world geography</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">9</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">1.00</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">B</td>
                  </tr>
                  <tr style="line-height:1;">
                    <td style="padding:3px 6px;line-height:1;font-size:13px;text-transform:uppercase;">world history</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">9</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">1.00</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">B</td>
                  </tr>
                  <tr style="line-height:1;">
                    <td style="padding:3px 6px;line-height:1;font-size:13px;text-transform:uppercase;">algebra 1</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">9</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">1.00</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">B</td>
                  </tr>
                  <tr style="line-height:1;">
                    <td style="padding:3px 6px;line-height:1;font-size:13px;text-transform:uppercase;">biology</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">9</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">1.00</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">B</td>
                  </tr>
                  <tr style="line-height:1;">
                    <td style="padding:3px 6px;line-height:1;font-size:13px;text-transform:uppercase;">painting</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">9</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">1.00</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">B</td>
                  </tr>
                  <tr style="line-height:1;">
                    <td style="padding:3px 6px;line-height:1;font-size:13px;text-transform:uppercase;">art</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">9</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">1.00</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">B</td>
                  </tr>
                   <tr style="line-height:1;">
                    <td style="font-weight:700;text-align:center;font-size:13px;" colspan="4"><span style="text-decoration:underline;">Acadmic Year 2014 - 2015</span></td>

                  </tr>
                  <tr style="line-height:1;">
                    <td style="padding:3px 6px;line-height:1;font-size:13px;text-transform:uppercase;">spanish</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">9</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">1.00</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">B</td>
                  </tr>
                  <tr style="line-height:1;">
                    <td style="padding:3px 6px;line-height:1;font-size:13px;text-transform:uppercase;">english 9</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">9</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">1.00</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">B</td>
                  </tr>
                  <tr style="line-height:1;">
                    <td style="padding:3px 6px;line-height:1;font-size:13px;text-transform:uppercase;">health</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">9</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">1.00</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">B</td>
                  </tr>
                  <tr style="line-height:1;">
                    <td style="padding:3px 6px;line-height:1;font-size:13px;text-transform:uppercase;">world geography</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">9</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">1.00</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">B</td>
                  </tr>
                  <tr style="line-height:1;">
                    <td style="padding:3px 6px;line-height:1;font-size:13px;text-transform:uppercase;">world history</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">9</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">1.00</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">B</td>
                  </tr>
                  <tr style="line-height:1;">
                    <td style="font-weight:700;text-align:center;font-size:13px;" colspan="4"><span style="text-decoration:underline;">Acadmic Year 2014 - 2015</span></td>

                  </tr>
                  <tr style="line-height:1;">
                    <td style="padding:3px 6px;line-height:1;font-size:13px;text-transform:uppercase;">spanish</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">9</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">1.00</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">B</td>
                  </tr>
                  <tr style="line-height:1;">
                    <td style="padding:3px 6px;line-height:1;font-size:13px;text-transform:uppercase;">english 9</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">9</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">1.00</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">B</td>
                  </tr>
                  <tr style="line-height:1;">
                    <td style="padding:3px 6px;line-height:1;font-size:13px;text-transform:uppercase;">health</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">9</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">1.00</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">B</td>
                  </tr>
                  <tr style="line-height:1;">
                    <td style="padding:3px 6px;line-height:1;font-size:13px;text-transform:uppercase;">world geography</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">9</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">1.00</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">B</td>
                  </tr>
                  <tr style="line-height:1;">
                    <td style="padding:3px 6px;line-height:1;font-size:13px;text-transform:uppercase;">world history</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">9</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">1.00</td>
                    <td style="padding:3px 6px;line-height:1;font-size:13px;">B</td>
                  </tr>
                  </tbody>
                </table>
              </td>
           </tr>
           </table>   
            </tr>
          </tbody>
        </table>
<table width="100%" style="padding-top:30px;vertical-align:top;">
<tr>
 <td width="35%" style="vertical-align:top;">
 <table width="100%" style="border:1px solid #000;">
 <tr>
 <th style="padding:3px 5px;font-size:13px;line-height:1;text-align:left;" width="80%">Total credits earned</th>
 <td style="padding:3px 5px;font-size:13px;line-height:1;">26.00</td>
 </tr>
 <tr>
 <th style="padding:3px 5px;font-size:13px;line-height:1;text-align:left;" width="80%">G.P.A</th>
 <td style="padding:3px 5px;font-size:13px;line-height:1;">3.66</td>
 </tr>
 <tr>
 <th style="padding:3px 5px;font-size:13px;line-height:1;text-align:left;" width="80%">Total credits earned</th>
 <td style="padding:3px 5px;font-size:13px;line-height:1;">26.00</td>
 </tr>
 </table>
 <p style="font-size:13px;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Non, asperiores?</p>
 </td>
 <td width="45%" style="vertical-align:top;padding:0 4px 4px 4px; border:1px solid #000;">
  <p style="text-align:center;font-weight:600;margin-bottom:0;"><span style="border-bottom:1px solid #000;margin-bottom:0;margin-top:-20px;font-size:13px;">Grading System</span></p>
  <table>
  <thead>
  <tr>
    <th style="font-size:13px;text-decoration:underline;text-align:left;">Grade</th>
    <th style="font-size:13px;text-decoration:underline;text-align:left;">percent</th>
    <th style="font-size:13px;text-decoration:underline;text-align:left;">Points</th>
    <th style="font-size:13px;text-decoration:underline;text-align:left;">AP Points</th>
  </tr>
  </thead>
  <tr>
  <td style="font-size:13px;">A</td>
  <td style="font-size:13px;">90-100</td>
  <td style="font-size:13px;">4.00</td>
  <td style="font-size:13px;">5.00</td>
  </tr>
  <tr>
  <td style="font-size:13px;">B</td>
  <td style="font-size:13px;">90-100</td>
  <td style="font-size:13px;">3.00</td>
  <td style="font-size:13px;">5.00</td>
  </tr>
  <tr>
  <td style="font-size:13px;">C</td>
  <td style="font-size:13px;">90-100</td>
  <td style="font-size:13px;">4.00</td>
  <td style="font-size:13px;">5.00</td>
  </tr>
  <tr>
  <td style="font-size:13px;">D</td>
  <td style="font-size:13px;">90-100</td>
  <td style="font-size:13px;">4.00</td>
  <td style="font-size:13px;">5.00</td>
  </tr>
  <tr>
  <td style="font-size:13px;">D</td>
  <td style="font-size:13px;">90-100</td>
  <td style="font-size:13px;">4.00</td>
  <td style="font-size:13px;">5.00</td>
  </tr>
  <tr>
  <td style="font-size:13px;">F</td>
  <td style="font-size:13px;">90-100</td>
  <td style="font-size:13px;">4.00</td>
  <td style="font-size:13px;">5.00</td>
  </tr>
  <tr>
  <td style="font-size:13px;">P</td>
  <td style="font-size:13px;">90-100</td>
  <td style="font-size:13px;">4.00</td>
  <td style="font-size:13px;">5.00</td>
  </tr>
  </table>
 </td>
 <td width="40%" style="vertical-align:top;">
 <table>
        <tbody>
            <tr>
                <td width="60%"  style="text-align:center;"><span style="border-top: 1px solid #000;display:block;text-transform:uppercase;padding-top:10px;font-size:11px;">official signature</span></td>
                <td width="40%" ><span style="border-top: 1px solid #000;display:block;text-transform:uppercase;padding-top:10px;font-size:11px;text-align:center;">date</span></td>
            </tr>
        </tbody>
    </table>
    <table width="100%">
      <tr style="width:100%;">
          <td style="text-align:center;width:100%;" colspan="2"> 
          <div style="margin:0 auto;"><img src="../public/images/Stamp.png" style="width: 120px;height:120px;object-fit:contain;display:block;"  alt="Stamp"></div>
          </td>
        </tr>
    </table>
 </td>
</tr>
</table>

  
</body>

</html>