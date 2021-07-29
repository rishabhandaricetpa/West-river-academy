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
            <h3>Name of Representative: Gustvao Gonzalez ARG:</h3>
            <h3>Family Referred:</h3>
                    <table  style="border:1px solid black;margin-bottom:20px;" cellspacing="0" width="100%">
                        <thead  style="border-bottom: 1px solid grey">
                            <tr>
                                <th style="text-align: left">Date </th>
                                <th style="text-align: left">Family Name</th>
                                <th style="text-align: left">Amount Earned</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>12/09/2016</td>
                                <td>Hebert Alex Bascir Norambuena & Flavia Marchla Augero</td>
                                <td>$50</td>
                            </tr>
                            <tr>
                                <td>12/09/2016</td>
                                <td>Hebert Alex Bascir Norambuena & Flavia Marchla Augero</td>
                                <td>$50</td>
                            </tr>

                        </tbody>
                        <tfoot style="background-color:grey;">
                            <tr>
                                <td></td>
                                <td class="text-right">Total:</td>
                                <td>$100</td>
                            </tr>

                        </tfoot>
                    </table>
            
              
                    <table class="table table-striped" style="border:1px solid black; margin-bottom:20px;" cellspacing="0" width="100%">
                        <thead  style="border-bottom: 1px solid grey">
                            <tr>
                                <th style="text-align: left">Amount Paid</th>
                                <th style="text-align: left">Notes</th>
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
                        <tfoot style="background:grey;padding:5px;">
                            <tr>
                                <td class="text-right">Total:</td>
                                <td></td>
                            </tr>

                        </tfoot>
                    </table>
           

                    <table cellspacing="0" width="100%">
                        <tbody>
                            <tr>
                                <td>
                                    <p style="font-size: 20px;color:#004C99">Balance of Amount Earned minus Amount Paid:</p>
                                </td>
                                <td> <p style="font-size: 20px;color:#004C99">$0</p></td>
                            </tr>
                        </tbody>
                    </table>
          
            <table style="border:1px solid black;margin-bottom:20px;" cellspacing="0" width="100%">
                <thead  style="border-bottom: 1px solid grey">
                    <tr>
                        <th style="text-align: left;">Date Paid</th>
                        <th style="text-align: left;">Amount</th>
                        <th style="text-align: left;">Notes</th>
                    </tr>

                </thead>
                <tbody>
                    <tr>
                        <th>?</th>
                        <th></th>
                        <th></th>
                    </tr>
                    <tr class="border-botton-2">
                        <td> Total of fee paid with Client</td>
                        <td> $100</td>
                        <td></td>
                    </tr>

                </tbody>
                <tfoot style="background:grey;padding:5px;">
                   
                    <tr class="border-botton-2">
                        <td></td>
                        <td>
                            Final Balance in account:
                        </td>
                        <td>$0</td>
                    </tr>
                </tfoot>
            </table>
      

    </section>
    <html>
