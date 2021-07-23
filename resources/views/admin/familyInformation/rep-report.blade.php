<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation Letter</title>
</head>

<body>
    <section class="content container-fluid  my-1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <div class="rep-report bg-white py-3 px-2 overflow-auto">
            <h3>Nmae of Representative: Gustvao Gonzalez ARG:</h3>
            <h3>Family Referred:</h3>
            <table class="table table-striped" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Date </th>
                        <th>Family Name</th>
                        <th>Amount Earned</th>
                        <th>Amount Paid</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>12/09/2016</td>
                        <td>Hebert Alex Bascir Norambuena & Flavia Marchla Augero</td>
                        <td>$50</td>
                        <td>$0</td>
                    </tr>
                    <tr>
                        <td>12/09/2016</td>
                        <td>Hebert Alex Bascir Norambuena & Flavia Marchla Augero</td>
                        <td>$50</td>
                        <td>$0</td>
                    </tr>

                </tbody>
                <tfoot class="border-bottom-2">
                    <tr>
                        <td></td>
                        <td class="text-right">Total:</td>
                        <td>$100</td>
                        <td>$0</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="text-right">Balance of Amount Earned minus Amount Paid:</td>
                        <td>$0</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
            <h3>Fees & Other Payments from Account (if any)</h3>
            <table class="table table-striped" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Date Paid</th>
                        <th>Amount</th>
                        <th>Notes</th>
                    </tr>

                </thead>
                <tbody>
                    <tr>
                        <th>?</th>
                        <th></th>
                        <th></th>
                    </tr>
                </tbody>
                <tfoot>
                    <tr class="border-botton-2">
                        <td> Total of fee paid with Client</td>
                        <td> $100</td>
                    </tr>
                    <tr class="border-botton-2">
                        <td>
                            Final Balance in account:
                        </td>
                        <td>$0</td>
                    </tr>
                </tfoot>
            </table>
        </div>

    </section>
</body>

</html>
