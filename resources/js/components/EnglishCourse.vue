<template>
  <form method="POST" @submit.prevent="addCourses()">
    <div
      class="seperator mt-4"
      v-for="(englishCourse, index) in form.englishCourse"
      :key="englishCourse.id"
    >
      <div class="position-relative">
        <span
          v-if="canRemovePeriod"
          class="remove"
          @click="removeEnglishCourse(index)"
          ><i class="fas fa-times"></i>
        </span>
        <div class="form-group d-sm-flex mt-2r row">
          <div class="col-sm-6">
            <select
              class="form-control mb-4"
              name="english_course"
              id="english_course"
              required
              v-model="englishCourse.subject"
            >
              <option v-for="(val, i) in englishcourse" :key="i">
                {{ val.subject_name }}
              </option>
            </select>
            <div class="form-group d-sm-flex">
              <label for="" class="w-auto">Other</label>
              <input
                type="text"
                class="form-control"
                v-model="form.englishCourse.other_subjects"
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
                        v-model="englishCourse.grade"
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
        class="btn btn-primary float-left"
        id="addEnglish"
        @click="addNewSocialScienceCourse"
        >Add another English/Language Arts Course</a
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
  name: "EnglishCourse",
  components: {
    "v-select": vSelect,
  },
  data() {
    return {
      grades: [["A", "B", "C", "D", "PASS"]],
      form: {
        courses_id: this.courses_id,
        transcript_id: this.transcript_id,
        englishCourse: [
          {
            transcript_id: this.transcript_id,
            student_id: this.student_id,
            courses_id: this.courses_id,
            subject: "",
            other_subjects: "",
            grade: "",
          },
        ],
      },
      removingPeriod: false,
    };
  },
  props: ["englishcourse", "transcript_id", "student_id", "courses_id"],
  methods: {
    addCourses() {
      axios.post(route("englishCourse.store"), this.form).then((response) => {
        window.location =
          "/social-studies/" + this.student_id + "/" + this.transcript_id;
      });
    },
    addNewSocialScienceCourse() {
      this.form.englishCourse.push({
        transcript_id: this.transcript_id,
        student_id: this.student_id,
        courses_id: this.courses_id,
        subject: "",
        other_subjects: "",
        grades: "",
      });
    },
  },
  removeEnglishCourse(index) {
    if (this.removingPeriod) {
      return;
    }
    this.removingPeriod = true;

    let reqData = JSON.parse(JSON.stringify(this.form)); // copying object wihtout reference
    reqData.englishCourse.splice(index, 1);
  },
  computed: {
    canRemovePeriod() {
      return this.form.englishCourse.length > 1;
    },
  },
};
</script>
