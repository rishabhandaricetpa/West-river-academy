<!DOCTYPE html>
<html>
<head>
    <title>Confirmation_letter</title>
</head>
<body>
    <h1>{{ $title }}</h1>
    <p>{{ $date }}</p>
    {{$student->id}}
    {{$student->first_name}}
    {{$student->middle_name}}
    {{$student->last_name}}
    <p>This is confirmation letter</p>
</body>
</html>

