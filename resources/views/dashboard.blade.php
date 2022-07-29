@extends('layouts.layout')

@section('content')
    {{-- <p style="display:none;" value="\App\Models\Client::all()">
         --}}
         {{-- {{$client = App\Models\Client::all()}} --}}
         {{-- {{$client = auth()->user()->name}} --}}
    {{-- <p>User : {{ auth()->user()->name }}; Role : {{ auth()->user()->getRoles() }}</p>

    <br>
    <a href="{{ route('devis.create') }}">Devis & facture</a><br>
    <a href="{{ route('event.create') }}">Evènement</a><br>
    @if (auth()->user()->isAn('admin'))
    {{-- @can('client_index') --}}
        {{-- <a href="{{ route('client.index') }}">Clients<a><br> --}}
    {{-- @endcan --}}
    {{-- @endif
    <a href="{{ route('client.profil', ['client' => $client]) }}">Profil</a> --}}
    {{-- <a href="{{ route('sortie.create') }}">Créer une sortie</a> --}}
@endsection
