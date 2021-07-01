<template>
 
  <form method="POST" class="mb-0" @submit.prevent="EditStudent()">
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
      <div class="position-relative mb-0  col-md-3 col-xl-2 px-0">
        <flat-pickr required id="dob" name="dob" :config="config" v-model="form.dob">
        </flat-pickr>
        <i class="fas fa-calendar-alt" @click="clickDatepicker" aria-hidden="true"></i>
      </div>
      
    </div>
    <div class="form-group d-sm-flex mb-2">
      <label for="">Email Address</label>
      <div>
        <input
          type="email"
          class="form-control"
          name="email"
          id="email"
          v-model="form.email"
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
      <label for="">National ID</label>
        <div class="row">
        <div class="col-md-5 col-lg-3">
        <div class="form-group w-100 datepicker-full">
        <input
          type="text"
          class="form-control"
          id="student_id"
          name="student_id"
          v-model="form.student_Id"
          aria-describedby="emailHelp"
        />
      </div>
      </div>
        <div class="info-detail col-md-8 col-lg-9 lato-italic">
            <p>
              Please enter your National ID if you wish to have it on your documents.
            </p>
          </div>
       </div>
    </div>

       <div v-if="countryname==='Hungary'" class="form-group d-sm-flex mb-2">
        <label for="">Mother's Name</label>
        <div class="row">
          <div class="col-md-5 col-lg-3">
            <div class="form-group w-100 datepicker-full">
             <input
                type="text"
                class="form-control"
                id="mothers_name"
                name="mothers_name"
                aria-describedby="emailHelp"
                v-model="form.mothers_name"
               />
            </div>
          </div>
          <div class="info-detail col-md-8 col-lg-9 lato-italic">
            <p>
              Please enter your Mother's name if you wish to have it on your documents.
            </p>
          </div>
        </div>
      </div>
       <div v-if="countryname==='Hungary'" class="form-group d-sm-flex mb-2">
        <label for="">Birth City</label>
        <div class="row">
          <div class="col-md-5 col-lg-3">
            <div class="form-group w-100 datepicker-full">
             <input
                type="text"
                class="form-control"
                id="birth_city"
                name="birth_city"
                aria-describedby="emailHelp"
                v-model="form.birth_city"
               />
            </div>
          </div>
          <div class="info-detail col-md-8 col-lg-9 lato-italic">
            <p>
              Please enter your Birth city if you wish to have it on your documents.
            </p>
          </div>
        </div>
      </div>
    <div class="seperator mt-4" v-for="(period, index) in form.periods" :key="period.id">
      <div v-if="period.status === 'pending'" class="position-relative">
        <span v-if="canRemovePeriod"  class="remove" @click="removePeriod(index)"><i class="fas fa-times"></i></span>
        <div class="form-group d-sm-flex mb-2 mt-2r">
          <label for="">Select your START date of enrollment</label>
          <div class="row">
            <div class="col-md-4 col-lg-2">
              <div class="form-group w-100 datepicker-full">
                <p>
                <flat-pickr
                  id="startdate"
                  name="startdate"
                  v-model="period.selectedStartDate"
                  :config="period.configstartdate"
                  :value="period.selectedStartDate"
                  required
                  @input="updateEndDate(index)"
                >
                </flat-pickr>
                </p>
              </div>
            </div>
            <div class="info-detail col-md-8 col-lg-6 lato-italic">
              <p>
              You can enter a different date AFTER the one entered. The date you enter will appear on your confirmation of enrollment letter, but your official enrollment will START on the date you see in the box. 
              </p>
            </div>
             <div class="col-lg-4 links-list pl-0 mt-3 mt-sm-0">
           <a href="#chooseDates" data-toggle="modal">help me choose a date</a>
          </div>
          </div>
        </div>
        <div class="form-group d-sm-flex mb-2 mt-2r">
          <label for="">Select your END date of enrollment</label>
          <div class="row">
            <div class="col-md-4 col-lg-2">
              <div class="form-group w-100 datepicker-full">
                <p>
                <flat-pickr
                  id="enddate"
                  name="enddate"
                  v-model="period.selectedEndDate"
                  required
                  :config="period.configenddate"
                  :value="period.selectedEndDate"
                  :open-date="period.selectedStartDate" 
                >
                </flat-pickr>
                </p>
              </div>
            </div>
            <div class="info-detail col-md-8 col-lg-6 lato-italic">
              <p>
               You can enter a different date BEFORE the one entered. The date you enter will appear on your confirmation of enrollment letter, but your official enrollment will START on the date you see in the box. 
              </p>
            </div>
             <div class="col-lg-4 links-list pl-0 mt-3 mt-sm-0">
           <a href="#chooseDates" data-toggle="modal">help me choose a date</a>
          </div>
          </div>
        </div>
        <div class="form-group d-sm-flex mb-2r lato-italic info-detail ">
          <label for=""
            >Select grade level(s) for your enrollment period.</label
          >
          <div class="row pl-sm-5">
            <div v-for="(grade, index) in grades" :key="index" class="col-6 col-sm-3">
              <div v-for="(val, i) in grade" :key="i" class="form-check">
                <input
                  class="form-check-input"
                  type="radio"
                  :value= "val"
                  v-model="period.grade"
                  required
                />
                <label class="form-check-label" for=""> {{ val }} </label>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div v-else class="overflow-auto">
            <table class="table-styling border w-100 my-5">
            <thead>
            <tr>
              <th>
             Start Date
              </th>
              <th>End Date</th>
              <th>Grade</th>
              </tr>
            </thead>
              <tbody>
                <tr>
                <td>{{ period.selectedStartDate | moment("MMMM D, YYYY")}}</td>
                <td>{{ period.selectedEndDate | moment("MMMM D, YYYY") }}</td>
                <td>{{ period.grade }} </td>
                </tr>
              </tbody>
            </table>
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
      <label for="">Tell us more about your situation</label>
      <div>
      <textarea
        class="form-control"
        id="exampleFormControlTextarea1"
        name="student_situation"
        value=""
        rows="3"
        maxlength="2000"
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
        @click="addNewEnrollPeriod"
        v-if="canAddMorePeriod"
        >Add Another Enrollment Period</a
      >
      <button type="submit" class="btn btn-primary mb-4 mb-sm-0">Continue</button>
    </div>
  </form>

</template>

<script>
import flatPickr from "vue-flatpickr-component";
import "flatpickr/dist/flatpickr.css";
import axios from "axios";
export default {
  name: "EditEnrollStudent",
  components: {
    flatPickr,
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
        first_name: this.students.first_name,
        middle_name: this.students.middle_name,
        last_name: this.students.last_name,
        gender: this.students.gender,
        email: this.students.email,
        dob: this.date_of_birth,
        cell_phone: this.students.cell_phone,
        student_Id: this.students.student_Id,
        student_situation: this.students.student_situation,
        immunized_status: this.students.immunized_status,
        birth_city:this.students.birth_city,
        mothers_name:this.students.mothers_name,
        periods: [],
      },
      config: {
        altFormat: "F j, Y",
        altInput: true,
        allowInput: true,
      },
      errors: [],
      removingPeriod: false,
    };
  },
  created() {
    this.periods.forEach((item) => {
      this.form.periods.push({
        id: item.id,
        selectedStartDate: new Date(item.start_date_of_enrollment),
        selectedEndDate: new Date(item.end_date_of_enrollment),
        grade: item.grade_level,
        status: item.status,
        configstartdate: {
          altFormat: "F j, Y",
          altInput: true,
          allowInput: true,
        },
        configenddate: {
          altFormat: "F j, Y",
          altInputClass: "form-control",
          altInput: true,
          allowInput: true,
          minDate:this.calcMinDate(this.startdate),
          disable: [
            {
              from: this.calcEndDate(item.start_date_of_enrollment),
              to: this.calcToData(item.start_date_of_enrollment),
            },
          ],
        },
      });
    });
  },
  methods: {
    EditStudent() {
      this.errors = [];
      // if (!this.validEmail(this.form.email)) {
      //   return this.errors.push("Valid email required.");
      // }
      if (!this.vallidateGrades()) {
        this.errors.push(
          "Grade is a required Field! Please select a Grade and then continue."
        );
      }
      if (!this.vallidateEndDate()) {
        this.errors.push(
          "End date of Enrollment is a required! Please select a End Date and then continue."
        );
      } else {
        axios
          .post(route("update.student", this.students), this.form)
          .then((response) => {
            const resp = response.data;
            resp.status == "success"
              ? (window.location = "/reviewstudents")
              : alert(resp.message);
          })
          .catch((error) => console.log(error));
      }
    },
    // validEmail: function (email) {
    //   var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    //   return re.test(email);
    // },
    calcEndDate(date) {
      const oldDate = new Date(date);
      const year = oldDate.getFullYear();
      const oDate = oldDate.getDate();
      const month = oldDate.getMonth();
      return new Date(year + 1, month, oDate);
    },
     calcMinDate(date){
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
    updateEndDate(index) {
      this.form.periods[index].configenddate.disable[0].from = this.calcEndDate(
        this.form.periods[index].selectedStartDate
      );
      this.form.periods[index].configenddate.disable[0].to = this.calcToData(
        this.form.periods[index].selectedStartDate
      );
       this.form.periods[
        index
      ].configenddate.minDate = this.calcMinDate(
        this.form.periods[index].selectedStartDate
      );
      this.form.periods[index].selectedEndDate = ""; // reset the end date value
    },
    addNewEnrollPeriod() {
      this.form.periods.push({
        id: null,
        selectedStartDate: new Date(this.semesters.start_date),
        status: "pending",
        selectedEndDate: new Date(this.semesters.end_date),
        grade: "",
        configstartdate: {
          altFormat: "F j, Y",
          altInput: true,
          allowInput: true,
        },
        configenddate: {
          altFormat: "F j, Y",
          altInput: true,
          allowInput: true,
          minDate:this.calcMinDate(this.startdate),
          disable: [
            {
              from: this.calcEndDate(this.semesters.start_date),
              to: this.calcToData(this.semesters.start_date),
            },
          ],
        },
      });
    },
    removePeriod(index) {
      if (this.removingPeriod) {
        return;
      }
      this.removingPeriod = true;

      let reqData = JSON.parse(JSON.stringify(this.form)); // copying object wihtout reference
      reqData.periods.splice(index, 1);

      axios
        .post(route("delete.enroll", this.students), reqData)
        .then((response) => {
          const resp = response.data;
          resp.status == "success"
            ? this.form.periods.splice(index, 1)
            : alert(resp.message);
          this.removingPeriod = false;
        })
        .catch((error) => {
          this.removingPeriod = false;
          console.log(error);
        });
    },
    vallidateGrades() {
      for (let i = 0; i < this.form.periods.length; i++) {
        const periods = this.form.periods[i];
        if (!periods.grade) {
          return false;
          break;
        }
      }
      return true;
    },
    vallidateEndDate() {
      for (let i = 0; i < this.form.periods.length; i++) {
        const periods = this.form.periods[i];
        if (!periods.selectedEndDate) {
          return false;
          break;
        }
      }
      return true;
    },
    clickDatepicker() {
      document.getElementById("dob").click();
      document.getElementById("dob").focus();
    },
  },
  props: {
    students: {
      type: Object,
      required: true,
    },
  date_of_birth:{
    type:Object,
    required:true
  },
    periods: {
      type: Array,
      required: true,
    },
    semesters: {
      required: true,
    },
     semmonth: {
      required: true,
    },
    countryname:{
    
    }
  },
  computed: {
    canAddMorePeriod() {
      return this.form.periods.length < 4;
    },
    canRemovePeriod() {
      return this.form.periods.length > 1;
    },
  },
};
</script>


