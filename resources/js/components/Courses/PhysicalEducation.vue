<template>
  <form method="POST" @submit.prevent="addCourses()">
    <div
      class="seperator mt-4"
      v-for="(physicalEducation,index) in form.physicalEducation"
      :key="physicalEducation.id"
    >  
     <div class="position-relative">
        <span
          class="remove"
          @click="removeEnglishCourse(index)"
          ><i class="fas fa-times"></i>
        </span>
      <div class="form-group d-sm-flex mt-2r row">
        <div class="col-sm-6">
          <select
            class="form-control mb-4"
            name="social_studies"
            id="social_studies"
            v-model="physicalEducation.subject"
          >
            <option v-for="(val, i) in physical_education" :key="i">
              {{ val.subject_name }}
            </option>
          </select>
          <div class="form-group d-sm-flex">
            <label for="" class="w-auto">Other</label>
            <input
              type="text"
              class="form-control"
              v-model="physicalEducation.other_subjects"
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
                      v-model="physicalEducation.grade"
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
        @click="addNewEnglishCourse"
        >Add another Physical Education Course</a
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
        courses_id: this.courses_id,
        transcript_id: this.transcript_id,
        physicalEducation: [
          {
            student_id: this.student_id,
            courses_id: this.courses_id,
            transcript_id: this.transcript_id,
            subject: "",
            other_subjects: "",
            grade: "",
          },
        ],
      },
      removingPeriod: false,
    };
  },
  props: ["physical_education", "student_id", "courses_id", "transcript_id"],
  methods: {
    addCourses() {
      axios
        .post(route("physicalEducation.store"), this.form)
        .then((response) => {
          window.location =
            "/health/" + this.student_id + "/" + this.transcript_id;
        });
    },
    addNewEnglishCourse() {
      this.form.physicalEducation.push({
        student_id: this.student_id,
        courses_id: this.courses_id,
        transcript_id: this.transcript_id,
        subject: "",
        other_subjects: "",
        grades: "",
      });
    },
       removeEnglishCourse(index) {
       this.form.physicalEducation.splice(index, 1)
    }
  },
};
</script>

