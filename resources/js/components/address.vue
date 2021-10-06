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
            aria-describedby="emailHelp"
          />
        </div>
      </div>

      <div class="form-group d-sm-flex mb-2">
        <label for="">Last Name</label>
        <div>
          <input
            type="text"
            class="form-control"
            name="last_name"
            v-model="form.billing_address.last_name"
            required
            aria-describedby="emailHelp"
          />
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
            aria-describedby="emailHelp"
          />
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
            aria-describedby="emailHelp"
          />
        </div>
      </div>
      <div class="form-group d-sm-flex mb-2">
        <label for="">State</label>
        <div>
          <input
            type="text"
            class="form-control"
            name="state"
            v-model="form.billing_address.state"
            required
            aria-describedby="emailHelp"
          />
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
            required
            aria-describedby="emailHelp"
          />
        </div>
      </div>
      <div class="form-group d-sm-flex">
        <label for="">Country</label>
        <div class="col-sm-4 px-0">
          <select
            class="form-control"
            name="country"
            v-model="form.billing_address.country"
            required
          >
            <option v-for="(val, i) in countries" :key="i">
              {{ val.country }}
            </option>
          </select>
        </div>
      </div>
    </div>

    <div class="form-wrap border bg-light py-5 px-25 mt-2r">
      <h2>Mailing Address</h2>

      <div class="checkbox">
        <label for="sSame" class="sSame"
          ><input
            type="checkbox"
            @change="copyBilling"
            id="sSame"
            v-model="form.sSame"
          />
          Same as Billing Address</label
        >
      </div>
      <div class="form-group d-sm-flex mb-2">
        <label for="">First Name</label>
        <div>
          <input
            type="text"
            class="form-control"
            name="first_name"
            v-model="form.shipping_address.first_name"
            aria-describedby="emailHelp"
          />
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
            aria-describedby="emailHelp"
          />
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
            aria-describedby="emailHelp"
          />
        </div>
      </div>
      <div class="form-group d-sm-flex mb-2">
        <label for="">City</label>
        <div>
          <input
            type="text"
            class="form-control"
            name="city"
            v-model="form.shipping_address.city"
            aria-describedby="emailHelp"
          />
        </div>
      </div>
      <div class="form-group d-sm-flex mb-2">
        <label for="">State</label>
        <div>
          <input
            type="text"
            class="form-control"
            name="state"
            v-model="form.shipping_address.state"
            aria-describedby="emailHelp"
          />
        </div>
      </div>
      <div class="form-group d-sm-flex mb-2">
        <label for="">Zip Code</label>
        <div>
          <input
            type="text"
            class="form-control"
            name="zip_code"
            v-model="form.shipping_address.zip_code"
            aria-describedby="emailHelp"
          />
        </div>
      </div>
      <div class="form-group d-sm-flex">
        <label for="">Country</label>
        <div class="col-sm-4 px-0">
          <select
            class="form-control"
            name="country"
            v-model="form.shipping_address.country"
          >
            <option v-for="(val, i) in countries" :key="i">
              {{ val.country }}
            </option>
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
            aria-describedby="emailHelp"
          />
        </div>
      </div>
    </div>
    <div class="form-wrap border bg-light py-5 px-25 mt-2r">
      <h2>Coupon</h2>
      <div class="form-group d-sm-flex mb-2 col-md-6 px-0">
        <label for="">Enter Code</label>
        <div>
          <input
            type="text"
            class="form-control"
            v-model="couponSelected"
            placeholder="Enter coupon code"
          />
        </div>
      </div>
      <div class="form-group d-sm-flex mt-3">
        <button type="button" class="btn btn-primary" @click="applyCoupon">
          Apply Coupon
        </button>
        <button
          type="button"
          class="btn btn-primary ml-3"
          @click="removeCoupon"
        >
          Remove Coupon
        </button>
      </div>
    </div>
    <div class="form-wrap border bg-light py-5 px-25 mt-2r">
      <h2 class="mb-3">Payment Total</h2>
      <div class="overflow-auto">
        <table class="w-100 table-styling">
          <tfoot>
            <tr>
              <td class="mb-3 pl-0">Order total</td>
              <td>
                <h2 class="mb-3">${{ amount }}</h2>
              </td>
            </tr>
          </tfoot>
        </table>
      </div>
      <p class="font-md">
        All transactions are final and fees are non-refundable without prior
        written agreement. Click
        <a
          href="#"
          type="button"
          data-toggle="modal"
          data-target=".bd-example-modal-lg"
          ><strong>here</strong></a
        >
        for full Refund Policy
        <a href="https://staging.westriveracademy.com/refund-policy"
          >(https://staging.westriveracademy.com/refund-policy)</a
        >
      </p>
    </div>

    <div
      class="modal fade bd-example-modal-lg"
      tabindex="-1"
      role="dialog"
      aria-labelledby="myLargeModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h2 class="modal-title" id="exampleModalLabel">Refund Policy</h2>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="position-relative refund-page bg-white">
              <div class="bg-white position-relative">
                <div class="container">
                  <div class="row">
                    <div class="col-12">
                      <p>
                        WEST RIVER ACADEMY (the “Company”) has a
                        <strong>NO REFUND</strong> policy for its services,
                        products and enrollment.
                      </p>
                      <p>
                        Please note that all transactions are
                        <strong>final</strong> and fees are
                        <strong>non-refundable</strong> unless prior agreement
                        has been made with West River Academy.
                      </p>
                      <p>
                        If you have any questions or concerns, please contact
                        West River Academy at
                        <a href="mailto:Contact@westriveracademy.com"
                          >Contact@westriveracademy.com</a
                        >
                        <strong>PRIOR</strong> to making any payments.
                      </p>
                      <p>
                        <strong>Your Acceptance of These Terms:</strong> By
                        enrolling in West River Academy, you accept the policies
                        and restrictions set forth in this Refund Policy. If you
                        do not agree to this policy, please do not make payments
                        or enroll. This Refund Policy may be revised from time
                        to time by updating this posting. You are bound by any
                        such revisions and should therefore periodically visit
                        this page to review the then current Refund Policy to
                        which you are bound.
                      </p>
                      <p>
                        <em><strong>En Español:</strong></em>
                      </p>
                      <p>
                        WEST RIVER ACADEMY (la “Compañía”) tiene una política de
                        NO REEMBOLSO para sus servicios, productos e
                        inscripción.
                      </p>
                      <p>
                        Tenga en cuenta que todas las transacciones son finales
                        y los honorarios no son reembolsables acuerdo a menos
                        que antes se ha hecho con West River Academy.
                      </p>
                      <p>
                        Si tiene alguna pregunta o inquietud, comuníquese con
                        West River Academy en
                        <a href="mailto:Contact@westriveracademy.com"
                          >Contact@westriveracademy.com</a
                        >
                        ANTES de realizar cualquier pago.
                      </p>
                      <p>
                        <strong>Su aceptación de estos términos:</strong> Al
                        inscribirse en West River Academy, acepta las políticas
                        y restricciones establecidas en esta Política de
                        reembolso. Si no está de acuerdo con esta política, no
                        se inscriba. Esta Política de reembolso puede ser
                        revisada de vez en cuando actualizando esta publicación.
                        Usted está sujeto a dichas revisiones y, por lo tanto,
                        debe visitar periódicamente esta página para revisar la
                        Política de reembolso vigente en ese momento a la que
                        está obligado.
                      </p>
                      <p>Last Updated: September 29, 2021</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="form-wrap border bg-light py-5 px-25 mt-2r payment-method">
      <h2>Select your method of payment...</h2>
      <h3 class="py-2">Pay with</h3>
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
            />
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
              value="PayPal"
              v-model="form.paymentMethod.payment_type"
            />
          </div>
          <div class="payment-info">
            <h3>PayPal</h3>
            <p>
              You will be redirected to the PayPal website to complete your
              payment.
            </p>
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
            />
          </div>
          <div class="payment-info">
            <h3>Bank Transfer</h3>
            <p>
              Release of enrollment confirmation may be delayed until payment
              clears.
            </p>
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
            />
          </div>
          <div class="payment-info">
            <h3>MoneyGram</h3>
            <p>
              Release of enrollment confirmation may be delayed until payment
              clears.
            </p>
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
            />
          </div>
          <div class="payment-info">
            <h3>Check or Money Order</h3>
            <p>
              Release of enrollment confirmation may be delayed until payment
              clears.
            </p>
          </div>
        </li>
      </ul>
    </div>
    <div class="form-wrap border bg-light py-2r px-25 mt-2r">
      <a href="#" class="btn btn-primary">Back</a>
      <button type="submit" class="btn btn-primary ml-3">Continue</button>
    </div>
  </form>
</template>

<script>
import axios from "axios";
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";

export default {
  name: "Address",
  components: {
    "v-select": vSelect
  },
  data() {
    return {
      amount: this.total.amount,
      couponSelected: this.selectedcoupon,
      form: {
        sSame: false,
        email: this.parents.p1_email,
        paymentMethod: {
          payment_type: null
        },
        billing_address: {
          first_name: this.parents.p1_first_name,
          last_name: this.parents.p1_last_name,
          street_address: this.parents.street_address,
          city: this.parents.city,
          state: this.parents.state,
          zip_code: this.parents.zip_code,
          country: this.parents.country
        },
        shipping_address: {
          first_name: null,
          last_name: null,
          street_address: null,
          city: null,
          state: null,
          zip_code: null,
          country: null
        }
      }
    };
  },
  props: ["parents", "countries", "total", "coupons", "selectedcoupon"],
  methods: {
    copyBilling() {
      if (this.form.sSame == true) {
        for (let key in this.form.billing_address) {
          this.form.shipping_address[key] = this.form.billing_address[key];
        }
      } else {
        for (let key in this.form.shipping_address) {
          this.form.shipping_address[key] = "";
        }
      }
    },
    addPayments() {
      axios
        .post(route("billing.address"), this.form)
        .then(response => {
          window.location = response.data
            ? response.data + "/" + this.parents.id
            : alert(response.message);
        })
        .catch(error => console.log(error));
    },
    applyCoupon() {
      if (this.couponSelected === null) {
        return false;
      }
      axios
        .get(route("coupon.apply", this.couponSelected))
        .then(response => {
          if (response.data.status == "success") {
            if (response.data.amount > this.total.amount) {
              this.amount = 1;
            } else {
              this.amount = this.total.amount - response.data.amount;
            }
          } else {
            this.couponSelected = null;
            this.amount = this.total.amount;
          }
        })
        .catch(error => console.log(error));
    },
    removeCoupon() {
      if (this.couponSelected === null) {
        return false;
      }
      axios
        .get(route("coupon.remove", this.couponSelected))
        .then(response => {
          if (response.data.status == "success") {
            if (response.data.amount > this.total.amount) {
              this.amount = 1;
            } else {
              this.amount = this.total.amount - response.data.amount;
            }
          } else {
            this.couponSelected = null;
            this.amount = this.total.amount;
          }
        })
        .catch(error => console.log(error));
    }
  },
  mounted() {
    this.couponSelected !== null ? this.applyCoupon() : "";
    this.couponSelected !== null ? this.removeCoupon() : "";
  }
};
</script>
