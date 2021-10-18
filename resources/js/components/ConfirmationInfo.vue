<template>
  <form method="POST" class="mb-0" @submit.prevent="addItems()">
    <table>
      <tbody>
        <tr>
          <td>Student</td>
          <td>{{ this.student.fullname }}</td>
        
        </tr>
        <tr>
          <td>Date of Birth</td>
          <td>{{ this.student.birthdate | moment("MMMM D, YYYY") }}</td>
        </tr>
      </tbody>
    </table>
    <div class="row pt-3">
      <div class="col-12 confirmation-letter__options">
        <h3 class="mb-3">
        Add any of the following fields by checking the box(es) below.
         Be sure you have provided this information if you wish to select it.
        </h3>
        <div class="form-group d-sm-flex mb-2">
          <label class=" pl-0 container">
            <input
              type="checkbox"
              name="IsMotherName"
              v-model="form.IsMotherName"
             
              v-on:click='checkMotherName()'
            />
        <span :style="[this.form.mother_name == ''|| this.form.mother_name == null ? {textDecoration: 'line-through'} : {textDecoration: 'none'}]">   Mother's Maiden Name </span>
            <span class="IsMotherName"></span>
          </label>
        </div>
        <label class="pl-0 container">
             <input 
             type="checkbox" 
            name="isDobCity" 
            class='line-through'
            v-model="form.isDobCity"
             v-on:change='checkisDobCity()'
            > 
         <span :style="[ (this.form.dobCity == null || this.form.dobCity == '') ? {textDecoration: 'line-through'} : {textDecoration: 'none'}]">  Birth City </span>

        </label>
        <label class="pl-0 container">
          <input
            type="checkbox"
            name="isStudentId"
            v-model="form.isStudentId"
             v-on:change='checkisNationalId()'
          />
       <span :style="[ (this.form.nationalId == null || this.form.nationalId == '') ? {textDecoration: 'line-through'} : {textDecoration: 'none'}]">  National ID </span>
          <span class="isStudentId"></span>
        </label>
       
        <input type="hidden" name="enrolment_id" v-model="form.enrolment_id" />
      </div>
        <p v-if="errors.length" >
       <ul>
       <li style="color:red" v-for="error in errors" :key="error.id">  {{error}} </li>
      </ul>
    </p> 
      <!-- <p>If the checkbox is disabled or field data is not showing up for the field you want to include, click
                        <a href="{{route('edit.student',$student->id)}}">here</a> to add it to the student record.
                    </p> -->
      <div class="mt-2r">
        <!-- <a href="{{route('dashboard')}}"
                            class="btn btn-primary addenrollment mb-4 mb-sm-0">Back</a> -->
        <a v-on:click="editInfo()" class="btn btn-primary mb-4 mb-sm-0 ml-2">
         Add Above information
        </a>
        <button type="submit" class="btn btn-primary mb-4 mb-sm-0 ml-2">
          Continue
        </button>
       
      </div>
    </div>
  </form>
</template>

<script>
import axios from "axios";
export default {
  name: "ConfirmationInfo",
  data() {
    return {
      form: {
        isDobCity: '',
        isStudentId: '',  
        IsMotherName: '',
        enrolment_id: this.enrollments.id,
        mother_name: this.student.mothers_name,
        dobCity :this.student.birth_city,
        nationalId:this.student.student_Id,
     
      },
     
      
      errors: []
    };
  },

  props: [
    "student",
    "gradeid",
    "confirmationdata",
    "student_id",
    "enrollments",
    "countryData"
  ],
  methods: {
 
    checkMotherName(){
    if (this.form.mother_name == null || this.form.mother_name == '' ) {
        alert('This is information was not provided . Click Add button to add it');
       
      }
    },
    checkisDobCity(){
        if (this.form.dobCity == null || this.form.dobCity == '' ) {
        alert('This is information was not provided . Click Add button to add it');

      
      }
    },  checkisNationalId(){
        if (this.form.nationalId == null || this.form.nationalId == '' ) {
        alert('This is information was not provided . Click Add button to add it');
     
      }
    },
    editInfo(){
     window.location ='/edit/'+this.student_id;
    },

  
    addItems() {
       
     
      axios
        .post(
          route("save.confirmationData", [this.student_id, this.gradeid]),
          this.form
        )
        .then(response => {
          window.location =
            "/viewdownload/" + this.enrollments.id + "/" + this.gradeid;
        })
        .catch(error => console.log(error));
        }
      
    
  }
};
</script>


<style >

</style>