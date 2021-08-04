@extends('admin.app')

@section('content')
<section class="content container-fluid  my-1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <div class="rep-list bg-white py-3 px-2 overflow-auto">
        <table class="datatable-pagination table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Name of Rep </th>
                    <th>Country</th>
                    <th>City/Area</th>
                    <th>Rep E-mail</th>
                    <th>Rep Phone</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Name </td>
                    <td>India</td>
                    <td>Dehradun</td>
                    <td class="center">melissa.manisha@ithands.com</td>


                <tr>
                    <td>Name </td>
                    <td>India</td>
                    <td>Dehradun</td>
                    <td class="center">melissa.manisha@ithands.com</td>
                    <td class="center">9789658563875</td>
                </tr>

            </tbody>
        </table>
    </div>

</section>
@endsection