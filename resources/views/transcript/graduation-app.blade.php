@extends('layouts.app')
@section('pageTitle', 'Purchase Transcript')
@section('content')
    <!-- * =============== Main =============== * -->
    <main class="position-relative container form-content mt-4">
        <h1 class="text-center text-white text-uppercase">Purchase Transcript</h1>
        <div class="form-wrap border bg-light py-5 px-25">
            <form action="{{ route('transcript.studentInfo') }}" method="post">
                @csrf
            <h2 class="mb-3">Select the student(s) who need transcripts. You may select more than one.</h2>
           <div class="row">
               <div class="col-lg-6">
                <div class="overflow-auto">
                    <table>
                        <thead>
                            <tr>
                                <th class="p-2 bg-grey">Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($enroll_students as $key=> $enroll_student) 
                                <tr>
                                    <td class="d-flex align-items-center"><input class="mr-2" type="checkbox" id="checkbox_val" name="transcript_val[]" value="{{ $enroll_student->id }}">{{ $enroll_student->fullname }}</td>
                                    <input type="hidden" id="student_id" name="student_id" value="{{$enroll_student->id}} "/>
                                </tr>
                            @endforeach
                        </tbody>
                       
                    </table>
                    <div class="mt-5">
                        <button  type="submit"  class="btn btn-primary">Purchase</button>
                    </div>
                </div>
               </div>
           </div>
            
        </form>
    </main>

    <!-- * =============== /Main =============== * -->
@endsection
