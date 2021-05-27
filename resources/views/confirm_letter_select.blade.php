<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <div class="content-wrapper">

    <main class="position-relative container form-content mt-4">

      <div class="form-wrap border bg-light py-5 px-25 mb-4">
        <h2 class="mb-5">What would you like to do?</h2>
        <div class="row confirmation-letter__options border-bottom">
          <h2 class="mb-3">Select your Confirmation Letter Options</h2>
          <table>
            <tbody>
              <tr>
                <td>Student</td>
                <td>White Rice</td>
              </tr>
              <tr>
                <td>Date of Birth</td>
                <td>Jan 1, 2004</td>
              </tr>
              <tr>
                <td>Enrollment Period</td>
                <td>Aug 1, 2019-July 31,2020</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="row confirmation-letter__options">
          <h3 class="mb-3">You may choose to include or exclude any of the following fields. Check the ones you want on
            the Confirmation Letter.</h3>
          <label class="container-checkbox">Birth City
            <input type="checkbox" checked="checked">
            <span class="checkmark"></span>
          </label>
          <label class="container">Mother's Maiden Name
            <input type="checkbox">
            <span class="checkmark"></span>
          </label>
          <label class="container">Student ID
            <input type="checkbox">
            <span class="checkmark"></span>
          </label>
          <label class="container">Grade
            <input type="checkbox">
            <span class="checkmark"></span>
          </label>
        </div>
        <p>If teh checkbox is disabled or field data is not showing up for the field you want to include, click
          <a href="#">here</a> to add it to the student record.
        </p>
        <div class="mt-2r">
          <a type="button" id="addEnroll" value="addEnroll" class="btn btn-primary addenrollment mb-4 mb-sm-0">Cancel</a>
          <button type="submit" class="btn btn-primary mb-4 mb-sm-0 ml-2">Continue</button>
        </div>
    </main>
  </div>
</body>

</html>
