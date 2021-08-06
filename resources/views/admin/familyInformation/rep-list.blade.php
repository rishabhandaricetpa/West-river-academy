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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($all_reps as $rep)
                <tr>
                    <td><a href="{{route('admin.rep.details',$rep->id)}}"> {{$rep->name}} </a></td>
                    <td>{{$rep->country}}</td>
                    <td>{{$rep->city}}</td>
                    <td class="center">{{$rep->email}}</td>
                    <td><a class="nav-link" href="{{route('admin.delete.rep',$rep->id)}}" onclick="return confirm('Are you sure you want to delete this representative?');" aria-controls="documents" aria-selected="true"><i class="fas fa-trash-alt"></i></a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</section>
@endsection