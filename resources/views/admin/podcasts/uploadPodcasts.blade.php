@extends('admin.app')

@section('content')


<div class="container-fluid position-relative mt-5">
    <div class="col-12">
      <!-- Custom Tabs -->
      <div class="card">
        <div class="card-header d-flex p-0">
          <h3 class="card-title p-3">UPLOAD PODCAST AUDIOS AND VIDEOS</h3>
          <ul class="nav nav-pills ml-auto p-2">
            <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Podcast</a></li>
            <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Audio</a></li>
            <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Video</a></li>
          </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
          <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                <form action="" class="row">
                    <div class="form-group col-md-6">
                        <label> HEADING <sup>*</sup></label>
                        <input class="form-control" value="" name="heading" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label> Content <sup>*</sup></label>
                        <input class="form-control" value="" name="Content" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label> UPLOAD <sup>*</sup></label>
                        <input type="file" id="myFile" name="filename"  required>
                    </div>
                    <div class="form-group col-12">
                        <input type="submit">
                    </div>
                   
                  </form>
            </div>
            <!-- /.tab-pane -->
  
            <div class="tab-pane" id="tab_2">
                <form action="" class="row">
                    <div class="form-group col-md-6">
                        <label> HEADING <sup>*</sup></label>
                        <input class="form-control" value="" name="heading" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label> Content <sup>*</sup></label>
                        <input class="form-control" value="" name="Content" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label> UPLOAD <sup>*</sup></label>
                        <input type="file" id="myFile" name="filename"  required>
                    </div>
                    <div class="form-group col-12">
                        <input type="submit">
                    </div>
                   
                  </form>
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="tab_3">
                <form action="" class="row">
                    <div class="form-group col-md-6">
                        <label> HEADING <sup>*</sup></label>
                        <input class="form-control" value="" name="heading" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label> Content <sup>*</sup></label>
                        <input class="form-control" value="" name="Content" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label> UPLOAD <sup>*</sup></label>
                        <input type="file" id="myFile" name="filename"  required>
                    </div>
                    <div class="form-group col-12">
                        <input type="submit">
                    </div>
                   
                  </form>
            </div>
            <!-- /.tab-pane -->
          </div>
  
          <!-- /.tab-content -->
        </div><!-- /.card-body -->
      </div>
      <!-- ./card -->
    </div>
    <!-- /.col -->
  </div>
  @endsection

  
