<template>
 <div class="form-wrap border bg-light py-5 px-25 position-relative">
    <h2>Enroll Student {{studentcount+1}}</h2> 
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
          required
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
    <div class="form-group d-sm-flex mb-1 lato-italic info-detail">
        <label for="">Gender <sup>*</sup></label>
        <div class="row pl-sm-5">
          <div class="col-6 col-sm-3">
            <div class="form-check">
              <input 
              class="form-check-input" 
              type="radio" 
              name="gender" 
              value="Male"
              v-model="form.gender"
              required
              >
            <label class="form-check-label pl-1 pl-sm-0">
              Male
            </label>
            </div>
            </div>
            <div class="col-6 col-sm-3">
            <div class="form-check">
            <input 
            class="form-check-input" 
            type="radio" 
            name="gender" 
            value="Female"
            id="gender" 
            v-model="form.gender"
            >
            <label class="form-check-label pl-1 pl-sm-0">
              Female
            </label>
            </div>
            </div>     
      </div>
      </div>
    <div class="form-group d-sm-flex mb-2 position-relative">
      <label for="">Date of Birth<sup>*</sup></label>
      <div class="position-relative mb-0 col-md-3 col-xl-2 px-0">
        <flat-pickr id="dob" name="dob"  v-model="form.dob" required>
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
                aria-describedby="emailHelp"
                v-model="form.studentID"
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
       <div class="form-group d-sm-flex mb-2">
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
                v-model="form.mothersName"
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
       <div class="form-group d-sm-flex mb-2">
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
                v-model="form.birthCity"
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
    <div
      class="seperator mt-4"
      v-for="(enrollPeriod, index) in form.enrollPeriods"
      :key="enrollPeriod.id"
    >
      <div class="position-relative">
      <span  class="remove" @click="removePeriod(index)"><i class="fas fa-times"></i></span>
      <h3>Enrollment Period {{ index + 1 }}</h3>
      <div class="form-group d-sm-flex mb-2 mt-2r">
        <label for="">Select your START date of enrollment<sup>*</sup></label>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group w-100 datepicker-full date-field-style">
              <p>
               <date-picker   :default="startDate" v-model="enrollPeriod.selectedStartDate"/>
              </p>
            </div>
          </div>
          <div class="info-detail col-md-8 col-lg-5 lato-italic">
            <p>
             You can enter a different date AFTER the one entered. The date you enter will appear on your confirmation of enrollment letter, but your official enrollment will START on the date you see in the box. 

            </p>
          </div>
           <div class="col-lg-3 links-list mt-3 mt-sm-0">
           <a href="#chooseDates" data-toggle="modal">help me choose a date</a>
          </div>
        </div>
      </div>

      <div class="form-group d-sm-flex mb-2 mt-2r">
        <label for="">Select your END date of enrollment<sup>*</sup></label>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group w-100 datepicker-full date-field-style">
              <p>
                 <date-picker v-bind:default="endDate" v-model='enrollPeriod.selectedEndDate'/>
              </p>
     
            </div>
          </div>
          <div class="info-detail col-md-8 col-lg-5 lato-italic">
            <p>
            You can enter a different date BEFORE the one entered. The date you enter will appear on your confirmation of enrollment letter, but your official enrollment will END on the date you see in the box. 

            </p>
          </div>
          <div class="col-lg-3 links-list mt-3 mt-sm-0">
           <a href="#chooseDates" data-toggle="modal">help me choose a date</a>
          </div>
        </div>
      </div>
    
      <div class="form-group d-sm-flex mb-2 lato-italic info-detail">
        <label for=""
          >Select grade level(s) for your enrollment period.<sup>*</sup></label
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
              <label class="form-check-label pl-2 pl-sm-0" for=""> {{ val }} </label>
            </div>
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
        <label for="">Use this space to tell us anything you'd like us to know.</label>
        <div>
        <textarea
          class="form-control"
          id="exampleFormControlTextarea1"
          name="student_situation"
          rows="3"
          maxlength="2000"
          onKeyPress="if(this.value.length==2000) return false;"
          v-model="form.student_situation"
        ></textarea>
        </div>
      </div>
      <p v-if="errors.length" >
       <ul>
       <li style="color:red" v-for="error in errors" :key="error.id">  {{error}} </li>
      </ul>
    </p> 
    <div class="mt-2r">
      <a
        type="button"
        class="btn btn-primary addenrollment mb-4 mb-sm-0"
        id="addEnroll"
        value="addEnroll"
        v-if="canAddMorePeriod"
        @click="addNewEnrollPeriod"
        >Add Another Enrollment Period</a
      >
      <button type="submit"  class="btn btn-primary mb-4 mb-sm-0 ml-2">Continue</button>
    </div>
  </form>
  </div>
</template>

<script>
import axios from "axios";
import moment from "moment"
import flatPickr from "vue-flatpickr-component";
import "flatpickr/dist/flatpickr.css";
import DatePicker from './DatePicker.vue';
export default {
  name: "EnrollStudent",
  components: {
    flatPickr,
    DatePicker
  },
  data() {
 
       return {
     startDate:this.startdate,
     endDate:this.enddate,
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
        birthCity:"",
        mothersName:"",
        enrollPeriods: [
          {
            selectedStartDate: '',
            selectedEndDate:'',
            grade: "",
            configstartdate: {
              altFormat: "F j, Y",
              altInput: true,
              allowInput: true,
            },
            // configenddate: {
            //   altFormat: "F j, Y",
            //   altInputClass: "form-control",
            //   altInput: true,
            //   allowInput: true,
            //   minDate:this.calcMinDate(this.startdate),
            //   disable: [
            //     {
            //       from: this.calcEndDate(this.startdate),
            //       to: this.calcToData(this.startdate),
            //     },
            //   ],
            // },
          },
        ],
      },
      config: {
        altFormat: "F j, Y",
        altInput: true,
        allowInput: true,
      },
      students: [],
      errors: [],
      removingPeriod: false,
    };
  },
  props: {
    startdate: {
      required: true,
    },
    enddate: {
      required: true,
    },
    sem: {
      required: true,
    },
    studentcount:{
      type: Number,
      required:true
    },
    countryname:{
      required:true,
    }
  },
  methods: {
    
    calcEndDate(date) {
      const oldDate = new Date(date);
      const year = oldDate.getFullYear();
      const oDate = oldDate.getDate();
      const month = oldDate.getMonth();
      return new Date(year + 1, month, oDate +1); 
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
    validEmail: function (email) {
      var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    },
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
      this.form.enrollPeriods[
        index
      ].configenddate.minDate = this.calcMinDate(
        this.form.enrollPeriods[index].selectedStartDate
      );
      this.form.enrollPeriods[index].selectedEndDate = ""; // reset the end date value
    },
    addNewEnrollPeriod() {
      this.form.enrollPeriods.push({
        selectedStartDate: this.startdate,
        selectedEndDate: this.enddate,
        grade: "",
        // configstartdate: {
        //   altFormat: "F j, Y",
        //   altInput: true,
        //   allowInput: true,
        // },
        // configenddate: {
        //   altFormat: "F j, Y",
        //   altInput: true,
        //   allowInput: true,
        //   minDate:this.calcMinDate(this.startdate),
        //   disable: [
        //     {
        //       from: this.calcEndDate(this.startdate),
        //       to: this.calcToData(this.startdate),
        //     },
        //   ],
        // },
      });
    },
    removePeriod(index){
        this.form.enrollPeriods.splice(index, 1)
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
          "Grade is a required Field! Please select a Grade and then continue."
        );
      }
      if (!this.vallidateEndDate()) {
       
        this.errors.push(
          "End date of Enrollment can not be smaller then Start Date of Enrollment"
        );
      }
      if (
        this.form.dob &&
        this.vallidateGrades() && this.vallidateEndDate()
      ) {
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
     
      let isValid = true;
      this.form.enrollPeriods.forEach((enrollPeriod) => {
       
        const selectedStartDate = moment(enrollPeriod.selectedStartDate);
        const selectedEndDate = moment(enrollPeriod.selectedEndDate);
        if ( selectedEndDate.isBefore(selectedStartDate)) {
          isValid = false;
         
        }
      });

      return isValid;
    },
    clickDatepicker() {
      document.getElementById("dob").click();
    },
    clickDatepicker() {
      document.getElementById("dob").click();
      document.getElementById("dob").focus();
    },
  },
  computed: {
    canAddMorePeriod() {
      return this.form.enrollPeriods.length < 4;
    },
     canRemovePeriod() {
      return this.form.enrollPeriods.length > 1;
    },
  },
};
</script>

