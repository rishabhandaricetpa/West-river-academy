<template>
  <form method="POST" @submit.prevent="EditStudent()">
    <p>
      We would be happy to speak with you and your student(s) to advise on
      educational situations, materials, resources and transcripts. You may
      choose English or Spanish as your preferred language for the consultation.
    </p>
    <div class="form-group mb-2 lato-italic info-detail pb-4">
      <h3 class="mb-3">Please choose the languge you prefer.</h3>
      <div class="form-check mb-2">
        <input
          class="form-check-input"
          type="radio"
          name="preferred_language"
          value=""
          v-model="form.preferred_language"
          required
        />
        <label class="form-check-label" for="">
          English
        </label>
      </div>
      <div class="form-check mb-2">
        <input
          class="form-check-input"
          type="radio"
          name="preferred_language"
          value=""
          v-model="form.preferred_language"
        />
        <label class="form-check-label" for="">
          Spanish
        </label>
      </div>
    </div>
    <div class="form-group mb-2 lato-italic info-detail pb-4">
      <h3 class="mb-3">
        You will inititate the call. How do you wish to call us?
      </h3>
      <div class="form-check mb-2">
        <input
          class="form-check-input"
          type="radio"
          name="en_call_type"
          value=""
          v-model="form.en_call_type"
        />
        <label class="form-check-label" for="">
          My service provider
        </label>
      </div>
      <div class="form-check mb-2">
        <input
          class="form-check-input"
          type="radio"
          name="en_call_type"
          value=""
          v-model="form.en_call_type"
        />
        <label class="form-check-label" for="">
          WhatsApp
        </label>
      </div>
      <div class="form-check mb-2">
        <input
          class="form-check-input"
          type="radio"
          name="en_call_type"
          value=""
          v-model="form.en_call_type"
        />
        <label class="form-check-label" for="">
          Telegram
        </label>
      </div>
    </div>
    <div class="form-group mb-2 lato-italic info-detail pb-4">
      <div class="form-check mb-2">
        <input
          class="form-check-input"
          type="radio"
          name="sp_call_type"
          value=""
          v-model="form.sp_call_type"
        />
        <label class="form-check-label" for="">
          Zoom
        </label>
      </div>
      <div class="form-check mb-2">
        <input
          class="form-check-input"
          type="radio"
          name="sp_call_type"
          value=""
          v-model="form.sp_call_type"
        />
        <label class="form-check-label" for="">
          Google Meet
        </label>
      </div>
    </div>
    <div class="d-sm-flex mb-3">
      <p>The fee is $80 per hour. Select the number of hours:</p>
      <div class="row ml-3 mx-0">
        <select class="form-control col-3">
          <option value="">Select hours</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
          <option value="9">9</option>
          <option value="10">10</option>
        </select>
        <span class="col-3 text-center">=</span>
        <input
          type="text"
          class="form-control col-3"
          value=""
          name="amount_due"
          v-model="form.amount_due"
        />
      </div>
    </div>
    <div class="form-group">
      <p class="mb-2">what would you like about during the consultation?</p>
      <textarea
        class="form-control"
        id="exampleFormControlTextarea1"
        value=""
        name="consulting_about"
        v-model="form.consulting_about"
        rows="3"
      ></textarea>
    </div>
    </div>
    <div class="form-wrap border bg-light py-5 px-25 dashboard-info mt-4">
      <button type="submit" class="btn btn-primary ml-auto">Add to cart</button>
    </div>
  </form>
</template>

<script>
import axios from "axios";
import flatPickr from "vue-flatpickr-component";
import "flatpickr/dist/flatpickr.css";

export default {
  name: "EnrollStudent",
  components: {
    flatPickr
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
          "4"
        ],
        ["5", "6", "7", "8", "9", "10", "11", "12"]
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
            selectedStartDate: this.startdate,
            selectedEndDate: this.enddate,
            grade: "",
            configstartdate: {
              altFormat: "F j, Y",
              altInput: true,
              allowInput: true
            },
            configenddate: {
              altFormat: "F j, Y",
              altInputClass: "form-control",
              altInput: true,
              allowInput: true,
              minDate: this.calcMinDate(this.startdate),
              disable: [
                {
                  from: this.calcEndDate(this.startdate),
                  to: this.calcToData(this.startdate)
                }
              ]
            }
          }
        ]
      },
      config: {
        altFormat: "F j, Y",
        altInput: true,
        allowInput: true
      },
      students: [],
      errors: [],
      removingPeriod: false
    };
  },
  props: {
    startdate: {
      required: true
    },
    enddate: {
      required: true
    },
    sem: {
      required: true
    }
  },
  methods: {
    calcEndDate(date) {
      const oldDate = new Date(date);
      const year = oldDate.getFullYear();
      const oDate = oldDate.getDate();
      const month = oldDate.getMonth();
      return new Date(year + 1, month, oDate);
    },
    calcMinDate(date) {
      const oldDate = new Date(date);
      const year = oldDate.getFullYear();
      const oDate = oldDate.getDate();
      const month = oldDate.getMonth();
      return new Date(year, month, oDate + 1);
    },
    calcToData(date) {
      const oldDate = new Date(date);
      const oDate = oldDate.getDate();
      const year = oldDate.getFullYear();
      const month = oldDate.getMonth();
      return new Date(year + 900, month, oDate + 1);
    },
    // validEmail: function (email) {
    //   var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    //   return re.test(email);
    // },
    updateEndDate(index) {
      this.form.enrollPeriods[
        index
      ].configenddate.disable[0].from = this.calcEndDate(
        this.form.enrollPeriods[index].selectedStartDate
      );
      this.form.enrollPeriods[
        index
      ].configenddate.disable[0].to = this.calcToData(
        this.form.enrollPeriods[index].selectedStartDate
      );
      this.form.enrollPeriods[index].configenddate.minDate = this.calcMinDate(
        this.form.enrollPeriods[index].selectedStartDate
      );
      this.form.enrollPeriods[index].selectedEndDate = ""; // reset the end date value
    },
    addNewEnrollPeriod() {
      this.form.enrollPeriods.push({
        selectedStartDate: this.startdate,
        selectedEndDate: new Date(this.enddate),
        grade: "",
        configstartdate: {
          altFormat: "F j, Y",
          altInput: true,
          allowInput: true
        },
        configenddate: {
          altFormat: "F j, Y",
          altInput: true,
          allowInput: true,
          minDate: this.calcMinDate(this.startdate),
          disable: [
            {
              from: this.calcEndDate(this.startdate),
              to: this.calcToData(this.startdate)
            }
          ]
        }
      });
    },
    removePeriod(index) {
      this.form.enrollPeriods.splice(index, 1);
    },
    addStudent() {
      this.errors = [];
      if (!this.form.dob) {
        this.errors.push("Date of birth is required");
        alert("Please fill the required form");
      }
      // if (!this.validEmail(this.form.email)) {
      //   this.errors.push("Valid email required.");
      // }
      if (!this.vallidateGrades()) {
        this.errors.push(
          "Grade is required Field! Please select a Grade and then continue"
        );
      }
      if (!this.vallidateEndDate()) {
        this.errors.push(
          "End date of Enrollment is required!Please select a End Date and then continue"
        );
      }
      if (this.form.dob && this.vallidateGrades() && this.vallidateEndDate()) {
        axios.post(route("enroll.student"), this.form).then(response => {
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
    clickDatepicker() {
      document.getElementById("dob").click();
      document.getElementById("dob").focus();
    }
  },
  computed: {
    canAddMorePeriod() {
      return this.form.enrollPeriods.length < 4;
    },
    canRemovePeriod() {
      return this.form.enrollPeriods.length > 1;
    }
  }
};
</script>
