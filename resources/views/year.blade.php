<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<table>
<th>Year</th>
@foreach ($result as $year)
<tr>
<td>{{$year}}-{{$year+1}}</td>
</tr>
@endforeach
</table>
</body>
</html>