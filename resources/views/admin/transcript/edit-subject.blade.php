@extends('admin.app')

@section('content')
    <section class="content">
        <div class="container-fluid position-relative">
            <h1>Edit Subject Name</h1>
            <div class="form-wrap border py-5 px-25 position-relative">
                <form method="post" class="row" action="{{ url('admin/update/subject', $name->id) }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Subject Name<sup>*</sup></label>
                            <input class="form-control" id="subject_name" value="{{ $name->subject_name }}"
                                name="subject_name">
                        </div>
                        <div class="form-group">
                            <label>Grade</label>
                            <select class="form-control" name="grade" value="" Required>
                                <option value="K-8" @if($name->transcript_period == 'K-8')
                                    selected="selected" @endif>K - 8</option>
                                <option value="9-12" @if($name->transcript_period == '9-12')
                                    selected="selected" @endif>9 - 12</option>
                            </select>
                        </div>

                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a onclick="goBack()" class="btn btn-primary">Back</a>
                        </div>
                </form>
            </div>
            <!-- /.card -->

            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>

@endsection
