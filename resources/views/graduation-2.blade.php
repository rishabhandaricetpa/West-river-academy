@extends('layouts.app')

@section('content')
<!-- * =============== Main =============== * -->
<main class="position-relative container form-content mt-4">
    <h1 class="text-center text-white text-uppercase">Graduation application</h1>
    <div class="form-wrap border bg-light py-5 px-25">
        <div class="col-sm-6 pt-4">
            <form>
                <div class="form-group d-sm-flex mb-1">
                    <label for="">Student Name</label>
                    <div>Brown Rice</div>
                </div>
                <div class="form-group d-sm-flex mb-1 pb-1 align-items-center">
                    <input type="radio" name="" id="" value="">
                    <p class="mb-0 pl-2">Graduation</p>
                    <p class="ml-sm-auto mb-0">$395</p>
                </div>
                <div class="form-group d-sm-flex mb-1 border-top pt-4">
                    <input type="radio" name="" id="" value="">
                    <p class="pl-2">Apostille Package for 2 documents (the diploma and the transcript)
                        and Express postage:</p>
                    <p class="ml-sm-auto">$165</p>
                </div>
                <div class="form-group d-sm-flex mb-1 align-items-center">
                    <label for="" class="w-auto px-sm-4 space-pre">What country are the documents to be used for?</label>
                    <div>
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                </div>
                <p class="pt-3">What is the mailing address for the documents?</p>
                <div class="form-group d-sm-flex mb-2">
                    <label for="">Name</label>
                    <div>
                        <input type="text" name="" id="" value="" class="w-100 ml-sm-3 form-control">
                    </div>
                </div>
                <div class="form-group d-sm-flex mb-2">
                    <label for="">Street</label>
                    <div>
                        <input type="text" name="" id="" value="" class="w-100 ml-sm-3 form-control">
                    </div>
                </div>
                <div class="form-group d-sm-flex mb-2">
                    <label for="">City</label>
                    <div>
                        <input type="text" name="" id="" value="" class="w-100 ml-sm-3 form-control">
                    </div>
                </div>
                <div class="form-group d-sm-flex mb-2">
                    <label for="">Country</label>
                    <div>
                        <input type="text" name="" id="" value="" class="w-100 ml-sm-3 form-control">
                    </div>
                </div>
                <div class="form-group d-sm-flex mb-2">
                    <label for="">Postal Code</label>
                    <div>
                        <input type="text" name="" id="" value="" class="w-100 ml-sm-3 form-control">
                    </div>
                </div>
                <div class="d-flex border-top py-3">
                    <span class="text-secondary">Total to Pay</span>
                    <span class="text-secondary ml-auto">$560</span>
                </div>
                <div class="text-right pt-4 border-top">
                    <button type="button" class="btn btn-primary">Add to Cart</button>
                </div>
            </form>
        </div>
    </div>
</main>
<!-- * =============== /Main =============== * -->
@endsection