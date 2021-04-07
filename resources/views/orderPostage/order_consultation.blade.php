@extends('layouts.app')
@section('pageTitle', 'Personal Consulation')
@section('content')
<main class="position-relative container form-content mt-4 label-styling label-md">
   <h1 class="text-center text-white text-uppercase">order a personal consultation</h1>
   <div class="form-wrap border bg-light py-5 px-25 dashboard-info">
      <div id="app">
         <order-consultation :fees='@json($hourly_charge)'></order-consultation>
      </div>
</main>
@endsection