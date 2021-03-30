/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./custom');
window.Vue = require('vue');
Vue.use(require('vue-moment'));


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


Vue.component('enroll-student', require('./components/EnrollStudent.vue').default);
Vue.component('edit-enroll', require('./components/EditEnrollStudent.vue').default);
Vue.component('billing-shipping', require('./components/address.vue').default);
Vue.component('get-cart', require('./components/Cart.vue').default);
Vue.component('notification-bell', require('./components/Notification.vue').default);

//courses - K-8
Vue.component('english-course', require('./components/Courses/EnglishCourse.vue').default);
Vue.component('social-studies', require('./components/Courses/SocialStudiesCourse.vue').default);
Vue.component('maths-course', require('./components/Courses/Maths.vue').default);
Vue.component('science-course', require('./components/Courses/ScienceCourse.vue').default);
Vue.component('physical-educatiom', require('./components/Courses/PhysicalEducation.vue').default);
Vue.component('health-course', require('./components/Courses/HealthCourse.vue').default);
Vue.component('foreign-course', require('./components/Courses/ForeignCourse.vue').default);
Vue.component('another-course', require('./components/Courses/AnotherCourse.vue').default);

//edit courses K-8

Vue.component('edit-english-course', require('./components/EditCourses/EditEnglishCourse.vue').default);
Vue.component('edit-social-studies', require('./components/EditCourses/EditSocialStudies.vue').default);
Vue.component('edit-maths', require('./components/EditCourses/EditMathsCourse.vue').default);
Vue.component('edit-science', require('./components/EditCourses/EditScienceCourse.vue').default);
Vue.component('edit-physical', require('./components/EditCourses/EditPhysicalEducationCourse.vue').default);
Vue.component('edit-health', require('./components/EditCourses/EditHealthCourse.vue').default);
Vue.component('edit-foreign', require('./components/EditCourses/EditForeignCourse.vue').default);
Vue.component('edit-another', require('./components/EditCourses/EditAnotherCourse.vue').default);
Vue.component('ap-course', require('./components/Trancript9to12OtherCourses/ApCourse.vue').default);

//courses 9-12
Vue.component('english-transcript-course', require('./components/TranscriptCourses/EnglishCourse.vue').default);
Vue.component('maths-transcript-course', require('./components/TranscriptCourses/MathsCourse.vue').default);
Vue.component('history-transcript-course', require('./components/TranscriptCourses/HistoryCourse.vue').default);
Vue.component('science-transcript-course', require('./components/TranscriptCourses/ScienceCourse.vue').default);
Vue.component('physical-transcript-course', require('./components/TranscriptCourses/PhysicalEducationCourse.vue').default);
Vue.component('health-transcript-course', require('./components/TranscriptCourses/HealthCourse.vue').default);
Vue.component('foreign-transcript-course', require('./components/TranscriptCourses/ForeignCourse.vue').default);
Vue.component('another-transcript-course', require('./components/TranscriptCourses/AnotherCourse.vue').default);

// college information
Vue.component('college-course', require('./components/Trancript9to12OtherCourses/CollegeCourse.vue').default);


// edit transcript 9-12 courses
Vue.component('edit-english-transcript-course', require('./components/EditTranscriptCourses/EditEnglishCourse.vue').default);
Vue.component('edit-mathematics-transcript-course', require('./components/EditTranscriptCourses/EditMathematicsCourse.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

const notification = new Vue({
    el: '#notification-container',
});
