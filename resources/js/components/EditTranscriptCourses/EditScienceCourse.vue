<template>
<div v-if="this.remaining_credit >0 ">
  <form
    method="POST"
    class="mb-0 px-0 unstyled-label"
    @submit.prevent="submitCourse()"
  >
    <div
      class="seperator mt-4"
      v-for="(scienceCourse,index) in form.scienceCourse"
      :key="scienceCourse.id"
    >
      <div class="position-relative">
        <span class="remove" @click="removeCourse(index)"
          ><i class="fas fa-times"></i>
        </span>
        <div class="col-sm-7 px-0">
          <div class="form-group d-sm-flex  align-items-center">
            <select
              class="form-control text-uppercase"
              v-model="scienceCourse.subject_name"
            >
              <option v-for="Course in sciencecourse" :key="Course">
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
                v-model="scienceCourse.other_subject"
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
                v-model="scienceCourse.grade"
                value="A"
              />
              <label class="form-check-label" for="">A</label>
            </div>
            <div class="form-check mb-1">
              <input
                class="form-check-input"
                type="radio"
                name=""
                v-model="scienceCourse.grade"
                value="B"
              />
              <label class="form-check-label" for="">B</label>
            </div>
            <div class="form-check mb-1">
              <input
                class="form-check-input"
                type="radio"
                name=""
                v-model="scienceCourse.grade"
                value="C"
              />
              <label class="form-check-label" for="">C</label>
            </div>
            <div class="form-check mb-1">
              <input
                class="form-check-input"
                type="radio"
                v-model="scienceCourse.grade"
                name="D"
                value="D"
              />
              <label class="form-check-label" for="">D</label>
            </div>
            <div class="form-check mb-1">
              <input
                class="form-check-input"
                type="radio"
                v-model="scienceCourse.grade"
                name=""
                value="Pass"
              />
              <label class="form-check-label" for="">Pass</label>
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
                v-model="scienceCourse.selectedCredit"
                v-on:change="reCalculateAll"
                aria-expanded="false"
                aria-controls="remainingCredits"
              >
                <option v-for="credit in total_credits" :key="credit.id">
                  {{ credit.credit }}
                </option>
              </select>
              <h3 >
                You have
               {{ final_credits[scienceCourse.component_index + 1] }}
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
        >Add another  History/Social Science Course</a
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
  <input type="submit" value="Continue" class="btn btn-primary ml-4 float-right" @click="nextCourse"/>
</div>
</template>

<script>
export default {
  name: "MathsCourse",
  data() {
    return {
      errors: [],
      final_credits: [this.remaining_credit],
      form: {
        remainingCredit: "",
        course_id: this.courses_id,
        transcript_id: this.transcript_id,
        scienceCourse: []
      }
    };
  },

  props: [
    "sciencecourse",
    "transcript_id",
    "student_id",
    "courses_id",
    "all_credits",
    "total_credits",
    "outofcredit",
    "transcripts",
    'remaining_credit',
    'selected_credit'
  ],
  methods: {
    initForm() {
      const courses = this.transcripts.map((transcript ,index)=> {
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

      this.form.scienceCourse = courses;
       this.reCalculateAll();
    },
     mounted() {
      this.form.scienceCourse[0].selectedCredit = this.required_credit.credit;
      this.final_credits.push(this.calculateRemainingCredit(this.form.scienceCourse[0]));
      this.finalValue();
    },
    
      calculateRemainingCredit(scienceCourse) {
      this.finalValue();
      return this.final_credits[scienceCourse.component_index] - scienceCourse.selectedCredit;

    },
      reIndex(){
      this.form.scienceCourse.forEach((scienceCourse, index) => {
        scienceCourse.component_index = index;
      });
    },

    reCalculateAll() {
      this.form.scienceCourse.forEach((scienceCourse, index) => {
        this.final_credits[index + 1] = this.calculateRemainingCredit(scienceCourse)
      })
      this.finalValue();
    },
    finalValue(){
      const finalValue = this.final_credits[this.final_credits.length - 1];
      this.form.final_remaining_credit = finalValue;
      console.log('finalValue ', this.final_remaining_credit);

    },
    addCourse() {
      const scienceCourse ={
        courses_id: this.courses_id,
        transcript_id: this.transcript_id,
        student_id: this.student_id,
        subject_name: "",
        other_subject: "",
        selectedCredit: this.selected_credit.credit,
        grade: "",
         total_credits: this.outofcredit.total_credit,
         component_index: this.form.scienceCourse.length
      };
      this.final_credits.push(this.calculateRemainingCredit(scienceCourse))
      this.form.scienceCourse.push(scienceCourse);
      this.finalValue();
    },
    removeCourse(index) {
       this.form.scienceCourse.splice(index, 1);
       this.final_credits.splice(this.final_credits.length - 1, 1);
      this.reIndex();
      this.reCalculateAll();
    },
    submitCourse() {
      this.errors = [];
      if (!this.vallidateGrades()) {
        this.errors.push(
          "Grade is required Field! Please select a Grade and then continue"
        );
      }
      if (!this.validateSubject()) {
        this.errors.push(
          "Course name is required Field! Please select a Grade and then continue"
        );
      }
      if (!this.validateCredit()) {
        this.errors.push(
          "Credit is required Field! Please select a Grade and then continue"
        );
      }
      if (
        this.vallidateGrades() &&
        this.validateSubject() &&
        this.validateCredit()
      ) {
        axios
          .post(route("editScienceTranscriptCourse.store"), this.form)
          .then(response => {
            window.location =
              "/edit-physicalEducation-transcript/" +
              this.student_id +
              "/" +
              this.transcript_id;
          })
          .catch(error => {
            alert("Please fill in the fields");
          });
      }
    },
    vallidateGrades() {
      for (let i = 0; i < this.form.scienceCourse.length; i++) {
        const scienceCourse = this.form.scienceCourse[i];
        if (!scienceCourse.grade) {
          return false;
        }
      }
      return true;
    },
    validateSubject() {
      for (let i = 0; i < this.form.scienceCourse.length; i++) {
        const enrollmentSubject = this.form.scienceCourse[i];
        if (!enrollmentSubject.subject_name) {
          return false;
        }
      }
      return true;
    },
    validateCredit() {
      for (let i = 0; i < this.form.scienceCourse.length; i++) {
        const enrollmentSubject = this.form.scienceCourse[i];
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
