<template>
   <form method="POST" class="mb-0" @submit.prevent="addItems()">
    <table>
        <tbody>
                <tr>
                    <td>Student</td>
                    <td>{{this.student.fullname}}</td>
                </tr>                           
                <tr>
                    <td>Date of Birth</td>
                    <td>{{this.student.birthdate | moment("MMMM D, YYYY")}}</td>
                    </tr>
        </tbody>
    </table>
    <div class="row confirmation-letter__options">
    <h3 class="mb-3">You may choose to include or exclude any of the following fields. Check the ones you want on the Confirmation Letter.</h3>
                               <div  v-if="countryname ==='Hungary'" class="form-group d-sm-flex mb-2">
                        <label class="container">Birth City
                            <input 
                            type="checkbox" 
                            name="isDobCity" 
                             v-model="form.isDobCity"
                            >
                            <span class="isDobCity"></span>
                        </label>
                        <label class="container">Mother's Maiden Name
                            <input
                            type="checkbox"
                            name="IsMotherName"
                             v-model="form.IsMotherName">
                            <span class="IsMotherName"></span>
                        </label>
                        </div>
                        <label class="container">Student ID
                            <input 
                            type="checkbox" 
                            name="isStudentId" 
                            v-model="form.isStudentId">
                            <span class="isStudentId"></span>
                        </label>
                        <label class="container">Grade
                            <input 
                            type="checkbox" 
                            name="isGrade" 
                            v-model="form.isGrade">
                            <span class="isGrade"></span>
                        </label>
                        <input type="hidden" name="enrolment_id" v-model="form.enrolment_id">
                    </div>
                    <!-- <p>If the checkbox is disabled or field data is not showing up for the field you want to include, click
                        <a href="{{route('edit.student',$student->id)}}">here</a> to add it to the student record.
                    </p> -->
                    <div class="mt-2r">
                        <!-- <a href="{{route('dashboard')}}"
                            class="btn btn-primary addenrollment mb-4 mb-sm-0">Back</a> -->
                    <button type="submit" class="btn btn-primary mb-4 mb-sm-0 ml-2">Continue</button>
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
        isDobCity: this.confirmationdata.isDobCity,
        isStudentId: this.confirmationdata.isStudentId,
        isGrade:this.confirmationdata.isGrade,
        IsMotherName:this.confirmationdata.IsMotherName,
        enrolment_id:this.enrollments.id
      },
    };
  },
  props: ["student","gradeid","confirmationdata","student_id","enrollments","countryData"],
  methods: {
    addItems() {
      axios
        .post(route("save.confirmationData",[this.student_id,this.gradeid]), this.form)
       .then(response => {
            window.location =
              "/viewdownload/" +
              this.enrollments.id +
              "/" +
              this.gradeid;
          })
        .catch((error) => console.log(error));
    },
   
    
  },
 
};
</script>
