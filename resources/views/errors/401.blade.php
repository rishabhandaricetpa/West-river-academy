@extends('_layouts.minimal')

@section('pageTitle','401')

@section('content')
  @component('components.httpStatusMessage',[
  'errorCode' => '401',
  'errorHeading' => 'Unauthorised',
  'actionUrl' => url()->previous(),
  'actionLabel' => 'Back to previous page'
  ])
    @empty($exception->getMessage())
      Sorry, you are not authorized to access this page.
    @else
      {{$exception->getMessage()}}
    @endempty
  @endComponent
@endsection
