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
    <table style="width:100%;">
        <tbody>
        </tbody>
    </table>
    <table style="margin-bottom:20px;width:100%;">
        <tbody>
            <tr style="width:100%;">
                <td valign="middle"
                    style="text-transform:uppercase;font-weight: 300;font-size:25px;width:50%;height:100px;">
                    official transcript</td>
                <td valign="middle" style="text-align:center;width:50%;height:100px;">
                    <img src="../public/images/letterhead.png" alt="logo"
                        style="filter: brightness(0.5);max-width: 300px;height:90px;margin: 0 auto;object-fit:contain;display:block;">
                    <!-- <p style="margin:0;font-size:13px;">Califorinia Colorado USA</p>
                               <p style="margin:0;font-size:13px;">949.492.1540 info@westriveracademy.com</p> -->
                </td>
            </tr>
        </tbody>
    </table>
    <table style="width:100%;">
        <tbody>
            <tr style="width:100%;">
                <td style="text-transform:uppercase;width:10%;font-size:11px;line-height:1;">student</td>
                <td
                    style="font-weight:700;text-transform:uppercase;text-align:left;font-size:11px;width:50%;line-height:1;">
                    {{ $student->fullname }}</td>
                <td style="text-transform:uppercase;width:20%;font-size:11px;line-height:1;">date of birth</td>
                <td
                    style="font-weight:700;text-transform:uppercase;text-align:left;width:20%;font-size:11px;line-height:1;">
                    {{ $student->d_o_b->format(' M j, Y') }}</td>
            </tr>
        </tbody>
    </table>
    <table style="width:100%;">
        <tbody>
            <tr style="width:100%;">
                <td style="text-transform:uppercase;font-size:11px;width:10%;line-height:1;">address</td>
                <td
                    style="font-weight:700;text-transform:uppercase;text-align:left;font-size:11px;width:50%;line-height:1;">
                    {{ $address->street_address }} {{ $address->city }}, {{ $address->zip_code }},
                    {{ $address->country }}</td>
                <td style="text-transform:uppercase;font-size:11px;width:20%;line-height:1;">academic years</td>
                <td
                    style="font-weight:700;text-transform:uppercase;text-align:left;font-size:11px;width:20%;line-height:1;">
                    {{ $minYear }} - {{ $maxYear }}</td>
            </tr>
        </tbody>
    </table>
    <table style="margin-bottom:20px;width:100%;">
        <tbody>
            <tr style="width:100%;">
                <td style="text-transform:uppercase;font-size:14px;width:10%;"></td>
                <td style="font-weight:700;text-transform:uppercase;text-align:left;font-size:14px;width:50%;"></td>
                <td style="text-transform:uppercase;font-size:11px;width:20%;line-height:1;">grade level</td>
                <td
                    style="font-weight:700;text-transform:uppercase;text-align:left;font-size:11px;width:20%;line-height:1;">
                    4
                    and 5</td>
            </tr>
        </tbody>
    </table>
    <table style="width:100%;">
        <tbody>
            <tr style="width:100%;vertical-align:top;">
                <td style="width:80%;">
                    <table style="width:100%;border:2px solid #000;border-collapse:collapse;text-transform:uppercase;">
                        <thead>
                            <tr>
                                <th
                                    style="border-bottom:1px solid #000;font-size: 11px;font-weight:700;width:70%;padding:3px 5px;">
                                    Course
                                    name</th>
                                @foreach ($grades as $grade)
                                    <th
                                        style="border-bottom:1px solid #000;border-left:1px solid #000;font-size: 11px;font-weight:700;padding:3px 5px;white-spane:initial;word-break:break-all;">
                                        Grade {{ $grade->grade }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($groupCourses as $course)
                                <tr>
                                    <td style="border-bottom:1px solid #000;width:70%;padding:3px;font-size:11px;">
                                        {{ $course->subject->subject_name }}</td>
                                    @foreach ($transcriptData as $niddle => $data)
                                        <td
                                            style="border-bottom:1px solid #000;border-left:1px solid #000;width:15%;padding:3px;font-size:11px;text-align:center;">
                                            {{ getMetrixValues($course, $data, $transcriptData) }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
                <td style="text-align:right;width:20%;">
                    <table style="width:100%;">
                        <tbody>
                            <tr style="width:100%;">
                                <td
                                    style="white-space:nowrap;font-weight:600;text-transform:uppercase;padding-left:15px;">
                                    <span
                                        style="border-bottom:1px solid #000;display:inline-block;font-size:11px;">GRADING
                                        SYSTEM</span>
                                </td>
                            </tr>
                            <tr style="width:100%;">
                                <td style="white-space: pre;padding-left:15px;font-size:11px;">A = 90-100%</td>
                            </tr>
                            <tr style="width:100%;">
                                <td style="white-space: pre;padding-left:15px;font-size:11px;">B = 80-89%</td>
                            </tr>
                            <tr style="width:100%;">
                                <td style="white-space: pre;padding-left:15px;font-size:11px;">C = 70-79%</td>
                            </tr>
                            <tr style="width:100%;">
                                <td style="white-space: pre;padding-left:15px;font-size:11px;">D = 60-69%</td>
                            </tr>
                            <tr style="width:100%;">
                                <td style="white-space: pre;padding-left:15px;font-size:11px;">F = 0-59%</td>
                            </tr>
                            <tr style="width:100%;">
                                <td style="white-space: pre;padding-left:15px;font-size:11px;">P = PASS</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <table style="margin:10px 0 20px;width:100%;">
        <tbody>
            <tr width="100%">
                <td style="padding-top:20px;width:100%;font-size:12px;">This Student has met West River
                    Academy's
                    requirements for Grades <span style="font-weight:700;">{{ getPromotedGrades($grades) }}</span>
                    and is
                    promoted to grade <span style="font-weight:700;">{{ getPromtedGrade($grades) }}</span>.</td>
            </tr>
        </tbody>
    </table>
    <table style="margin-top:60px;width:100%;">
        <tr>
            <td style="width:60%;" valign="middle">
                <table style="width:100%;">
                    <tbody>
                        <tr>
                            <td style="text-align:center;width:40%" valign="bottom">
                                <span><img src="../public/images/signature.png" style="width:200px;height:80px;"
                                        alt=""></span></br>
                                <span
                                    style="border-top: 1px solid #000;display:block;text-transform:uppercase;padding-top:10px;font-size:11px;">official
                                    signature</span>
                            </td>
                            <td style="width:20%;" valign="bottom">
                                <span
                                    style="border-top: 1px solid #000;display:block;text-transform:uppercase;padding-top:10px;font-size:11px;text-align:center;">date</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td style="text-align:center;width:40%;" colspan="2" valign="middle">
                <span style="margin:0 auto;"><img src="../public/images/Stamp.png"
                        style="width: 120px;height:120px;object-fit:contain;display:block;" alt="Stamp"></span>
            </td>
        </tr>
    </table>
    <table style="width:100%;">
        <tbody>
            <tr>
                <td>
                    <p style="font-size:11px;">SIGNED</p>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
