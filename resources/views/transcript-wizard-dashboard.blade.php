@extends('layouts.app')

@section('content')
<!-- * =============== Main =============== * -->
<main class="position-relative container form-content mt-4">
    <h1 class="text-center text-white text-uppercase">Transcript Wizard</h1>
    <div class="form-wrap border bg-light py-5 px-25 mb-4">
        <h2 class="mb-3">{{$student->first_name}}</h2>
        <form method="POST" action="" class="mb-0">

            <div class="form-group d-sm-flex mb-2">
                <label for="">Name</label>
                <div>
                    {{$student->first_name}}
                </div>
            </div>
            <div class="form-group d-sm-flex mb-2">
                <label for="">Date of Birth</label>
                <div>
                    {{$student->d_o_b->format('d M Y ')}}
                </div>
            </div>
        </form>
    </div>
    <div class="form-wrap border bg-light py-5 px-25 mb-4">
        <h2 class="mb-3">Solana Beach Elementary School</h2>
        <div>
            <p class="mb-0">Academic School Year(s): 2017-2018</p>
            <p>Grade: 5</p>
        </div>
        <div class="overflow-auto">
            <table class="table-styling w-100">
                <thead>
                    <tr>
                        <th>Course / Subject</th>
                        <th>Category</th>
                        <th>Grade</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>ENGLISH</td>
                        <td>English / Language Arts</td>
                        <td>A</td>
                    </tr>
                    <tr>
                        <td>GEOGRAPHY</td>
                        <td>Social Studies / History</td>
                        <td>A</td>
                    </tr>
                    <tr>
                        <td>MATHEMATICS</td>
                        <td>Mathematics</td>
                        <td>A</td>
                    </tr>
                    <tr>
                        <td>PHYSICAL EDUCATION</td>
                        <td>Physical Education</td>
                        <td>P</td>
                    </tr>
                    <tr>
                        <td>SCIENCE</td>
                        <td>Science</td>
                        <td>c</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <a href="#" class="btn btn-primary mt-4" role="button">Select Course Names and Grades</a>
    </div>
    <div class="form-wrap border bg-light py-5 px-25 mb-4">
        <h2 class="mb-3">West River Academy</h2>
        <div>
            <p class="mb-0">Academic School Year(s): 2019-2020</p>
            <p>Grade: 5</p>
        </div>
        <div class="overflow-auto">
            <table class="table-styling w-100">
                <thead>
                    <tr>
                        <th>Course / Subject</th>
                        <th>Category</th>
                        <th>Grade</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>ENGLISH</td>
                        <td>English / Language Arts</td>
                        <td>A</td>
                    </tr>
                    <tr>
                        <td>GEOGRAPHY</td>
                        <td>Social Studies / History</td>
                        <td>A</td>
                    </tr>
                    <tr>
                        <td>MATHEMATICS</td>
                        <td>Mathematics</td>
                        <td>A</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <a href="#" class="btn btn-primary mt-4" role="button">Select Course Names and Grades</a>
    </div>

    <div class="form-wrap border bg-light py-5 px-25 mb-4">
        <p>You can use the button below to add classes from other schools, colleges, and universities. Course selection, credits, and grades must match exactly the transcript we have on file from the other school. Heading on transcript will indicate the name of the school.</p>
        <a href="#" class="btn btn-primary mt-3" role="button">Add Other School, College, or University</a>
    </div>
    <div class="form-wrap border bg-light py-5 px-25">
        <p>If you are finished with this transcript and would like to see what it looks like, you can click the "Preview Transcript" button to download a preview. If you would like to submit it to be reviewed click the "Submit Transcript" button.</p>
        <a href="#" class="btn btn-primary mt-3" role="button">Back to Dashboard</a>
        <a href="#" class="btn btn-primary mt-3 ml-2" role="button">Preview Transcript</a>
        <a href="#" class="btn btn-primary mt-3 ml-2" role="button">Submit Transcript</a>
    </div>
</main>

<!-- * =============== /Main =============== * -->
@endsection