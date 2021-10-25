@extends('layouts.app')
@section('pageTitle', 'Edit & Account')
@section('content')
    <!-- * =============== Main =============== * -->
    <form method="POST" action="{{ route('update.mailingAddress', $parent->id) }}">
        @csrf
        <main class="position-relative container">

            <div class="form-wrap border bg-light form-content small-container">
                <h2>Enter the Mailing Address below</h2>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="form-group d-sm-flex mb-2">
                    <label for="">Street Address</label>
                    <div>
                        <input class="form-control " name="street_address" value="{{ $parent->street_address }}" required
                            autocomplete="p1_first_name" autofocus>
                    </div>
                </div>
                <div class="form-group d-sm-flex mb-2">
                    <label for="">City</label>
                    <div>
                        <input class="form-control " name="city" value="{{ $parent->city }}" required
                            autocomplete="p1_last_name" autofocus>
                    </div>
                </div>
                <div class="form-group d-sm-flex mb-2">
                    <label for="">State</label>
                    <div>
                        <input  type="text" class="form-control" value="{{ $parent->state }}" name="state"
                            required autocomplete="p1_email" autofocus>
                    </div>
                </div>
                <div class="form-group d-sm-flex mb-2">
                    <label for="">Zip code</label>
                    <div>
                        <input type="number" class="form-control" value="{{ $parent->zip_code }}" name="zip_code" required
                            autocomplete="p1_email" autofocus>
                    </div>
                </div>
                <div class="form-group d-sm-flex mb-2">
                    <label for="">Country</label>
                    <div>
                        <input type="text" class="form-control" value="{{ $parent->country }}" name="country" required
                            autocomplete="p1_email" autofocus>
                    </div>
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
            </div>

            </div>
        </main>
    </form>
@endsection
