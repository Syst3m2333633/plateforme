@extends('Layouts.layout')

@section('content')
{{-- {{$message}} --}}
<div class="container">
    <div class="row card text-white bg-dark">
        <div>
            <h4 class="card-header">Liste des clients supprimer</h4>
            {{-- {{ $clients->links() }} --}}
            </div>
        <a class="btn btn-primary" href="{{ route('client.index') }}">Retour</a>

        <table>
            <thead>
                <tr>
                    <th>raison social</th><th>email</th><th>téléphone</th>
                    <th>nom du responsable / contact</th><th>prénom du responsable / contact</th><th>actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clients as $client)
                <tr>
                    <td>{{ $client->raisonSocial }}</td><td>{{ $client->email }}</td><td>{{ $client->telephone }}</td>
                    <td style="text-align:center;">{{ $client->name }}</td><td style="text-align:center;">{{ $client->firstname }}</td>
                    <td style="background:white">
                        {{-- <form action ="{{ route('client.restore', $client->id) }}" method="GET"> --}}
                            <a class="btn btn-primary" href="{{ route('client.restore', ['client' => $client]) }}">Restore</a>
                            {{-- <a class="btn btn-secondary" href="{{ route('client.show', $client->raisonSocial) }}">Show</a>
                            <a class="btn btn-primary" href="{{ route('client.edit', $client->raisonSocial) }}">edit</a> --}}
                            {{-- @csrf
                            @method('GET')
                            <button type="submit" class="btn btn-primary">Restore</button> --}}

                        {{-- <a href="{{ route('client.update' ['client']) }}">Modifier</a> --}}
                        {{-- <a href="{{ route('user.destroy', ['user' => $client->id]) }}">supprimer</a> --}}
                        {{-- <form method="POST" action="{{ route('user.update') }}">
                            @csrf
                            @method('PUT')
                             --}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{-- <div class="pull-right" style="background:white;">
        </div> --}}
        {{-- <a class="btn btn-success" href="{{ route('client.create') }}">Create New Client</a>
        <a class="btn btn-primary" href="{{ route('client.withTrash') }}">Afficher le contenu de la corbeille</a> --}}

    </div>
</div>

@endsection
