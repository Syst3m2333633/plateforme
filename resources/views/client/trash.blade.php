@extends('Layouts.layout')

@section('content')
    <div class="container">
        <div class="row card text-white bg-dark">
            <div>
                <h4 class="card-header">Liste des clients supprimer</h4>
            </div>
            <a class="btn btn-primary" href="{{ route('client.index') }}">Retour</a>
            <table>
                <thead>
                    <tr>
                        <th>raison social</th>
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
                            <td>{{ $client->email }}</td>
                            <td>{{ $client->telephone }}</td>
                            <td style="text-align:center;">{{ $client->name }}</td>
                            <td style="text-align:center;">{{ $client->firstname }}</td>
                            <td style="background:white">
                                <a class="btn btn-primary"
                                    href="{{ route('client.restore', ['client' => $client]) }}">Restore</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
