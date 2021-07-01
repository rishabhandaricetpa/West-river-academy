<template>
<div v-if="this.remaining_credit >0 ">
  <form
    method="POST"
    class="mb-0 px-0 unstyled-label"
    @submit.prevent="submitCourse()"
  >
    <div
      class="seperator mt-4"
      v-for="(electiveCourse,index) in form.electiveCourse"
      :key="electiveCourse.id"
    >
      <div class="position-relative">
        <span class="remove" @click="removeCourse(index)"
          ><i class="fas fa-times"></i>
        </span>
        <div class="col-sm-7 px-0">
          <div class="form-group d-sm-flex  align-items-center">
            <select
              class="form-control text-uppercase"
              v-model="electiveCourse.subject_name"
            >
              <option v-for="Course in electivecourse" :key="Course.id">
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
                v-model="electiveCourse.other_subject"
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
                v-model="electiveCourse.grade"
                value="A"
              />
              <label class="form-check-label" for="">A</label>
            </div>
            <div class="form-check mb-1">
              <input
                class="form-check-input"
                type="radio"
                name=""
                v-model="electiveCourse.grade"
                value="B"
              />
              <label class="form-check-label" for="">B</label>
            </div>
            <div class="form-check mb-1">
              <input
                class="form-check-input"
                type="radio"
                name=""
                v-model="electiveCourse.grade"
                value="C"
              />
              <label class="form-check-label" for="">C</label>
            </div>
            <div class="form-check mb-1">
              <input
                class="form-check-input"
                type="radio"
                v-model="electiveCourse.grade"
                name="D"
                value="D"
              />
              <label class="form-check-label" for="">D</label>
            </div>
            <div class="form-check mb-1">
              <input
                class="form-check-input"
                type="radio"
                v-model="electiveCourse.grade"
                name=""
                value="PASS"
              />
              <label class="form-check-label" for="">PASS</label>
            </div>
            <div class="form-group mb-1 mt-2r">
              <h3 class="text-black">
                Select Credit
              </h3>
              <select
                class="form-control min-select"
                data-toggle="collapse"
                href="#remainingCredits"
                role="button"
                v-model="electiveCourse.selectedCredit"
                  v-on:change="reCalculateAll"
                aria-expanded="false"
                aria-controls="remainingCredits"
              >
                <option v-for="credit in all_credits" :key="credit.id">
                  {{ credit.credit }}
                </option>
              </select>
              <h3 >
                You have
                {{ final_credits[electiveCourse.component_index + 1] }}
                out of
                {{ outofcredit.total_credit }}
                remaining credits for this year.
              </h3>
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
      <a class="btn btn-primary" @click="addCourse"
        >Add another Elective Course</a
      >
      <a
        type="button"
        class="btn btn-primary float-left mr-2 mb-sm-0 mb-3"
        id="addEnglish"
        @click="viewCourses"
        >View All Courses</a
      >
  <button type="submit" class="btn btn-primary ml-4 float-right">
        Continue
      </button>
    </div>
  </form>
     </div>
  <div v-else>
  No Credits Remaining
  <input type="submit" value="Continue" class="btn btn-primary ml-4 float-right" @click="viewCourses"/>
</div>
</template>

<script>
export default {
  name: "ElectiveCourse",
  data() {
    return {
      isCredit: false,
      errors: [],
       final_credits: [this.remaining_credit],
      form: {
        remainingCredit: "",
        course_id: this.courses_id,
        transcript_id: this.transcript_id,
        electiveCourse: []
      }
    };
  },

  props: [
    "electivecourse",
    "transcript_id",
    "student_id",
    "courses_id",
    "total_credits",
    "outofcredit",
    "transcripts",
    'selected_credit',
    'remaining_credit',
    'all_credits'
  ],
  methods: {
    initForm() {
      const courses = this.transcripts.map((transcript,index) => {
        return {
          courses_id: transcript.courses_id,
          transcript_id: this.transcript_id,
          student_id: this.student_id,
          subject_name: transcript.subject.subject_name,
          other_subject: transcript.other_subject,
          grade: transcript.score,
          selectedCredit: transcript.selectedCredit,
          total_credits: this.outofcredit.total_credit,
           component_index: index
        };
      });

      this.form.electiveCourse = courses;
        this.reCalculateAll();
    },
      mounted() {
      this.form.electiveCourse[0].selectedCredit = this.required_credit.credit;
      this.final_credits.push(this.calculateRemainingCredit(this.form.electiveCourse[0]));
      this.finalValue();
    },
    
      calculateRemainingCredit(electiveCourse) {
      this.finalValue();
      return this.final_credits[electiveCourse.component_index] - electiveCourse.selectedCredit;

    },
      reIndex(){
      this.form.electiveCourse.forEach((electiveCourse, index) => {
        electiveCourse.component_index = index;
      });
    },

    reCalculateAll() {
      this.form.electiveCourse.forEach((electiveCourse, index) => {
        this.final_credits[index + 1] = this.calculateRemainingCredit(electiveCourse)
      })
      this.finalValue();
    },
    finalValue(){
      const finalValue = this.final_credits[this.final_credits.length - 1];
      this.form.final_remaining_credit = finalValue;
      console.log('finalValue ', this.final_remaining_credit);

    },
    addCourse() {
      const electiveCourse ={
        courses_id: this.courses_id,
        transcript_id: this.transcript_id,
        student_id: this.student_id,
        subject_name: "",
        other_subject: "",
        selectedCredit: this.selected_credit.credit,
        grade: "",
        total_credits: this.outofcredit.total_credit,
         component_index: this.form.electiveCourse.length
      };
       this.final_credits.push(this.calculateRemainingCredit(electiveCourse))
      this.form.electiveCourse.push(electiveCourse);
      this.finalValue();
    },
    removeCourse(index) {
       this.form.electiveCourse.splice(index, 1);
      this.final_credits.splice(this.final_credits.length - 1, 1);
      this.reIndex();
      this.reCalculateAll();
    },
    submitCourse() {
      this.errors = [];
      if (!this.vallidateGrades()) {
        this.errors.push(
          "Grade is a required Field! Please select a Grade and then continue."
        );
      }
      if (!this.validateSubject()) {
        this.errors.push(
          "Course name is a required Field! Please select a Grade and then continue."
        );
      }
      if (!this.validateCredit()) {
        this.errors.push(
          "Credit is a required Field! Please select a Grade and then continue."
        );
      }
        if(!this.validateFinalCredit()){
         this.errors.push(
          "Credits cann't be negative"
        );
      }
      if (
        this.vallidateGrades() &&
        this.validateSubject() &&
        this.validateCredit() && this.validateFinalCredit()
      ) {
        axios
          .post(route("editElectiveTranscriptCourse.store"), this.form)
          .then(response => {
            window.location =
              "/display-course-details/" +
            this.transcript_id +
            "/" +
            this.student_id;
          })
          .catch(error => {
            alert("Please fill in the fields");
          });
      }
    },
    vallidateGrades() {
      for (let i = 0; i < this.form.electiveCourse.length; i++) {
        const electiveCourse = this.form.electiveCourse[i];
        if (!electiveCourse.grade) {
          return false;
        }
      }
      return true;
    },
    validateSubject() {
      for (let i = 0; i < this.form.electiveCourse.length; i++) {
        const enrollmentSubject = this.form.electiveCourse[i];
        if (!enrollmentSubject.subject_name) {
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
    validateCredit() {
      for (let i = 0; i < this.form.electiveCourse.length; i++) {
        const enrollmentSubject = this.form.electiveCourse[i];
        if (!enrollmentSubject.selectedCredit) {
          return false;
        }
      }
      return true;
    },
    viewCourses(){
  window.location =
            "/display-course-details/" +
            this.transcript_id +
            "/" +
            this.student_id;
    }
  },
  created() {
    this.initForm();
  }
};
</script>
