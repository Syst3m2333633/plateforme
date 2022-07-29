@extends('Layouts.layout')

@section('content')
    <div class="container">
        <div class="row card text-white bg-dark">
            <a class="btn btn-primary" href="{{ route('client.index') }}">Retour</a>
            <div class="row">
                <div class="col-md-8">
                    <h1 class="my-4">Résultat de recherche :
                        {{-- <small>{{$client->name}}</small> --}}
                    </h1>
                </div>
            </div>
                    <table>
                        <thead>
                            <tr>
                                <th>raison social</th>
                                <th>email</th>
                                <th>téléphone</th>
                                <th>nom du responsable / contact</th>
                                <th>prénom du responsable / contact</th>
                                @if (auth()->user()->isAn('admin'))
                                    <th>actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $client)
                                <tr>
                                    <td>{{ $client->raisonSocial }}</td>
                                    <td><a href="mailto:{{ $client->email }}">{{ $client->email }}</a></td>
                                    <td><a href="tel:{{ $client->telephone }}">{{ $client->telephone }}</a></td>
                                    <td style="text-align:center;">{{ $client->name }}</td>
                                    <td style="text-align:center;">{{ $client->firstname }}</td>
                                    @if (auth()->user()->isAn('admin'))
                                        <td style="background:white">
                                            <form action="{{ route('client.destroy', ['client' => $client]) }}"
                                                method="POST">
                                                <a class="btn btn-primary"
                                                    href="{{ route('client.edit', ['client' => Str::slug($client->raisonSocial)]) }}">Editer</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                            {{-- <a class="btn btn-danger" href="{{ route('client.destroy', $client->id) }}">Supprimer</a> --}}

                                            {{-- <a class="btn btn-primary" href="{{ route('client.edit', $client->raisonSocial) }}">edit</a> --}}
                                            {{-- <a href="{{ route('client.update' ['client']) }}">Modifier</a> --}}
                                            {{-- <a href="{{ route('user.destroy', ['user' => $client->id]) }}">supprimer</a> --}}
                                            {{-- <form method="POST" action="{{ route('user.update') }}">
                            @csrf
                            @method('PUT') --}}
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

        </div>
    </div>
@endsection
