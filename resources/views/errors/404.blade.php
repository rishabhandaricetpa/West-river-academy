@extends('layouts.minimal')

@section('pageTitle','404')

@section('content')
  @component('components.httpStatusMessage',[
  'errorCode' => '404',
  'errorHeading' => 'Page not found'
  ])
    Sorry, the page you are looking for could not be found.
  @endComponent
@endsection
