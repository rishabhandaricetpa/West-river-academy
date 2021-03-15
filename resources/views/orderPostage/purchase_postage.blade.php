@extends('layouts.app')

@section('content')
<!-- * =============== Main =============== * -->
<main class="position-relative container form-content mt-4">
    <div class="form-wrap border bg-light py-5 px-25 mb-4">
        <h2 class="mb-3 mt-5">Postage</h2>
        <p>Please choose the level of expedited postage or tracking you would like your documents to be mailed to you with. Express mail is highly recommended to ensure receipt of your document. If you don’t order express mail, you risk the document not arriving and having to pay the Apostille fee again. We are not responsible for documents lost in the mail.</p>
        <form method="POST" action="{{ route('add.cart') }}">
            @csrf
            <input type="hidden" name="type" id="postage" value="postage" class="w-100" step="0.01">
            <div class="overflow-auto mb-2">
                <table class="table-styling w-100 enlarge-input">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Price (each)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input class="form-check-input" type="Radio" name="payment_for" value="priority_international">
                                <h3 class="mb-0 mt-1">Priority Mail International</h3>
                                <p class="mb-1">6-10 business days to arrive, customs tracking until it leaves the U.S., but not past that.</p>
                            </td>
                            <td>${{ getFeeDetails('priority_international') }}</td>
                        </tr>
                        <tr>
                            <td><input class="form-check-input" type="Radio" name="payment_for" value="express_international" required>
                                <h3 class="mb-0 mt-1">Priority Mail Express International</h3>
                                <p class="mb-1">3-5 business days to arrive, tracking door to door, $100 insurance included.</p>
                            </td>
                            <td>${{ getFeeDetails('express_international') }}</td>
                        </tr>
                        <tr>
                            <td><input class="form-check-input" type="Radio" name="payment_for" value="united_postal_service">
                                <h3 class="mb-0 mt-1">United Postal Service (UPS)</h3>
                                <p class="mb-1">6-10 business days to arrive, customs tracking until it leaves the U.S., but not past that.</p>
                            </td>
                            <td>${{ getFeeDetails('united_postal_service') }}</td>
                        </tr>
                        <tr>
                            <td><input class="form-check-input" type="Radio" name="payment_for" value="global_guaranteed_international">
                                <h3 class="mb-0 mt-1">Global Express Guaranteed</h3>
                                <p class="mb-1">6-10 business days to arrive, customs tracking until it leaves the U.S., but not past that.</p>
                            </td>
                            <td>${{ getFeeDetails('global_guaranteed_international') }}</td>
                        </tr>
                        <tr>
                            <td><input class="form-check-input" type="Radio" name="payment_for" value="priority_usa">
                                <h3 class="mb-0 mt-1">USA Domestic Priority Mail</h3>
                            </td>
                            <td>${{ getFeeDetails('priority_usa') }}</td>
                        </tr>
                        <tr>
                            <td><input class="form-check-input" type="Radio" name="payment_for" value="express_usa">
                                <h3 class="mb-0 mt-1">USA Domestic Priority Mail Express</h3>
                            </td>
                            <td>${{ getFeeDetails('express_usa') }}</td>
                        </tr>
                        <tr>
                            <td><input class="form-check-input" type="Radio" name="payment_for" value="usa_domestic_prioirity_mail">
                                <h3 class="mb-0 mt-1">USA Domestic First Class Mail</h3>
                            </td>
                            <td>${{ getFeeDetails('usa_domestic_prioirity_mail') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
    </div>
    <div class="form-wrap border bg-light py-5 px-25 mb-4">
        <a href="/dashboard" class="btn btn-primary" role="button">cancel</a>
        <button type="submit" class="btn btn-primary">Add to Cart</button>
    </div>
    </form>
</main>
@endsection