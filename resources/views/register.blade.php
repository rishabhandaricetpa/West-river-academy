<!DOCTYPE html>
<html lang="en">

<body>
  <div id="app" class="app">
    <img src="/images/gradient-bg.jpg" class="img-absolute" alt="bg-img">
    @include('./layouts/partials/header');


    <!-- * =============== Main =============== * -->

  <main class="position-relative container form-content mt-4">
    <div class="form-wrap border bg-light mb-4">
      <h2 class="text-capitalize">Create Your Account</h2>
      <p>Enter the information below and click “Submit.” An email with a link to activate your account will be sent to the email address you provide. You will then be able to sign in, enroll and purchase other services.</p>
      <div class="register-info">Don't have an account yet? <a href="#">Click this link to create one.</a></div>
  </div>

  <div class="form-wrap border bg-light py-5 px-25">
      <div>
      <h2>Create your User ID</h2>
      <form class="seperator">
      <div class="form-group d-flex mb-1">
        <label for="">First name</label>
        <div>
        <input type="text" class="form-control" id="" aria-describedby="emailHelp">
      </div>
      </div>
      <div class="form-group d-flex mb-1">
        <label for="">Preferred Nickname</label>
        <div>
        <input type="text" class="form-control" id="" aria-describedby="emailHelp">
      </div>
      </div>
      <div class="form-group d-flex mb-1">
        <label for="">Last Name</label>
        <div>
        <input type="text" class="form-control" id="" aria-describedby="emailHelp">
      </div>
      </div>
      <div class="form-group d-flex mb-1">
        <label for="">Email Address</label>
        <div>
        <input type="text" class="form-control" id="" aria-describedby="emailHelp">
      </div>
      </div>
      <div class="form-group d-flex mb-1">
        <label for="">Cell Phone</label>
        <div>
        <input type="text" class="form-control" id="" aria-describedby="emailHelp">
      </div>
      </div>
      <div class="form-group d-flex mb-1">
        <label for="">Work/Home Phone</label>
        <div>
        <input type="text" class="form-control" id="" aria-describedby="emailHelp">
      </div>
      </div>
    </form>
</div>


    <div class="text-center mt-2r">
          <a href="#parent-2info" aria-expanded="false" aria-controls="parent-2info" data-toggle="collapse" class="btn btn-primary">Add Parent 2</a>
      </div>
      <div class="collapse" id="parent-2info">
      <h2>Enter Parent 2 Information</h2>
      <form class="seperator">
      <div class="form-group d-flex mb-1">
        <label for="">First name</label>
        <div>
        <input type="text" class="form-control" id="" aria-describedby="emailHelp">
      </div>
      </div>
      <div class="form-group d-flex mb-1">
        <label for="">Preferred Nickname</label>
        <div>
        <input type="text" class="form-control" id="" aria-describedby="emailHelp">
      </div>
      </div>
      <div class="form-group d-flex mb-1">
        <label for="">Last Name</label>
        <div>
        <input type="text" class="form-control" id="" aria-describedby="emailHelp">
      </div>
      </div>
      <div class="form-group d-flex mb-1">
        <label for="">Email Address</label>
        <div>
        <input type="text" class="form-control" id="" aria-describedby="emailHelp">
      </div>
      </div>
      <div class="form-group d-flex mb-1">
        <label for="">Cell Phone</label>
        <div>
        <input type="text" class="form-control" id="" aria-describedby="emailHelp">
      </div>
      </div>
      <div class="form-group d-flex mb-1">
        <label for="">Work/Home Phone</label>
        <div>
        <input type="text" class="form-control" id="" aria-describedby="emailHelp">
      </div>
      </div>
    </form>
</div>
      <div class="mt-2r" >
          <h2>Mailing Address</h2>
      <form class="seperator">
      <div class="form-group d-flex mb-1">
        <label for="">Street Address</label>
        <div>
        <input type="text" class="form-control" id="" aria-describedby="emailHelp">
      </div>
      </div>
      <div class="form-group d-flex mb-1">
        <label for="">city</label>
        <div>
        <input type="text" class="form-control" id="" aria-describedby="emailHelp">
      </div>
      </div>
      <div class="form-group d-flex mb-1">
        <label for="">state</label>
        <div>
        <input type="text" class="form-control" id="" aria-describedby="emailHelp">
      </div>
      </div>
      <div class="form-group d-flex mb-1">
        <label for="">Zip COde</label>
        <div>
        <input type="text" class="form-control" id="" aria-describedby="emailHelp">
      </div>
      </div>
      <div class="form-group d-flex mb-1">
        <label for="">country</label>
        <div class="col-4 px-0">
        <select class="form-control" id="exampleFormControlSelect1">
            <option>united states</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
    </select>
      </div>
      </div>
    </form>
    </div>
    <div class="py-5 seperator">
    <label class="h3 w-100">Who referred you to WRA, or how did you learn about us?</label>
    <input type="text" class="form-control" id="" aria-describedby="emailHelp">
    </div>
    <div class="mt-2r">
    <h2>Create your Password using ONLY letters and numbers</h2>
    <form>
      <div class="form-group d-flex mb-1">
        <label for="exampleInputEmail1">User ID</label>
        <div>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
      </div>
      </div>
      <div class="form-group d-flex mb-1">
        <label for="exampleInputPassword1">Password</label>
        <div>
        <input type="password" class="form-control" id="exampleInputPassword1">
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
</body>
</html>


