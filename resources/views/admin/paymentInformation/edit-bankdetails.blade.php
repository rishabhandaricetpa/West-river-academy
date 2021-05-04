@extends('admin.app')

@section('content')



<h5 class="mb-2">Payment Address</h5>
            <div class="container-fluid position-relative">
                <div class="col-12">
            <!-- Custom Tabs -->
                    <div class="card">
                        <div class="card-header d-flex p-0">
                             <h3 class="card-title p-3"></h3>
                                 <ul class="nav nav-pills ml-auto p-2">
                                    <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Money Gram Address</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Bank Transfer Address</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#tab_3" data-toggle="tab">Transfer Wise Address</a></li>
                
                                </ul>
                        </div><!-- /.card-header -->
                     <div class="card-body">
                         <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#moneygramModal">Add New Money Gram Address</button>
                                   
                                   
                                    <table id="addressData" class="table table-bordered table-striped data-table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Address</th>
                                                <th>City</th>
                                                <th>State</th>
                                                <th>Zip Code</th>
                                                <th>ID</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($moneyGram as $moneygram)
                                            <tr>
                                                <td>{{$moneygram->name}}</td>
                                                <td>{{$moneygram->address}}</td>
                                                <td>{{$moneygram->city}}</td>
                                                <td>{{$moneygram->state}}</td>
                                                <td>{{$moneygram->zip}}</td>
                                                <td>{{$moneygram->money_gram_id}}</td>
                                                <td>{{$moneygram->status==1 ?'Active':'Deactivated'}}</td>
                                                <td>
                                                <a href="{{ url('admin/edit-moneygram',$moneygram->id)}}"><i class="fas fa-edit"></i>
                                                <a href="{{ url('admin/delete/moneygram',$moneygram->id)}}"><i class="fas fa-trash-alt" onclick="return myFunction();"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                            </div>
                  <!-- /.tab-pane -->
                  
                            <div class="tab-pane" id="tab_2">
                                <button type="submit" class="btn btn-primary mb-4" data-toggle="modal" data-target="#bankTransferModal">Add New Bank Transfer Address</button>
                                     <table id="addressData" class="table table-bordered table-striped data-table">
                                        <thead>
                                            <tr>
                                                <th>Bank Name</th>
                                                <th>Swift Code</th>
                                                <th>Bank Address</th>
                                                <th>Phone Number</th>
                                                <th>Routing Number</th>
                                                <th>Account Name</th>
                                                <th>Account Number</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($banktransfer as $bankTransfer)
                                            <tr>
                                                <td>{{$bankTransfer->bank_name}}</td>
                                                <td>{{$bankTransfer->swift_code}}</td>
                                                <td>{{$bankTransfer->street}}</td>
                                                <td>{{$bankTransfer->phone_number}}</td>
                                                <td>{{$bankTransfer->routing_number}}</td>
                                                <td>{{$bankTransfer->account_name}}</td>
                                                <td>{{$bankTransfer->account_number}}</td>
                                                <td>{{$bankTransfer->status==1 ?'Active':'Deactivated'}}</td>
                                                <td>
                                                <a href="{{ url('admin/edit-banktransfer',$bankTransfer->id)}}"> <i class="fas fa-edit"></i>
                                                <a href="{{ url('admin/delete/banktransfer',$bankTransfer->id)}}"><i class="fas fa-trash-alt" onclick="return myFunction();"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                 </table>
                            </div>
                  <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_3">
                                <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#transferwiseModal">Add New Transfer Wise Address</button>
                                    <table id="addressData" class="table table-bordered table-striped data-table">
                                        <thead>
                                        <tr>
                                            <th>Account Holder</th>
                                                <th>Account Number</th>
                                                <th>Wire Transfer Number</th>
                                                <th>Swift Code</th>
                                                <th>Routing Number</th>
                                                <th>Address</th>
                                                <th>Website</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($tranferwise as $tranferWise)
                                            <tr>
                                                <td>{{$tranferWise->account_holder}}</td>
                                                <td>{{$tranferWise->account_number}}</td>
                                                <td>{{$tranferWise->wire_transfer_number}}</td>
                                                <td>{{$tranferWise->swift_code}}</td>
                                                <td>{{$tranferWise->routing_number}}</td>
                                                <td>{{$tranferWise->address}} {{$tranferWise->state}} {{$tranferWise->country}}</td>
                                                <td>{{$tranferWise->website}}</td>
                                                <td>{{$tranferWise->status==1 ?'Active':'Deactivated'}}</td>
                                                <td>
                                                <a href="{{ url('admin/edit-transferwise',$tranferWise->id)}}"><i class="fas fa-edit"></i>
                                                <a href="{{ url('admin/delete/transferwise',$tranferWise->id)}}"><i class="fas fa-trash-alt" onclick="return myFunction();"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                        </table>
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
  </div>

<!------------------Money Gram Modal------------------------>

<div class="modal fade" id="moneygramModal" tabindex="-1" role="dialog" aria-labelledby="moneygramModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3  id="moneygramModalLabel">Add New Address for Money Gram</h3>
      </div>
      <form method="post" action="{{route('admin.create.moneygram')}}">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Name<sup>*</sup></label>
                    <input  class="form-control" id="name" value="" name="name">
                  </div>
                  <div class="form-group">
                    <label>Address</label>
                    <input  class="form-control" id="address" name="address" value="">
                  </div>
                  <div class="form-group">
                    <label>City <sup>*</sup></label>
                    <input  class="form-control" id="city" name="city" value="">
                  </div>
                  <div class="form-group">
                    <label>State</label>
                    <input  class="form-control" name="state" id="state" value="">
                  </div>
                  <div class="form-group">
                    <label>Zip Code</label>
                    <input  class="form-control"  id="zip" name="zip" value="">
                  </div>
                  <div class="form-group">
                    <label>ID</label>
                    <input  class="form-control" id="money_gram_id" name="money_gram_id" value="">
                  </div>
                <!-- /.card-body -->
      <div class="modal-footer py-3 px-0">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
</div>


<!------------------Bank Transfer Modal------------------------>

<div class="modal fade" id="bankTransferModal" tabindex="-2" role="dialog" aria-labelledby="bankTransferModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 id="bankTransferModalLabel">Add New Address for Bank Transfer</h3>
      </div>
      <form method="post" action="{{route('admin.create.banktransfer')}}">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Bank Name<sup>*</sup></label>
                    <input  class="form-control" id="bank_name" value="" name="bank_name">
                  </div>
                  <div class="form-group">
                    <label>Swift Code</label>
                    <input  class="form-control" id="swift_code" name="swift_code" value="">
                  </div>
                  <div class="form-group">
                    <label>Bank Address <sup>*</sup></label>
                    <input  class="form-control" id="bank_address" name="bank_address" value="">
                  </div>
                  <div class="form-group">
                    <label>Street</label>
                    <input  class="form-control" name="street" id="street" value="">
                  </div>
                  <div class="form-group">
                    <label>Phone Number</label>
                    <input  class="form-control"  id="phone_number" name="phone_number" value="">
                  </div>
                  <div class="form-group">
                    <label>Routing Number</label>
                    <input  class="form-control" id="routing_number" name="routing_number" value="">
                  </div>
                  <div class="form-group">
                    <label>Account Name</label>
                    <input  class="form-control"  id="account_name" name="account_name" value="">
                  </div>
                  <div class="form-group">
                    <label>Account Number</label>
                    <input  class="form-control" id="account_number" name="account_number" value="">
                  </div>
                <!-- /.card-body -->
      <div class="modal-footer py-3">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
</div>

<!------------------Transfer Wise Modal------------------------>

<div class="modal fade" id="transferwiseModal" tabindex="-2" role="dialog" aria-labelledby="transferwiseModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="transferwiseModalLabel">Add New Address for Transfer Wise</h5>
      </div>
      <form method="post" action="{{route('admin.create.transferwise')}}">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Account Holder<sup>*</sup></label>
                    <input  class="form-control" id="account_holder" value="" name="account_holder">
                  </div>
                  <div class="form-group">
                    <label>Account Number</label>
                    <input  class="form-control" id="account_number" name="account_number" value="">
                  </div>
                  <div class="form-group">
                    <label>Wire Transfer Number <sup>*</sup></label>
                    <input  class="form-control" id="wire_transfer_number" name="wire_transfer_number" value="">
                  </div>
                  <div class="form-group">
                    <label>Swift Code</label>
                    <input  class="form-control" name="swift_code" id="swift_code" value="">
                  </div>
                  <div class="form-group">
                    <label>Routing Number</label>
                    <input  class="form-control" name="routing_number" id="routing_number" value="">
                  </div>
                  <div class="form-group">
                    <label>Address</label>
                    <input  class="form-control" name="address" id="address" value="">
                  </div>
                  <div class="form-group">
                    <label>State</label>
                    <input  class="form-control"  id="state" name="state" value="">
                  </div>
                  <div class="form-group">
                    <label>Country</label>
                    <input  class="form-control" id="country" name="country" value="">
                  </div>
                  <div class="form-group">
                    <label>Website</label>
                    <input  class="form-control" id="website" name="website" value="">
                  </div>
                <!-- /.card-body -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
</div>
@endsection

<script>
  function myFunction() {
      if(!confirm("Are You Sure to delete this"))
      event.preventDefault();
  }
 </script>
