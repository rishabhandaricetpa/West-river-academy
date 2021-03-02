@extends('layouts.app')

@section('content')

<main class="position-relative container form-content mt-4">
  <h1 class="text-center text-white text-uppercase">dashboard</h1>

  <div class="form-wrap border bg-light py-2r px-25 text-center dashboard-info">
    <p>The transcript for {{$students->fullname}} is Ready to download<a href="#"></a></p>
    <p><embed src="{{ asset('storage/pdf/'.$pdflink) }}" width="400px" height="200px" /></p>
    <a href="{{ route('fetch.transcript',[$transcrip_id,$student_id]) }}" class="btn btn-primary mt-4 font-weight-bold">Download</a>
  </div>
</main>
<!-- Modal -->
<div class="modal fade" id="transcript-notification" tabindex="-1" aria-labelledby="chooseDatesLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-body">
        <p>Thank you. We will review your transcript and give you our feedback. Then you will be able to approve or edit your transcript. After you approve it, it will be available for you to download.</p>
        <p>Any changes requested after your approval will incur a $25 change fee.</p>
        <div class="text-right mt-3"><button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
@endsection