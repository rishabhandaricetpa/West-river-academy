<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transcript pdf</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <!-- <link href="https://fonts.googleapis.com/css2?family=Catamaran:wght@100;200;300;400;500;600;700;800;900&family=Judson:ital,wght@0,400;0,700;1,400&family=Lato:ital,wght@0,100;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet"> -->
    <style>
        body {
            font-weight: 400;
            font-family: "Catamaran", sans-serif;
        }

        table {
            width: 100%;
        }

        @page {
            margin: 30px;
            padding: 20px 0px;
        }

        .mb-20 {
            margin-bottom: 20px;
        }

        .mt-40 {
            margin-top: 40px;
        }
    </style>
</head>

<body>
    <div style="max-width:600px; margin-left:auto; margin-right: auto;">
        <table class="mb-20">
            <tbody>
                <tr style="width:100%">
                    <td style="text-align:center;"><img src="../public/images/letterhead.png" alt="logo" style="height:80px; width:auto; object-fit: contain;"></td>
                </tr>
            </tbody>
        </table>
        <table>
            <tbody>
                <tr style="width:100%">
                    <td style="width:100%; text-align: center;">
                        <h2>Request for Student Records</h2>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="mb-20">
            <tbody>
                <tr style="width:100%">
                    <td>Date:{{$date}} </td>
                </tr>
            </tbody>
        </table>
        <table class="mb-20">
            <tbody>
                <tr style="width:100%">
                    <td>To:</td>
                </tr>
            </tbody>
        </table>
        <table class="mb-20">
            <tbody>
                <tr style="width:100%">
                    <td>Attention: School Records:</td>
                </tr>
            </tbody>
        </table>
        <table class="mb-20">
            <tbody>
                <tr style="width:100%">
                    <td>The following student is currently enrolled in West River Academy. Please forward all
                        school records and cumulative files for the student to us as soon as possible.</td>
                </tr>
            </tbody>
        </table>
        <table class="mb-20">
            <tbody>
                <tr style="width:100%">
                    <td>Student Name:{{$name}}</td>
                </tr>
                <tr style="width:100%">
                    <td>Date of Birth:{{$dob}} </td>
                </tr>
                <tr style="width:100%">
                    <td>Grade Level:@foreach($grade as $gradelevel)
                        {{$gradelevel}}
                        @endforeach
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="mb-20">
            <tbody>
                <tr style="width:100%">
                    <td> <span style="max-width:200px; display: block;">Please send records to: <br /> <span>West River Academy
                                5475 S. Shawnee Way
                                Aurora, CO 80015 USA</span></span> </td>
                </tr>
            </tbody>
        </table>

        <table class="mb-20">
            <tbody>
                <tr style="width:100%">
                    <td>Fax: 949-315-4317</td>
                </tr>
                <tr style="width:100%">
                    <td>Email: registrar@westriveracademy.com </td>
                </tr>
            </tbody>
        </table>

        <table class="mb-20">
            <tbody>
                <tr style="width:100%">
                    <td>Thank you.</td>
                </tr>
            </tbody>
        </table>

        <table class="mb-20">
            <tbody>
                <tr style="width:100%">
                    <td style="width:50%;"> <img src="../public/images/signature.png" alt=""> </td>
                    <td style="width:50%; text-align:center;"> <img src="../public/images/Stamp.png" style="float:right;width:150px;height:150px;object-fit:contain;" alt=""> </td>
                </tr>
            </tbody>
        </table>

        <table class="mt-40">
            <tbody>
                <tr style="width:100%">
                    <td>Stacey Nishikawa</td>
                </tr>
                <tr style="width:100%">
                    <td>Administrative Director</td>
                </tr>
            </tbody>
        </table>

    </div>
</body>

</html>