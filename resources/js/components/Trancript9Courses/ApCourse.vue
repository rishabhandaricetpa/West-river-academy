<template>
  <form
    method="POST"
    class="mb-0 px-0 mt-2r unstyled-label collapse"
    id="ap-courses"
    @submit.prevent="submitCredit()"
  >
    <div
      class="seperator mt-4"
      v-for="apCourse in form.apCourses"
      :key="apCourse.id"
    >
      <div class="col-sm-7 px-0">
        <div class="form-group d-sm-flex  align-items-center">
          <label for="" class="h3 text-black mb-0">AP Course Name</label>

          <div class="w-75">
            <input
              type="text"
              class="form-control"
              id=""
              name=""
              value=""
              v-model="apCourse.course_name"
              required
              aria-describedby=""
            />
          </div>
        </div>
        <div class="form-group mb-2 mt-2r">
          <label for="" class="h3 text-black mb-3"
            >What grade did you receive?</label
          >
          <div class="d-sm-flex">
            <div class="form-check">
              <input
                class="form-check-input"
                type="radio"
                required
                v-model="apCourse.grade"
                value="A"
              />
              <label class="form-check-label" for="">A</label>
            </div>
            <div class="form-check ml-5">
              <input
                class="form-check-input"
                type="radio"
                v-model="apCourse.grade"
                value="B"
              />
              <label class="form-check-label" for="">B</label>
            </div>
            <div class="form-check ml-5">
              <input
                class="form-check-input"
                type="radio"
                v-model="apCourse.grade"
                value="C"
              />
              <label class="form-check-label" for="">C</label>
            </div>
          </div>
          <div class="form-group mb-2 mt-2r">
            <label for="" class="h3 text-black mb-3">Select Credit</label>
            <div class="d-sm-flex">
              <div
                class="form-check"
                v-for="credits in all_credits"
                :key="credits.id"
              >
                <div v-for="credit in credits" :key="credit.id">
                  <input
                    class="form-check-input"
                    type="radio"
                    v-model="apCourse.credit"
                    id=""
                    :value="credit"
                    required
                  />

                  <label class="form-check-label" for=""> {{ credit }}</label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="text-center mt-5">
      <button type="submit" class="btn btn-primary">
        I'm finished adding AP Courses
      </button>
      <a @click="addCourses()" class="btn btn-primary ml-4"
        >Add Another AP Course</a
      >
    </div>
  </form>
</template>

<script>
export default {
  name: "ApCourses",
  data() {
    return {
      form: {
        student_id: this.student_id,
        transcript_id: this.transcript_id,
        apCourses: [
          {
            course_name: "",
            grade: "",
            credit: ""
          }
        ]
      }
    };
  },
  props: ["transcript_id", "student_id", "all_credits"],
  methods: {
    addCourses() {
      this.form.apCourses.push({
        course_name: "",
        grade: "",
        credit: ""
      });
    },
    submitCredit() {
      axios
        .post(route("apCourse.store"), this.form)
        .then(response => {
          window.location =
            "/english-transcript/" + this.student_id + "/" + this.transcript_id;
        })
        .catch(error => {
          alert("Unable to add course. Please try later!");
        });
    }
  }
};
</script>
