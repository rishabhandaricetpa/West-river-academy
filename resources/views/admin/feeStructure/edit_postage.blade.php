@extends('admin.app')

@section('content')
    <section class="content">
        <div class="container-fluid position-relative">
            <h1>Edit Postage By Country</h1>
            <div class="form-wrap border py-5 px-25 position-relative">
                <form method="post" action="{{ route('admin.update.countryPostage', $country_data->id) }}">
                    @csrf
                    <div class="card-body p-0 row">
                        <div class="form-group col-sm-6">
                            <label>Country Name<sup>*</sup></label>
                            <input class="form-control" id="description" value="{{ $country_data->country }}"
                                name="description" disabled>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Amount</label>
                            <input type="hidden" class="form-control" id="id" name="id" value="{{ $country_data->id }}">
                            <input class="form-control" id="amount" name="amount"
                                value="{{ $country_data->postage_charges }}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a onclick="goBack()" class="btn btn-primary">Back</a>
            </div>
            <!-- /.card-body -->
        </div>

        </form>
        </div>
        </div>
        <!-- /.card -->

        <!-- /.card-body -->
        </div><!-- /.container-fluid -->
    </section>

@endsection
