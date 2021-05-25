@extends('admin.app')

@section('content')

    <section class="content">
        <div class="container-fluid position-relative">
            <h1>Student Payment Information</h1>
            <div class="form-wrap border py-5 px-25 position-relative">
                <!-- form start -->
                <h3></h3>

                <form method="post" class="row" action="{{ route('admin.update.uploadedDocument') }}">
                    @csrf
                    <div class="col-sm-12 d-sm-flex position-relative">
                        <input name="is_upload" type="checkbox" value="{{ $document->is_upload_to_student }}"
                            class="form-control">
                        <label class="ml-2">Want to upload in Student Dashboard <sup>*</sup></label>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Document Name <sup>*</sup></label>
                        <input name="document_name" value="{{ $document->original_filename }}" class="form-control">
                    </div>
                    <input type="hidden" name="document_id" value="{{ $document->id }}">
                    <div class="form-group col-sm-6">
                        <label>Document Type <sup>*</sup></label>
                        <input name="document_type" value="{{ $document->document_type }}" class="form-control">
                    </div>
                    <div class="col-sm-12 mb-3">
                        <a href="{{ $document->document_url }}" download target="_blank">Click here to download and
                            preview</a>
                    </div>
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a onclick="goBack()" class="btn btn-primary">Back</a>
                    </div>
            </div>

            </form>
        </div>
        </div><!-- /.container-fluid -->
    </section>

@endsection
