<template>
<div v-if="this.remaining_credit >0 ">
  <form
    method="POST"
    class="mb-0 px-0 unstyled-label"
    @submit.prevent="submitCourse()"
  >
    <div
      class="seperator mt-4"
      v-for="(physicalEducationCourse, index) in form.physicalEducationCourse"
      :key="physicalEducationCourse.id"
    >
      <div class="position-relative">
      <p  v-if="index>0" class="delete-course">Delete Course </p>
       <span v-if="index>0" class="remove place-top" @click="removeCourse(index)"
          ><i class="fas fa-times"></i>
        </span>
        <div class="col-sm-7 px-0">
          <div class="form-group d-sm-flex  align-items-center">
            <select
              class="form-control text-uppercase"
              v-model="physicalEducationCourse.subject_name"
            >
              <option disabled value="">Please select one</option>
              <option v-for="Course in physicalsubjects" :key="Course.id">
                {{ Course.subject_name }}</option
              >
            </select>
          </div>
          <div class="form-group d-sm-flex  align-items-center">
            <label for="" class="h3 text-black mb-0">Other</label>
            <div class="w-100">
              <input
                type="text"
                class="form-control"
                name=""
                value="other"
                  @click='setOtherValue(index)'
                v-model="physicalEducationCourse.other_subject"
                aria-describedby=""
              />
            </div>
          </div>
          <div class="form-group">
            <div class="d-sm-flex mt-4">
              <h3>Select a Grade</h3>
              <a
                href="#"
                class="btn btn-primary ml-auto"
                data-toggle="modal"
                data-target="#GradeHelp"
                >Help me Decide</a
              >
            </div>
            <div class="form-check mb-1">
              <input
                class="form-check-input"
                type="radio"
                name=""
                v-model="physicalEducationCourse.grade"
                value="A"
              />
              <label class="form-check-label" for="">A</label>
            </div>
            <div class="form-check mb-1">
              <input
                class="form-check-input"
                type="radio"
                name=""
                v-model="physicalEducationCourse.grade"
                value="B"
              />
              <label class="form-check-label" for="">B</label>
            </div>
            <div class="form-check mb-1">
              <input
                class="form-check-input"
                type="radio"
                name=""
                v-model="physicalEducationCourse.grade"
                value="C"
              />
              <label class="form-check-label" for="">C</label>
            </div>
            <div class="form-check mb-1">
              <input
                class="form-check-input"
                type="radio"
                v-model="physicalEducationCourse.grade"
                name="D"
                value="D"
              />
              <label class="form-check-label" for="">D</label>
            </div>
            <div class="form-check mb-1">
              <input
                class="form-check-input"
                type="radio"
                v-model="physicalEducationCourse.grade"
                name=""
                value="PASS"
              />
              <label class="form-check-label" for="">PASS</label>
            </div>
            <div class="form-group mb-1 mt-2r">
              <h3 class="text-black">
                Select Credit: The recommended credit for a one-year course is
                selected. You may change it.
              </h3>
              <select
                class="form-control col-sm-3"
                data-toggle="collapse"
                href="#remainingCredits"
                role="button"
                v-model="physicalEducationCourse.selectedCredit"
                v-on:change="reCalculateAll"
                aria-expanded="false"
                aria-controls="remainingCredits"
              >
                <option disabled value="">Please select one</option>

                <option v-for="credit in all_credits" :key="credit.id">
                  {{ credit.credit }}
                </option>
              </select>
              <h3 class="mt-3" v-if='(final_credits[physicalEducationCourse.component_index ] - physicalEducationCourse.selectedCredit)>=0'>
                You have
               {{ final_credits[physicalEducationCourse.component_index + 1] }}
                out of
                {{ total_credits.total_credit }}
                remaining credits for this year.
              </h3>
                <h3  class="mt-3" v-else>Credits Are Over</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
            <p v-if="errors.length" >
       <ul>
       <li style="color:red" v-for="error in errors" :key="error.id">  {{error}} </li>
      </ul>
    </p> 
    <div class="mt-2r">
      <a v-if='this.form.final_remaining_credit >0' class="btn btn-primary" @click="addCourse"
        >Add Another Physical Education Course</a
      >
      <button type="submit" class="btn btn-primary ml-4 float-right">
        Continue
      </button>
        <a class="btn btn-primary float-right" @click="skipCourse()">Skip Course</a>
    </div>
  </form>
</div>
  <div v-else>
    No Credits Remaining
      <input type="submit" value="Continue" class="btn btn-primary ml-4 float-right" @click="nextCourse"/>
  </div>
</template>

<script>
export default {
  name: "PhysicalEducationCourse",
  data() {
    return {
      errors: [],
       final_credits: [this.remaining_credit],
      form: {
        remainingCredit: "",
        course_id: this.courses_id,
        transcript_id: this.transcript_id,
          final_remaining_credit:'',
        physicalEducationCourse: [
          {
            course_id: this.courses_id,
            transcript_id: this.transcript_id,
            student_id: this.student_id,
            subject_name: "",
            other_subject: "",
            selectedCredit: this.required_credit,
            grade: "",
            total_credits: this.total_credits.total_credit,
             component_index: 0
          }
        ]
      }
    };
  },
  mounted() {
    this.form.physicalEducationCourse[0].selectedCredit = this.required_credit;
    this.final_credits.push(this.calculateRemainingCredit(this.form.physicalEducationCourse[0]));
    this.finalValue();
  },
  props: [
    "physicalsubjects",
    "transcript_id",
    "student_id",
    "courses_id",
    "all_credits",
    "total_credits",
     'required_credit',
     'remaining_credit',
     'trans_id'
  ],
  methods: {
 calculateRemainingCredit(physicalEducationCourse) {
       this.finalValue();
      return this.final_credits[physicalEducationCourse.component_index] - physicalEducationCourse.selectedCredit;     
    },
     setOtherValue(index){
     this.form.physicalEducationCourse[index].subject_name ="";
    },
       reIndex(){
      this.form.physicalEducationCourse.forEach((physicalEducationCourse, index) => {
        physicalEducationCourse.component_index = index;
      });
    },
     reCalculateAll() {
      this.form.physicalEducationCourse.forEach((physicalEducationCourse, index) => {
        this.final_credits[index + 1] = this.calculateRemainingCredit(physicalEducationCourse)
      })
       const getFinalCredit= this.finalValue();
     if(getFinalCredit <0){
        alert('Credits are overs , either select smaller value or delete the course');
     }
    }, 
     finalValue(){
      const finalValue = this.final_credits[this.final_credits.length - 1];
      this.form.final_remaining_credit = finalValue;
      console.log('finalValue ', this.final_remaining_credit); 
     return finalValue;
    },
    addCourse() {
    const  physicalEducationCourse= {
        course_id: this.courses_id,
        transcript_id: this.transcript_id,
        student_id: this.student_id,
        subject_name: "",
        other_subject: "",
        selectedCredit: this.required_credit,
        grade: "",
        total_credits: this.final_credits[this.form.physicalEducationCourse.length - 1],
         component_index: this.form.physicalEducationCourse.length
      };
        this.final_credits.push(this.calculateRemainingCredit(physicalEducationCourse))
      this.form.physicalEducationCourse.push(physicalEducationCourse);
      this.finalValue();
    },
    removeCourse(index) {
      this.form.physicalEducationCourse.splice(index, 1);
        this.final_credits.splice(this.final_credits.length - 1, 1);
      this.reIndex();
      this.reCalculateAll();
    },
    submitCourse() {
      this.errors = [];
      if (!this.validateSubject() && !this.validateOtherSubject()) {
        this.errors.push(
          "Course name is required Field! Please select a Course name"
        );
      }
      if (!this.validateCredit()) {
        this.errors.push("Credit is required Field! Please select a credit ");
      }
       if(!this.validateFinalCredit()){
         this.errors.push(
           "No Credits remaining"
        );
      }
      if(this.validateFinalCredit()){
      axios
        .post(route("physicalEducation-transcript.store"), this.form)
        .then(response => {
          window.location =
            "/healthCourse-transcript/" +
            this.student_id +
            "/" +
            this.transcript_id;
        })
        .catch(error => {
          alert("Please fill in the fields");
        });
      }

    },

    validateSubject() {
      for (let i = 0; i < this.form.physicalEducationCourse.length; i++) {
        const enrollmentSubject = this.form.physicalEducationCourse[i];
        if (!enrollmentSubject.subject_name) {
          return false;
        }
      }
      return true;
    },
    validateCredit() {
      for (let i = 0; i < this.form.physicalEducationCourse.length; i++) {
        const enrollmentSubject = this.form.physicalEducationCourse[i];
        if (!enrollmentSubject.selectedCredit) {
          return false;
        }
      }
      return true;
    },
    validateFinalCredit(){
       if(this.form.final_remaining_credit <0){
       return false;
      }
      return true;
    },
    validateOtherSubject() {
      for (let i = 0; i < this.form.physicalEducationCourse.length; i++) {
        const enrollmentOtherSubject = this.form.physicalEducationCourse[i];
        if (!enrollmentOtherSubject.other_subject) {
          return false;
        }
      }
      return true;
    },
          nextCourse(){
      window.location =
            "/another-grade-transcript/" +
            this.student_id +
            "/" +
            this.trans_id +
            "/" +
            this.transcript_id;
    },
 skipCourse() {
    
   window.location =
         "/healthCourse-transcript/" +
            this.student_id +
            "/" +
            this.transcript_id;
    }
  },

};
</script>
