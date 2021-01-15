
@extends('layouts.app')

@section('content')
<main class="position-relative container form-content mt-4">
       <h1 class="text-center text-white text-uppercase">cart</h1>
       <div id="app">
          <billing-shipping :parents='@json($parent)' :countries='@json($country_list)' :total='@json($enroll_fees)'></billing-shipping>
          </div>
  </main>
@endsection
