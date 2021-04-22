@extends('admin.app')

@section('content')
<section class="content">
    <div class="container-fluid position-relative">
        <h1>Parent Details</h1>
        <div class="form-wrap border py-5 px-25 position-relative">
            <!-- form start -->
            <form method="post" class="row" action="{{route('admin.parent.update',$parent->id)}}">
                @csrf
                <div class="form-group col-sm-12">
                    <label>User Status<sup>*</sup> <sup>{{$parent->status===0 ?'Active':'Inactive'}}</sup></label>
                    <select id="status" name="status" class="form-control" value="{{$parent->status===0?'Active':'Inactive'}}">
                        <option value="0" @if($parent->status == 0)
                            selected="selected" @endif>Active</option>
                        <option value="1" @if($parent->status == 1)
                            selected="selected" @endif>Inactive</option>
                    </select>
                </div>
                <div class="form-group col-sm-6">
                    <label>Parent 1 First/Given Name <sup>*</sup></label>
                    <input class="form-control" id="p1_first_name" value="{{$parent->p1_first_name}}" name="p1_first_name">
                </div>
                <div class="form-group col-sm-6">
                    <label>Parent 1 Middle Name</label>
                    <input class="form-control" id="p1_middle_name" name="p1_middle_name" value="{{$parent->p1_middle_name}}">
                </div>
                <div class="form-group col-sm-6">
                    <label>Parent 1 Last/Family Name <sup>*</sup></label>
                    <input class="form-control" id="p1_last_name" name="p1_last_name" value="{{$parent->p1_last_name}}">
                </div>
                <div class="form-group col-sm-6">

                    <label>Parent 1 Email<sup>*</sup> </label>
                    <input class="form-control" id="p1_email" name="p1_email" value="{{$parent->p1_email}}" disabled>
                </div>
                <div class="form-group col-sm-6">
                    <label>Parent 1 Cell Phone</label>
                    <input class="form-control" name="p1_cell_phone" id="p1_cell_phone" value="{{$parent->p1_cell_phone}}">
                </div>
                <div class="form-group col-sm-6">
                    <label>Parent 1 Home Phone</label>
                    <input class="form-control" id="p1_home_phone" name="p1_home_phone" value="{{$parent->p1_home_phone}}">
                </div>
                <div class="form-group col-sm-6">
                    <label>Parent 2 First/Given Name</label>
                    <input class="form-control" id="p2_first_name" value="{{$parent->p2_first_name}}" name="p2_first_name">
                </div>
                <div class="form-group col-sm-6">
                    <label>Parent 2 Middle Name</label>
                    <input class="form-control" id="p2_middle_name" name="p2_middle_name" value="{{$parent->p2_middle_name}}">
                </div>
                <div class="form-group col-sm-6">
                    <label>Parent 2 Email</label>
                    <input class="form-control" id="p2_email" name="p2_email" value="{{$parent->p2_email}}">
                </div>
                <div class="form-group col-sm-6">
                    <label>Parent 2 Cell Phone</label>
                    <input class="form-control" name="p2_cell_phone" id="p2_cell_phone" value="{{$parent->p2_cell_phone}}">
                </div>
                <div class="form-group col-sm-6">
                    <label>Parent 2 Home Phone</label>
                    <input class="form-control" id="p2_home_phone" name="p2_home_phone" value="{{$parent->p2_home_phone}}">
                </div>
                <div class="form-group col-sm-6">
                    <label>Street Address<sup>*</sup></label>
                    <input class="form-control" id="street_address" name="street_address" value="{{$parent->street_address}}">
                </div>
                <div class="form-group col-sm-6">
                    <label>City</label>
                    <input class="form-control" id="city" name="city" value="{{$parent->city}}">
                </div>
                <div class="form-group col-sm-6">
                    <label>State<sup>*</sup></label>
                    <input class="form-control" id="state" name="state" value="{{$parent->state}}">
                </div>
                <div class="form-group col-sm-6">
                    <label>Country<sup>*</sup></label>
                    <input class="form-control" id="country" name="country" value="{{$parent->country}}">
                </div>
                <div class="form-group col-sm-6">
                    <label>Referred by</label>
                    <input class="form-control" id="reference" name="reference" value="{{$parent->reference}}">
                </div>
                <div class="form-group col-sm-6">
                    <label>Immunization Status<sup>*</sup></label>
                    <input class="form-control" id="immunized" name="immunized" value="{{$parent->immunized}}">
                </div>
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>

        </div>
    </div><!-- /.container-fluid -->

</section>

@endsection
