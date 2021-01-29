<template>
 <div class="form-wrap border bg-light py-5 px-25 position-relative">
    <h2>Enroll Student 1</h2> 
    <p class="required-option">* Fields are required</p>
  <form method="POST" @submit.prevent="addStudent()">
    <div class="form-group d-sm-flex mb-2">
      <label for="">First/Given Name <sup>*</sup></label>
      <div>
        <input
          type="text"
          class="form-control"
          id="first_name"
          name="first_name"
          aria-describedby="emailHelp"
          v-model="form.first_name"
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
          aria-describedby="emailHelp"
          v-model="form.middle_name"
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
          required
          aria-describedby="emailHelp"
          v-model="form.last_name"
        />
      </div>
    </div>
    <div class="form-group d-flex mb-1 lato-italic info-detail">
        <label for="">Gender <sup>*</sup></label>
        <div class="row pl-5">
          <div class="col-sm-3">
            <div class="form-check">
              <input 
              class="form-check-input" 
              type="radio" 
              name="gender" 
              value="Male"
              v-model="form.gender"
              >
            <label class="form-check-label">
              Male
            </label>
            </div>
            </div>
            <div class="col-sm-3">
            <div class="form-check">
            <input 
            class="form-check-input" 
            type="radio" 
            name="gender" 
            value="Female"
            id="gender" 
            v-model="form.gender"
            >
            <label class="form-check-label">
              Female
            </label>
            </div>
            </div>     
      </div>
      </div>
    <div class="form-group d-sm-flex mb-2 position-relative">
      <label for="">Date of Birth<sup>*</sup></label>
      <p>
        <Datepicker id="dob" name="dob" v-model="form.dob" required>
        </Datepicker>
      </p>
      <i class="fas fa-calendar-alt" @click="clickDatepicker" aria-hidden="true"></i>
    </div>
    <div class="form-group d-sm-flex mb-2">
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
    <div class="form-group d-sm-flex mb-2">
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
    <div class="form-group d-sm-flex mb-2 mt-2r">
        <label for="">National ID</label>
        <div class="row">
          <div class="col-md-4 col-lg-2">
            <div class="form-group w-100 datepicker-full">
             <input
                type="text"
                class="form-control"
                id="student_id"
                name="student_id"
                aria-describedby="emailHelp"
                v-model="form.studentID"
               />
            </div>
          </div>
          <div class="info-detail col-md-8 col-lg-10 lato-italic">
            <p>
              Please enter your National ID if you wish to have it on your documents.
            </p>
          </div>
        </div>
      </div>
    <div
      class="seperator mt-4"
      v-for="(enrollPeriod, index) in form.enrollPeriods"
      :key="enrollPeriod.id"
    >
      <h3>Enrollment Period {{ index + 1 }}</h3>
      <div class="form-group d-sm-flex mb-2 mt-2r">
        <label for="">Select your START date of enrollment</label>
        <div class="row">
          <div class="col-md-4 col-lg-2">
            <div class="form-group w-100 datepicker-full">
              <p>
                <Datepicker
                  name="startdate"
                  v-model="enrollPeriod.selectedStartDate"
                  required
                  placeholder="Select Start Date"
                  :value="enrollPeriod.selectedStartDate"
                  @input="updateEndDate(index)"
                  :open-date="enrollPeriod.selectedStartDate"
                >
                </Datepicker>
              </p>
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
        <div class="row">
          <div class="col-md-4 col-lg-2">
            <div class="form-group w-100 datepicker-full">
              <p>
                <Datepicker
                  name="enddate"
                  v-model="enrollPeriod.selectedEndDate"
                  placeholder="Select End Date"
                  required
                  :disabled-dates="enrollPeriod.endDisabledDates"
                  :open-date="enrollPeriod.selectedStartDate" 
                >
                </Datepicker>
              </p>
             
            </div>
          </div>
          <div class="info-detail col-md-8 col-lg-6 lato-italic">
            <p>
              Choose before July 31 (the last day of your enrollment) or another
              date before July 31. This date will appear on your confirmation of
              enrollment letter. Your enrollment will officially end on July 31.
            </p>
          </div>
          <div class="col-lg-4 links-list pl-0">
           <a href="#chooseDates" data-toggle="modal">help me choose a date</a>
          </div>
        </div>
      </div>
      <div class="form-group mt-2r d-sm-flex links-list mb-5">
        <!-- Button trigger modal -->
       
        <a href="#skipYear" data-toggle="modal" class="ml-sm-4"
          >what if i need to skip a year?</a
        >
      </div>
      <div class="form-group d-sm-flex mb-2 lato-italic info-detail">
        <label for=""
          >Select grade level(s) for your enrollment period
          <p>(You may select more than one for multiple years)</p></label
        >
        <div class="row pl-sm-5">
          <div v-for="(grade, index) in grades" :key="index" class="col-6 col-sm-3">
            <div v-for="(val, i) in grade" :key="i" class="form-check" :data-toggle="[val > 9 ? 'modal' : '']"  :data-target="[val > 9 ? '#chooseGrade' : '']">
              <input
                class="form-check-input"
                type="radio"
                :value= "val"
                v-model="enrollPeriod.grade"
                required
              />
              <label class="form-check-label pl-1 pl-sm-0" for=""> {{ val }} </label>
            </div>
          </div>
        </div>
      </div>
       </div>
      <div class="form-group d-sm-flex mt-2r">
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
        <label for="">Tell us more about your situation </label>
        <div>
        <textarea
          class="form-control"
          id="exampleFormControlTextarea1"
          name="student_situation"
          rows="3"
          v-model="form.student_situation"
        ></textarea>
        </div>
      </div>
      <p v-if="errors.length" >
       <ul>
       <li style="color:red" v-for="error in errors" :key="error.id">  {{error}} </li>
      </ul>
    </p> 
    <div class="form-wrap py-2r px-sm-25 mt-2r">
      <a
        type="button"
        class="btn btn-primary addenrollment mb-4 mb-sm-0"
        id="addEnroll"
        value="addEnroll"
        v-if="canAddMorePeriod"
        @click="addNewEnrollPeriod"
        >Add Another Enrollment Period</a
      >
      <button type="submit"  class="btn btn-primary mb-4 mb-sm-0">Continue</button>
    </div>
  </form>
  </div>
</template>

<script>
import axios from "axios";
import Datepicker from "vuejs-datepicker";


export default {
  name: "EnrollStudent",
  components: {
    Datepicker,
  },
  data() {
    return {
      grades: [
        [
          "Ungraded",
          "Preschool Age 3",
          "Preschool Age 4",
          "Kindergarten",
          "1",
          "2",
          "3",
          "4",
        ],
        ["5", "6", "7", "8", "9", "10", "11", "12"],
      ],
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
            selectedStartDate: new Date(this.semesters),
            selectedEndDate: "",
            grade: "",
            endDisabledDates: {
              from: this.calcEndDate(this.semesters),
              to: this.calcToData(this.semesters),
            },
          },
        ],
      },
      students: [],
      errors: [],
    };
  },
  props: {
    semesters: {
      required: true,
    },
  },
  methods: {
    calcEndDate(date) {
      const oldDate = new Date(date);
      const year = oldDate.getFullYear();
      return new Date(year + 1, 0, 1); // returns 31 dec for same year
    },
    calcToData(date) {
      const oldDate = new Date(date);
      const oDate = oldDate.getDate();
      const year = oldDate.getFullYear();
      const month = oldDate.getMonth();

      return new Date(year, month, oDate + 1);
    },
    validEmail: function (email) {
      var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    },
    updateEndDate(index) {
      this.form.enrollPeriods[index].endDisabledDates.from = this.calcEndDate(
        this.form.enrollPeriods[index].selectedStartDate
      );
      this.form.enrollPeriods[index].endDisabledDates.to = this.calcToData(
        this.form.enrollPeriods[index].selectedStartDate
      );
      this.form.enrollPeriods[index].selectedEndDate = ""; // reset the end date value
    },
    addNewEnrollPeriod() {
      this.form.enrollPeriods.push({
        selectedStartDate: new Date(this.semesters),
        selectedEndDate: "",
        grade: "",
        endDisabledDates: {
          from: this.calcEndDate(this.semesters),
          to: this.calcToData(this.semesters),
        },
      });
    },
    addStudent() {
      this.errors = [];
      if (!this.form.dob) {
        this.errors.push("Date of birth is required");
        alert("Please fill the required form");
      }
      if (!this.validEmail(this.form.email)) {
        this.errors.push("Valid email required.");
      }
      if (!this.vallidateGrades()) {
        this.errors.push("Grade is required Field! Please select a Grade and then continue");
      }
      if (!this.vallidateEndDate()) {
        this.errors.push("End date of Enrollment is required!Please select a End Date and then continue");
      }
      if (this.form.dob && this.validEmail(this.form.email) && this.vallidateGrades() && this.vallidateEndDate()) {
        axios.post(route("enroll.student"), this.form).then((response) => {
          const resp = response.data;
          resp.status == "success"
            ? (window.location = "/reviewstudents")
            : alert(resp.message);
        });
      }
    },
    vallidateGrades() {
      for (let i = 0; i < this.form.enrollPeriods.length; i++) {
        const enrollPeriod = this.form.enrollPeriods[i];
        if (!enrollPeriod.grade) {
          return false;
          break;
        }
      }
      return true;
    },
     vallidateEndDate() {
      for (let i = 0; i < this.form.enrollPeriods.length; i++) {
        const enrollPeriod = this.form.enrollPeriods[i];
        if (!enrollPeriod.selectedEndDate) {
          return false;
          break;
        }
      }
      return true;
    },
    clickDatepicker() {
      document.getElementById("dob").click();
    },
    clickDatepicker(){
      document.getElementById('dob').click();
      document.getElementById('dob').focus();
    }
 },
  computed: {
    canAddMorePeriod() {
      return this.form.enrollPeriods.length < 4;
    },
  },
};
</script>

