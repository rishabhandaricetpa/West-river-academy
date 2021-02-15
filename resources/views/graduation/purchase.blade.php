@extends('layouts.app')

@section('content')
<!-- * =============== Main =============== * -->
<main id="mainapp-purchase" class="position-relative container form-content mt-4">
  <h1 class="text-center text-white text-uppercase">Purchase Graduation</h1>
  <div class="form-wrap border bg-light py-5 px-25">
    <div class="col-sm-6 pt-4">
        <form @submit.prevent ref="form" method="POST" action="{{ route('add.cart') }}" >
            @csrf
            <div class="form-group d-sm-flex mb-1">
                <label for="">Student Name</label>
                {{ $student->fullname }}
            </div>
            <div class="form-group d-sm-flex mb-1 pb-1 align-items-center">
                <input type="hidden" name="student_id" value="{{ $student->id }}">
                <p class="mb-0 pl-2">Graduation</p>
                <p class="ml-sm-auto mb-0">${{ $graduation_fee }}</p>
            </div>
            @if ($student->parentProfile->country !== 'United States')
                <div class="form-group d-sm-flex mb-1 border-top pt-4">
                    <input type="radio" v-on:click.once="changeTotal" name="apostille" v-model="apostille" value="yes">
                    <p class="pl-2">Apostille Package for 2 documents (the diploma and the transcript) and Express postage:</p>
                    <p class="ml-sm-auto">${{ $apostille_fee }}</p>
                </div>
                <div class="form-group d-sm-flex mb-1 align-items-center">
                    <label for="" class="w-auto px-sm-4 space-pre">What country are the documents to be used for?</label>
                    <select class="form-control" v-model="apostilleCountry" id="apostille_country" name="apostille_country">
                        <option value="">Select country</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->country }}">{{ $country->country }}</option>
                        @endforeach
                    </select>
                </div> 
            @endif
            <p class="pt-3">What is the mailing address for the documents?</p>
            <div class="form-group d-sm-flex mb-2">
                <label for="name">Name</label>
                <div>
                   <input type="text" name="name" id="name" value="{{ $student->graduationAddress->name ?? '' }}" class="w-100 ml-sm-3 form-control">
                </div>
            </div>
            <div class="form-group d-sm-flex mb-2">
                <label for="street">Street</label>
                <div>
                   <input type="text" name="street" id="street" value="{{ $student->graduationAddress->street ?? '' }}" class="w-100 ml-sm-3 form-control">
                </div>
            </div>           
             <div class="form-group d-sm-flex mb-2">
                <label for="city">City</label>
                <div>
                   <input type="text" name="city" id="city" value="{{ $student->graduationAddress->city ?? '' }}" class="w-100 ml-sm-3 form-control">
                </div>
            </div>           
             <div class="form-group d-sm-flex mb-2">
                <label for="gcountry">Country</label>
                <div>
                   <input type="text" name="country" id="gcountry" value="{{ $student->graduationAddress->country ?? '' }}" class="w-100 ml-sm-3 form-control">
                </div>
            </div>
            <div class="form-group d-sm-flex mb-2">
                <label for="postal_code">Postal Code</label>
                <div>
                   <input type="text" name="postal_code" id="postal_code" value="{{ $student->graduationAddress->postal_code ?? '' }}" class="w-100 ml-sm-3 form-control">
                </div>
            </div>
            <div class="d-flex border-top py-3">
                <span class="text-secondary">Total to Pay</span>
                <span class="text-secondary ml-auto">$ @{{ total }} </span>
            </div>
            <div class="text-right pt-4 border-top">
            <input type="hidden" name="type" value="graduation">
            <button type="submit" v-on:click="validate()" class="btn btn-primary">Add to Cart</button>
     </div>
       </form>
   </div>
    </div>
</main>
<!-- * =============== /Main =============== * -->
@endsection
@section('manualscript')
<script>
    const graduationApp = new Vue({
        el: '#mainapp-purchase',
        data() {
            return {
                apostille: null,
                apostilleCountry: '',
                total: {{ $graduation_fee }},
            }
        },
        methods:{
            validate(){
                if(this.apostille !== null && this.apostilleCountry === ''){
                    alert('Please choose Country!')
                    return false;
                }
                this.$refs.form.submit();
            },
            changeTotal(){
                this.total = this.total + {{ $apostille_fee }};
            }
        }
    });
</script>
@endsection