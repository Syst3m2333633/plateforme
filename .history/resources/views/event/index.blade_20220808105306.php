{{-- @can('client_indexation') --}}
@extends('Layouts.layout')

@section('content')
    @if (auth()->user()->isAn('admin'))
        <div class="container">
            <div class="row card text-white bg-dark">
                <div class="pull-left">
                    <h4 class="card-header">Liste des évenements</h4>
                    {{ $clients->links() }}
                </div>

                <a class="btn btn-primary" href="{{ route('dashboard') }}">Retour</a>
                <table>
                    <thead>
                        <tr>
                            <th>raison social</th>
                            <th>Titre</th>
                            <th>message</th>
                            <th>documents</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $client)
                        @foreach ($events as $event)
                            <tr>
                                @if ($event->client_id != false)

                                <td>{{ $client->raisonSocial }}</td>
                                @endif
                                    {{-- @dd($event) --}}
                                    @if ($client->id == $event->client_id)
                                        <td>{{ $event->titre }}</td>
                                        <td>{{ $event->message }}</td>
                                        <td>
                                            {{ $event->name }}
                                            <a href="{{ route('event.download', ['event' => $event->client_id]) }}" class="btn"><img
                                                    src="{{ asset('images/bootstrap.svg') }}" style="background-color:green;"
                                                    with="10" alt="download"></a>
                                        </td>
                                    @endif
                                </tr>
                                @endforeach
                        @endforeach
                    </tbody>
                </table>
                {{-- <a class="btn btn-success" href="{{ route('devis.create') }}">Drop New Devis</a> --}}
            </div>
        </div>
    @endif
@endsection
