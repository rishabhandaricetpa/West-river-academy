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
        <h1 style="font-size:23px;text-align:center;margin:70px 0 30px;">Confirmation of Enrollment</h1>
        <p style="font-size: 17px;">Date:
            {{ formatDate($enrollment->start_date_of_enrollment) }}</p>
        <p style="margin-top:25px;font-size: 17px;">This confirms the enrollment of the following student in West River
            Academy.</p>
        <div class="info-detail" style="margin-top:25px;">

            <p style="margin-top:0;margin-bottom:5px;font-size: 17px;">Student: {{ $student->first_name }}
                {{ $student->last_name }}
            </p>
            <p style="margin-top:0;margin-bottom:5px;font-size: 17px;">Date of Birth:
                {{ Carbon\Carbon::parse($student->d_o_b)->format('F j, Y') }}</p>
            @if ($confirmData->isDobCity == 1 && !empty($student->birth_city))
                <p style="margin-top:0;margin-bottom:5px;font-size: 17px;">Birth City:
                    {{ $student->birth_city }}</p>
            @endif
            @if ($confirmData->isStudentId && !empty($student->student_Id))
                <p style="margin-top:0;margin-bottom:5px;font-size: 17px;">National ID:
                    {{ $student->student_Id }}</p>

            @endif
            @if ($confirmData->IsMotherName == 1 && !empty($student->mothers_name))
                <p style="margin-top:0;margin-bottom:5px;font-size: 17px;">Name of Mother:
                    {{ $student->mothers_name }}</p>
            @endif


            @if ($confirmData->isGrade == 1)

                <p style="margin-top:0;margin-bottom:5px;font-size: 17px;">Grade: {{ $enrollment->grade_level }}
                </p>
            @endif
            <p style="margin-top:25px;font-size: 17px;">Enrollment Period:
                {{ formatDate($enrollment->start_date_of_enrollment) }} -
                {{ formatDate($enrollment->end_date_of_enrollment) }}</p>
        </div>
        <table style="padding-top:20px;width:100%;">
            <tbody>
                <tr>
                    @if ($type == 'signed')
                        <td style="width:50%;padding-top:100px;">
                            <img style="width:200px;" src="../public/images/signature.png" alt="signature">
                            <p style="margin-bottom:0;">Stacey Nishikawa</p>
                            <p style="margin-top:6px;font-style:italic">Administrative Director</p>
                        </td>
                        <td style="width:50%"><img src="../public/images/Stamp.png"
                                style="width:150px;height:150px;object-fit:contain;" alt="Stamp"></td>
                    @endif
                </tr>
            </tbody>
        </table>
</body>

</html>
