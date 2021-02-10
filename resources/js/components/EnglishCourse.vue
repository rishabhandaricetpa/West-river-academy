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
          ><i class="fas fa-times"></i>
        </span>
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
                        v-model="form.englishCourse.grade"
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
      grades: [["A", "B", "C", "D", "PASS"]],
      form: {
        englishCourse: [
          {
            subject: "",
            other_subjcts: "",
            grade: ""
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
