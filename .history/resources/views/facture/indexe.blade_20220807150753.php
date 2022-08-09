{{-- @can('client_indexation') --}}
@extends('Layouts.layout')

@section('content')
    <div class="container">
        <div class="row card text-white bg-dark">
            <div class="pull-left">
                <h4 class="card-header">Liste des factures</h4>
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
                            <form>
                                @csrf
                                {{ $factures->name }}<a
                                    href="{{ route('facture.download', ['facture' => $factures->client_id]) }}"
                                    class="btn"><img src="{{ asset('images/bootstrap.svg') }}"
                                        style="background-color:green;" with="10" alt="download" /></a>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
            <a class="btn btn-success" href="{{ route('facture.create') }}">Drop New Facture</a>
        </div>
    </div>
@endsection
