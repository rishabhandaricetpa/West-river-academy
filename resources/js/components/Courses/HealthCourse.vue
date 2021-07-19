<template>
  <form class="mb 0" method="POST" @submit.prevent="addCourses()">
    <div
      class="seperator mt-4"
      v-for="(healthCourse, index) in form.healthCourse"
      :key="healthCourse.id"
    >
      <div class="position-relative">
        <span class="remove" @click="removeHealthCourse(index)"
          ><i class="fas fa-times"></i>
        </span>
        <div class="form-group d-sm-flex mt-2r row">
          <div class="col-sm-6">
            <select
              class="form-control mb-4"
              name="health_course"
              id="health_course"
              v-model="healthCourse.subject"
            >
              <option disabled value="">Please select one</option>
              <option v-for="(val, i) in healthstudies" :key="i">
                {{ val.subject_name }}
              </option>
            </select>
            <div class="form-group d-sm-flex">
              <label for="" class="w-auto">Other</label>
              <input
                type="text"
                class="form-control"
                placeholder="Enter other course if not present in above courses"
                v-model="healthCourse.other_subjects"
              />
            </div>
            <div class="form-group d-sm-flex mt-4">
              <div class="col-sm-3 px-0">
                <h3>Select a Grade</h3>
                <a
                  href="#chooseGrades"
                  data-toggle="modal"
                  class="btn btn-primary"
                  >Help me Decide</a
                >
                <div class="row pl-sm-5 mt-3">
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
                        v-model="healthCourse.grade"
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
    </div>
    <div class="mt-4">
      <a
        type="button"
        class="btn btn-primary float-left mr-2 mb-sm-0 mb-3"
        id="addEnglish"
        @click="addNewSocialScienceCourse"
        >Add another Health Course</a
      >
      <button type="submit" class="btn btn-primary">Continue</button>
    </div>
  </form>
</template>

<script>
import axios from "axios";
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";

export default {
  name: "HealthCourse",
  components: {
    "v-select": vSelect
  },
  data() {
    return {
      grades: [["A", "B", "C", "D", "PASS"]],
      form: {
        courses_id: this.courses_id,
        transcript_id: this.transcript_id,
        healthCourse: [
          {
            transcript_id: this.transcript_id,
            student_id: this.student_id,
            courses_id: this.courses_id,
            subject: "",
            other_subjects: "",
            grade: ""
          }
        ]
      },
      removingPeriod: false
    };
  },
  props: ["healthstudies", "transcript_id", "student_id", "courses_id"],
  methods: {
    addCourses() {
      axios
        .post(route("health.store"), this.form)
        .then(response => {
          window.location =
            "/foreign/" + this.student_id + "/" + this.transcript_id;
        })
        .catch(error => {
          alert("Please choose a course or click the X button on the top right of the screen to continue .");
        });
    },
    addNewSocialScienceCourse() {
      this.form.healthCourse.push({
        transcript_id: this.transcript_id,
        student_id: this.student_id,
        courses_id: this.courses_id,
        subject: "",
        other_subjects: "",
        grades: ""
      });
    },
    removeHealthCourse(index) {
      this.form.healthCourse.splice(index, 1);
    }
  }
};
</script>
