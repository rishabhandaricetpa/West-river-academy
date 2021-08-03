<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rep Report</title>
</head>

<body>

    <section class="content container-fluid  my-1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <div class="rep-report bg-white py-3 px-2 overflow-auto">
            <h3>Name of Representative: {{ $representative }}</h3>
            <h3>Family Referred:</h3>
            <table style="border:1px solid black;margin-bottom:20px;" cellspacing="0" width="100%">
                <thead style="border-bottom: 1px solid grey">
                    <tr>
                        <th style="text-align: left">Date </th>
                        <th style="text-align: left">Family Name</th>
                        <th style="text-align: left">Amount Earned</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($rep_families as $rep_familie)
                    <tr>
                        <td>{{ $rep_familie->created_at }}</td>
                        <td>{{ $rep_familie->p1_first_name }}</td>
                        <td>{{ $rep_familie->amount }}</td>
                    </tr>
                    @endforeach

                </tbody>
                <tfoot style="background-color:grey;">
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="text-right">Total:{{ $calculatedAmount }}</td>
                    </tr>

                </tfoot>
            </table>


            <table class="table table-striped" style="border:1px solid black; margin-bottom:20px;" cellspacing="0" width="100%">
                <thead style="border-bottom: 1px solid grey">
                    <tr>
                        <th style="text-align: left">Notes</th>
                        <th style="text-align: left"></th>
                        <th style="text-align: left">Amount Paid</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($repGroupAmountDetails as $repGroupAmountDetail)
                    <tr>
                        <td>{{ $repGroupAmountDetail->notes }}</td>
                        <td></td>
                        <td>{{ $repGroupAmountDetail->amount }}</td>

                    </tr>
                    @endforeach
                </tbody>
                <tfoot style="background:grey;padding:5px;">
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="text-right">Total:{{ $amountPaid }}</td>

                    </tr>

                </tfoot>
            </table>


            <table cellspacing="0" width="100%">
                <tbody>
                    <tr>
                        <td>
                            <p style="font-size: 20px;color:#004C99">Balance of Amount Earned minus Amount Paid:</p>
                        </td>
                        <td>
                            @if($calculatedAmount > 0)
                            <p style="font-size: 20px;color:#004C99">${{ $calculatedAmount }}</p>
                            @else
                            <p style="font-size: 20px;color:#004C99">{{'-$'. abs($calculatedAmount) }}</p>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>




    </section>
    <html>