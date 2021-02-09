<template>
  <form method="POST" action="">
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
          ><i class="fas fa-times"></i
        ></span>
        <div class="form-group d-sm-flex mt-2r row">
          <div class="col-sm-6">
            <select
              class="form-control mb-4"
              name="english_course"
              id="english_course"
              v-model="form.englishCourse.subject"
            >
              <option v-for="(val, i) in englishcourse" :key="i">
                {{ val.subject_name }}
              </option>
            </select>
            <div class="form-group d-sm-flex">
              <label for="" class="w-auto">Other</label>
              <input type="text" class="form-control" />
            </div>
            <div class="form-group d-sm-flex mt-4">
              <div class="col-sm-3 px-0">
                <h3>Select a Grade</h3>
                <div class="form-check">
                  <input
                    class="form-check-input"
                    type="radio"
                    name="student_grade"
                    value="2"
                  />
                  <label class="form-check-label" for="">
                    A
                  </label>
                </div>
                <div class="form-check">
                  <input
                    class="form-check-input"
                    type="radio"
                    name="student_grade"
                    value="3"
                  />
                  <label class="form-check-label" for="">
                    B
                  </label>
                </div>
                <div class="form-check">
                  <input
                    class="form-check-input"
                    type="radio"
                    name="student_grade"
                    value="4"
                  />
                  <label class="form-check-label" for="">
                    C
                  </label>
                </div>
                <div class="form-check">
                  <input
                    class="form-check-input"
                    type="radio"
                    name="student_grade"
                    value="5"
                  />
                  <label class="form-check-label" for="">
                    D
                  </label>
                </div>
                <div class="form-check">
                  <input
                    class="form-check-input"
                    type="radio"
                    name="student_grade"
                    value="5"
                  />
                  <label class="form-check-label" for="">
                    PASS
                  </label>
                </div>
              </div>
              <div>
                <a
                  href="#chooseGrades"
                  data-toggle="modal"
                  class="btn btn-primary"
                  >Help me decide</a
                >
              </div>
            </div>
            <div class="mt-5">
              <a
                type="button"
                class="btn btn-primary float-left"
                id="addEnglish"
                @click="addNewEnglishCourse"
                >Add another English/Language Arts Course</a
              >
              <a href="#" class="btn btn-primary float-right">Continue</a>
            </div>
          </div>
        </div>
      </div>
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
    "v-select": vSelect
  },
  data() {
    return {
      form: {
        englishCourse: [
          {
            subject: "",
            other_subjcts: "",
            grades: ""
          }
        ]
      },
      removingPeriod: false
    };
  },
  props: ["englishcourse"],
  methods: {
    addNewEnglishCourse() {
      this.form.englishCourse.push({
        subject: "",
        other_subjcts: "",
        grades: ""
      });
    }
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
    }
  }
};
</script>
