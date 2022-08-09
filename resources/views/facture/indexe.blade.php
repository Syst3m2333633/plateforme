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
                        <td>{{ $client->raisonSocial }}</td>
                        <td>
                            @foreach ($factures as $facture)
                            {{-- @dd($factures) --}}
                            <form>
                                @csrf
                                {{-- @dd($factures->) --}}

                                    {{ $facture->name }}<a
                                        href="{{ route('facture.download', ['facture' => $facture->client_id]) }}"
                                        class="btn"><img src="{{ asset('images/bootstrap.svg') }}"
                                            style="background-color:green;" with="10" alt="download" /></a>
                                        </form>
                                        @endforeach
                            </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
