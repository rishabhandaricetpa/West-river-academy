@extends('_layouts.minimal')

@section('pageTitle','500')

@section('content')
  @component('components.httpStatusMessage',[
  'errorCode' => '500',
  'errorHeading' => 'Looks like something went wrong!',
  'actionUrl' => request()->url(),
  'actionLabel' => 'Retry'
  ])
    We track these errors automatically, but if the problem persists feel free to contact us.
    <br>In the meantime, try refreshing.
  @endComponent
@endsection
