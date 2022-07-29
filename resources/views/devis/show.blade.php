@extends('Layouts.layout')

@section('content')
   <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Devis Table</h2>
                <table class="table table-bordered table-striped">
                    <caption>Tableau des devis</caption>
                    <thead>
                        <th>Devis</th>
                        <th>File Name</th>
                        <th>File size (Mo)</th>
                        <th>Date Uploaded</th>
                        {{-- <th>File Location</th> --}}
                        <th>Action</th>
                    </thead>
                    <tbody>
                        {{-- @dd($devi) --}}
                        {{-- @foreach($devis as $devi) --}}
                        <tr>
                            @dump($devis)
                            <td></td>
                            <td>{{$devis}}</td>
                            <td></td><td></td>
                            {{-- <td>{{$devi->size}}</td> --}}
                            {{-- <td>{{$devi->created_at}}</td> --}}
                            {{-- <td>{{$devi->location}}</td> --}}
                            <td><a href="{{ asset('app/{{-- . $devi->client->slug . --}}devis'/*, $documentName*/) }}">Download</a></td>
                        </tr>
                        {{-- @endforeach --}}
                    <tbody>
                </table>
            </div>
        </div>
   </div>
@endsection
