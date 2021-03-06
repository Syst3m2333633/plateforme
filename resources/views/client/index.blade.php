{{-- @can('client_indexation') --}}
@extends('Layouts.layout')

@section('content')
    @if (auth()->user()->isAn('admin'))
        <div class="container">
            <div class="row card text-white bg-dark">

                <div class="pull-left">
                    <h4 class="card-header">Liste des clients</h4>
                    {{ $clients->links() }}
                </div>
                <div class="card my-10 bg-dark">
                    <h5 class="card-header bg-dark">Recherche par raison sociale ou nom</h5>

                    <form class="card-body bg-dark" action="{{ url('/search') }}" method="GET" role="search">
                        @csrf
                        <div class="input-group">
                            <input type="search" class="form-control" placeholder="Rechercher..." name="searchClient">
                            <span class="input-group-btn">
                                <button class="btn btn-secondary" type="submit">Go!</button>
                            </span>
                        </div>
                    </form>
                </div>

                <a class="btn btn-primary" href="{{ route('dashboard') }}">Retour</a>

                <table>
                    <thead>
                        <tr>
                            <th>raison social</th>
                            {{-- <th>slug</th> --}}
                            <th>email</th>
                            <th>téléphone</th>
                            <th>nom du responsable / contact</th>
                            <th>prénom du responsable / contact</th>

                            <th>actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clients as $client)
                            <tr>
                                <td>{{ $client->raisonSocial }}</td>
                                {{-- <td>{{ $client->slug }}</td> --}}
                                <td><a href="mailto:{{ $client->email }}">{{ $client->email }}</a></td>
                                <td><a href="tel:{{ $client->telephone }}">{{ $client->telephone }}</a></td>
                                <td style="text-align:center;">{{ $client->name }}</td>
                                <td style="text-align:center;">{{ $client->firstname }}</td>
                                <td style="background:white">
                                    <form action="{{ route('client.destroy', ['client' => $client]) }}" method="POST">
                                        <a class="btn btn-primary"
                                            href="{{ route('client.edit', ['client' => Str::slug($client->raisonSocial)]) }}">Editer</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>

                <a class="btn btn-success" href="{{ route('client.create') }}">Create New Client</a>
                <a class="btn btn-primary" href="{{ route('client.trash') }}">Afficher le contenu de la corbeille</a>
            </div>
        </div>
    @endif
@endsection
