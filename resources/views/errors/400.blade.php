@extends('_layouts.minimal')

@section('pageTitle','400')

@section('content')
  @component('components.httpStatusMessage',[
  'errorCode' => '400',
  'errorHeading' => 'Bad Request',
  'actionUrl' => url('/'),
  'actionLabel' => 'Back to home page'
  ])
    @empty($exception->getMessage())
      Your browser did something wrong. Please try again.
    @else
      {{$exception->getMessage()}}
    @endempty
  @endComponent
@endsection
