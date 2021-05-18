@extends('admin.app')

@section('content')
    <section class="content">
        <div class="container-fluid position-relative">
            <h1>Parent Details</h1>
            <div class="form-wrap border py-5 px-25 position-relative">
                <!-- form start -->
                <form method="post" class="row" action="{{ route('admin.parent.update', $parent->id) }}">
                    @csrf
                    <div class="form-group col-sm-12">
                        <label>User Status<sup>*</sup> <sup>{{ $parent->status === 0 ? 'Active' : 'Inactive' }}</sup></label>
                        <select id="status" name="status" class="form-control"
                            value="{{ $parent->status === 0 ? 'Active' : 'Inactive' }}">
                            <option value="0" @if ($parent->status == 0) selected="selected" @endif>Active</option>
                            <option value="1" @if ($parent->status == 1) selected="selected" @endif>Inactive</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Parent 1 First/Given Name <sup>*</sup></label>
                        <input class="form-control" id="p1_first_name" value="{{ $parent->p1_first_name }}"
                            name="p1_first_name">
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Parent 1 Middle Name</label>
                        <input class="form-control" id="p1_middle_name" name="p1_middle_name"
                            value="{{ $parent->p1_middle_name }}">
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Parent 1 Last/Family Name <sup>*</sup></label>
                        <input class="form-control" id="p1_last_name" name="p1_last_name"
                            value="{{ $parent->p1_last_name }}">
                    </div>
                    <div class="form-group col-sm-6">

                        <label>Parent 1 Email<sup>*</sup> </label>
                        <input class="form-control" id="p1_email" name="p1_email" value="{{ $parent->p1_email }}" disabled>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Parent 1 Cell Phone</label>
                        <input class="form-control" name="p1_cell_phone" id="p1_cell_phone"
                            value="{{ $parent->p1_cell_phone }}">
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Parent 1 Home Phone</label>
                        <input class="form-control" id="p1_home_phone" name="p1_home_phone"
                            value="{{ $parent->p1_home_phone }}">
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Parent 2 First/Given Name</label>
                        <input class="form-control" id="p2_first_name" value="{{ $parent->p2_first_name }}"
                            name="p2_first_name">
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Parent 2 Middle Name</label>
                        <input class="form-control" id="p2_middle_name" name="p2_middle_name"
                            value="{{ $parent->p2_middle_name }}">
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Parent 2 Email</label>
                        <input class="form-control" id="p2_email" name="p2_email" value="{{ $parent->p2_email }}">
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Parent 2 Cell Phone</label>
                        <input class="form-control" name="p2_cell_phone" id="p2_cell_phone"
                            value="{{ $parent->p2_cell_phone }}">
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Parent 2 Home Phone</label>
                        <input class="form-control" id="p2_home_phone" name="p2_home_phone"
                            value="{{ $parent->p2_home_phone }}">
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Street Address<sup>*</sup></label>
                        <input class="form-control" id="street_address" name="street_address"
                            value="{{ $parent->street_address }}">
                    </div>
                    <div class="form-group col-sm-6">
                        <label>City</label>
                        <input class="form-control" id="city" name="city" value="{{ $parent->city }}">
                    </div>
                    <div class="form-group col-sm-6">
                        <label>State<sup>*</sup></label>
                        <input class="form-control" id="state" name="state" value="{{ $parent->state }}">
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Country<sup>*</sup></label>
                        <input class="form-control" id="country" name="country" value="{{ $parent->country }}">
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Referred by</label>
                        <input class="form-control" id="reference" name="reference" value="{{ $parent->reference }}">
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Immunization Status<sup>*</sup></label>
                        <input class="form-control" id="immunized" name="immunized" value="{{ $parent->immunized }}">
                    </div>
                    <div class="form-group col-sm-12">
                    <label>Students<sup>*</sup></label>
                    <div class="container my-3">
  <div class="card">
    <div class="card-header">
      <!-- START TABS DIV -->
      <div class="tabbable-responsive">
        <div class="tabbable">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab" aria-controls="first" aria-selected="true">First Tab</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="second-tab" data-toggle="tab" href="#second" role="tab" aria-controls="second" aria-selected="false">Second Tab</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="third-tab" data-toggle="tab" href="#third" role="tab" aria-controls="third" aria-selected="false">Third Tab</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="fourth-tab" data-toggle="tab" href="#fourth" role="tab" aria-controls="fourth" aria-selected="false">Fourth Tab</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="fifth-tab" data-toggle="tab" href="#fifth" role="tab" aria-controls="fifth" aria-selected="false">Fifth Tab</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="sixth-tab" data-toggle="tab" href="#sixth" role="tab" aria-controls="sixth" aria-selected="false">Sixth Tab</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="card-body">
      
      <div class="tab-content">
        <div class="tab-pane fade show active" id="first" role="tabpanel" aria-labelledby="first-tab">
          <h5 class="card-title">First Tab header</h5>
          <p class="card-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
        </div>
        <div class="tab-pane fade" id="second" role="tabpanel" aria-labelledby="second-tab">
          <h5 class="card-title">Second Tab header</h5>
          <p class="card-text">In hac habitasse platea dictumst. Cras sit amet massa fermentum risus eleifend malesuada vel nec erat. Cras massa tellus, volutpat efficitur feugiat eu, accumsan vel felis. Nullam ornare tellus eu dolor rhoncus, ut tempor lectus tincidunt. Ut in condimentum lectus. Praesent non pretium mauris, efficitur condimentum ex. Nam ante lorem, eleifend in egestas a, rhoncus at ex.</p>
        </div>
        <div class="tab-pane fade" id="third" role="tabpanel" aria-labelledby="third-tab">
          <h5 class="card-title">Third Tab header</h5>
          <p class="card-text">Vestibulum neque nunc, ullamcorper et laoreet in, dictum vitae nisi. Morbi scelerisque cursus lobortis. Fusce a leo elit. In hac habitasse platea dictumst. Curabitur aliquet nunc sed tellus rutrum ornare. Mauris euismod cursus ligula, nec mollis lorem sodales vel. Proin mollis posuere nisl a pretium. Aenean sit amet nibh quis nisl pharetra malesuada convallis id leo.</p>
        </div>
        <div class="tab-pane fade" id="fourth" role="tabpanel" aria-labelledby="fourth-tab">
          <h5 class="card-title">Fourth Tab header</h5>
          <p class="card-text">Nulla dignissim justo sed nulla dignissim pellentesque. Maecenas rhoncus faucibus finibus. Mauris eget tincidunt metus. Morbi bibendum nunc sed nisl aliquam, sit amet lacinia lectus pharetra. Cras accumsan convallis risus. Morbi nisi libero, consequat eget leo vel, finibus rhoncus nulla. Mauris tempus risus quis efficitur sollicitudin. Suspendisse potenti. Quisque ut leo interdum ipsum tristique ultrices.</p>
        </div>
        <div class="tab-pane fade" id="fifth" role="tabpanel" aria-labelledby="fifth-tab">
          <h5 class="card-title">Fifth Tab header</h5>
          <p class="card-text">Nunc lacinia sodales ex, in mattis nulla eleifend in. Quisque molestie, dolor non egestas ornare, diam sapien accumsan erat, non malesuada nulla est ac purus. Donec pharetra molestie leo sit amet posuere. Etiam feugiat mi nisi, id semper neque dignissim ut. Praesent vitae accumsan eros. Curabitur a nisi non arcu suscipit rutrum at ut orci. Praesent nec eros eros. Quisque tempus neque ut nibh viverra, ut commodo dolor dapibus.</p>
        </div>
        <div class="tab-pane fade" id="sixth" role="tabpanel" aria-labelledby="sixth-tab">
          <h5 class="card-title">Sixth Tab header</h5>
          <p class="card-text">Proin ornare purus vitae magna viverra suscipit. Etiam rutrum lorem cursus libero scelerisque lacinia. Praesent bibendum risus id aliquam finibus. Donec sed orci sodales, viverra dolor a, dignissim mi. Pellentesque nec lectus enim. Suspendisse eu ligula ac tortor mollis lobortis. Nulla a laoreet neque, sit amet luctus dolor. Nam facilisis at odio ac commodo. Nullam vehicula blandit dui, vel suscipit orci.</p>
        </div>
      </div>
      <!-- END TABS DIV -->
      
    </div>
  </div>
</div>
                    @if($allstudent)
                    @foreach ($allstudent as $student)
                    <a href="{{ route('admin.edit-student',$student->id)}}">{{ $student->fullname }},</a>
                    @endforeach
                    @endif
                    </div>
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('admin.view.parent')}}" class="btn btn-primary">Back</a>
                    </div>
                </form>

            </div>
        </div><!-- /.container-fluid -->

    </section>

@endsection
