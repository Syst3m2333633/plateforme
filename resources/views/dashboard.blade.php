@extends('layouts.layout')

@section('content')
    <p>User : {{ auth()->user()->name }}; Role : {{ auth()->user()->getRoles() }}</p>

    <br>
    <a href="{{ route('devis.create') }}">Devis & facture</a><br>
    <a href="{{ route('event.create') }}">Evènement</a><br>
    @if (auth()->user()->isAn('admin'))
        <a href="{{ route('client.index') }}">Clients<a>
    @endif
    {{-- <a href="{{ route('sortie.create') }}">Créer une sortie</a> --}}
@endsection
