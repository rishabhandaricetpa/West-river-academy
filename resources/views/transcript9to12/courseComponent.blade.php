<table style="width:100%;border-collapse:collapse;">
    <thead style="background-color:#cccccc70">
        <tr style="line-height:1;">
            <th style="text-transform:uppercase;font-size:13px;padding:4px 7px;line-height:1;text-align:left;">course
                name
            </th>
            <th style="text-transform:uppercase;font-size:13px;padding:4px 7px;line-height:1;text-align:left;">yr</th>
            <th style="text-transform:uppercase;font-size:13px;padding:4px 7px;line-height:1;text-align:left;">cr</th>
            <th style="text-transform:uppercase;font-size:13px;padding:4px 7px;line-height:1;text-align:left;">gr</th>
        </tr>
    </thead>
    <tbody>
        @foreach($yearGroup as $year => $courses)
        <tr style="line-height:1;">
            <td style="font-weight:700;text-align:center;font-size:13px;" colspan="4">
                <span style="text-decoration:underline;">Academic Year {{$year}}</span>
            </td>
        </tr>

        @foreach($courses as $course)
        @if($course->id === -1)
        <tr style="line-height:1;">
            <td  colspan="4">&ensp;</td>
        </tr>
        @else
        <tr style="line-height:1;">
            <td style="padding:3px 6px;line-height:1;font-size:13px;text-transform:uppercase;">{{$course->name}}</td>
            <td style="padding:3px 6px;line-height:1;font-size:13px;"> {{$course->grade}}</td>
            <td style="padding:3px 6px;line-height:1;font-size:13px;">{{$course->credit}}</td>
            <td style="padding:3px 6px;line-height:1;font-size:13px;">{{$course->score}}</td>
        </tr>
        @endif
        @endforeach

        @endforeach
    </tbody>
</table>