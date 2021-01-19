<template>
  <form method="POST" @submit.prevent="EditStudent()">
    <div class="form-group d-sm-flex mb-2">
      <label for="">First/Given Name <sup>*</sup></label>
      <div>
        <input
          type="text"
          class="form-control"
          id="first_name"
          value=""
          name="first_name"
          v-model="form.first_name"
          required
          aria-describedby="emailHelp"
        />
      </div>
    </div>
    <div class="form-group d-sm-flex mb-2">
      <label for="">Middle Name </label>
      <div>
        <input
          type="text"
          class="form-control"
          id="middle_name"
          name="middle_name"
          v-model="form.middle_name"
          aria-describedby="emailHelp"
        />
      </div>
    </div>
    <div class="form-group d-sm-flex mb-2">
      <label for="">Last/Family Name <sup>*</sup></label>
      <div>
        <input
          type="text"
          class="form-control"
          id="last_name"
          name="last_name"
          v-model="form.last_name"
          required
          aria-describedby="emailHelp"
        />
      </div>
    </div>
    <div class="form-group d-sm-flex mb-2">
      <label for="">Date of Birth</label>
      <p class="position-relative mb-0">
        <Datepicker required id="dob" name="dob" v-model="form.dob">
        </Datepicker>
      </p>
        <i class="fas fa-calendar-alt" aria-hidden="true"></i>
    </div>
    <div class="form-group d-sm-flex mb-2">
      <label for="">Email Address</label>
      <div>
        <input
          type="text"
          class="form-control"
          name="email"
          id="email"
          v-model="form.email"
          required
          aria-describedby="emailHelp"
        />
      </div>
    </div>
    <div class="form-group d-sm-flex mb-2">
      <label for="">Cell Phone</label>
      <div>
        <input
          type="number"
          class="form-control"
          id="cell_phone"
          name="cell_phone"
          v-model="form.cell_phone"
          aria-describedby="emailHelp"
        />
      </div>
    </div>
    <div class="form-group d-sm-flex mb-2">
      <label for="">Student ID</label>
      <div>
        <input
          type="text"
          class="form-control"
          id="student_id"
          name="student_id"
          v-model="form.student_Id"
          required
          aria-describedby="emailHelp"
        />
      </div>
    </div>
    <div v-for="(period, index) in form.periods" :key="period.id">
      <div v-if="period.status === 'pending'" class="position-relative">
        <span class="remove" @click="removePeriod(index)"><i class="fas fa-times"></i></span>
        <div class="form-group d-sm-flex mb-2 mt-2r">
          <label for="">Select your START date of enrollment{{ index }}</label>
          <div class="row mx-0">
            <div class="form-row col-md-4 col-lg-2 px-0">
              <div class="form-group w-100">
                <Datepicker
                  id="startdate"
                  name="startdate"
                  v-model="period.selectedStartDate"
                  required
                  placeholder="Select Start Date"
                  @input="updateEndDate(index)"
                >
                </Datepicker>
              </div>
            </div>
            <div class="info-detail col-md-8 col-lg-10 lato-italic">
              <p>
                Choose August 1 (the first day of the Annual enrollment period),
                January 1 (the first day of the Second Semester), today's date or
                another date. This date will appear on your confirmation of
                enrollment letter. You will be considered enrolled for the full
                12-month period for Annual or 7-month period for Second Semester
                Only.
              </p>
            </div>
          </div>
        </div>

        <div class="form-group d-sm-flex mb-2 mt-2r">
          <label for="">Select your END date of enrollment</label>
          <div class="row mx-0">
            <div class="form-row col-md-4 col-lg-2 px-0">
              <div class="form-group w-100">
                <Datepicker
                  id="startdate"
                  name="startdate"
                  v-model="period.selectedEndDate"
                  required
                  placeholder="Select Start Date"
                  :disabled-dates="period.endDisabledDates"
                >
                </Datepicker>
              </div>
            </div>
            <div class="info-detail col-md-8 col-lg-10 lato-italic">
              <p>
                Choose before July 31 (the last day of your enrollment) or another
                date before July 31. This date will appear on your confirmation of
                enrollment letter. Your enrollment will officially end on July 31.
              </p>
            </div>
          </div>
        </div>
        <div class="form-group mt-2r d-sm-flex links-list mb-5">
          <!-- Button trigger modal -->
          <a href="#chooseDates" data-toggle="modal">help me choose my dates</a>
          <a href="#skipYear" data-toggle="modal" class="ml-sm-4"
            >what if i need to skip a year?</a
          >
        </div>

        <div class="form-group d-sm-flex mb-2r lato-italic info-detail ">
          <label for=""
            >Select grade level(s) for your enrollment period
            <p>(You may select more than one for multiple years)</p></label
          >
          <div class="row pl-5">
            <div v-for="(grade, index) in grades" :key="index" class="col-sm-3">
              <div v-for="(val, i) in grade" :key="i" class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  :value= "val"
                  v-model="period.grade"
                />
                <label class="form-check-label" for=""> {{ val }} </label>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div v-else>
          <div>
            <p><span> Start Date: </span> {{ period.selectedStartDate }} </p>
          </div>
          <div>
            <p><span> End Date: </span> {{ period.selectedEndDate }} </p>
          </div>
          <div>
            <p><span> Grade: </span> {{ period.grade }} </p>
          </div>
      </div>
    </div>
    <div class="form-group d-sm-flex">
      <label for="">Is this student immunized?</label>
      <div class="col-sm-6 px-0">
        <select
          class="form-control"
          name="immunized_status"
          v-model="form.immunized_status"
        >
          <option>Yes, records will come with school records.</option>
          <option>Yes, I will provide records.</option>
          <option>Yes, I plan to get immunizations soon.</option>
          <option>No, for personal reasons.</option>
          <option>No, for medical reasons.</option>
          <option>No, for religious reasons.</option>
        </select>
      </div>
    </div>
    <div class="form-group d-sm-flex">
      <label for="">tell us more about your situation<sup>*</sup> </label>
      <div>
      <textarea
        class="form-control"
        id="exampleFormControlTextarea1"
        name="student_situation"
        value=""
        rows="3"
        v-model="form.student_situation"
        required
      ></textarea>
      </div>
    </div>

    <div class="form-wrap">
      <a
        type="button"
        class="btn btn-primary addenrollment mb-4 mb-sm-0"
        id="addEnroll"
        value="addEnroll"
        @click="addNewEnrollPeriod"
        v-if="canAddMorePeriod"
        >Add Another Enrollment Period</a
      >
      <button type="submit" class="btn btn-primary">Continue</button>
    </div>
  </form>
</template>

<script>
import Datepicker from "vuejs-datepicker";
import axios from "axios";
export default {
  name: "EditEnrollStudent",
  components: {
    Datepicker,
  },
  data() {
    return {
      grades:[['Upgraded', 'Preschool Age 3', 'Preschool Age 4', 'Kindergarten', '1', '2', '3', '4'],['5', '6', '7', '8', '9', '10', '11', '12']],
      form: {
        first_name: this.students.first_name,
        middle_name: this.students.middle_name,
        last_name: this.students.last_name,
        email: this.students.email,
        dob: this.students.d_o_b,
        cell_phone: this.students.cell_phone,
        student_Id: this.students.student_Id,
        student_situation: this.students.student_situation,
        immunized_status: this.students.immunized_status,
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
        status: item.status,
        endDisabledDates: {
          from: this.calcEndDate(item.start_date_of_enrollment),
        },
      });
    });
  },
  methods: {
    EditStudent() {
      axios
        .post(route("update.student", this.students), this.form)
        .then(
          (response) => {
            const resp = response.data;
            resp.status == 'success' ? window.location = "/reviewstudents"  : alert(resp.message);
          }
        )
        .catch((error) => console.log(error));
    },
    calcEndDate(date){
      const oldDate = new Date(date);
      const year = oldDate.getFullYear();

      return new Date(year + 1, 0, 1); // returns 31 dec for same year
    },
    updateEndDate(index) {
      this.form.periods[index].endDisabledDates.from = this.calcEndDate(this.form.periods[index].selectedStartDate);
      this.form.periods[index].selectedEndDate = ''; // reset the end date value
    },
    addNewEnrollPeriod() {
      this.form.periods.push({
        id: null,
        selectedStartDate: new Date(this.semesters.start_date),
        selectedEndDate: "",
        grade: "",
        endDisabledDates: {
          from: this.calcEndDate(this.semesters.start_date),
        },
      });
    },
    removePeriod(index) {
      axios
        .post(route("delete.student", this.students), this.form)
        .then(
          (response) => {
            const resp = response.data;
            resp.status == 'success' ? this.form.periods.splice(index, 1) : alert(resp.message);
          }
        )
        .catch((error) => console.log(error));
    },
  },
  props: {
    students: {
      type: Object,
      required: true,
    },
    periods: {
      type: Array,
      required: true,
    },
    semesters: {
      required: true,
    },
  },
  computed: {
    canAddMorePeriod() {
      return this.form.periods.length < 4;
    },
  },
};
</script>


