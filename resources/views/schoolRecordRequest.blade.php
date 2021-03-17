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

        <p style="font-size: 17px;">Date: {{$date}} </p>
        <p style="margin-top:25px;font-size: 17px;">This confirms the enrollment of the following student in West River Academy.</p>
        <div class="info-detail" style="margin-top:25px;">
            <p style="margin-top:0;margin-bottom:5px;font-size: 17px;">Name:{{$name}} </p>
            <p style="margin-top:0;margin-bottom:5px;font-size: 17px;">Date of Birth:{{$dob}} </p>

            <p style="margin-top:0;margin-bottom:5px;font-size: 17px;">Grade:@foreach($grade as $gradelevel)
                {{$gradelevel}}
                @endforeach


            </p>

        </div>
    </div>
</body>

</html>