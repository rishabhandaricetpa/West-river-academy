<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation Letter</title>
</head>

<body>

    <div style="text-align:center;width:300px;margin:0 auto;">
        <img src="{{ asset('images/letterhead.png') }}" style="width:100%;object-fit:contain;" alt="logo-img">
    </div>

    <div style="max-width: 1000px; margin: 0 auto;">
        <h1 style="font-size:23px;text-align:center;margin:70px 0 60px;">Confirmation of Enrollment</h1>
        <p style="font-size: 17px;">Date:
            {{ Carbon\Carbon::parse($enrollment->start_date_of_enrollment)->format('F j, Y') }}</p>
        <p style="margin-top:25px;font-size: 17px;">This confirms the enrollment of the following student in West River
            Academy.</p>
        <div class="info-detail" style="margin-top:25px;">
            <p style="margin-top:0;margin-bottom:5px;font-size: 17px;">Name: {{ $student->first_name }}
                {{ $student->last_name }}
            </p>
            <p style="margin-top:0;margin-bottom:5px;font-size: 17px;">Date of Birth:
                {{ Carbon\Carbon::parse($student->d_o_b)->format('F j, Y') }}</p>
            @if($confirmData->isStudentId)
                <p style="margin-top:0;margin-bottom:5px;font-size: 17px;">Student ID:
                    {{ $student->student_Id }}</p>
            @elseif($confirmData->isDobCity)
            <p style="margin-top:0;margin-bottom:5px;font-size: 17px;">Birth City:
                {{ $student->birth_city }}</p>
            @elseif($confirmData->IsMotherName)
            <p style="margin-top:0;margin-bottom:5px;font-size: 17px;">Mothers' Name:
                {{ $student->mothers_name }}</p>
            @elseif($confirmData->isGrade && $enrollment->grade_level!='Ungraded')
            <p style="margin-top:0;margin-bottom:5px;font-size: 17px;">Grade: {{ $enrollment->grade_level }}
            </p>
            @endif
            <p style="margin-top:25px;font-size: 17px;">Enrollment Period:
                {{ Carbon\Carbon::parse($enrollment->start_date_of_enrollment)->format('F j, Y') }} -
                {{ Carbon\Carbon::parse($enrollment->end_date_of_enrollment)->format('F j, Y') }}</p>
        </div>
        <table style="padding-top:30px;width:100%;">
            <tbody>
                <tr>
                    @if($type=='signed')
                    <td>
                        <img src="../public/images/signature.png" alt="signature">
                        <p>Stacey Nishikawa</p>
                        <p>Administrative Director</p>
                    </td>
                    <td style="text-align: right"><img src="../public/images/Stamp.png" style="width:150px;height:150px;object-fit:contain;"
                            alt="Stamp"></td>
                            @endif
                </tr>
            </tbody>
        </table>
</body>

</html>
