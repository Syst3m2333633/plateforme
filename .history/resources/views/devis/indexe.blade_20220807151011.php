{{-- @can('client_indexation') --}}
@extends('Layouts.layout')

@section('content')
<div class="container">
    <h1>TOTO</h1>
    <div class="row card text-white bg-dark">
        <div class="pull-left">
            <h4 class="card-header">Liste des devis</h4>
        </div>
        <a class="btn btn-primary" href="{{ route('dashboard') }}">Retour</a>
        <table>
            <thead>
                <tr>
                    <th>raison social</th>
                    <th>intitulé</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td>{{ $clients->raisonSocial }}</td>
                        <td>
                                {{-- @if ($clients->id == $devis->client_id) --}}
                                    <form>
                                        @csrf
                                        {{-- ligne fonctionnelle --}}
                                        {{ $devi->name }}<a href="{{ route('devis.download', ['devi' => $devis->client_id])}}" class="btn"><img src="{{ asset('images/bootstrap.svg')}}" style="background-color:green;" with="10" alt="download"/></a>
                                    </form>
                                    {{-- @endif --}}
                        </td>
                    </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
