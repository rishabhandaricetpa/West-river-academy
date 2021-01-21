<title> @yield('pageTitle', 'Register') | {{config('app.name')}}</title>
<!-- <sup>*</sup> =============== Header =============== <sup>*</sup> -->
@include('layouts.partials.header')
<!-- <sup>*</sup> =============== /Header =============== <sup>*</sup> -->

<!-- <sup>*</sup> =============== Main =============== <sup>*</sup> -->
<main class="position-relative container form-content mt-4">
  <div class="form-wrap border bg-light mb-4">
    <h2 class="text-capitalize">Create Your Account</h2>
    <p>Enter the information below and click “Submit.” An email with a link to activate your account will be sent to the email address you provide. You will then be able to sign in, enroll and purchase other services.</p>
    <div class="register-info">Already have an account? <a href="{{route('login')}}">Click this link to sign in.</a></div>
  </div>

  <div class="form-wrap border bg-light py-5 px-25">
    <form method="POST" action="{{ route('register') }}">
      @csrf
      <div>
        <h2>Enter Parent 1 Information</h2>

        <div class="form-group d-sm-flex mb-2">
          <label for="">First Name <sup>*</sup></label>
          <div>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
          </div>
        </div>
        <div class="form-group d-sm-flex mb-2">
          <label for="">Preferred Nickname</label>
          <div>
            <input type="text" class="form-control" id="" name="nick_name" value="{{ old('nick_name') }}" aria-describedby="emailHelp">
          </div>
        </div>
        <div class="form-group d-sm-flex mb-2">
          <label for="">Last Name</label>
          <div>
            <input type="text" class="form-control" id="" value="{{ old('last_name') }}" name="last_name" aria-describedby="emailHelp">
          </div>
        </div>
        <div class="form-group d-sm-flex mb-2">
          <label for="">Email Address <sup>*</sup></label>
          <div>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
            @error('email')
            <div class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </div>
            @enderror
          </div>

        </div>
        <div class="form-group d-sm-flex mb-2">
          <label for="">Cell Phone <sup>*</sup></label>
          <div>
            <input type="number" class="form-control" value="{{ old('cell_phone') }}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control" name="cell_phone" maxlength="10" pattern="[0-9]<sup>*</sup>" />
          </div>
        </div>
        <div class="form-group d-sm-flex mb-2">
          <label for="">Work/Home Phone</label>
          <div>
            <input type="number" class="form-control" value="{{ old('home_phone') }}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control" name="home_phone" maxlength="10" pattern="[0-9]<sup>*</sup>" />
          </div>
        </div>

      </div>


      <div class="text-center mt-2r">
        <a href="#parent-2info" aria-expanded="false" aria-controls="parent-2info" data-toggle="collapse" class="btn btn-primary">Add Parent 2</a>
      </div>
      <div class="collapse" id="parent-2info">
        <h2>Enter Parent 2 Information</h2>

        <div class="form-group d-sm-flex mb-2">
          <label for="">First Name</label>
          <div>
            <input type="text" class="form-control" name="p2_name" id="" value="{{ old('p2_name') }}" aria-describedby="emailHelp">
          </div>
        </div>
        <div class="form-group d-sm-flex mb-2">
          <label for="">Preferred Nickname</label>
          <div>
            <input type="text" class="form-control" name="p2_nickname" value="{{ old('p2_nickname') }}" id="" aria-describedby="emailHelp">
          </div>
        </div>
        <div class="form-group d-sm-flex mb-2">
          <label for="">Last Name</label>
          <div>
            <input type="text" class="form-control" name="p2_lastname" value="{{ old('p2_lastname') }}" id="" aria-describedby="emailHelp">
          </div>
        </div>
        <div class="form-group d-sm-flex mb-2">
          <label for="">Email Address</label>
          <div>
            <input type="text" class="form-control" name="p2_email" value="{{ old('p2_email') }}" id="" aria-describedby="emailHelp">
          </div>
        </div>
        <div class="form-group d-sm-flex mb-2">
          <label for="">Cell Phone</label>
          <div>
            <input type="number" class="form-control" value="{{ old('p2_cellphone') }}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control" name="p2_cellphone" maxlength="10" pattern="[0-9]<sup>*</sup>" />
          </div>
        </div>
        <div class="form-group d-sm-flex mb-2">
          <label for="">Work/Home Phone</label>
          <div>
            <input type="number" class="form-control" value="{{ old('p2_homephone') }}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control" name="p2_homephone" maxlength="10" pattern="[0-9]<sup>*</sup>" />
          </div>
        </div>

      </div>
      <div class="mt-2r">
        <h2>Mailing Address</h2>

        <div class="form-group d-sm-flex mb-2">
          <label for="">Street Address <sup>*</sup></label>
          <div>
            <input type="text" class="form-control" name="street_address" value="{{ old('street_address') }}" id="" required aria-describedby="emailHelp">
          </div>
        </div>
        <div class="form-group d-sm-flex mb-2">
          <label for="">City <sup>*</sup></label>
          <div>
            <input type="text" class="form-control" name="city" value="{{ old('city') }}" id="" required aria-describedby="emailHelp">
          </div>
        </div>
        <div class="form-group d-sm-flex mb-2">
          <label for="">State <sup>*</sup></label>
          <div>
            <input type="text" class="form-control" value="{{ old('state') }}" name="state" id="" required aria-describedby="emailHelp">
          </div>
        </div>
        <div class="form-group d-sm-flex mb-2">
          <label for="">Zip Code <sup>*</sup></label>
          <div>
            <input type="number" class="form-control" value="{{ old('zip_code') }}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control" name="zip_code" maxlength="6" pattern="[0-9]<sup>*</sup>" />
          </div>
        </div>
        <div class="form-group d-sm-flex mb-2">
          <label for="">Country <sup>*</sup></label>
          <div class="col-sm-4 px-0">
            <select class="form-control" name="country" id="country" id="exampleFormControlSelect1" required>
              <option value="">Select Country</option>
              @foreach($country_list ?? '' as $country)
              <option value="{{$country->country}}">
                {{$country->country}}</option>
              @endForeach
            </select>
          </div>
        </div>

      </div>
      <div class="py-5 seperator">
        <label class="h3 w-100">Who referred you to WRA, or how did you learn about us?</label>
        <input type="text" class="form-control" name="refrence" id="" aria-describedby="emailHelp">
      </div>
      <div class="mt-2r">
        <h2>Create your Password using ONLY letters and numbers</h2>

        <div class="form-group d-sm-flex mb-2">
          <label for="exampleInputEmail1">Password <sup>*</sup></label>
          <div>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
            @error('password')
            <div class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </div>
            @enderror
          </div>
        </div>
        <div class="form-group d-sm-flex mb-2">
          <label for="exampleInputPassword1">Confirm Password <sup>*</sup></label>
          <div>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            <div class="info-detail mt-3">
              <p>After activating your account, you will log in.</p>
              <p>Enter the email address of Parent 1 and your password.</p>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>


</main>

<!-- <sup>*</sup> =============== /Main =============== <sup>*</sup> -->

@include('layouts.partials.footer')


