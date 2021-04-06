@extends('layouts.app')
@section('pageTitle', 'Notarization & Appostile')
@section('content')
<!-- * =============== Main =============== * -->

<main class="position-relative container form-content mt-4 label-styling label-md">
  <h1 class="text-center text-white text-uppercase">order postage</h1>
  <div class="form-wrap border bg-light py-5 px-25 dashboard-info">
    <form method="POST" class="mb-0" action="">
      @csrf
      <p>Select the country you are shipping to. We only ship Express outside the US.</p>
      <div class="form-row col-md-10 px-0">
        <div class="form-group col-md-9">
          <select id="select-particular" class="form-control col-md-4">
            <option selected="">United states of america</option>
            <option>india</option>
            <option>America</option>
          </select>
        </div>
        <div class="form-group col-md-3 d-md-flex">
          <p class="pr-md-3 space-pre">Total Due:</p>
          <div class="d-flex">
            <i class="fas fa-dollar-sign additional-sign"></i>
            <input type="text" class="form-control" id="inputZip">

          </div>
        </div>
        <button type="submit" class="btn btn-primary ml-auto">Add to cart</button>
      </div>
      <div id="select-us" class="d-none">
        <p>If country is US:</p>
        <div class="form-row col-md-10 px-0">
          <div class="form-group col-md-10 form-row">
            <select id="inputState" class="form-control col-md-4 mr-5">
              <option selected="">United States of America</option>
              <option>...</option>
            </select>
            <input type="text" class="form-control col-md-2 ml-4" id="inputZip">
          </div>

        </div>
        <div class="form-row col-md-10 px-0">
          <div class="form-group col-md-9 form-row">
            <select id="inputState" class="form-control col-md-2  offset-md-6">
              <option selected="">United States of America</option>
              <option>...</option>
            </select>
          </div>
          <div class="form-group col-md-3 d-md-flex">
            <p class="pr-md-3 space-pre">Total Due:</p>
            <div class="d-flex">
              <i class="fas fa-dollar-sign additional-sign"></i>
              <input type="text" class="form-control" id="inputZip">

            </div>

          </div>
          <button type="submit" class="btn btn-primary ml-auto">Add to cart</button>
        </div>
      </div>
    </form>
</main>
@endsection