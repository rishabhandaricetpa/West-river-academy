@extends('layouts.app')

@section('content')

    <main class="position-relative container form-content mt-4">
      <h1 class="text-center text-white text-uppercase">dashboard</h1>

      <div class="form-wrap border bg-light py-2r px-25 text-center dashboard-info">
        <p>I'm finished with this transcript. I want to see what it looks like</p>
        <a href="{{ route('genrate.transcript',1) }}" class="btn btn-primary mt-4 font-weight-bold">View Transcript</a>
      </div>
    </main>

 @endsection