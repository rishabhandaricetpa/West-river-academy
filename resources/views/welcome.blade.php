<!DOCTYPE html>
<html lang="en">

<body>
  <div id="app" class="app">
    <img src="/images/gradient-bg.jpg" class="img-absolute" alt="bg-img">
    @include('./layouts/partials/header');

    <!-- * =============== Main =============== * -->

    <main class="position-relative container">
      <div class="form-wrap border bg-light form-content">
        <h2>Login to My Account</h2>
        <form>
          <div class="form-group d-flex mb-1">
            <label for="exampleInputEmail1">User ID</label>
            <div>
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
              <div class="alert alert-danger">Enter your user ID.</div>
            </div>
          </div>
          <div class="form-group d-flex mb-1">
            <label for="exampleInputPassword1">Password</label>
            <div>
              <input type="password" class="form-control" id="exampleInputPassword1">
              <div class="alert alert-danger">Enter your password.</div>
            </div>
          </div>
          <div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="#" class="ml-4">Forgot Password?</a>
          </div>
          <div class="register-info">Don't have an account yet? <a href="#">Click this link to create one.</a></div>
        </form>
      </div>
    </main>
  </body>
</html>