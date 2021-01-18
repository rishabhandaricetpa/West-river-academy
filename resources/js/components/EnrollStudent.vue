<template>
 <div class="form-wrap border bg-light py-5 px-25">
    <h2>Enroll Student 1</h2>
  <form method="POST" @submit.prevent="addStudent()">
    <div class="form-group d-flex mb-2">
      <label for="">First/Given Name <sup>*</sup></label>
      <div>
        <input
          type="text"
          class="form-control"
          id="first_name"
          name="first_name"
          required
          aria-describedby="emailHelp"
          v-model="form.first_name"
        />
      </div>
    </div>
    <div class="form-group d-flex mb-2">
      <label for="">Middle Name </label>
      <div>
        <input
          type="text"
          class="form-control"
          id="middle_name"
          name="middle_name"
          aria-describedby="emailHelp"
          v-model="form.middle_name"
        />
      </div>
    </div>
    <div class="form-group d-flex mb-2">
      <label for="">Last/Family Name <sup>*</sup></label>
      <div>
        <input
          type="text"
          class="form-control"
          id="last_name"
          name="last_name"
          required
          aria-describedby="emailHelp"
          v-model="form.last_name"
        />
      </div>
    </div>
    <div class="form-group d-flex mb-2">
      <label for="">Date of Birth</label>
      <p>
        <Datepicker id="dob" name="dob" v-model="form.dob" required>
        </Datepicker>
      </p>
      <i class="fas fa-calendar-alt" aria-hidden="true"></i>
    </div>
    <div class="form-group d-flex mb-2">
      <label for="">Email Address</label>
      <div>
        <input
          type="text"
          class="form-control"
          name="email"
          id="email"
          required
          aria-describedby="emailHelp"
          v-model="form.email"
        />
      </div>
    </div>
    <div class="form-group d-flex mb-2">
      <label for="">Cell Phone</label>
      <div>
        <input
          type="text"
          class="form-control"
          id="cell_phone"
          name="cell_phone"
          aria-describedby="emailHelp"
          v-model="form.cell_phone"
        />
      </div>
    </div>
    <div class="form-group d-flex mb-2">
      <label for="">Student ID </label>
      <div>
        <input
          type="text"
          class="form-control"
          id="student_id"
          name="student_id"
          required
          aria-describedby="emailHelp"
          v-model="form.studentID"
        />
      </div>
    </div>
    <div
      class="seperator"
      v-for="(enrollPeriod, index) in form.enrollPeriods"
      :key="enrollPeriod.id"
    >
      <h3>Enrollment Period {{ index + 1 }}</h3>
      <div class="form-group d-flex mb-2 mt-2r">
        <label for="">Select your START date of enrollment</label>
        <div class="row mx-0">
          <div class="form-row col-sm-3 px-0">
            <div class="form-group col-md-5">
              <p>
                <Datepicker
                  name="startdate"
                  v-model="enrollPeriod.selectedStartDate"
                  required
                  placeholder="Select Start Date"
                  :value="enrollPeriod.selectedStartDate"
                  @input="updateEndDate(index)"
                >
                </Datepicker>
              </p>
            </div>
          </div>
          <div class="info-detail col-sm-9 lato-italic">
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

      <div class="form-group d-flex mb-2 mt-2r">
        <label for="">Select your END date of enrollment</label>
        <div class="row mx-0">
          <div class="form-row col-sm-3 px-0">
            <div class="form-group col-md-5">
              <p>
                <Datepicker
                  name="enddate"
                  v-model="enrollPeriod.selectedEndDate"
                  placeholder="Select End Date"
                  required
                  :disabled-dates="enrollPeriod.endDisabledDates"
                >
                </Datepicker>
              </p>
              <i class="fas fa-calendar-alt" aria-hidden="true"></i>
            </div>
          </div>
          <div class="info-detail col-sm-9 lato-italic">
            <p>
              Choose before July 31 (the last day of your enrollment) or another
              date before July 31. This date will appear on your confirmation of
              enrollment letter. Your enrollment will officially end on July 31.
            </p>
          </div>
        </div>
      </div>
      <div class="form-group mt-2r d-flex links-list mb-5">
        <!-- Button trigger modal -->
        <a href="#chooseDates" data-toggle="modal">help me choose my dates</a>
        <a href="#skipYear" data-toggle="modal" class="ml-4"
          >what if i need to skip a year?</a
        >
      </div>
      <div class="form-group d-flex mb-2 lato-italic info-detail">
        <label for=""
          >Select grade level(s) for your enrollment period
          <p>(You may select more than one for multiple years)</p></label
        >
        <div class="row pl-5">
          <div v-for="(grade, index) in grades" :key="index" class="col-sm-3">
            <div v-for="(val, i) in grade" :key="i" class="form-check" :data-toggle="[val > 9 ? 'modal' : '']"  :data-target="[val > 9 ? '#chooseGrade' : '']">
              <input
                class="form-check-input"
                type="radio"
                :value= "val"
                v-model="enrollPeriod.grade"
              />
              <label class="form-check-label" for=""> {{ val }} </label>
            </div>
          </div>
        </div>
      </div>
       </div>
      <div class="form-group d-flex mt-2r">
        <label for="">Is this student immunized?</label>
        <div class="col-sm-6">
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
      <div class="form-group d-flex">
        <label for="">tell us more about your situation </label>
        <textarea
          class="form-control"
          id="exampleFormControlTextarea1"
          name="student_situation"
          rows="3"
          v-model="form.student_situation"
          required
        ></textarea>
      </div>
    <div class="form-wrap py-2r px-25 mt-2r">
      <a
        type="button"
        class="btn btn-primary addenrollment"
        id="addEnroll"
        value="addEnroll"
        v-if="canAddMorePeriod"
        @click="addNewEnrollPeriod"
        >Add Another Enrollment Period</a
      >
      <button type="submit" :disabled="disableSubmit" class="btn btn-primary">Continue</button>
    </div>
  </form>
  </div>
</template>

<script>
import axios from "axios";
import Datepicker from "vuejs-datepicker";
import moment from 'moment';

export default {
  name: "EnrollStudent",
  components: {
    Datepicker,
  },
  data() {
    return {
      grades:[['Upgraded', 'Preschool Age 3', 'Preschool Age 4', 'Kindergarten', '1', '2', '3', '4'],['5', '6', '7', '8', '9', '10', '11', '12']],
        form: {
          first_name: "",
          middle_name: "",
          last_name: "",
          dob: "",
          email: "",
          cell_phone: "",
          immunized_status: "",
          student_situation: "",
          studentID: "",
          enrollPeriods: [
            {
              selectedStartDate: new Date(this.semesters.start_date),
              selectedEndDate: "",
              grade: "",
              endDisabledDates: {
                from: this.calcEndDate(this.semesters.start_date),
              },
            },
          ],
        },
      students: [],
      disableSubmit:false
    };
  },
  props: {
    semesters: {
      required: true,
    },
  },
  methods: {
    calcEndDate(date){
      const oldDate = new Date(date);
      const year = oldDate.getFullYear();

      return new Date(year + 1, 0, 1); // returns 31 dec for same year
    },
    updateEndDate(index) {
      this.form.enrollPeriods[index].endDisabledDates.from = this.calcEndDate(this.form.enrollPeriods[index].selectedStartDate);
      this.form.enrollPeriods[index].selectedEndDate = ''; // reset the end date value
    },
    addNewEnrollPeriod() {
      this.form.enrollPeriods.push({
        selectedStartDate: new Date(this.semesters.start_date),
        selectedEndDate: "",
        grade: "",
        endDisabledDates: {
          from: this.calcEndDate(this.semesters.start_date),
        },
      });
    },
    addStudent() {
      this.disableSubmit = true;
      axios
        .post(route("enroll.student"), this.form)
        .then(
          (response) => {
            const resp = response.data;
            resp.status == 'success' ? window.location = "/reviewstudents" : alert(resp.message);
            this.disableSubmit = false;
          }
        )
        .catch((error) => this.disableSubmit = false);
    },
  },
  computed: {
    canAddMorePeriod() {
      return this.form.enrollPeriods.length < 4;
    },
  },
};
</script>

