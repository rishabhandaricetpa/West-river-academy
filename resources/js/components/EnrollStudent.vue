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
    <div class="seperator" v-for="enrollPeriod in form.enrollPeriods" :key="enrollPeriod.id">
      <div class="form-group d-flex mb-2 mt-2r">
        <label for="">Select your START date of enrollment</label>
        <div class="row mx-0">
          <div class="form-row col-sm-3 px-0">
            <div class="form-group col-md-5">
              <p>
                <Datepicker
                  id="startdate"
                  name="startdate"
                  v-model="enrollPeriod.selectedStartDate"
                  required
                  placeholder="Select Start Date"
                  :value="enrollPeriod.selectedStartDate"
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
                  id="enddate"
                  name="enddate"
                  v-model="enrollPeriod.selectedEndDate"
                  placeholder="Select End Date"
                  required
                  :disabledDates="enrollPeriod.disabledDates"
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
          <div class="col-sm-3">
            <div class="form-check">
              <input
                class="form-check-input"
                type="radio"
                name="student_grade"
                value="Upgraded"
                v-model="enrollPeriod.grade"
              />
              <label class="form-check-label" for=""> Upgraded </label>
            </div>
            <div class="form-check">
              <input
                class="form-check-input"
                type="radio"
                name="student_grade"
                value="Preschool Age 3"
                v-model="enrollPeriod.grade"
                :required="true"
              />
              <label class="form-check-label" for=""> Preschool Age 3 </label>
            </div>
            <div class="form-check">
              <input
                class="form-check-input"
                type="radio"
                name="student_grade"
                value="Preschool Age 4"
                v-model="enrollPeriod.grade"
                :required="true"
              />
              <label class="form-check-label" for=""> Preschool Age 4 </label>
            </div>
            <div class="form-check">
              <input
                class="form-check-input"
                type="radio"
                name="student_grade"
                value="Kindergarten"
                v-model="enrollPeriod.grade"
              />
              <label class="form-check-label" for=""> Kindergarten </label>
            </div>
            <div class="form-check">
              <input
                class="form-check-input"
                type="radio"
                name="student_grade"
                value="1"
                v-model="enrollPeriod.grade"
              />
              <label class="form-check-label" for=""> 1 </label>
            </div>
            <div class="form-check">
              <input
                class="form-check-input"
                type="radio"
                name="student_grade"
                value="2"
                v-model="enrollPeriod.grade"
              />
              <label class="form-check-label" for=""> 2 </label>
            </div>
            <div class="form-check">
              <input
                class="form-check-input"
                type="radio"
                name="student_grade"
                value="3"
                v-model="enrollPeriod.grade"
              />
              <label class="form-check-label" for=""> 3 </label>
            </div>
            <div class="form-check">
              <input
                class="form-check-input"
                type="radio"
                name="student_grade"
                value="4"
                v-model="enrollPeriod.grade"
              />
              <label class="form-check-label" for=""> 4 </label>
            </div>
          </div>
          <div class="col-sm-3">
            <div class="form-check">
              <input
                class="form-check-input"
                type="radio"
                name="student_grade"
                value="5"
                v-model="enrollPeriod.grade"
              />
              <label class="form-check-label" for=""> 5 </label>
            </div>
            <div class="form-check">
              <input
                class="form-check-input"
                type="radio"
                name="student_grade"
                value="6"
                v-model="enrollPeriod.grade"
              />
              <label class="form-check-label" for=""> 6 </label>
            </div>
            <div class="form-check">
              <input
                class="form-check-input"
                type="radio"
                name="student_grade"
                value="7"
                v-model="enrollPeriod.grade"
              />
              <label class="form-check-label" for=""> 7 </label>
            </div>
            <div class="form-check">
              <input
                class="form-check-input"
                type="radio"
                name="student_grade"
                value="8"
                v-model="enrollPeriod.grade"
              />
              <label class="form-check-label" for=""> 8 </label>
            </div>
            <div class="form-check">
              <input
                class="form-check-input"
                type="radio"
                name="student_grade"
                value="9"
                v-model="enrollPeriod.grade"
              />
              <label class="form-check-label" for=""> 9 </label>
            </div>
            <div
              class="form-check"
              data-toggle="modal"
              data-target="#chooseGrade"
            >
              <input
                class="form-check-input"
                type="radio"
                name="student_grade"
                id=""
                value="10"
                v-model="enrollPeriod.grade"
              />
              <label class="form-check-label" for=""> 10 </label>
            </div>
            <div
              class="form-check"
              data-toggle="modal"
              data-target="#chooseGrade"
            >
              <input
                class="form-check-input"
                type="radio"
                name="student_grade"
                id=""
                value="11"
                v-model="enrollPeriod.grade"
              />
              <label class="form-check-label" for=""> 11 </label>
            </div>
            <div
              class="form-check"
              data-toggle="modal"
              data-target="#chooseGrade"
            >
              <input
                class="form-check-input"
                type="radio"
                name="student_grade"
                id=""
                value="12"
                v-model="enrollPeriod.grade"
              />
              <label class="form-check-label" for=""> 12 </label>
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
        @click="addNewEnrollPeriod"
        >Add Another Enrollment Period</a
      >
      <button type="submit" class="btn btn-primary">Continue</button>
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
            selectedStartDate: new Date(2020, 0,  11),
            selectedEndDate: "",
            grade: "",
            disabledDates: {
             ranges: [{
                  from: new Date(2020 ,12, 1),
                  to: new Date(2131 ,12, 1),
            },
        ],
        }
          },
        ],
      },
      students: [],
    };
  },
  props: {
    semesters: {
      type: Array,
      required: true,
    },
  },
  mounted() {
    this.students = this.semesters;
  },
  methods: {
    addNewEnrollPeriod() {
      this.form.enrollPeriods.push({
        selectedStartDate: "",
        selectedEndDate: "",
        grade: "",
      });
    },
    addStudent() {
      axios
        .post(route("enroll.student"), this.form)
        .then(
          (response) => (window.location = "/reviewstudent/" + response.data.id)
        )
        .catch((error) => console.log(error));
    },
  },
};
</script>

