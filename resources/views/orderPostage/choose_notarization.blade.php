@extends('layouts.app')
@section('pageTitle', 'Choose Notarization')
@section('content')
<!-- * =============== Main =============== * -->
<main class="position-relative container form-content mt-4">
    <h1 class="text-center text-white text-uppercase">Dashboard</h1>
    <div class="form-wrap border bg-light py-5 px-25">
        <div class="col-sm-6 mx-auto">
            <div class="text-center">
                <h2 class="mb-3">Order an Apostille or Notarization</h2>
            </div>
            <form method="post" action="{{ route ('notarization.apostille')}}" class="mb-0 mt-5 label-large">
                @csrf
                <div class="d-sm-flex py-4 col-sm-8 mx-auto justify-content-center">
                    <div class="form-check mb-1 pl-5 pr-4">
                        <input class="form-check-input" type="radio" name="type" value="apostille" required>
                        <label class="form-check-label inline" for="">Apostille</label>
                    </div>
                    <div class="form-check mb-1 pl-5 pr-4">
                        <input class="form-check-input" type="radio" name="type" value="notarization">
                        <label class="form-check-label inline" for="">Notarization</label>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">continue</button>
                </div>
            </form>
        </div>

    </div>

</main>

<!-- * =============== /Main =============== * -->
@endsection
