@extends('layouts.app')

@section('content')

    <main class="position-relative container form-content mt-4">
      <h1 class="text-center text-white text-uppercase">dashboard</h1>

      <div class="form-wrap border bg-light py-2r px-25 text-center dashboard-info">
        <p>The transcript for Paige is Ready to download<a href="#"></a></p>
        <a href="{{ route('genrate.transcript',1) }}" class="btn btn-primary mt-4 font-weight-bold">Download</a>
                <!-- <a href="{{ route('genrate.transcript',1) }}" class="btn btn-primary mt-4 font-weight-bold">View Transcript</a> -->

      </div>
    </main>


<!-- Modal -->

<div class="modal fade" id="transcript-notification" tabindex="-1" aria-labelledby="chooseDatesLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-body">
        <p>Annual enrollment covers the 12 months from  Second Semester Only covers If you prefer to start your enrollment on the date you enroll, select that date. If you want your
          enrollment to date back to  even though it is now later in the year, you can do so.</p>
        <p>The dates you select will appear on your confirmation of enrollment letter. Regardless of the date you
          select, your enrollment will include the full 12-month period for Annual or the full 7-month period for Second
          Semester Only.</p>
        <div class="text-right mt-3"><button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
@endsection

