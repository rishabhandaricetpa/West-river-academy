<template>
  <form
    method="POST"
    class="mb-0 px-0 unstyled-label"
    @submit.prevent="submitCourse()"
  >
    <div
      class="seperator mt-4"
      v-for="scienceCourse in form.scienceCourse"
      :key="scienceCourse.id"
    >
      <div class="position-relative">
        <span class="remove" @click="removeCourse(index)"
          ><i class="fas fa-times"></i>
        </span>
        <div class="col-sm-7 px-0">
          <h3 class="mb-3">
            Select an Science Arts course:<i
              class="ml-2 fas fa-question-circle tooltip-styling text-secondary"
              data-toggle="tooltip"
              data-placement="top"
              title="Tooltip on top"
            ></i>
          </h3>
          <div class="form-group d-sm-flex  align-items-center">
            <select
              class="form-control text-uppercase"
              v-model="scienceCourse.subject_name"
            >
              <option disabled value="">Please select one</option>
              <option v-for="Course in science" :key="Course">
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
                Select Credit: The recommended credit for a one-year course is
                selected. You may change it.
              </h3>
              <select
                class="form-control min-select"
                data-toggle="collapse"
                href="#remainingCredits"
                role="button"
                v-model="scienceCourse.selectedCredit"
                v-on:change="showCredit"
                aria-expanded="false"
                aria-controls="remainingCredits"
              >
                <option disabled value="">Please select one</option>

                <option v-for="credit in all_credits" :key="credit.id">
                  {{ credit.credit }}
                </option>
              </select>
              <h3 v-if="isCredit">
                You have
                {{ total_credits.total_credit - scienceCourse.selectedCredit }}
                out of
                {{ total_credits.total_credit }}
                remaining credits for this year.
              </h3>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="mt-2r">
      <a class="btn btn-primary" @click="addCourse"
        >Add another Science Course</a
      >
      <button type="submit" class="btn btn-primary ml-4 float-right">
        Continue
      </button>
    </div>
  </form>
</template>

<script>
export default {
  name: "ScienceCourse",
  data() {
    return {
      isCredit: false,
      form: {
        remainingCredit: "",
        course_id: this.courses_id,
        transcript_id: this.transcript_id,
        scienceCourse: [
          {
            course_id: this.courses_id,
            transcript_id: this.transcript_id,
            student_id: this.student_id,
            subject_name: "",
            other_subject: "",
            selectedCredit: "",
            grade: "",
            total_credits: this.total_credits.total_credit
          }
        ]
      }
    };
  },

  props: [
    "science",
    "transcript_id",
    "student_id",
    "courses_id",
    "all_credits",
    "total_credits"
  ],
  methods: {
    showCredit(e) {
      this.isCredit = true;
      this.form.remainingCredit =
        this.total_credits.total_credit - e.target.value;
      return this.isCredit;
    },
    addCourse() {
      this.form.scienceCourse.push({
        course_id: this.courses_id,
        transcript_id: this.transcript_id,
        student_id: this.student_id,
        subject_name: "",
        other_subject: "",
        selectedCredit: "",
        grade: "",
        total_credits: this.total_credits.total_credit
      });
    },
    removeCourse(index) {
      this.form.scienceCourse.splice(index, 1);
    },
    submitCourse() {
      axios
        .post(route("science-transcript.store"), this.form)
        .then(response => {
          window.location =
            "/physicalEducation-transcript/" +
            this.student_id +
            "/" +
            this.transcript_id;
        })
        .catch(error => {
          alert("Please choose the course or remove it");
        });
    }
  }
};
</script>
