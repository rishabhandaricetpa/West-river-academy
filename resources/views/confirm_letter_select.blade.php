@extends('layouts.app')
@section('pageTitle', 'Confirmation')
@section('content')
        <div class="content-wrapper">
            <main class="position-relative container form-content mt-4">
                <div class="form-wrap border bg-light py-5 px-25 mb-4">
                    <h2 class="mb-5">What would you like to do?</h2>
                    <div class="row confirmation-letter__options border-bottom">
                        <h2 class="mb-3">Select your Confirmation Letter Options</h2>
                        <form method="post" class="mb-0" action="{{route('save.confirmationData',[$student->id, $grade_id])}}">
                            @csrf     
                        <table>
                            <tbody>
                                <tr>
                                    <td>Student</td>
                                    <td>{{$student->fullname}}</td>
                                </tr>
                                <tr>
                                    <td>Date of Birth</td>
                                    <td>{{ Carbon\Carbon::parse($student->dob)->format('M d Y') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row confirmation-letter__options">
                        <h3 class="mb-3">You may choose to include or exclude any of the following fields. Check the ones
                            you want on
                            the Confirmation Letter.</h3> 
                        </label>
                        <label class="container">Birth City
                            <input type="checkbox" name="isDobCity" value="{{$confirmation_data->isDobCity?'true':'false'}}">
                            <span class="isDobCity"></span>
                        </label>
                        <label class="container">Mother's Maiden Name
                            <input type="checkbox" name="IsMotherName" value="{{$confirmation_data->IsMotherName?'true':'false'}}">
                            <span class="IsMotherName"></span>
                        </label>
                        <label class="container">Student ID
                            <input type="checkbox" name="isGrade" value="{{$confirmation_data->isGrade?'true':'false'}}">
                            <span class="isGrade"></span>
                        </label>
                        <label class="container">Grade
                            <input type="checkbox" name="isStudentId" value="{{$confirmation_data->isStudentId?'true':'false'}}">
                            <span class="isStudentId"></span>
                        </label>
                    </div>
                    <p>If the checkbox is disabled or field data is not showing up for the field you want to include, click
                        <a href="{{route('edit.student',$student->id)}}">here</a> to add it to the student record.
                    </p>
                    <div class="mt-2r">
                        <a href="{{route('dashboard')}}"
                            class="btn btn-primary addenrollment mb-4 mb-sm-0">Back</a>
                        <button type="submit" class="btn btn-primary mb-4 mb-sm-0 ml-2">Continue</button>
                    </div>
                </form>
            </main>
        </div>
@endsection
