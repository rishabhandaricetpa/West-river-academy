@extends('layouts.app')

@section('content')
<!-- * =============== Main =============== * -->
<main id="mainapp" class="position-relative container form-content mt-4">
  <h1 class="text-center text-white text-uppercase">Graduation application</h1>
  <div class="form-wrap border bg-light py-5 px-25">
      <p>To graduate from West River Academy, please fill out our application. Once your application has been approved, we will invite you continue to pay the fee of $395 and receive instructions on how to complete your Graduation Project and final transcript.</p>
   <div class="col-sm-6 pt-4">
       <form>
       <div class="form-group d-sm-flex mb-1">
        <label for="">Student Name</label>
        <div>{{ $student->first_name.' '.$student->last_name }}</div>
      </div>
      <div class="form-group d-sm-flex mb-1">
        <label for="">Student Email</label>
        <div>
        <input type="text" name="email" id="email" v-model="form.email" value="" class="w-100">
        </div>
      </div>
      <p class="mt-2r mb-4">Please tell us how you completed grades 9,10 and 11.</p>
      <div class="mt-4">
         <p>Grade 9</p>
            <div v-for="option in options" class="form-group d-sm-flex mb-1">
                <input type="radio" required name="grade_nine_option" v-model="form.grade_nine_option" :value="option">
                <label for="" class="w-auto pl-2 pr-0">@{{ option }}</label>
            </div>
            <div class="form-group d-sm-flex mb-1">
                <input type="radio" required name="grade_nine_option" v-model="form.grade_nine_option" value="other">
                <label for="" class="w-auto pl-2 pr-0">Other</label>
                <input type="text" v-model="form.grade_nine_other" value="" class="w-100 ml-3" placeholder="Reason">
            </div>
      </div>

      <div class="mt-4">
         <p>Grade 10</p>
            <div v-for="option in options" class="form-group d-sm-flex mb-1">
                <input type="radio" required name="grade_ten_option" v-model="form.grade_ten_option" :value="option">
                <label for="" class="w-auto pl-2 pr-0">@{{ option }}</label>
            </div>
            <div class="form-group d-sm-flex mb-1">
                <input type="radio" required name="grade_ten_option" v-model="form.grade_ten_option" value="other">
                <label for="" class="w-auto pl-2 pr-0">Other</label>
                <input type="text" v-model="form.grade_ten_other" value="" class="w-100 ml-3" placeholder="Reason">
            </div>
      </div>
      <div class="mt-4">
         <p>Grade 11</p>
            <div v-for="option in options" class="form-group d-sm-flex mb-1">
                <input type="radio" required name="grade_eleven_option" v-model="form.grade_eleven_option" :value="option">
                <label for="" class="w-auto pl-2 pr-0">@{{ option }}</label>
            </div>
            <div class="form-group d-sm-flex mb-1">
                <input type="radio" required name="grade_eleven_option" v-model="form.grade_eleven_option" value="other">
                <label for="" class="w-auto pl-2 pr-0">Other</label>
                <input type="text" v-model="form.grade_eleven_other" value="" class="w-100 ml-3" placeholder="Reason">
            </div>
      </div>
     <button type="button" class="btn btn-primary mt-4" v-on:click="submitForm">Submit</button>
     <button type="button" ref="modal" class="d-none" data-toggle="modal" data-target="#grade"></button>
       </form>
   </div>
    </div>
</main>
<!-- Modal -->
<div class="modal fade text-center" id="grade" tabindex="-1" role="dialog" aria-labelledby="gradeTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <p>Thank you for your application.</p>
        <p>We will review it and notify you of the next steps.</p>
        <button type="button" class="btn btn-primary" v-on:click="redirect" data-dismiss="modal">Okay</button>
      </div>
    </div>
  </div>
</div>
<!-- * =============== /Main =============== * -->
@endsection
@section('manualscript')
<script>
    const graduationApp = new Vue({
        el: '#mainapp',
        data() {
            return {
                form:{
                    student_id:"{{ $student->id }}",
                    email:"{{ $student->email }}",
                    grade_nine_option: '',
                    grade_nine_other: '',
                    grade_ten_option: '',
                    grade_ten_other: '',
                    grade_eleven_option: '',
                    grade_eleven_other: '',
                },
                options: [
                    'I was enrolled in West River Academy.',
                    'I homeschooled independently. (There are no transcripts that a school can send.)',
                    'I was enrolled in another school that can send or has already sent transcripts.'
                ]
            }
        },
        methods:{
            submitForm(){
                if(this.validate()){
                    const elem = this.$refs.modal;

                    axios
                    .post(route("graduation.store"), this.form)
                    .then((response) => {
                        const resp = response.data;
                        resp.status == "success" ? elem.click() : alert(resp.message);
                        })
                    .catch((error) => {
                        console.log(error);
                    });
                }
            },
            validate(){
                if(!this.form.grade_nine_option || !this.form.grade_ten_option || !this.form.grade_eleven_option){
                    alert('Please select an option!');
                    return false;
                }else if(this.form.grade_nine_option === 'other' && !this.form.grade_nine_other){
                    alert('Please enter other reason for Grade 9!');
                    return false;
                }else if(this.form.grade_ten_option === 'other' && !this.form.grade_ten_other){
                    alert('Please enter other reason for Grade 10!');
                    return false;
                }else if(this.form.grade_eleven_option === 'other' && !this.form.grade_eleven_other){
                    alert('Please enter other reason for Grade 11!');
                    return false;
                }

                return true;
            },
            redirect(){
                console.log('here');
                console.log(window);
                window.location = "{{ route('dashboard') }}";
            }
        }
    });
</script>
@endsection