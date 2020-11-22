@extends('layouts.minimal')

@section('pageTitle','429')

@section('content')
  @component('components.httpStatusMessage',[
  'errorCode' => '429',
  'errorHeading' => 'Too many requests',
  'actionUrl' => request()->url(),
  'actionLabel' => 'Retry'
  ])
    Sorry, you have made too many requests.<br>
    Please wait for sometime and try again.
  @endComponent
@endsection
