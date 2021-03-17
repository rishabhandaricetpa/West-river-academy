<template>
  <form method="POST" @submit.prevent="addCourses()">
    <div
      class="seperator mt-4"
      v-for="(Course, index) in form.Course"
      :key="Course.id"
    >
      <div class="position-relative">
        <span class="remove" @click="removeCourse(index)"
          ><i class="fas fa-times"></i>
        </span>
        <div class="form-group d-sm-flex mt-2r row">
          <div class="col-sm-6">
            <select
              class="form-control mb-4"
              name="english_course"
              id="english_course"
              v-model="Course.subject_name"
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
                placeholder="Enter other course if not present in above courses"
                v-model="Course.other_subject"
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
                        v-model="Course.grade"
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
        @click="addNewCourse"
        >Add another History/Social Science Course</a
      >
      <a
        type="button"
        class="btn btn-primary float-left mr-2 mb-sm-0 mb-3"
        id="addEnglish"
        @click="viewCourses"
        >View All Courses</a
      >
      <button type="submit" class="btn btn-primary mb-sm-0 mb-3">
        Continue
      </button>
    </div>
  </form>
</template>

<script>
import axios from "axios";
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";

export default {
  name: "EditSocialStudiesCourse",
  components: {
    "v-select": vSelect
  },
  data() {
    return {
      grades: [["A", "B", "C", "D", "PASS"]],
      form: {
        courses_id: this.courses_id,
        transcript_id: this.transcript_id,
        Course: []
      },
      removingPeriod: false
    };
  },
  props: [
    "socialstudies",
    "transcripts",
    "english_details",
    "student_id",
    "courses_id",
    "transcript_id"
  ],
  methods: {
    addCourses() {
      axios
        .post(route("editSocialCourse.store"), this.form)
        .then(response => {
          window.location =
            "/edit-math/" + this.student_id + "/" + this.transcript_id;
        })
        .catch(error => {
          alert("Please choose the course or remove it");
        });
    },
    addNewCourse() {
      this.form.Course.push({
        transcript_id: this.transcript_id,
        student_id: this.student_id,
        courses_id: this.courses_id,
        subject_name: "",
        other_subject: "",
        grade: ""
      });
    },
    initForm() {
      const courses = this.transcripts.map(transcript => {
        return {
          transcript_id: transcript.k8transcript_id,
          student_id: transcript.student_profile_id,
          courses_id: transcript.courses_id,
          subject_name: transcript.subject.subject_name,
          other_subject: transcript.other_subject,
          grade: transcript.score
        };
      });

      this.form.Course = courses;
    },
    viewCourses() {
      window.location = "/another-grade/" + this.student_id;
    },
    removeCourse(index) {
      this.form.Course.splice(index, 1);
    }
  },

  created() {
    this.initForm();
  }
};
</script>
