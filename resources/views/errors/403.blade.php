@extends('layouts.minimal')

@section('pageTitle','403')

@section('content')
  @component('components.httpStatusMessage',[
  'errorCode' => '403',
  'errorHeading' => 'Forbidden',
  'actionUrl' => url()->previous(),
  'actionLabel' => 'Back to previous page'
  ])
    @empty($exception->getMessage())
      Sorry, you are forbidden from performing this action.
    @else
      {{$exception->getMessage()}}
    @endempty
  @endComponent
@endsection
