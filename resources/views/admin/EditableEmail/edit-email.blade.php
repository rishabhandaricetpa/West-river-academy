@extends('admin.app')

@section('content')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <section class="content container-fluid  mt-3 pb-3">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <!-- first card parent details -->

        <div class="card mt-3 px-4 py-5">
            <form method='post' action='{{ route('admin.savemail', $type) }}'>
                @csrf

                <div class="form-group">
                    <label for="message-text" class="col-form-label">Email Body:</label>

                    <textarea class="form-control" id='message-text' name='email_body'
                        id="message-text"> {{ $email_data }}</textarea>
                </div>


                <button class="btn btn-primary">Save</button>
            </form>
            @include('admin.EditableEmail.legends')
            <p style='color:red'> Note : Any edits in variables or replacement of them is prohibited.
            <p>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            $("#message-text").wysihtml5();
        });

    </script>

@endsection