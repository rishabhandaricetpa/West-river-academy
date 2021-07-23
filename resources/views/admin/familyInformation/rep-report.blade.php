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
            <h3>Nmae of Representative: Gustvao Gonzalez ARG:</h3>
            <h3>Family Referred:</h3>
            <div class="row ">
                <div class="col-lg-8 border-bottom-2 ">
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
                        <tfoot>
                            <tr>
                                <td></td>
                                <td class="text-right">Total:</td>
                                <td>$100</td>
                                <td>$0</td>
                            </tr>

                        </tfoot>
                    </table>
                </div>
                <div class="col-lg-4 border-bottom-2 ">
                    <table class="table table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Amount Paid</th>
                                <th>Notes</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>$0</td>
                                <td>Write a Note here</td>
                            </tr>
                            <tr>
                                <td>$0</td>
                                <td>Write a Note here</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-12 ">
                    <table class="border-bottom-2">
                        <tbody>
                            <tr>
                                <td class="py-2">
                                    <h2 class="mb-0">Balance of Amount Earned minus Amount Paid:</h2>
                                </td>
                                <td>$0</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>



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
    <html>
