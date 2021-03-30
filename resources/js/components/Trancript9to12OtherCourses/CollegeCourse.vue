<template>
  <form
    method="POST"
    class="mb-0 px-0 unstyled-label"
    @submit.prevent="submitCourse()"
  >
    <div
      class="seperator mt-4"
      v-for="(collegeCourse, index) in form.collegeCourse"
      :key="collegeCourse.id"
    >
      <div class="position-relative">
        <span class="remove" @click="removeEnglishCourse(index)"
          ><i class="fas fa-times"></i>
        </span>
        <div class="col-lg-9 px-0">
          <div class="form-group row  align-items-center">
            <label for="" class="h3 text-black mb-0 col-md-4"
              >What is the full name of the college?</label
            >
            <div class="w-100 col-md-8">
              <input
                type="text"
                class="form-control"
                name=""
                value=""
                v-model="collegeCourse.name"
                aria-describedby=""
                required
              />
            </div>
          </div>
          <div class="form-group d-sm-flex row  align-items-center">
            <label for="" class="h3 text-black mb-0 col-md-4"
              >Name of the Course (name must match exactly the college
              transcript)</label
            >
            <div class="w-100 col-md-8">
              <input
                type="text"
                class="form-control"
                name=""
                value=""
                v-model="collegeCourse.course_name"
                aria-describedby=""
                required
              />
            </div>
          </div>
          <div class="form-group">
            <div class="d-sm-flex mt-4 mb-3">
              <h3>What grade were you in when you took the course?</h3>
            </div>
            <div class="form-check mb-1">
              <input
                class="form-check-input"
                type="radio"
                v-model="collegeCourse.grade"
                value="9"
              />
              <label class="form-check-label" for="">9</label>
            </div>
            <div class="form-check mb-1">
              <input
                class="form-check-input"
                type="radio"
                v-model="collegeCourse.grade"
                value="10"
              />
              <label class="form-check-label" for="">10</label>
            </div>
            <div class="form-check mb-1">
              <input
                class="form-check-input"
                type="radio"
                v-model="collegeCourse.grade"
                value="11"
              />
              <label class="form-check-label" for="">11</label>
            </div>
            <div class="form-check mb-1">
              <input
                class="form-check-input"
                type="radio"
                v-model="collegeCourse.grade"
                value="12"
              />
              <label class="form-check-label" for="">12</label>
            </div>

            <div class="d-sm-flex mt-4 align-items-center">
              <h3>Was it a college level course?</h3>
              <a
                href="#"
                class="btn btn-primary ml-4"
                data-toggle="modal"
                data-target="#GradeHelp"
                >Help me Decide</a
              >
            </div>
            <div class="form-group mb-1">
              <div class="form-check mb-1">
                <input
                  class="form-check-input"
                  type="radio"
                  v-model="collegeCourse.is_college_level"
                  value="Yes"
                />
                <label class="form-check-label" for="">Yes</label>
              </div>
              <div class="form-check mb-1">
                <input
                  class="form-check-input"
                  type="radio"
                  v-model="collegeCourse.is_college_level"
                  value="No"
                />
                <label class="form-check-label" for="">No</label>
              </div>
            </div>
            <div class="d-sm-flex mt-4 align-items-center">
              <h3>What grade did you get in the course?</h3>
            </div>
            <div class="form-group mb-1">
              <div class="form-check mb-1">
                <input
                  class="form-check-input"
                  type="radio"
                  name=""
                  v-model="collegeCourse.course_grade"
                  value="A"
                />
                <label class="form-check-label" for="">A</label>
              </div>
              <div class="form-check mb-1">
                <input
                  class="form-check-input"
                  type="radio"
                  name=""
                  v-model="collegeCourse.course_grade"
                  value="B"
                />
                <label class="form-check-label" for="">B</label>
              </div>
              <div class="form-check mb-1">
                <input
                  class="form-check-input"
                  type="radio"
                  name=""
                  v-model="collegeCourse.course_grade"
                  value="C"
                />
                <label class="form-check-label" for="">C</label>
              </div>
              <div class="form-check mb-1">
                <input
                  class="form-check-input"
                  type="radio"
                  v-model="collegeCourse.course_grade"
                  value="D"
                />
                <label class="form-check-label" for="">D</label>
              </div>
              <div class="form-check mb-1">
                <input
                  class="form-check-input"
                  type="radio"
                  v-model="collegeCourse.course_grade"
                  value="F"
                />
                <label class="form-check-label" for="">F</label>
              </div>
            </div>
            <div class="info-detail lato-italic mt-4">
              <h3>
                Select Credit: The recommended credit for a one-year course is
                selected. You may change it.
              </h3>
              <p>
                A one-semester college level course is equivalent to a one-year
                high school course.
              </p>
              <p>
                If your college transcript shows 3 or more credits, select 1
                credit; otherwise, select 0.50 or 0.25 credit.
              </p>
              <div class="col-sm-2 px-0 mt-3">
                <select
                  name="immunized_status"
                  class="form-control"
                  v-model="collegeCourse.selectedCredit"
                >
                  <option disabled value="">Select one</option>
                  <option v-for="credit in credits" :key="credit.id">{{
                    credit.credit
                  }}</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="mt-2r">
      <a @click="addCourse" class="btn btn-primary"
        >Add another College Course</a
      >
      <button type="submit" class="btn btn-primary ml-4 float-right">
        Continue
      </button>
    </div>
  </form>
</template>

<script>
export default {
  data() {
    return {
      form: {
        student_id: this.student_id,
        transcript_id: this.transcript_id,
        collegeCourse: [
          {
            name: "",
            course_name: "",
            grade: "",
            is_college_level: "",
            course_grade: "",
            selectedCredit: ""
          }
        ]
      }
    };
  },
  props: ["student_id", "transcript_id", "transcript9_12id", "credits"],
  methods: {
    addCourse() {
      this.form.collegeCourse.push({
        name: "",
        course_name: "",
        grade: "",
        is_college_level: "",
        course_grade: "",
        selectedCredit: ""
      });
    },
    submitCourse() {
      axios
        .post(route("collegeCourse.store"), this.form)
        .then(response => {
          window.location = "/display-all-grades/" + this.student_id;
        })
        .catch(error => {
          alert("Please choose the course or remove it");
        });
    }
  }
};
</script>

<style></style>
