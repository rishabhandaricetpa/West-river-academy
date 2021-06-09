<template>
  <form
    method="POST"
    class="mb-0 px-0 unstyled-label"
    @submit.prevent="submitCourse()"
  >
    <div
      class="seperator mt-4"
      v-for="(englishCourse,index) in form.englishCourse"
      :key="englishCourse.id"
    > 
      <div class="position-relative">
        <span class="remove place-top" @click="removeCourse(index)"
          ><i class="fas fa-times"></i>
        </span>
        <div class="col-sm-7 px-0">
          <div class="form-group d-sm-flex  align-items-center">
            <select
              class="form-control text-uppercase"
              v-model="englishCourse.subject_name"
            >
              <option disabled value="">Please select one</option>
              <option v-for="Course in englishcourse" :key="Course">
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
                v-on:change="showCredit"
                aria-expanded="false"
                aria-controls="remainingCredits"
              >
                

                <option v-for="credit in all_credits" :key="credit.id" >
                 
                  {{ credit.credit }}
                </option>
              </select>
              <h3 v-if="isCredit" class="mt-3">
                You have
                {{ total_credits.total_credit - englishCourse.selectedCredit }}
                out of
                {{ total_credits.total_credit }}
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
        >Add another English/Language Arts Course</a
      >
      <button type="submit" class="btn btn-primary ml-4 float-right">
        Continue
      </button>
    </div>
  </form>
</template>

<script>
export default {
  name: "EnglishCourse",
  data() {
    return {
      isCredit: false,
      errors: [],
      form: {
        remainingCredit: "",
        required_credit :this.required_credit,
        course_id: this.courses_id,
        transcript_id: this.transcript_id,

        englishCourse: [
          {
            course_id: this.courses_id,
            transcript_id: this.transcript_id,
            student_id: this.student_id,
            subject_name: "",
            other_subject: "",
            selectedCredit: this.required_credit.credit,
            grade: "",
            total_credits: this.total_credits.total_credit
          }
        ]
      }
    };
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
    
    showCredit(e) {
      this.isCredit = true;
      this.form.remainingCredit =
        this.total_credits.total_credit - e.target.value;
      return this.isCredit;
    },
    addCourse() {
      this.form.englishCourse.push({
        course_id: this.courses_id,
        transcript_id: this.transcript_id,
        student_id: this.student_id,
        subject_name: "",
        other_subject: "",
        selectedCredit: this.required_credit.credit,
        grade: "",
        total_credits: this.total_credits.total_credit
      });
    },
    removeCourse(index) {
      this.form.englishCourse.splice(index, 1);
    },
    submitCourse() {
      this.errors = [];
     
  
      if(!this.validateSubject() && !this.validateOtherSubject()){
          this.errors.push(
          "Course name is required Field! Please select a Course name"
        );
      }
         if(!this.validateCredit()){
         this.errors.push(
          "Credit is required Field! Please select a credit "
        );
      }
      
         axios
        .post(route("english-transcript.store"), this.form)
        .then(response => {
          window.location =
            "/mathematics-transcript/" +
            this.student_id +
            "/" +
            this.transcript_id;
        })
        .catch(error => {
          alert("Please fill in the fields");
        });
      
    
    },

    validateSubject(){
      for(let i=0;i<this.form.englishCourse.length;i++){
        const enrollmentSubject = this.form.englishCourse[i];
         if(!enrollmentSubject.subject_name){
         return false;
        }
     }
     return true;
    },
      validateCredit(){
      for(let i=0;i<this.form.englishCourse.length;i++){
        const enrollmentSubject = this.form.englishCourse[i];
         if(!enrollmentSubject.selectedCredit){
         return false;
        }
     }
     return true;
    },
    validateOtherSubject(){
      for(let i=0;i<this.form.englishCourse.length;i++){
        const enrollmentOtherSubject = this.form.englishCourse[i];
         if(!enrollmentOtherSubject.other_subject){
         return false;
        }
     }
         return true;
    } 
    

  },
   computed:{
     showCredit(selectedCredit) {
      this.isCredit = true;
      this.form.remainingCredit =
        this.total_credits.total_credit - selectedCredit;
      return this.isCredit;
    },
  }
};
</script>
