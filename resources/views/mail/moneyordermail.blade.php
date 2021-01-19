<p>{{ $user['name'] }}
<p>PAYMENT: Cheque or Money Order<p>
<p>West River Academy<p>
<p>33721 Bluewater Lane<p>
<p>Dana Point, CA 92629</p>
<p>DATE: {{ $date}}
PAYMENT: N/A</p>


<p>BILLING INFORMATION</p>
<p>{{$parent_profile->street_address}}</p>
<p>{{$parent_profile->city}} </p>
<p>{{$parent_profile->state}} </p>
<p>{{$parent_profile->zip_code}} </p>
<p>{{$parent_profile->country}} </p>

<p>-------------------------------------</p>
<p>ITEM: CUSTPAYMENT</p>
<p>Custom Payment</p>
<p>PRICE: ${{$payment->amount}} </p>

