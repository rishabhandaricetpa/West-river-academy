<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Students</title>
</head>

<body>
  <table id="example1" class="table table-bordered table-striped data-table"">
                  <thead>
                  <tr>
                   
                    <th>First name</th>
                    <th>Last name</th>
               
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($enroll_students as $enroll_student)
                  <tr>
                  
                      <td>{{$enroll_student->first_name}}</td>
                      <td>{{$enroll_student->last_name}}</td>
                      <td><a href=" {{route('view.enrollment',$enroll_student->id)}}">view student profile</a></td>

    </tr>
    @endforeach
    </tbody>
  </table>
</body>

</html>