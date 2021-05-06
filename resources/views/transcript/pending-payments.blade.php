@extends('layouts.app')
@section('pageTitle', 'Notify')
@section('content')

<main class="position-relative container form-content mt-4">
    <h1 class="text-center text-white text-uppercase">dashboard</h1>

    <div class="form-wrap border bg-light py-2r px-25 text-center dashboard-info">
        <p>You can not create the Transacript for this Student. Because you have not paid for any Transcript</a></p>
        <p>We recommend that you to first pay atleast for one enrollment to buy the Transacript</p>
        <td><a href="{{route('transcript.studentInfo',$id)}}" class="btn btn-primary">Purchase</a></td>
    </div>
</main>

@endsection