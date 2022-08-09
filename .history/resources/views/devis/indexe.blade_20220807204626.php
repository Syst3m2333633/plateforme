{{-- @can('client_indexation') --}}
@extends('Layouts.layout')

@section('content')
    <div class="container">
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
                        {{-- @dd($clients) --}}
                        <td>{{ $clients->raisonSocial }}</td>
                        <td>
                            <form>
                                @csrf
                                {{-- @dd($devis) --}}
                                {{ $devis->name }} --}}
                                {{-- <a href="{{ route('devis.download', ['devi' => $devis->client_id]) }}"
                                    class="btn"><img src="{{ asset('images/bootstrap.svg') }}"
                                        style="background-color:green;" with="10" alt="download" /></a>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
