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
            <p>For the first student Annual</p>
            <span class="text-secondary">${{ getFeeDetails('first_student_annual') }}</span>
          </div>
          <div class="d-flex justify-content-between align-items-center">
            <p>For the first student Semester</p>
            <span class="text-secondary">${{ getFeeDetails('first_student_half') }}</span>
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
            <p>For the additional student in the family for same enrollment year</p>
            <span class="text-secondary">$ {{ getFeeDetails('additional_student_annual') }}</span>
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
            <p>For the first student</p>
            <span class="text-secondary">${{ getFeeDetails('graduation') }}</span>
          </div>
        </div>
      </div>
    </div>
    <div class="bg-white mb-4">
      <div class="row">
        <div class="col-11 col-sm-3">
          <div class="bg-secondary h-100 d-flex align-items-center justify-content-center">
            <img src="/images/pattern.png" alt="pattern" class="img-absolute o-contain">
            <h2 class="text-white mb-0 text-center pl-3">Apostille</h2>
          </div>
        </div>
        <div class="col-sm-9 d-sm-flex">
          <div class="d-flex justify-content-between align-items-center">
            <p>For the first student</p>
            <span class="text-secondary">${{ getFeeDetails('apostille') }}</span>
          </div>
        </div>
      </div>
    </div>
    <div class="bg-white mb-4">
      <div class="row">
        <div class="col-11 col-sm-3">
          <div class="bg-secondary h-100 d-flex align-items-center justify-content-center">
            <img src="/images/pattern.png" alt="pattern" class="img-absolute o-contain">
            <h2 class="text-white mb-0 text-center pl-3">Order a Transcript</h2>
          </div>
        </div>
        <div class="col-sm-9 d-sm-flex">
          <div class="d-flex justify-content-between align-items-center">
            <p>For an initial transcript for a student</p>
            <span class="text-secondary">${{ getFeeDetails('transcript') }}</span>
          </div>
          <div class="d-flex justify-content-between align-items-center">
            <p>For a subsequest transcript if an initial one has been issued</p>
            <span class="text-secondary">${{ getFeeDetails('transcript_edit') }}</span>
          </div>
        </div>
      </div>
    </div>
    <div class="bg-white">
      <div class="row">
        <div class="col-11 col-sm-3">
          <div class="bg-secondary h-100 d-flex align-items-center justify-content-center">
            <img src="/images/pattern.png" alt="pattern" class="img-absolute o-contain">
            <h2 class="text-white mb-0 text-center pl-3">Order Postage<span class="d-block">(for future or past years)</span></h2>
          </div>
        </div>
        <div class="col-sm-9 d-sm-flex">
          <div class="d-flex justify-content-between align-items-center">
            <p>First class is free.Expedited postage with tracking is available also</p>
            <span class="text-secondary">$0</span>
          </div>
          <div class="text-center">
            <p>Express Mail is recommended for ALL documents mailed outside the U.S. We are not responsible for lost items.</p>
            <h3 style="text-transform: uppercase;">International :</h3>
            <table width="100%">
              <tr>
                <th>Express</th>
                <td class="text-secondary text-right">${{ getFeeDetails('express_international') }}</td>
              </tr>
              <tr>
                <th>Global Guaranteed</th>
                <td class="text-secondary text-right">${{ getFeeDetails('global_guaranteed_international') }}</td>
              </tr>
              <tr>
                <th>Priority</th>
                <td class="text-secondary text-right">${{ getFeeDetails('priority_international') }}</td>
              </tr>
            </table>
            <h3 style="text-transform: uppercase;">usa :</h3>
            <table width="100%">
              <tr>
                <th>Priority</th>
                <td class="text-secondary text-right">${{ getFeeDetails('priority_usa') }}</td>
              </tr>
              <tr>
                <th>Express</th>
                <td class="text-secondary text-right">${{ getFeeDetails('express_usa') }}</td>
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