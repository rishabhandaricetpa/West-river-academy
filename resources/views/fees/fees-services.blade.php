@extends('layouts.app')
@section('pageTitle', 'Fee & Services')
@section('content')
<!-- * =============== Main =============== * -->
<main class="position-relative container form-content mt-4">
  <h1 class="text-center text-white text-uppercase">Fees and services</h1>
  <div class="form-wrap border bg-light py-5 px-25 mb-4 service-list">
    <div class="bg-white mb-4">
      <div class="row">
        <div class="col-11 col-sm-3">
          <div class="bg-secondary h-100 d-flex align-items-center justify-content-center">
            <img src="/images/pattern.png" alt="pattern" class="img-absolute o-contain">
            <h2 class="text-white mb-0 text-center pl-3">Renew my Family’s Enrollment<span class="d-block">(for future or past years)</span></h2>
          </div>
        </div>
        <div class="col-sm-9 d-sm-flex">
          <div class="d-flex justify-content-between align-items-center">
            <p class="max-width__275">Fee for the first student in the family</p>
            <span>Annual</span>
            <span class="text-secondary lato">$ {{ getFeeDetails('first_student_annual') }}</span>
          </div>
          <div class="d-flex justify-content-between align-items-center">
            <p class="max-width__275">Second Semester Only</p>
            <span class="text-secondary lato">$ {{ getFeeDetails('first_student_half') }}</span>
          </div>
        </div>
      </div>
    </div>
    <div class="bg-white mb-4">
      <div class="row">
        <div class="col-11 col-sm-3">
          <div class="bg-secondary h-100 d-flex align-items-center justify-content-center">
            <img src="/images/pattern.png" alt="pattern" class="img-absolute o-contain">
            <h2 class="text-white mb-0 text-center pl-3">Enroll a New Student in my Family</h2>
          </div>
        </div>
        <div class="col-sm-9 d-sm-flex">
          <div class="d-flex justify-content-between align-items-center">
            <p class="max-width__275">Fee for each additional student in the same family</p>
            <span>Annual</span>
            <span class="text-secondary lato">$ {{ getFeeDetails('additional_student_annual') }}</span>
          </div>
          <div class="d-flex justify-content-between align-items-center">
            <p class="max-width__275">Second Semester Only</p>
            <span class="text-secondary lato">$ {{ getFeeDetails('additional_student_annual') }}</span>
          </div>
        </div>
      </div>
    </div>
    <div class="bg-white mb-4">
      <div class="row">
        <div class="col-11 col-sm-3">
          <div class="bg-secondary h-100 d-flex align-items-center justify-content-center">
            <img src="/images/pattern.png" alt="pattern" class="img-absolute o-contain">
            <h2 class="text-white mb-0 text-center pl-3">Apply for Graduation</h2>
          </div>
        </div>
        <div class="col-sm-9 d-sm-flex">
          <div class="d-flex justify-content-between align-items-center">
            <p class="max-width__275">Per student fee covers Graduation Project and high school transcript</p>
            <span class="text-secondary lato">$ {{ getFeeDetails('graduation') }}</span>
          </div>
        </div>
      </div>
    </div>
    <div class="bg-white mb-4">
      <div class="row">
        <div class="col-11 col-sm-3">
          <div class="bg-secondary h-100 d-flex align-items-center justify-content-center">
            <img src="/images/pattern.png" alt="pattern" class="img-absolute o-contain">
            <h2 class="text-white mb-0 text-center pl-3 transform-none">Notarization or Apostilles</h2>
          </div>
        </div>
        <div class="col-sm-9">
          <div class="d-flex justify-content-between align-items-center">
            <p class="max-width__275">Notarization per document fee</p>
            <span class="text-secondary lato">$ {{ getFeeDetails('notarization_doc_fee') }}</span>
          </div>
          <div class="d-flex justify-content-between align-items-center">
            <p class="max-width__275">Apostille per document fee</p>
            <span class="text-secondary lato">$ {{ getFeeDetails('apostille_doc_fee') }}</span>
          </div>
          <div class="d-flex justify-content-between align-items-center">
            <p class="max-width__275">Apostille Package includes 2 documents plus Express Mail </p>
            <span class="text-secondary lato">$ {{ getFeeDetails('apostille') }}</span>
          </div>
        </div>
      </div>
    </div>
    <div class="bg-white mb-4">
      <div class="row">
        <div class="col-11 col-sm-3">
          <div class="bg-secondary h-100 d-flex align-items-center justify-content-center">
            <img src="/images/pattern.png" alt="pattern" class="img-absolute o-contain">
            <h2 class="text-white mb-0 text-center pl-3">Transcripts</h2>
          </div>
        </div>
        <div class="col-sm-9 d-sm-flex">
          <div class="d-flex justify-content-between align-items-center">
            <p class="max-width__275">For an initial transcript for a student</p>
            <span class="text-secondary lato">$ {{ getFeeDetails('transcript') }}</span>
          </div>
          <div class="d-flex justify-content-between align-items-center">
            <p class="max-width__275">For a subsequest transcript if an initial one has been issued</p>
            <span class="text-secondary lato">$ {{ getFeeDetails('transcript_edit') }}</span>
          </div>
        </div>
      </div>
    </div>
    <div class="bg-white">
      <div class="row">
        <div class="col-11 col-sm-3">
          <div class="bg-secondary h-100 d-flex align-items-center justify-content-center">
            <img src="/images/pattern.png" alt="pattern" class="img-absolute o-contain">
            <h2 class="text-white mb-0 text-center pl-3">Postage<span class="d-block"></span></h2>
          </div>
        </div>
        <div class="col-sm-9 d-sm-flex">
          <div class="d-flex justify-content-between align-items-center">
            <p class="max-width__275">First class postage is free. Express Mail postge is added to documents that have been Notarized or sent for Apostilles. Other expedited postage fees are listed. We are not responsilble for lost items.</p>
          </div>
          <div class="text-center">
            <!-- <p class="max-width__275">Express Mail is recommended for ALL documents mailed outside the U.S. We are not responsible for lost items.</p> -->
            <h3 style="text-transform: uppercase;">International :</h3>
            <table width="100%">
              <tr>
                <th>Express Mail Tier 1 (for most countries)</th>
                <td class="text-secondary text-right lato">$ {{ getFeeDetails('express_international') }}</td>
              </tr>
              <tr>
                <th>Express Mail Tier 2 (for Hungary, Philippines, Romania, South Africa, Spain)</th>
                <td class="text-secondary text-right lato">$ {{ getFeeDetails('global_guaranteed_international') }}</td>
              </tr>
              <tr>
                <th>Express Mail Tier 3 (for Argentina and Brazil)</th>
                <td class="text-secondary text-right lato">$ {{ getFeeDetails('priority_international') }}</td>
              </tr>
            </table>
            <h3 style="text-transform: uppercase;">USA :</h3>
            <table width="100%">
              <tr>
                <th>Priority</th>
                <td class="text-secondary text-right lato">$ {{ getFeeDetails('priority_usa') }}</td>
              </tr>
              <tr>
                <th>Express</th>
                <td class="text-secondary text-right lato">$ {{ getFeeDetails('express_usa') }}</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<!-- * =============== /Main =============== * -->
@endsection