<template>
  <form
    method="POST"
    class="mb-0 px-0 unstyled-label"
    @submit.prevent="submitCourse()"
  >
    <div
      class="seperator mt-4"
      v-for="(englishCourse,index) in form.englishCourses"
      :key="englishCourse.id"
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
              v-model="englishCourse.subject_name"
            >
              <option disabled value="">Please select one</option>
              <option v-for="course in englishcourse" :key="course.id">
                {{ course.subject_name }}
              </option
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
                v-model="englishCourse.other_subject"
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
                v-model="englishCourse.grade"
                value="A"
              />
              <label class="form-check-label" for="">A</label>
            </div>
            <div class="form-check mb-1">
              <input
                class="form-check-input"
                type="radio"
                name=""
                v-model="englishCourse.grade"
                value="B"
              />
              <label class="form-check-label" for="">B</label>
            </div>
            <div class="form-check mb-1">
              <input
                class="form-check-input"
                type="radio"
                name=""
                v-model="englishCourse.grade"
                value="C"
              />
              <label class="form-check-label" for="">C</label>
            </div>
            <div class="form-check mb-1">
              <input
                class="form-check-input"
                type="radio"
                v-model="englishCourse.grade"
                name="D"
                value="D"
              />
              <label class="form-check-label" for="">D</label>
            </div>
            <div class="form-check mb-1">
              <input
                class="form-check-input"
                type="radio"
                v-model="englishCourse.grade"
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
                v-model="englishCourse.selectedCredit"
                v-on:change="reCalculateAll"
                aria-expanded="false"
                aria-controls="remainingCredits"
              >
                <option v-for="credit in all_credits" :key="credit.id">
                  {{ credit.credit }}
                </option>
              </select>
              <h3 class="mt-3" v-if='(final_credits[englishCourse.component_index ] - englishCourse.selectedCredit)>=0'>
                You have
                {{ final_credits[englishCourse.component_index + 1] }}
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
    <p v-if="errors.length">
    <ul>
      <li style="color:red" v-for="error in errors" :key="error.id"> {{ error }}</li>
    </ul>
    </p>
 
    <div class="mt-2r">
      <a v-if='this.form.final_remaining_credit >0'  class="btn btn-primary" @click="addCourse"
      >Add another English/Language Arts Course</a
      >
      <button type="submit" class="btn btn-primary ml-4 float-right">
        Continue
      </button>
      <a class="btn btn-primary float-right" @click="skipCourse()">Skip Course</a>
    </div>
  </form>

</template>

<script>
export default {
  name: "EnglishCourse",
  data() {
    return {
      errors: [],
      final_credits: [this.total_credits.total_credit],
      form: {
        required_credit: this.required_credit,
        course_id: this.courses_id,
        transcript_id: this.transcript_id,
        final_remaining_credit:'',
        englishCourses: [
          {
            course_id: this.courses_id,
            transcript_id: this.transcript_id,
            student_id: this.student_id,
            subject_name: "",
            other_subject: "",
            selectedCredit: "",
            grade: "",
            total_credits: this.total_credits.total_credit,
            component_index: 0
          }
        ]
      }
    };
  },

  mounted() {
    this.form.englishCourses[0].selectedCredit = this.required_credit.credit;
    this.final_credits.push(this.calculateRemainingCredit(this.form.englishCourses[0]));
    this.finalValue();
  },
  props: [
    "englishcourse",
    "transcript_id",
    "student_id",
    "courses_id",
    "all_credits",
    "total_credits",
    'required_credit'
  ],
  methods: {

    calculateRemainingCredit(englishCourse) {
       this.finalValue();
      return this.final_credits[englishCourse.component_index] - englishCourse.selectedCredit;
        
    },
    setOtherValue(index){
     this.form.englishCourses[index].subject_name = "";
    },
    reIndex(){
      this.form.englishCourses.forEach((englishCourse, index) => {
        englishCourse.component_index = index;
      });
    },
  validateFinalCredit(){
       if(this.form.final_remaining_credit <0){
       return false;
      }
      return true;
    },
    reCalculateAll() {
      this.form.englishCourses.forEach((englishCourse, index) => {
        this.final_credits[index + 1] = this.calculateRemainingCredit(englishCourse)
      })
        const getFinalCredit= this.finalValue();
     if(getFinalCredit <0){
        alert('Credits are overs , either select smaller value or delete the course');
     }
      this.finalValue();
    },
    finalValue(){
      const finalValue = this.final_credits[this.final_credits.length - 1];
      this.form.final_remaining_credit = finalValue;
      return finalValue;
    },
 
    addCourse() {
      const englishCourse = {
        course_id: this.courses_id,
        transcript_id: this.transcript_id,
        student_id: this.student_id,
        subject_name: "",
        other_subject: "",
        selectedCredit: this.required_credit.credit,
        grade: "",
        total_credits: this.final_credits[this.form.englishCourses.length - 1],
        component_index: this.form.englishCourses.length
      };
      this.final_credits.push(this.calculateRemainingCredit(englishCourse))
      this.form.englishCourses.push(englishCourse);
      this.finalValue();
    },
    removeCourse(index) {
      this.form.englishCourses.splice(index, 1);
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
        this.errors.push(
          "Credit is required Field! Please select a credit "
        );
      }  
       if(!this.validateFinalCredit()){
         this.errors.push(
          "No Credits remaining"
        );
      }
       if(this.validateFinalCredit()){
      axios
        .post(route("english-transcript.store"), this.form)
        .then(response => {
          window.location =
            "/mathematics-transcript/" +
            this.student_id +
            "/" +
            this.transcript_id  ;
        })
        .catch(error => {
          alert("Please fill in the fields");
        });
        }

    },
    validateSubject() {
      for (let i = 0; i < this.form.englishCourses.length; i++) {
        const enrollmentSubject = this.form.englishCourses[i];
        if (!enrollmentSubject.subject_name) {
          return false;
        }
      }
      return true;
    },
    validateCredit() {
      for (let i = 0; i < this.form.englishCourses.length; i++) {
        const enrollmentSubject = this.form.englishCourses[i];
        if (!enrollmentSubject.selectedCredit) {
          return false;
        }
      }
      return true;
    },
    validateOtherSubject() {
      for (let i = 0; i < this.form.englishCourses.length; i++) {
        const enrollmentOtherSubject = this.form.englishCourses[i];
        if (!enrollmentOtherSubject.other_subject) {
          return false;
        }
      }
      return true;
    },
     skipCourse() {
    
   window.location =
            "/mathematics-transcript/" +
            this.student_id +
            "/" +
            this.transcript_id  ;
    }

  },
};
</script>
