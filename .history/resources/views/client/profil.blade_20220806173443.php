{{-- @can('client_indexation') --}}
@extends('Layouts.layout')

@section('content')
        <div class="container">
            <div class="row card text-white bg-dark">

                <div class="pull-left">
                    <h4 class="card-header">Liste des clients</h4>
                    {{-- {{ $clients->links() }} --}}
                </div>


                <a class="btn btn-primary" href="{{ route('dashboard') }}">Retour</a>

                <table>
                    <caption>Profil</caption>
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
                                {{-- <td><a href="mailto:{{ $client->email }}">{{ $client->email }}</a></td>
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
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>

                </table>


            </div>
        </div>
@endsection
