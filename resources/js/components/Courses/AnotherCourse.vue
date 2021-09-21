<template>
  <form method="POST" @submit.prevent="addCourses()">
    <div
      class="seperator mt-4"
      v-for="(anotherCourse, index) in form.anotherCourse"
      :key="anotherCourse.id"
    >
      <div class="position-relative">
        <p v-if="index>0" class="delete-course">Delete Course </p>
        <span v-if="index>0" class="remove place-top" @click="removeForeignCourse(index)"
          ><i class="fas fa-times"></i>
        </span>
        <div class="form-group d-sm-flex mt-2r row">
          <div class="col-sm-6">
            <select
              class="form-control mb-4"
              name="health_course"
              id="health_course"
              v-model="anotherCourse.subject"
            >
              <option disabled value="">Please select one</option>
              <option v-for="(val, i) in anotherstudies" :key="i">
                {{ val.subject_name }}
              </option>
            </select>
            <div class="form-group d-sm-flex">
              <label for="" class="w-auto">Other</label>
              <input
                type="text"
                class="form-control"
                v-model="anotherCourse.other_subjects"
                placeholder="Enter other course if not present in above courses"
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
                        v-model="anotherCourse.grade"
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
    <div class="mt-5">
      <a
        type="button"
        class="btn btn-primary float-left mr-2 mb-sm-0 mb-3"
        id="addEnglish"
        @click="addNewSocialScienceCourse"
        >Add an Another Course</a
      >
      <button type="submit" class="btn btn-primary">Continue</button>
      <a class="btn btn-primary float-right" @click="skipCourse()">Skip Course</a>
    </div>
  </form>
</template>

<script>
import axios from "axios";
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";

export default {
  name: "AnotherCourse",
  components: {
    "v-select": vSelect
  },
  data() {
    return {
      grades: [["A", "B", "C", "D", "PASS"]],
      form: {
        courses_id: this.courses_id,
        transcript_id: this.transcript_id,
        anotherCourse: [
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
  props: [
    "anotherstudies",
    "transcript_id",
    "student_id",
    "courses_id",
    "trans_id"
  ],
  methods: {
    addCourses() {
      axios
        .post(route("another.store"), this.form)
        .then(response => {
          window.location =
            "/choose-another/" + this.student_id + "/" + this.trans_id;
        })
        .catch(error => {
          alert(
            "Please choose a course or click the X button on the top right of the screen to continue ."
          );
        });
    },
    addNewSocialScienceCourse() {
      this.form.anotherCourse.push({
        transcript_id: this.transcript_id,
        student_id: this.student_id,
        courses_id: this.courses_id,
        subject: "",
        other_subjects: "",
        grades: ""
      });
    },
    removeForeignCourse(index) {
      this.form.anotherCourse.splice(index, 1);
    },
    skipCourse() {
      window.location =
     "/choose-another/" + this.student_id + "/" + this.trans_id;
    }
  }
};
</script>
