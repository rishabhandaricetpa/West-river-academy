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
        <h1 style="text-align:center;">West River Academy Representative Status Report</h1>
        <div class="rep-report bg-white py-3 px-2 overflow-auto">
            <h3>Name of Representative: {{ ucfirst($representative) }}</h3>
            @if (count($rep_families) > 1)
                <h3>Families Referred:</h3>
            @else
                <h3>Family Referred:</h3>
            @endif
            <table style="border:1px solid black;margin-bottom:20px;" cellspacing="0" width="100%">
                <thead style="border-bottom: 1px solid grey">
                    <tr>
                        <th style="text-align: left;padding:5px;">Date </th>
                        <th style="text-align: left;padding:5px;">Family Name</th>
                        <th style="text-align: left;padding:5px;">Amount Earned</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($rep_families as $rep_familie)
                        <tr>
                            <td style="padding:5px;">{{ formatDate($rep_familie->created_at) }}</td>
                            <td style="padding:5px;">{{ $rep_familie->p1_first_name }}</td>
                            <td style="padding:5px;">{{ $rep_familie->amount }}</td>
                        </tr>
                    @endforeach

                </tbody>
                <tfoot style="background-color:grey;">
                    <tr>
                        <td style="padding:5px;"></td>
                        <td style="padding:5px;"></td>

                        @if ($totalFamilyAmount > 0)
                            <td style="padding:5px;" class="text-right no-wrap">Total: ${{ $totalFamilyAmount }}</td>
                        @elseif ($totalFamilyAmount == 0)
                            <td style="padding:5px;" class="text-right no-wrap">Total: $0</td>
                        @else
                            <td style="padding:5px;" class="text-right no-wrap">Total: {{ '-$' . abs($totalFamilyAmount) }} </td>
                        @endif
                    </tr>

                </tfoot>
            </table>


            <table class="table table-striped" style="border:1px solid black; margin-bottom:20px;" cellspacing="0"
                width="100%">
                <thead style="border-bottom: 1px solid grey">
                    <tr>
                        <th style="text-align: left;padding:5px;">Notes</th>
                        <th style="text-align: left;padding:5px;"></th>
                        <th style="text-align: left;padding:5px;">Amount Paid</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($repGroupAmountDetails as $repGroupAmountDetail)
                        <tr>
                            <td style="padding:5px;">{{ $repGroupAmountDetail->notes }}</td>
                            <td style="padding:5px;"></td>
                            <td style="padding:5px;">{{ $repGroupAmountDetail->amount }}</td>

                        </tr>
                    @endforeach
                </tbody>
                <tfoot style="background:grey;padding:5px;">
                    <tr>
                        <td style="padding:5px;"></td>
                        <td style="padding:5px;"></td>
                        @if ($amountPaid > 0)
                            <td class="text-right no-wrap" style="padding:5px;">Total: ${{ $amountPaid }}</td>
                        @elseif($amountPaid ==0)
                            <td class="text-right no-wrap" style="padding:5px;">Total: $0</td>
                        @else

                            <td class="text-right no-wrap" style="padding:5px;">Total: {{ '-$' . abs($amountPaid) }} </td>
                        @endif


                    </tr>

                </tfoot>
            </table>


            <table cellspacing="0" width="100%">
                <tbody>
                    <tr>
                        <td style="padding:5px;">
                            <p style="font-size: 20px;color:#004C99">Balance of Amount Earned minus Amount Paid:</p>
                        </td>
                        <td style="padding:5px;">
                            @if ($calculatedAmount > 0)
                                <p style="font-size: 20px;color:#004C99">${{ $calculatedAmount }}</p>
                            @elseif ($calculatedAmount == 0)
                                <p style="font-size: 20px;color:#004C99">$0</p>
                            @else
                                <p style="font-size: 20px;color:#004C99">{{ '-$' . abs($calculatedAmount) }}</p>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>




    </section>
    <html>
