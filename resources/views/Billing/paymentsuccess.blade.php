
@extends('layouts.app')

@section('content')
<body>
    <h1>Payment done successfully</h1>

    </form>
    <form method="post" action="{{route('payment.info',$charges->id)}}">
        @csrf
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Payment Information</h5>
                <h6 class="card-subtitle mb-2 text-muted">Transaction Id: {{$charges->id}}</h6>
                <p class="card-text">Paid Amount: {{$charges->amount}}</p>
                <input type="submit" name="submit" value="Submit">
            </div>
        </div>
    </form>
</body>
@endsection