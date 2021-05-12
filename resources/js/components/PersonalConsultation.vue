<template>
  <form method="POST" @submit.prevent="addconsultation()">
    <p>
      We would be happy to speak with you and your student(s) to advise on
      educational situations, materials, resources and transcripts. You may
      choose English or Spanish as your preferred language for the consultation.
    </p>
    <input
          type="hidden"
          class="form-control col-3"
          name="order_consultation"
          v-model="form.type" 
        />
    <div class="form-group mb-2 lato-italic info-detail pb-4">
      <h3 class="mb-3">Please choose the languge you prefer.</h3>
      <div class="form-check mb-2">
        <input
          class="form-check-input"
          type="radio"
          name="preferred_language"
          id="select-english"
          value="English"
          v-model="form.preferred_language"
          required
        />
        <label class="form-check-label" for="">
          English
        </label>
      </div>
      <div class="form-check mb-2">
        <input
          class="form-check-input"
          type="radio"
          id="select-spanish"
          name="preferred_language"
          value="Spanish"
          v-model="form.preferred_language"
        />
        <label class="form-check-label" for="">
          Spanish
        </label>
      </div>
    </div>
     <h3 class="mb-3">
          You will inititate the call. How do you wish to call us?
        </h3>
    <div
      class="form-group mb-2 lato-italic info-detail pb-4 d-none"
      id="call_method_1"
    >       
        <div class="form-check mb-2">
          <input
            class="form-check-input"
            type="radio"
            name="en_call_type"
            value="My service provider"
            v-model="form.en_call_type"
          />
          <label class="form-check-label" for="">
            My service provider
          </label>
        </div>
        <div class="form-check mb-2">
          <input
            class="form-check-input"
            type="radio"
            name="en_call_type"
            value="WhatsApp"
            v-model="form.en_call_type"
          />
          <label class="form-check-label" for="">
            WhatsApp
          </label>
        </div>
        <div class="form-check mb-2">
          <input
            class="form-check-input"
            type="radio"
            name="en_call_type"
            Value="Telegram"
            v-model="form.en_call_type"
          />
          <label class="form-check-label" for="">
            Telegram
          </label>
        </div>
    </div>
      <div
        class="form-group mb-2 lato-italic info-detail pb-4 d-none"
        id="call_method_2"
      >
        <div class="form-check mb-2">
          <input
            class="form-check-input"
            type="radio"
            name="sp_call_type"
            v-model="form.sp_call_type"
            Value="Zoom"
          />
          <label class="form-check-label" for="">
            Zoom
          </label>
        </div>
        <div class="form-check mb-2">
          <input
            class="form-check-input"
            type="radio"
            name="sp_call_type"
            v-model="form.sp_call_type"
            value="Google Meet"
          />
          <label class="form-check-label" for="">
            Google Meet
          </label>
        </div>
      </div>
    <div class="d-lg-flex mb-3">
      <p>The fee is $80 per hour. Select the number of hours:</p>
      <div class="row ml-lg-3 mx-0 align-items-center">
        <select class="form-control col-4" @change="gethourlyCharges($event)">
          <option value="">Select hours</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
          <option value="9">9</option>
          <option value="10">10</option>
        </select>
        <span class="col-2 text-center">=</span>
        <i class="fas fa-dollar-sign additional-sign"></i>
        <input
          type="text"
          class="form-control col-3"
          name="amount_due"
          v-model="form.amount_due"
          readonly
        />
      </div>
    </div>
    <div class="form-group">
      <p class="mb-2">What would you like to talk about during the consultation?</p>
      <textarea
        class="form-control"
        id="exampleFormControlTextarea1"
        name="consulting_about"
        v-model="form.consulting_about"
        rows="3"
        required
      ></textarea>
    </div>
    <p v-if="errors.length" >
       <ul>
       <li style="color:red" v-for="error in errors" :key="error.id">  {{error}} </li>
      </ul>
    </p> 

      <button type="submit" class="btn btn-primary ml-auto">Add to cart</button>
 
  </form>
</template>

<script>
import axios from "axios";

export default {
  name: "PersonalConsultation",

  data() {
    return {
      form: {
        preferred_language: [],
        en_call_type: "",
        sp_call_type: "",
        amount_due: "",
        consulting_about: "",
        type:"order_consultation"
      },
      errors: []
    };
  },
  props: {
    fees: {
      required: true
    }
  },
  methods: {
    gethourlyCharges(event) {
      var amount = this.fees * event.target.value;
      this.form.amount_due = amount;
    },
    addconsultation() {
      this.errors = [];
      if (!this.form.amount_due) {
        this.errors.push("Please select the number of hours for consultation");
        alert("Please fill the required data");
      }
      if (this.form.amount_due) {
              axios
        .post(route("add.cart"), this.form)
        .then(response => {
          window.location = "/cart" 
        })
        .catch(error => {
          alert("Invalid Input");
        });
    }
    }
  }
};
</script>
