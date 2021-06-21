<template>
  <form
    method="POST"
    class="mb-0 px-0 unstyled-label"
    @submit.prevent="submitCourse()"
  >
    <div
      class="seperator mt-4"
      v-for="(englishCourse,index ) in form.englishCourses"
      :key="englishCourse.id"
    >
      <div class="position-relative">
        <span class="remove" @click="removeCourse(index)"
          ><i class="fas fa-times"></i>
        </span>
        <div class="col-sm-7 px-0">
          <div class="form-group d-sm-flex  align-items-center">
            <select
              class="form-control text-uppercase"
              v-model="englishCourse.subject_name"
            >
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
                Select Credit
              </h3>
              <select
                class="form-control min-select"
                data-toggle="collapse"
                href="#remainingCredits"
                role="button"
                v-model="englishCourse.selectedCredit"
                v-on:change="reCalculateAll"
                aria-expanded="false"
                aria-controls="remainingCredits"
              >
                <option v-for="credit in total_credits" :key="credit.id">
                  {{ credit.credit }}
                </option>
              </select>
              <h3 v-if="isCredit">
                You have
                {{ final_credits[englishCourse.component_index + 1] }}
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
        >Add another English/Language Arts Course</a
      >
        <a class="btn btn-primary" @click="showAllCourses"
        >View All Courses</a
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
      isCredit: true,
      errors: [],
      final_credits: [this.outofcredit.total_credit],
      form: {
        remainingCredit: "",
        course_id: this.courses_id,
        transcript_id: this.transcript_id,
        englishCourses: []
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
    "outofcredit",
    "transcripts"
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

      this.form.englishCourses = courses;
      this.reCalculateAll();
    },
    mounted() {
      this.form.englishCourses[0].selectedCredit = this.required_credit.credit;
      this.final_credits.push(this.calculateRemainingCredit(this.form.englishCourses[0]));
      this.finalValue();
    },
    showCredit(e) {
      this.isCredit = false;
      this.form.remainingCredit =
        this.total_credits.total_credit - e.target.value;
      return this.isCredit;
    },

    calculateRemainingCredit(englishCourse) {
      this.finalValue();
      return this.final_credits[englishCourse.component_index] - englishCourse.selectedCredit;

    },

    reIndex(){
      this.form.englishCourses.forEach((englishCourse, index) => {
        englishCourse.component_index = index;
      });
    },

    reCalculateAll() {
      this.form.englishCourses.forEach((englishCourse, index) => {
        this.final_credits[index + 1] = this.calculateRemainingCredit(englishCourse)
      })
      this.finalValue();
    },
    finalValue(){
      const finalValue = this.final_credits[this.final_credits.length - 1];
      this.form.final_remaining_credit = finalValue;
      console.log('finalValue ', this.final_remaining_credit);

    },
    addCourse() {
      const englishCourse = {
        courses_id: this.courses_id,
        transcript_id: this.transcript_id,
        student_id: this.student_id,
        subject_name: "",
        other_subject: "",
        selectedCredit: 10,
        grade: "",
        total_credits: this.outofcredit.total_credit,
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
          .post(route("editEnglishTranscriptCourse.store"), this.form)
          .then(response => {
            window.location =
              "/edit-mathematics-transcript/" +
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
      for (let i = 0; i < this.form.englishCourses.length; i++) {
        const englishCourse = this.form.englishCourses[i];
        if (!englishCourse.grade) {
          return false;
        }
      }
      return true;
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
        showAllCourses(){
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
