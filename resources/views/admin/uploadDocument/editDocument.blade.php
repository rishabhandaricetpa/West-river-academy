@extends('admin.app')

@section('content')

    <section class="content">
        <div class="container-fluid position-relative">
            <h1>Upload Documents</h1>
            <div class="form-wrap border py-5 px-25 position-relative">
                <!-- form start -->
                <h3>
                    <form method="post" class="row" action="{{ route('admin.store.uploadDocument') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group col-sm-6">
                            <label>Upload Single/Multiple Documents<sup>*</sup></label>
                            <label class="font-weight-bold text-secondary">For Student
                                {{ $parentStudentData->full_name }}</label>
                            <input multiple="multiple" type="file" name="file[]" class="form-control choose-btn" multiple>
                        </div>
                        <input type="hidden" name="student_id" value="{{ $parentStudentData->id }}">
                        <input type="hidden" name="parent_id" value="{{ $parentStudentData['parentProfile']['id'] }}">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="col-sm-12">
                            <button type="submit"
                                onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();"
                                class="btn btn-primary">Upload</button>
                            <a onclick="goBack()" class="btn btn-primary">Back</a>
                        </div>

                        </ul>
            </div>

            </form>
        </div>
        </div><!-- /.container-fluid -->
    </section>

@endsection
