<template>
  <form method="POST" @submit.prevent="addCourses()">
    <div
      class="seperator mt-4"
      v-for="science in form.sciencecourse"
      :key="science.id"
    >
      <div class="position-relative">
        <div class="form-group d-sm-flex mt-2r row">
          <div class="col-sm-6">
            <select
              class="form-control mb-4"
              name="maths_course"
              id="maths_course"
              required
              v-model="science.subject"
            >
              <option v-for="(val, i) in sciencecourse" :key="i">
                {{ val.subject_name }}
              </option>
            </select>
            <div class="form-group d-sm-flex">
              <label for="" class="w-auto">Other</label>
              <input
                type="text"
                class="form-control"
                v-model="form.sciencecourse.other_subjects"
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
                        v-model="science.grade"
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
        >Add another Science Course</a
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
  name: "ScienceCourse",
  components: {
    "v-select": vSelect,
  },
  data() {
    return {
      grades: [["A", "B", "C", "D", "PASS"]],
      form: {
        courses_id: this.courses_id,
        sciencecourse: [
          {
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
  props: ["sciencecourse", "student_id", "courses_id"],
  methods: {
    addCourses() {
      axios.post(route("science.store"), this.form).then((response) => {
        window.location = "/physical-education/" + this.student_id;
      });
    },
    addNewSocialScienceCourse() {
      this.form.sciencecourse.push({
        transcript_id: this.transcript_id,
        student_id: this.student_id,
        courses_id: this.courses_id,
        subject: "",
        other_subjects: "",
        grade: "",
      });
    },
  },
  removeEnglishCourse(index) {
    if (this.removingPeriod) {
      return;
    }
    this.removingPeriod = true;

    let reqData = JSON.parse(JSON.stringify(this.form)); // copying object wihtout reference
    reqData.sciencecourse.splice(index, 1);
  },
  computed: {
    // canRemovePeriod() {
    //   return this.form.sciencecourse.length > 1;
    // },
  },
};
</script>
