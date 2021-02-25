@extends('admin.app')

@section('content')
<section class="content">
      <div class="container-fluid position-relative">
      <h1>Upload Transcript</h1>
            <div class="form-wrap border py-5 px-25 position-relative">

                    @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                    </div>
                    @endif
            
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

              <form action="{{ route('admin.file.upload.post') }}" method="POST" enctype="multipart/form-data">
                @csrf           
                <div class="card-body">
                  <div class="form-group">
                    <label>Upload Signed Document<sup>*</sup></label>
                    <input type="file" name="file" class="form-control">
                </div>
                  </div>
                <div class="col-sm-12">
                <button type="submit" class="btn btn-primary">Upload</button>
                  <a href="/admin/manage-courses" class="btn btn-primary">Back</a>
                </div>
              </form>
            </div>
            <!-- /.card -->

              <!-- /.card-body -->
            </div>
            <!-- /.card -->
</section>

@endsection


