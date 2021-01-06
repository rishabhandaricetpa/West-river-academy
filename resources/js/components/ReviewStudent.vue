<template>
  <form method="POST" action="" class="seperator pb-2">
    <div class="form-group d-sm-flex mb-2">
      <label for="">Student Name</label>
      <div>
        <p>
          {{
            this.form.first_name +
            " " +
            this.form.middle_name +
            " " +
            this.form.last_name
          }}
        </p>
      </div>
    </div>
    <div class="form-group d-sm-flex mb-2">
      <label for="">Date of Birth</label>
      <div>
        <p>{{ this.form.dob }}</p>
      </div>
    </div>
    <div class="form-group d-sm-flex mb-2">
      <label for="">Email Address</label>
      <div>
        <p>{{ this.form.email }}</p>
      </div>
    </div>
    <div class="form-group d-sm-flex mb-2">
      <label for="">Phone</label>
      <div>
        <p>{{ this.form.cell_phone }}</p>
      </div>
    </div>
    <div class="form-group d-sm-flex mb-2">
      <label for="">Student ID</label>
      <div>
        <p>{{ this.form.student_Id }}</p>
      </div>
    </div>
    <div v-for="(period, index) in form.periods" :key="period.id">
      <div class="form-group d-sm-flex mb-2">
        <label for="">Enrollment Period(s) {{ index }}</label>
        <div>
          <p>{{ period.selectedStartDate }} To {{ period.selectedEndDate }}</p>
        </div>
      </div>

      <div class="form-group d-sm-flex mb-2">
        <label for="">Grade Level(s)</label>
        <div>
          <p>{{ period.grade }}</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <h3 class="py-3">Fees</h3>
      <table class="px-0 w-100">
        <tbody>
          <tr>
            <td>Annual * 2</td>
            <td class="text-right">$750</td>
          </tr>
          <tr>
            <td>Second Semester Only * 1</td>
            <td class="text-right">$200</td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td>Annual * 2</td>
            <td class="text-right">$750</td>
          </tr>
        </tfoot>
      </table>
      <div class="text-right mt-4">
        <a
          type="button"
          class="btn btn-primary addenrollment"
          id="addEnroll"
          value="addEnroll"
          @click="editStudent()"
          >Edit</a
        >
        <a href="#" class="btn btn-primary ml-3">Add to Cart</a>
      </div>
    </div>
  </form>
</template>

<script>
import axios from "axios";
export default {
  name: "ReviewStudent",
  props: ["students", "periods"],
  data() {
    return {
      form: {
        first_name: this.students.first_name,
        middle_name: this.students.middle_name,
        last_name: this.students.last_name,
        dob: this.students.d_o_b,
        email: this.students.email,
        cell_phone: this.students.cell_phone,
        student_Id: this.students.student_Id,
        periods: [],
      },
    };
  },
  created() {
    this.periods.forEach((item) => {
      this.form.periods.push({
        id: item.id,
        selectedStartDate: item.start_date_of_enrollment,
        selectedEndDate: item.end_date_of_enrollment,
        grade: item.grade_level,
      });
    });
  },

  mounted() {},
  methods: {
    editStudent() {
      axios
        .get(route("edit.student", this.students), this.form)
        .then(
          (response) => (window.location = "/reviewstudent/" + response.data.id)
        )
        .catch((error) => console.log(error));
    },
  },
};
</script>

<style>
</style>
