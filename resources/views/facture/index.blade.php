{{-- @can('client_indexation') --}}
@extends('Layouts.layout')

@section('content')
    @if (auth()->user()->isAn('admin'))
        <div class="container">
            <div class="row card text-white bg-dark">
                <div class="pull-left">
                    <h4 class="card-header">Liste des factures</h4>
                    {{ $clients->links() }}
                </div>

                <a class="btn btn-primary" href="{{ route('dashboard') }}">Retour</a>
                <table>
                    <thead>
                        <tr>
                            <th>raison social</th>
                            <th>intitulé</th>
                            {{-- <th>date du devis</th> --}}
                            {{-- <th>actions</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $client)
                        @if ($client->id %2 === 0)
                        <tr class="bg-secondary">
                        @endif
                                <td>{{ $client->raisonSocial }}</td>
                                <td>
                                    @foreach ($factures as $facture)
                                        @if ($client->id == $facture->client_id)

                                            <form>
                                                @csrf
                                                {{-- ligne fonctionnelle --}}
                                                {{ $facture->name }}<a href="{{ route('facture.download', ['facture' => $facture->client_id])}}" class="btn"><img src="{{ asset('images/bootstrap.svg')}}" style="background-color:green;" with="10" alt="download"/></a>
                                                {{--  --}}
                                                {{-- <a href="{{ route('devis.download', ['devis' => $devi->client_id])}}" class="btn"><img src="{{ asset('images/bootstrap.svg')}}" style="background-color:green;" with="10" alt="download"/></a> --}}
                                            </form>
                                            @endif
                                    @endforeach
                                </td>
                                {{-- <td>{{ $devi->created_at }}</td> --}}
                                {{-- <td style="background:white">
                                    <a href="{{ route('devis.show', ['devi' => $devi->id])}}" class="btn btn-secondary">Download</a> --}}
                                    {{-- <button type="submit" class="btn btn-secondary">Download</button> --}}
                                {{-- </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <a class="btn btn-success" href="{{ route('facture.create') }}">Drop New Facture</a>
            </div>
        </div>
    @endif
@endsection
