@extends('layouts.app')

@section('content')
<!-- * =============== Main =============== * -->
<main class="position-relative container form-content mt-4">
  <h1 class="text-center text-white text-uppercase">Transcript Wizard</h1>
  <form method="POST" action="{{ route('add.cart') }}" >
  @csrf
  <div class="form-wrap border bg-light py-5 px-25 mb-4">
            <h2 class="mb-3">Purchase Transcripts</h2>
            <p>The first transcript created for a student is $80. Additional transcripts in subsequent years are $25.</p>
    <div class="form-wrap border bg-light py-5 px-25 mt-2r">
      <h2 class="mb-3">Transcript Payment Total</h2>
      <table class="w-100 table-styling">
        <tfoot>
          <tr>
            <td class="mb-3">Order total</td>
            <td class="mb-3">${{ $transcript_fee }}</td>
          </tr>
        </tfoot>
      </table>
    </div>
    
    <input type="hidden" name="transcript_id" value="{{$transcript_id}}">
    <input type="hidden" name="type" value="transcript">
    <input type="hidden" name="student_id" value="{{ $student->id }}">
    <div class="form-wrap border bg-light py-5 px-25 mb-4">
      <h2 class="mb-3">Apostille or Notarization</h2>
      <p>Apostilles are optional for international students whose countries are members of The Hague Convention. An Apostille includes notarization. Express Mail is strongly recommended to ensure delivery.</p>
     <div class="d-sm-flex enlarge-input align-items-center seperator pl-4">
      <p class="mb-0 pl-2 pt-3">My transcript needs to be notarized or sent for an Apostille.</p>
     </div>
     <p class="mt-2r">Choose Apostille or Notarization, enter your mailing address, and select your postage option.</p>
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
             <td><input class="form-check-input" type="Radio" name="">
             <h3 class="mb-0 mt-1">Notarization</h3>
             <p class="mb-1">Notarization of a document such as the confirmation of enrollment or transcript.</p>
          </td>
             <td>$20.00</td>
           </tr>
           <tr> 
             <td><input class="form-check-input" type="Radio" name="">
             <h3 class="mb-0 mt-1">Apostille</h3>
             <p class="mb-1">Student in the countries that are members of The Hague Convention can receive an Apostille on documents. Notarization included.</p></td>
             <td>$75.00</td>
           </tr>
           </tbody>
           </table>
           </div>
      <div class="form-group d-sm-flex mb-2 seperator mt-4">
        <label for="">Apostille Country</label>
        <div class="col-sm-2 px-0">
        <select name="" class="form-control" disabled>
            <option>-</option> 
            <option>--</option> 
            <option>--</option>
            <option>--</option> 
            <option>--</option> 
            <option>--</option>
         </select>
        </div>
      </div>
      <h2 class="mb-3 mt-5">Postage</h2>
      <p>Please choose the level of expedited postage or tracking you would like your documents to be mailed to you with. Express mail is highly recommended to ensure receipt of your document. If you don’t order express mail, you risk the document not arriving and having to pay the Apostille fee again. We are not responsible for documents lost in the mail.</p>
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
             <td><input class="form-check-input" type="Radio" name="">
             <h3 class="mb-0 mt-1">Priority Mail International</h3>
             <p class="mb-1">6-10 business days to arrive, customs tracking until it leaves the U.S., but not past that.</p>
          </td>
             <td>$55.00</td>
           </tr>
           <tr> 
             <td><input class="form-check-input" type="Radio" name="">
             <h3 class="mb-0 mt-1">Priority Mail Express International</h3>
             <p class="mb-1">3-5 business days to arrive, tracking door to door, $100 insurance included.</p></td>
             <td>$85.00</td>
           </tr>
           <tr> 
             <td><input class="form-check-input" type="Radio" name="">
             <h3 class="mb-0 mt-1">Priority Mail Express International</h3>
            </td>
             <td>$85.00</td>
           </tr>
           </tbody>
           </table>
           </div>
    </div>
    <div class="form-wrap border bg-light py-5 px-25 mb-4">
      <a href="#" class="btn btn-primary" role="button">cancel</a>
      <button type="submit" class="btn btn-primary">Add to Cart</button>
    </div>
    </form>  
</main>
<!-- * =============== /Main =============== * -->
@endsection
