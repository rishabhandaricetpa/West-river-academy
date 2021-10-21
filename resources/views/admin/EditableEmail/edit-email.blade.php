@extends('admin.app')

@section('content')

<section class="content container-fluid  mt-3 pb-3">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- first card parent details -->

    <div class="card mt-3 px-4 py-5">
        <form>
            <div class="form-group">
              <label for="Tittle" class="col-form-label">Tittle:</label>
              <input type="text" class="form-control" id="Tittle">
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Recipient:</label>
                <input type="text" class="form-control" id="recipient-name">
              </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Message:</label>
              <textarea class="form-control" id="message-text"></textarea>
            </div>
            <button class="btn btn-primary">Submit</button>
          </form>
    </div>
</section>


@endsection
