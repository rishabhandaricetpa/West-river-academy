<template>
  <form method="POST" @submit.prevent="addPayments()">
          <div class="form-wrap border bg-light py-5 px-25">
             <h2>Billing Address</h2>
                  <div class="form-group d-sm-flex mb-2">
                    <label for="">First Name</label>
                      <div>
                        <input 
                        type="text" 
                        class="form-control"  
                        name="first_name" 
                        v-model="form.billing_address.first_name"
                        required 
                        aria-describedby="emailHelp">
                      </div>
                  </div>

                  <div class="form-group d-sm-flex mb-2">
                    <label for="">Last Name</label>
                      <div>
                        <input type="text" 
                        class="form-control" 
                        name="last_name" 
                        v-model="form.billing_address.last_name"
                        required 
                        aria-describedby="emailHelp">
                      </div>
                  </div>

                  <div class="form-group d-sm-flex mb-2">
                    <label for="">Street</label>
                      <div>
                        <input 
                        type="text" 
                        class="form-control" 
                        name="street" 
                        v-model="form.billing_address.street_address"
                        required 
                        aria-describedby="emailHelp">
                      </div>
                  </div>
                  <div class="form-group d-sm-flex mb-2">
                    <label for="">City</label>
                      <div>
                        <input 
                        type="text" 
                        class="form-control" 
                        name="city" 
                        v-model="form.billing_address.city"
                        required 
                        aria-describedby="emailHelp">
                      </div>
                  </div>
                  <div class="form-group d-sm-flex mb-2">
                    <label for="">State</label>
                      <div>
                        <input type="text" 
                        class="form-control" 
                        name="state" 
                        v-model="form.billing_address.state"
                        required 
                        aria-describedby="emailHelp">
                      </div>
                  </div>
                  <div class="form-group d-sm-flex mb-2">
                    <label for="">Zip Code</label>
                      <div>
                        <input 
                        type="text" 
                        class="form-control" 
                        name="zip_code" 
                        v-model="form.billing_address.zip_code"
                        required aria-describedby="emailHelp">
                      </div>
                  </div>
                  <div class="form-group d-sm-flex">
                  <label for="">Country</label>
                        <div class="col-sm-4 px-0">
                              <select class="form-control" name="country" v-model="form.billing_address.country" required>  
                                  <option v-for="(val, i) in countries" :key="i" >{{val.country}}</option>   
                              </select>
                              </div>
                            </div>
                        </div>

          <div class="form-wrap border bg-light py-5 px-25 mt-2r">
             <h2>Mailing Address</h2>

             <div class="checkbox">
              <label for="sSame" class="sSame"><input type="checkbox" @change="copyBilling" id="sSame" v-model="form.sSame"> Same as Billing Address</label>
              </div>
                  <div class="form-group d-sm-flex mb-2">
                    <label for="">First Name</label>
                      <div>
                        <input 
                        type="text" 
                        class="form-control" 
                        name="first_name" 
                        v-model="form.shipping_address.first_name"
                        aria-describedby="emailHelp">
                      </div>
                  </div>

                  <div class="form-group d-sm-flex mb-2">
                    <label for="">Last Name</label>
                      <div>
                        <input 
                        type="text" 
                        class="form-control" 
                        name="last_name" 
                        v-model="form.shipping_address.last_name"
                        aria-describedby="emailHelp">
                      </div>
                  </div>

                  <div class="form-group d-sm-flex mb-2">
                    <label for="">Street</label>
                      <div>
                        <input 
                        type="text" 
                        class="form-control" 
                        name="street" 
                        v-model="form.shipping_address.street_address"
                        aria-describedby="emailHelp">
                      </div>
                  </div>
                  <div class="form-group d-sm-flex mb-2">
                    <label for="">City</label>
                      <div>
                        <input type="text" 
                        class="form-control" 
                        name="city" 
                        v-model="form.shipping_address.city"
                        aria-describedby="emailHelp">
                      </div>
                  </div>
                  <div class="form-group d-sm-flex mb-2">
                    <label for="">State</label>
                      <div>
                        <input type="text" 
                        class="form-control" 
                        name="state"
                        v-model="form.shipping_address.state" 
                        aria-describedby="emailHelp">
                      </div>
                  </div>
                  <div class="form-group d-sm-flex mb-2">
                    <label for="">Zip Code</label>
                      <div>
                        <input type="text" 
                        class="form-control" 
                        name="zip_code" 
                        v-model="form.shipping_address.zip_code"
                        aria-describedby="emailHelp">
                      </div>
                  </div>
                  <div class="form-group d-sm-flex">
                  <label for="">Country</label>
                      <div class="col-sm-4 px-0">  
                             <select class="form-control" name="country" v-model="form.shipping_address.country" >  
                                  <option v-for="(val, i) in countries" :key="i" >{{val.country}}</option>   
                              </select>                   
                        </div>
                      </div>
                    </div>

      <div class="form-wrap border bg-light py-5 px-25 mt-2r">
             <h2>Email Address</h2>
                  <div class="form-group d-sm-flex mb-2">
                    <label for="">Email</label>
                      <div>
                        <input 
                        type="email" 
                        class="form-control" 
                        name="email" 
                        v-model="form.email" 
                        aria-describedby="emailHelp">
                      </div>
                  </div>
            </div>
                        <div class="form-wrap border bg-light py-5 px-25 mt-2r">
                <h2 class="mb-3">Payment Items</h2>
                <div class="seperator overflow-auto">
            <table class="w-100 table-styling">
            <thead>
              <tr>
                <th>item</th>
                <th>quantity</th>
                <th>price</th>
                <th>total</th>
             </tr>
             </thead>
             <tbody>
             <tr>
                <td>Custom Payment </td>
                <td>1</td>
                <td><i class="fas fa-dollar-sign"></i>{{total.amount}}</td>
                <td><i class="fas fa-dollar-sign"></i>{{total.amount}}</td>
             </tr>
             </tbody>
             <tfoot>
             <tr>
                <td>Total price</td>
                <td><i class="fas fa-dollar-sign"></i>{{total.amount}}</td>
             </tr>
             </tfoot>
             </table>
                </div>
          </div>
          <div class="form-wrap border bg-light py-5 px-25 mt-2r payment-method">
             <h2>Select your method of payment...</h2>
             <h3 class="py-2">pay with</h3>
             <ul class="list-unstyled enlarge-input payment-method">
             <li class="py-3 pl-3">
             <div class="form-check">
              <input 
              class="form-check-input" 
              type="radio" 
              name="payment_type"
              value="Credit Card"
              v-model="form.paymentMethod.payment_type" 
              required
              >
            </div>
            <div class="payment-info"> 
            <h3>Credit Card/Debit Card</h3>
            <p>Your credit card information will be taken on the page</p>
          </div>
             </li>
             <li class="py-3 pl-3">
             <div class="form-check">
              <input 
              class="form-check-input" 
              type="radio" 
              name="payment_type"
              value="Pay Pal"
              v-model="form.paymentMethod.payment_type" 
              >
            </div>
            <div class="payment-info"> 
            <h3>Pay Pal</h3>
            <p>You will be redirected to the PayPal website to complete your payment.</p>
          </div>
             </li>
             <li class="py-3 pl-3">
             <div class="form-check">
              <input 
              class="form-check-input" 
              type="radio" 
              name="payment_type"
              value="Bank Transfer"
              v-model="form.paymentMethod.payment_type" 
              >
            </div>
          <div class="payment-info"> 
            <h3>Bank Transfer</h3>
            <p>Release of enrollment confirmation may be delayed until payment clears.</p>
          </div>
             </li>
             <li class="py-3 pl-3">
             <div class="form-check">
              <input 
              class="form-check-input" 
              type="radio" 
              name="payment_type"
              value="MoneyGram"
              v-model="form.paymentMethod.payment_type" 
              >
            </div>
          <div class="payment-info"> 
            <h3>MoneyGram</h3>
            <p>Release of enrollment confirmation may be delayed until payment clears.</p>
          </div>
             </li>
             <li class="py-3 pl-3">
             <div class="form-check">
              <input 
              class="form-check-input" 
              type="radio" 
              name="payment_type"
              value="Check or Money Order"
              v-model="form.paymentMethod.payment_type" 
              >
            </div>
          <div class="payment-info"> 
            <h3>Check or Money Order</h3>
            <p>Release of enrollment confirmation may be delayed until payment clears.</p>
          </div>
             </li>
             </ul>     
      </div>  
  <div class="form-wrap border bg-light py-2r px-25 mt-2r">
          <a href="#" class="btn btn-primary" >Back</a>
          <button type="submit" class="btn btn-primary ml-3">Continue</button>
        </div>
        </form>
</template>

<script>
import axios from "axios";

export default {
  name: "address",
  data() {
    return {
      form: {
            sSame:false,
            email:this.parents.p1_email,
            paymentMethod:
            {
              payment_type:null
            },
            billing_address:{
            first_name: this.parents.p1_first_name,
            last_name: this.parents.p1_last_name,
            street_address: this.parents.street_address,
            city: this.parents.city,
            state: this.parents.state,
            zip_code: this.parents.zip_code,
            country: this.parents.country,
             },
        shipping_address:{
            first_name: null,
            last_name: null,
            street_address: null,
            city: null,
            state: null,
            zip_code: null,
            country: null,
        }
      },
    };
  },
  props: ['parents', 'countries', 'total'],
  methods: {
      copyBilling() {
      if(this.form.sSame==true) {
        for(let key in this.form.billing_address) {
          this.form.shipping_address[key] = this.form.billing_address[key];
        }
      }
      else{
        for(let key in this.form.shipping_address) {
         this.form.shipping_address[key] ="";
        }
      }
    },
     addPayments() {
      axios
        .post(route("billing.address"), this.form)
        .then((response) => {
            window.location = response.data ? response.data+"/"+this.parents.id:alert(response.message)
        })
        .catch((error) => console.log(error));
    },
  },
};
</script>
