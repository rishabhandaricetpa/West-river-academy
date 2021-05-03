@extends('admin.app')

@section('content')
    <section class="content">
        <div class="container-fluid position-relative">
            <h1>Edit Fees Struture</h1>
            <div class="form-wrap border py-5 px-25 position-relative">
                <form method="post" action="{{ route('admin.update.fees', $fees->id) }}">
                    @csrf
                    <div class="card-body p-0 row">
                        <div class="form-group col-sm-6">
                            <label>Fees For<sup>*</sup></label>
                            <input class="form-control" id="description" value="{{ $fees->description }}"
                                name="description" disabled>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Amount</label>
                            <input type="hidden" class="form-control" id="id" name="id" value="{{ $fees->id }}">
                            <input class="form-control" min="0" type="number" id="amount" name="amount"
                                value="{{ $fees->amount }}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
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
