<template>
  <form method="POST" @submit.prevent="addCourses()">
    <div
      class="seperator mt-4"
      v-for="socialStudiesCourse in form.socialStudiesCourse"
      :key="socialStudiesCourse.id"
    >
      <div class="form-group d-sm-flex mt-2r row">
        <div class="col-sm-6">
          <select
            class="form-control mb-4"
            name="social_studies"
            id="social_studies"
            v-model="socialStudiesCourse.subject"
          >
            <option v-for="(val, i) in socialstudies" :key="i">
              {{ val.subject_name }}
            </option>
          </select>
          <div class="form-group d-sm-flex">
            <label for="" class="w-auto">Other</label>
            <input
              type="text"
              class="form-control"
              v-model="form.socialStudiesCourse.other_subjects"
            />
          </div>
          <div class="form-group d-sm-flex mt-4">
            <div class="col-sm-3 px-0">
              <h3>Select a Grade</h3>
              <a
                href="#chooseGrades"
                data-toggle="modal"
                class="btn btn-primary"
                >Help me decide</a
              >
              <div class="row pl-sm-5">
                <div
                  v-for="(grade, index) in grades"
                  :key="index"
                  class="col-6 col-sm-3"
                >
                  <div v-for="(val, i) in grade" :key="i" class="form-check">
                    <input
                      class="form-check-input"
                      type="radio"
                      :value="val"
                      v-model="socialStudiesCourse.grade"
                      required
                    />
                    <label class="form-check-label pl-1 pl-sm-0" for="">
                      {{ val }}
                    </label>
                  </div>
                </div>
              </div>
              <div></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="mt-5">
      <a
        type="button"
        class="btn btn-primary float-left"
        id="addEnglish"
        @click="addNewEnglishCourse"
        >Add another History/Social Science Course</a
      >
      <button type="submit" class="btn btn-primary">Continue</button>
    </div>
  </form>
</template>
<script>
export default {
  name: "social-studies",
  data() {
    return {
      grades: [["A", "B", "C", "D", "PASS"]],
      form: {
        course_id: this.course_id,
        socialStudiesCourse: [
          {
            student_id: this.student_id,
            courses_id: this.course_id,
            subject: "",
            other_subjects: "",
            grade: "",
          },
        ],
      },
      removingPeriod: false,
    };
  },
  props: ["socialstudies", "student_id", "course_id"],
  methods: {
    addCourses() {
      axios
        .post(route("socialStudiesCourse.store"), this.form)
        .then((response) => {
          window.location = "/mathematics/" + this.student_id;
        });
    },
    addNewEnglishCourse() {
      this.form.socialStudiesCourse.push({
        student_id: this.student_id,
        courses_id: this.course_id,
        subject: "",
        other_subjects: "",
        grades: "",
      });
    },
  },
};
</script>>